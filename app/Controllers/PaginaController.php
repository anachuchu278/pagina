<?php 
namespace App\Controllers;

use App\Models\EstadoModel;
use App\Models\UsuarioModelo;
use App\Models\EspecialidadModel;
use App\Models\HorarioModelo;
use App\Models\TurnoModel;
use CodeIgniter\Controller;

class PaginaController extends Controller{
    public function Ingresar() {
        $session = \Config\Services::session();
        $userRol = $session->get('user_rol'); // Cambiar a 'user_rol' en lugar de 'user_id_rol'
        $data['showAdmin'] = ($userRol == 2);
        $data['showMedico'] = ($userRol == 4);
        echo view('pagina-main', $data); 
        return view('layout/footer');
    } 
    public function Calendario($userID){ 
        $turnoModelo = new TurnoModel(); 
        $turno = $turnoModelo->getTurnosPorUsuario($userID); 

        $data['turnos'] = $turno;

        return view('calendario', $data);
    } 
    public function perfil(){ 
        $session = \Config\Services::session();
        $idUsuario = $session->get('user_id');
        $userModel = new UsuarioModelo(); 
        if(!$idUsuario || $idUsuario == 0) {
            return redirect()->to('');
        } else {
            $user = $userModel->getRol($idUsuario);
            $data['user'] = $user;  
            return view('perfil', $data);
        }
    } 
    public function preguntas(){
        return view('preguntasFrecuentes');
    } 
    public function pagina_confirmacion(){
        return view('pagina_confirmacion');
    } 
    public function validarCodigo() {
        $session = \Config\Services::session();
        $codigoIngresado = $this->request->getPost('codigo_turno'); 
        $turnoModel = new TurnoModel(); 
        $estadoModel = new EstadoModel();
        $usuarioModel = new UsuarioModelo();
        $HorarioModel = new HorarioModelo();

        $codigoturno = $session->get('codigoturno');
        $id = $session->get('user_id');
        $id_horario = $session->get('horario');
        $horario = $HorarioModel->getHorario($id_horario);
    
        // Buscar el turno por el código ingresado
        $turno = $turnoModel->where('codigo_turno', $codigoIngresado)->first(); 
    
        if ($turno) {
            // Obtener el ID del estado "confirmado" de la tabla Estado
            $estadoConfirmado = $estadoModel->where('estado', 'confirmado')->first();
            
            // Verificar que se encontró el estado "confirmado"
            if ($estadoConfirmado) {
                // Actualizar el estado del turno con el ID del estado "confirmado"
                $turnoModel->update($turno['id_Turno'], ['id_Estado' => $estadoConfirmado['id_Estado']]);
    
                // Eliminar el turno después de actualizar su estado
                $turnoModel->delete($turno['id_Turno']);
    
                // Mostrar mensaje de confirmación
                session()->setFlashdata('codigoValido', true);
                $email = \Config\Services::email();

                // Configurar la dirección del remitente (quien envía el correo)
                $email->setFrom('infosolutions.tesina@gmail.com', 'Clinica'); // Cambia 'tu_correo@dominio.com' por un correo válido y 'Nombre Remitente' por el nombre que quieras mostrar.

                // Obtener el usuario por su ID para obtener su correo
                $usuario = $usuarioModel->find($id); 
                $destinatario = 'infosolutions.tesina@gmail.com';

                $email->setTo($destinatario); 
                $email->setSubject('Aviso de Confirmación'); 

                $mensaje = "El usuario " . $usuario['nombre'] . "a confirmado su turno exitosamente." . "\n\n";
                $mensaje = "Su turno ha sido generado exitosamente.\n\n";
                $mensaje .= "Código de Turno: {$codigoturno}\n";
                $mensaje .= "El día: " . $horario['dia_sem'] . " desde las " . substr($horario['hora_inicio'],0,-3) . " hasta las " . substr($horario['hora_final'],0,-3) . "\n";

                $email->setMessage($mensaje);

                if (!$email->send()) {
                    echo $email->printDebugger(['headers']);
                    exit;
                }
                return redirect()->to('confirmacion');
            } else {
                return redirect()->back()->with('error', 'No se encontró el estado "confirmado".');
            }
        } else {
            return redirect()->back()->with('error', 'El código no coincide.');
        }
    }
    public function successpay(){
    $session = \Config\Services::session();
    if ($session->get('user_id')) {
        $usuarioModel = new UsuarioModelo();
        $HorarioModel =new HorarioModelo();
        $id = $session->get('user_id');

        $codigoturno = $session->get('codigoturno');
        $id_horario = $session->get('horario');
        $horario = $HorarioModel->getHorario($id_horario);

        // Enviar correo electrónico dinámicamente
        $email = \Config\Services::email();

        // Configurar la dirección del remitente (quien envía el correo)
        $email->setFrom('infosolutions.tesina@gmail.com', 'Clinica'); // Cambia 'tu_correo@dominio.com' por un correo válido y 'Nombre Remitente' por el nombre que quieras mostrar.

        // Obtener el usuario por su ID para obtener su correo
        $usuario = $usuarioModel->find($id); 
        $destinatario = $usuario['email'];

        $email->setTo($destinatario); 
        $email->setSubject('Confirmación de Turno'); 

        $mensaje = "Su turno ha sido generado exitosamente.\n\n";
        $mensaje .= "Código de Turno: {$codigoturno}\n";
        $mensaje .= "El día: " . $horario['dia_sem'] . " desde las " . substr($horario['hora_inicio'],0,-3) . " hasta las " . substr($horario['hora_final'],0,-3) . "\n";

        $email->setMessage($mensaje);

        if (!$email->send()) {
            echo $email->printDebugger(['headers']);
            exit;
        }
        $userRol = $session->get('user_rol'); // Cambiar a 'user_rol' en lugar de 'user_id_rol'
        $data['showMedico'] = ($userRol == 4);
        return redirect()->to('pagina');
    }
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
        $id_Usuario = $this->request->getPost('id_Usuario');
        $name = $this->request->getPost('nombre');
        $email = $this->request->getPost('email');
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
            'id_Usuario' => $id_Usuario,
            'nombre' => $name,
            'email' => $email,
            'password' => $hashedPassword,
            'id_rol' => $id_rol,
            'imagen_ruta' => $imagen,
            'id_especialidad' => $idEspecialidad,
        ];
        $id_user = $UsuarioModelo->insert($data);
        if ($horarios) {
            foreach ($horarios as $horario) {
                $dataHorario = [
                    'dia_sem' => $horario['dia_sem'],
                    'hora_inicio' => $horario['hora_inicio'],
                    'hora_final' => $horario['hora_final'],
                    'id_Usuario' => $id_user,
                ];
                $HorarioModelo->insert($dataHorario);
            }
        }
        return redirect()->to('crudMeds');
    }
    public function deleteMedico()
    {
        $id_Usuario = $this->request->getPost('id_Usuario');
        if ($id_Usuario) {
            $usuarioModelo = new UsuarioModelo();
            $usuarioModelo->deleteAdmin($id_Usuario);
            return redirect()->to('crudMeds');
        }
    }
    public function perfilMedico()
    {
        $session = \Config\Services::session();
        $idUsuario = $session->get('user_id');
        $UsuarioModelo = new UsuarioModelo();
        $EspecialidadModelo = new EspecialidadModel();
        $medico = $UsuarioModelo->find($idUsuario);
        if (!$medico) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Médico no encontrado');
        }
        $especialidad = $EspecialidadModelo->find($medico['id_especialidad']);
        // Pasar los datos a la vista
        return view('datosMedico', [
            'medico' => $medico,
            'especialidad' => $especialidad,
        ]);
    }
}
