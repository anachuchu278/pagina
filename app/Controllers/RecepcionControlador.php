<?php
namespace App\Controllers;
use App\Models\UsuarioModelo;
use App\Models\HorarioModelo;
use CodeIgniter\Controller;
use App\Models\PacienteModel;
use App\Models\EspecialidadModel;
use App\Models\TurnoModel;

class RecepcionControlador extends BaseController{
    public function __construct()
    {
        $session = \Config\Services::session();
        if (!$session->get('is_logged_in')) {
            return redirect()->to('/login');
        }
    }
    public function index(){
        $session = \Config\Services::session();
        if ($session->get('user_id')) {
            $rol= $session->get('user_rol');
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
        $data['showMedico'] = ($userRol == 4);
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
        $data['showMedico'] = ($userRol == 4);
        echo view('layout/navbar', $data);
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
        $data['showMedico'] = ($userRol == 4);
        echo view('layout/navbar', $data);
        return view('HorarioMedico', $data);
    }
    public function guardarHorario() //funcion que añade horarios
    {
        $session = \Config\Services::session();
        $HorarioModelo = new HorarioModelo();
        $UsuarioModelo = new UsuarioModelo();        
        $emailMed = $session->get('emailMed');
        if($emailMed){
            $medico_id = $UsuarioModelo->where('email', $emailMed)->first();
        }else {
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
    public function formMed()
    {
        $session = \Config\Services::session(); 
        $EspecialidadModelo = new EspecialidadModel();
        $especialidades = $EspecialidadModelo->findAll();
        $userRol = $session->get('user_rol');
        $data['showAdmin'] = ($userRol == 2); 
        $data['showMedico'] = ($userRol == 4);
        echo view('layout/navbar' , $data);
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

        // Verificar si el email ya está registrado
        $existingEmail = $UsuarioModelo->where('email', $email)->first();
        if ($existingEmail) {
            return redirect()->back()->with('error', 'El email ya está registrado.')->withInput();
        }


        if ($name) {

            // Validar que solo contenga letras
            if (preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]*$/", $name)) {
                echo "El nombre es válido: " . htmlspecialchars($name);
            } else {
                return redirect()->back()->with('error', 'El nombre no puede contener numeros.')->withInput();
            }
        }
        // Verificar si el nombre de usuario ya está registrado
        $existingName = $UsuarioModelo->where('nombre', $name)->first();
        if ($existingName) {
            return redirect()->back()->with('error', 'El nombre de usuario ya está registrado.')->withInput();
        }

        // Hash de la contraseña después de todas las verificaciones
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

        // Pasar los datos a la vista
        return view('datosMedico', [
            'medico' => $medico,
            'especialidad' => $especialidad,
            'horarios' => $horarios
        ]);
    }
}