<?php

namespace App\Controllers;

use App\Models\UsuarioModelo;
use App\Models\HorarioModelo;
use CodeIgniter\Controller;
use App\Models\PacienteModel;
use App\Models\EspecialidadModel;
use App\Models\EstadoModel;
use App\Models\TurnoModel;

class RecepcionControlador extends BaseController
{
    public function __construct()
    {
        $session = \Config\Services::session();
        if (!$session->get('is_logged_in')) {
            return redirect()->to('/login');
        }
    }
    public function index()
    {
        $session = \Config\Services::session();
        if ($session->get('user_id')) {
            $rol = $session->get('user_rol');
            if ($rol == 3 && $rol == 2) {
                $pacienteModel = new PacienteModel();
                $turnoModel = new TurnoModel();
                $data['pacientes'] = $pacienteModel->findAll();
                $data['turnos'] = $turnoModel->findAll();

                $userRol = $session->get('user_rol');
                $data['showAdmin'] = ($userRol == 2);
                $data['showMedico'] = ($userRol == 4);
                echo view('layout/navbar', $data);
                return view('Recepcion');
            } else {
                return redirect()->to('#');
            }
        } else {
            return redirect()->to('/');
        }
    }
    public function indexMed() 
    {
        $session = \Config\Services::session();
        $usuarioModelo = new UsuarioModelo();
        $horarioModelo = new HorarioModelo();
        $medicos = $usuarioModelo->where('id_rol', 4)->findAll();
        $horarios = $horarioModelo->findAll();

        $data = [
            'medicos' => $medicos,
            'horarios' => $horarios,
        ];

        $userRol = $session->get('user_rol'); 
        $data['showAdmin'] = ($userRol == 2); 
        $data['showMedico'] = ($userRol == 4);
        echo view('layout/navbar', $data);
        return view('crudMedico', $data);
    }
    public function newMedVista()
    {
        $session = \Config\Services::session();
        $usuario = new UsuarioModelo();
        $espec = new EspecialidadModel();

        $data['usuarios'] = $usuario->findAll();
        $data['especialidades'] = $espec->findAll();

        $userRol = $session->get('user_rol'); 
        $data['showAdmin'] = ($userRol == 2);
        $data['showMedico'] = ($userRol == 4);
        echo view('layout/navbar', $data);
        return view('nuevoMedico', $data);
    }
    public function newMed()
    {
        $session = \Config\Services::session();
        $usuarioModelo = new UsuarioModelo();

        $data = [
            'id_Usuario' => $this->request->getPost('id_Usuario'),
            'id_especialidad' => $this->request->getPost('especialidad'),
            'id_rol' => 4
        ];
        $usuarioModelo->editarUsuario($data);
        return redirect()->to('crudPaciente');
    }
    public function delMed($id)
    {
        $usuarioModelo = new UsuarioModelo();

        $data = [
            'id_especialidad' => null,
            'id_rol' => 1
        ];
        $usuarioModelo->update($id, $data);
        return redirect()->to('crudPaciente');
    }
    public function horMed($id = null) 
    {
        $session = \Config\Services::session();
        $UsuarioModelo = new UsuarioModelo();
        $data['medicos'] = $UsuarioModelo->where('id_rol', 4)->findAll();
        $data['horarios'] = [];

        if ($id) {
            $HorarioModelo = new HorarioModelo();
            $data['usuario'] = $UsuarioModelo->find($id);
            $data['horarios'] = $HorarioModelo->where('id_usuario', $id)->findAll();
        }

        $userRol = $session->get('user_rol'); 
        $data['showAdmin'] = ($userRol == 2); 
        $data['showMedico'] = ($userRol == 4);
        echo view('layout/navbar', $data);
        return view('HorarioMedico', $data);
    }
    public function guardarHorario() 
    {
        $session = \Config\Services::session();
        $HorarioModelo = new HorarioModelo();
        $UsuarioModelo = new UsuarioModelo();
        $emailMed = $session->get('emailMed');
        if ($emailMed) {
            $medico_id = $UsuarioModelo->where('email', $emailMed)->first();
        } else {
            $medico_id = $this->request->getPost('doctor_id');
        }
        $dia = $this->request->getPost('day');
        $hora_inicio = $this->request->getPost('start_time');
        $hora_final = $this->request->getPost('end_time');


        $data = [
            'id_usuario' => $medico_id['id_Usuario'],
            'dia_sem' => $dia,
            'hora_inicio' => $hora_inicio,
            'hora_final' => $hora_final,
        ];

        $HorarioModelo->insertData($data);
        return redirect()->to('pagina');
    }
    public function deleteHorario($id)
    {
        $horarioModel = new HorarioModelo();
        $horarioModel->deleteHorario($id);

        return redirect()->to('crudMeds');
    }
    public function turnoDisp() 
    {
        $HorarioModelo = new HorarioModelo();
        $TurnoModelo = new TurnoModel();
        $UsuarioModelo = new UsuarioModelo();

        $medicos = $UsuarioModelo->where('id_rol', 4)->findAll();

        $fecha_turno = $this->request->getPost('fecha_turno');
        $id_Medico = $this->request->getPost('id_Medico');

        $horarios_disponibles = [];

        if ($fecha_turno && $id_Medico) {
            $horarios = $HorarioModelo->where('id_usuario', $id_Medico)->findAll();

            $turnos_reservados = $TurnoModelo
                ->where('id_Usuario', $id_Medico)
                ->where('fecha_turno', $fecha_turno)
                ->findAll();

            $reservados = [];
            foreach ($turnos_reservados as $turno) {
                $reservados[] = $turno['id_Horario'];
            }

            foreach ($horarios as $horario) {
                if (!in_array($horario['id_Horario'], $reservados)) {
                    $horarios_disponibles[] = $horario;
                }
            }
        }

        $data = [
            'medicos' => $medicos,
            'horarios_disponibles' => $horarios_disponibles,
            'fecha_turno' => $fecha_turno,
            'id_Medico' => $id_Medico,
        ];

        return view('turno_disponible', $data);
    }

