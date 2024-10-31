<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\TurnoModel;
use App\Models\PacienteModel;
use App\Models\UsuarioModelo;
use App\Models\HorarioModelo;
use App\Models\EstadoModel;
use App\Models\MetPagoModel;
use App\Models\DetPagoModelo;
class TurnoControlador extends BaseController{
    public function index(){
        $session = \Config\Services::session();
        $turnoModel = new TurnoModel();
        $pacienteModel = new PacienteModel();
        $usuarioModel = new UsuarioModelo();
        $estadoModel = new EstadoModel();
        $HorarioModel = new HorarioModelo();

        $userId = $session->get('user_id');
        $user = $pacienteModel->find($userId);
        $turnos = $turnoModel->findAll();
        
        $usuariosTurnos = [];
        foreach ($turnos as $turno) {
            $usuariosTurnos[$turno['id_Usuario']] = $usuarioModel->find($turno['id_Usuario']);
        }
        $pacienteTurnos = [];
        foreach ($turnos as $turno){
            $pacienteTurnos[$turno['id_paciente']] = $pacienteModel->find($turno['id_paciente']);
        }

        $horarios = $HorarioModel->findAll();

        $data['usuarios'] = $user;
        $data['turnos'] = $turnos;
        $data['horarios'] = $horarios;
        $data['usuariosTurno'] = $usuariosTurnos;
        $data['pacienteTurno'] = $pacienteTurnos;

        $userRol = $session->get('user_rol');
        $data['showAdmin'] = ($userRol == 2);
        echo view('layout/navbar', $data);
        return view('turnoVista', $data);
    }
    public function newVista() { // Vista para agendar un turno
        $session = \Config\Services::session();
        $turnoModel = new TurnoModel();
        $pacienteModel = new PacienteModel();
        $usuarioModel = new UsuarioModelo();
        $HorarioModel = new HorarioModelo();
        $MetpagoModel = new MetPagoModel();
        $userId = $session->get('user_id');

        $user = $pacienteModel->getPaciente($userId);
        $turnos = $turnoModel->getTurnosPorUsuario($userId);
        $data['horarios'] = $HorarioModel->findAll();
        $data['medicos'] = $usuarioModel->findAll();
        $data['metpagos'] = $MetpagoModel->findAll();
        $data['usuario'] = $user;
        $data['turnos'] = $turnos;

        $userRol = $session->get('user_rol');
        $data['showAdmin'] = ($userRol == 2);
        echo view('layout/navbar', $data);
        return view('TurnoNew', $data);
    }
    public function new()
{ 
    // Guardar datos del nuevo turno
    $session = \Config\Services::session();
    
    if ($session->get('user_id')) {
        $turnoModel = new TurnoModel();
        $pacienteModel = new PacienteModel();
        $usuarioModel = new UsuarioModelo();
        $detpagoModel = new DetPagoModelo();

        $id = $session->get('user_id');
        $idPaciente = $pacienteModel->getPacientePorUsuarioID($id);

        function getRandomHex($num_bytes = 4) { //Genera el codigo del turno
            return bin2hex(openssl_random_pseudo_bytes($num_bytes));
        }

        $codigoturno = getRandomHex(4);

        $dato = [
            'id_metodop' => $this->request->getPost('id_Metpago'),
            'monto' => 5000
        ];
        $id_Detpago = $detpagoModel->insertarDatos($dato);

        $data = [
            'fecha_hora' => $this->request->getPost('id_Horario'),
            'codigo_turno' => $codigoturno,
            'id_Usuario' => $this->request->getPost('id_Medico'),
            'id_paciente' => $idPaciente['id_Paciente'],
            'id_estado' => 1,
            'id_det_pago' => $id_Detpago
        ];

        $turnoModel->insertarDatos($data);

        // Enviar correo electrónico dinámicamente
        $email = \Config\Services::email();

        // Configurar la dirección del remitente (quien envía el correo)
        $email->setFrom('mateobargas@alumnos.itr3.edu.ar', 'Clinica'); // Cambia 'tu_correo@dominio.com' por un correo válido y 'Nombre Remitente' por el nombre que quieras mostrar.

        // Obtener el usuario por su ID para obtener su correo
        $usuario = $usuarioModel->find($id); 
        $destinatario = $usuario['email'];

        $email->setTo($destinatario); 
        $email->setSubject('Confirmación de Turno'); 

        $mensaje = "Su turno ha sido generado exitosamente.\n\n";
        $mensaje .= "Código de Turno: {$codigoturno}\n";
        $mensaje .= "Fecha y Hora: " . $this->request->getPost('id_Horario') . "\n";

        $email->setMessage($mensaje);

        if (!$email->send()) {
            echo $email->printDebugger(['headers']);
            exit;
        }

        $id_Metpago = $this->request->getPost('id_Metpago'); // Dependiendo del tipo de pago elegido se redireccionara a una pagina
        switch ($id_Metpago) {
            case 1:
                return redirect()->to('pay');
            case 2:
                return redirect()->to('pagina')->with('message', 'Por favor diríjase a recepción para efectuar el pago.');
            case 3:
                return redirect()->to('pay');
            case 4:
                return redirect()->to('ruta_para_id_metpago_4');
            default:
                return redirect()->to('pagina');
        }
    } else {
        return redirect()->to('/');
    }
}
}
