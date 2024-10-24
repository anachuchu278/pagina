<?php
namespace App\Controllers;
use App\Models\UsuarioModelo;
use App\Models\HorarioModelo;
use CodeIgniter\Controller;
use App\Models\PacienteModel;
use App\Models\EspecialidadModel;
use App\Models\TurnoModel;

class RecepcionControlador extends BaseController{
    public function index(){
        $session = \Config\Services::session();
        if ($session->get('user_id')) {
            $rol= $session->get('user_rol');
            if ($rol == 3 && $rol == 2) {
                $pacienteModel = new PacienteModel();
                $turnoModel = new TurnoModel();
                $data['pacientes'] = $pacienteModel->findAll();
                $data['turnos'] = $turnoModel->findAll();
    
                echo view('layout/navbar.css');
                return view('Recepcion');
            } else {
                return redirect()->to('#');
            }
        } else {
            return redirect()->to('/');
        }
    }
    public function indexMed() // Vista para el crud de Medicos 
    {
        $session = \Config\Services::session();
        $usuarioModelo = new UsuarioModelo();
        $horarioModelo = new HorarioModelo();
        $medicos = $usuarioModelo->where('id_rol', 4)->findAll();
        $horarios = $horarioModelo->findAll();

        // Preparar datos para la vista
        $data = [
            'medicos' => $medicos,
            'horarios' => $horarios,
        ];

        $userRol = $session->get('user_rol'); // Cambiar a 'user_rol' en lugar de 'user_id_rol'
        $data['showAdmin'] = ($userRol == 2); // Simplificar la lógica para mostrar el admin
        echo view('layout/navbar',$data);
        return view('crudMedico', $data);
    }
    public function newMedVista()
    {
        $session = \Config\Services::session();
        $usuario = new UsuarioModelo();
        $espec = new EspecialidadModel();

        $data['usuarios'] = $usuario->findAll();
        $data['especialidades'] = $espec->findAll();

        $userRol = $session->get('user_rol'); // Cambiar a 'user_rol' en lugar de 'user_id_rol'
        $data['showAdmin'] = ($userRol == 2); // Simplificar la lógica para mostrar el admin
        echo view('layout/navbar.php', $data);
        return view('nuevoMedico', $data);
    }
    public function newMed()
    {
        $session = \Config\Services::session();
        $usuarioModelo= new UsuarioModelo();

        $data=[
            'id_Usuario' => $this->request->getPost('id_Usuario'),
            'id_especialidad' => $this->request->getPost('especialidad'),
            'id_rol' => 4
        ];
        $usuarioModelo->editarUsuario($data);
        return redirect()->to('crudPaciente');
    }
    public function delMed($id)
    {
        $usuarioModelo= new UsuarioModelo();

        $data=[
            'id_especialidad'=> null,
            'id_rol'=> 1
        ];
        $usuarioModelo->update($id, $data);
        return redirect()->to('crudPaciente');
    }
    public function horMed($id = null) //Vista para añadir horarios
    {
        $session = \Config\Services::session();
        // Obtener médicos con rol 3
        $UsuarioModelo = new UsuarioModelo();
        $data['medicos'] = $UsuarioModelo->where('id_rol', 4)->findAll();
        $data['horarios'] = [];

        if ($id){
            $HorarioModelo = new HorarioModelo();
            $data['usuario'] = $UsuarioModelo->find($id);
            $data['horarios'] = $HorarioModelo->where('id_usuario', $id)->findAll();
        }

        $userRol = $session->get('user_rol'); // Cambiar a 'user_rol' en lugar de 'user_id_rol'
        $data['showAdmin'] = ($userRol == 2); // Simplificar la lógica para mostrar el admin
        echo view('layout/navbar.php', $data);
        return view('HorarioMedico', $data);
    }
    public function guardarHorario() //funcion que añade horarios
    {
        $HorarioModelo = new HorarioModelo();
        $UsuarioModelo = new UsuarioModelo();        
        $medico_id = $this->request->getPost('doctor_id');
        $dia = $this->request->getPost('day');
        $hora_inicio = $this->request->getPost('start_time');
        $hora_final = $this->request->getPost('end_time');
        
        $data = [
            'id_usuario' => $medico_id,
            'dia_sem' => $dia,
            'hora_inicio' => $hora_inicio,
            'hora_final' => $hora_final,
        ];
        
        $HorarioModelo->insertData($data);
        return redirect()->to('');
    }
    public function deleteHorario($id)
    {
        $horarioModel = new HorarioModelo();
        $horarioModel->deleteHorario($id);

        return redirect()->to('crudMeds');
    }
    public function turnoDisp() // Vista de turnos disponibles
    {
        $HorarioModelo = new HorarioModelo();
        $UsuarioModelo = new UsuarioModelo();        
        $medicos = $UsuarioModelo->where('id_rol', 4)->findAll();

        // Obtener horarios para cada médico
        $horarios = [];
        foreach ($medicos as $medico) {
            $horarios[$medico['id_Usuario']] = $HorarioModelo->where('id_usuario', $medico['id_Usuario'])->findAll();
        }

        // Preparar datos para la vista
        $data = [
            'medicos' => $medicos,
            'horarios' => $this->calculateAllSlots($horarios),
        ];

        return view('turno_disponible', $data);
    }

    private function calculateAllSlots($horarios) // Calculo
    {
        $slotsData = [];
        
        foreach ($horarios as $medicoId => $Hor) {
            foreach ($Hor as $horario) {
                $dia_sem = $horario['dia_sem'];
                $hora_inicio = $horario['hora_inicio'];
                $hora_final = $horario['hora_final'];
                
                // Calcular slots para este horario
                $slotsData[$medicoId][$dia_sem][] = $this->calculateAvailableSlots($hora_inicio, $hora_final);
            }
        }

        return $slotsData;
    }

    private function calculateAvailableSlots($hora_inicio, $hora_final) // Calculo turno de 30 min
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
}