    private function calculateAllSlots($horarios) 
    {
        $slotsData = [];

        foreach ($horarios as $medicoId => $Hor) {
            foreach ($Hor as $horario) {
                $dia_sem = $horario['dia_sem'];
                $hora_inicio = $horario['hora_inicio'];
                $hora_final = $horario['hora_final'];

                $slotsData[$medicoId][$dia_sem][] = $this->calculateAvailableSlots($hora_inicio, $hora_final);
            }
        }

        return $slotsData;
    }

    private function calculateAvailableSlots($hora_inicio, $hora_final) 
    {
        $slots = [];
        $start = new \DateTime($hora_inicio);
        $end = new \DateTime($hora_final);

        while ($start < $end) {
            $slot_end = clone $start;
            $slot_end->modify('+30 minutes');

            if ($slot_end <= $end) {
                $slots[] = [
                    'start' => $start->format('H:i'),
                    'end' => $slot_end->format('H:i'),
                ];
            }

            $start->modify('+30 minutes');
        }

        return $slots;
    }
    public function formMed()
    {
        $session = \Config\Services::session();
        $EspecialidadModelo = new EspecialidadModel();
        $especialidades = $EspecialidadModelo->findAll();
        $userRol = $session->get('user_rol');
        $data['showAdmin'] = ($userRol == 2);
        $data['showMedico'] = ($userRol == 4);
        echo view('layout/navbar', $data);
        return view('formMedico', ['especialidades' => $especialidades]);
    }
    public function nuevoMed()
    {
        $session = \Config\Services::session();
        $HorarioModelo = new HorarioModelo();
        $UsuarioModelo = new UsuarioModelo();

        $name = $this->request->getPost('nombre');
        $email = $this->request->getPost('email');
        $session->set('emailMed', $email);
        $password = $this->request->getPost('password');
        $imagen = $this->request->getPost('imagen_ruta');
        $idEspecialidad = $this->request->getPost('especialidad');
        $id_rol = 4;
        $horarios = $this->request->getPost('horarios');

        $existingEmail = $UsuarioModelo->where('email', $email)->first();
        if ($existingEmail) {
            return redirect()->back()->with('error', 'El email ya está registrado.')->withInput();
        }


        if ($name) {

            if (preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]*$/", $name)) {
                echo "El nombre es válido: " . htmlspecialchars($name);
            } else {
                return redirect()->back()->with('error', 'El nombre no puede contener numeros.')->withInput();
            }
        }
        $existingName = $UsuarioModelo->where('nombre', $name)->first();
        if ($existingName) {
            return redirect()->back()->with('error', 'El nombre de usuario ya está registrado.')->withInput();
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        if (empty($imagen)) {
            $imagen = '/img/medico_imagen.png';
        }

        $data = [
            'nombre' => $name,
            'email' => $email,
            'password' => $hashedPassword,
            'id_rol' => $id_rol,
            'imagen_ruta' => $imagen,
            'id_especialidad' => $idEspecialidad,

        ];
        $id_user = $UsuarioModelo->insert($data);

        return redirect()->to('horario_medico');
    }
    public function deleteMedico($id)
    {
        $id_Usuario = $this->request->getPost('id_Usuario');
        if ($id_Usuario) {
            $usuarioModelo = new UsuarioModelo();

            $usuarioModelo->deleteAdmin($id);

            return redirect()->to('crudMeds');
        }
    }
    public function perfilMedico()
    {
        $session = \Config\Services::session();
        $idUsuario = $session->get('user_id');
        $UsuarioModelo = new UsuarioModelo();
        $EspecialidadModelo = new EspecialidadModel();
        $HorarioModel = new HorarioModelo();

        $medico = $UsuarioModelo->find($idUsuario);
        $horarios = $HorarioModel->where('id_usuario',$idUsuario)->findAll();


        if (!$medico) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Médico no encontrado');
        }

        $especialidad = $EspecialidadModelo->find($medico['id_especialidad']);

        return view('datosMedico', [
            'medico' => $medico,
            'especialidad' => $especialidad,
            'horarios' => $horarios
        ]);
    }





    public function turnosMedico()
    {
        $session = \Config\Services::session();
        $turnoModel = new TurnoModel();
        $pacienteModel = new PacienteModel();
        $estadoModel = new EstadoModel();

        $idMedico = $session->get('user_id');

        $turnos = $turnoModel->where('id_Usuario', $idMedico)->findAll();

        $estados = $estadoModel->findAll();

        $fechaActual = date('Y-m-d');

        $turnos = $turnoModel->where('id_Usuario', $idMedico)
            ->where('fecha_turno >=', $fechaActual)
            ->orderBy('fecha_turno', 'ASC')
            ->findAll();

        //$horarios = $HorarioModel->where('id_Horario', $turnos['id_Horario'])->findAll();

        $estadosMap = array_column($estados, 'estado', 'id_Estado');

        $turnosPorDia = [];
        foreach ($turnos as $turno) {

            $dia = date('Y-m-d', strtotime($turno['id_Horario']));

            $paciente = $pacienteModel->find($turno['id_Paciente']);
            $turno['Paciente'] = $paciente ? $paciente['nombre'] : 'Desconocido';

            $turno['estado'] = $estadosMap[$turno['id_estado']] ?? 'Desconocido';


            $turnosPorDia[$dia][] = $turno;
        }
        $diasSemana = [
            1 => 'Lunes',
            2 => 'Martes',
            3 => 'Miércoles',
            4 => 'Jueves',
            5 => 'Viernes',
            6 => 'Sábado',
            7 => 'Domingo'
        ];

        ksort($turnosPorDia);

        $data['turnosPorDia'] = $turnosPorDia;
        $data['diasSemana'] = $diasSemana;

        return view('turnosMedico', $data);
    } 
    public function cancelarTurnosMedico(){
        $turnoModel = new TurnoModel();
        $estadoModel = new EstadoModel();
    
        
        $idTurno = $this->request->getPost('id_turno');
    
        
        $estadoCancelado = $estadoModel->where('estado', 'cancelado')->first();
    
        if ($estadoCancelado) {
            
            $turnoModel->update($idTurno, ['id_Estado' => $estadoCancelado['id_Estado']]);
    
            
            return redirect()->back()->with('success', 'El turno ha sido cancelado exitosamente.');
        } else {
           
            return redirect()->back()->with('error', 'El estado "cancelado" no existe en la base de datos.');
        }
    }
}
