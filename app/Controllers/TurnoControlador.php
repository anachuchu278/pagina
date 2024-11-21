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
    public function __construct()
    {
        $session = \Config\Services::session();
        if (!$session->get('is_logged_in')) {
            return redirect()->to('/login');
        }
    }
    public function index(){
        $session = \Config\Services::session();
        $turnoModel = new TurnoModel();
        $pacienteModel = new PacienteModel();
        $usuarioModel = new UsuarioModelo();
        $estadoModel = new EstadoModel();
        $HorarioModel = new HorarioModelo();

        $userId = $session->get('user_id');
        $userRol = $session->get('user_rol');
        $user = $pacienteModel->find($userId);
        $estados = $estadoModel->findAll();
        $horarios = $HorarioModel->findAll();
        $idPaciente = $pacienteModel->getPacientePorUsuarioID($userId);
        $search = $this->request->getPost('search');
        if ($userRol == 1) { // Usuario - Paciente
            $turnos = $turnoModel->where('id_paciente', $idPaciente['id_Paciente'])->findAll();
        } elseif ($userRol == 2) { //Admin
            $turnos = $turnoModel->findAll();
        } elseif ($userRol == 3) { // Recepcion
            $turnos = $turnoModel->findAll();    
        } elseif ($userRol == 4) { // Medico
            $turnos = $turnoModel->where('id_Usuario', $userId)->findAll();
        }

        $estadosMap = [];
        foreach ($estados as $estado) {
            $estadosMap[$estado['id_Estado']] = $estado['estado'];
        }     
        $usuariosTurnos = [];
        foreach ($turnos as $turno) {
            $usuariosTurnos[$turno['id_Usuario']] = $usuarioModel->find($turno['id_Usuario']);
        }
        $pacienteTurnos = [];
        foreach ($turnos as $turno){
            $pacienteTurnos[$turno['id_paciente']] = $pacienteModel->find($turno['id_paciente']);
        }

        foreach ($turnos as &$turno) {
            $paciente = $pacienteModel->find($turno['id_paciente']);
            if ($paciente) {
                $turno['paciente'] = $paciente['nombre'];
            } else {
                $turno['paciente'] = 'Desconocido';
            }
            if (isset($estadosMap[$turno['id_estado']])) {
                $turno['estado'] = $estadosMap[$turno['id_estado']];
            } else {
                $turno['estado'] = 'Desconocido';
            }
        }

        $data['usuarios'] = $user;
        $data['turnos'] = $turnos;
        $data['horarios'] = $horarios;
        $data['usuariosTurno'] = $usuariosTurnos;
        $data['pacienteTurno'] = $pacienteTurnos;

        $userRol = $session->get('user_rol');
        $data['showAdmin'] = ($userRol == 2);
        $data['showMedico'] = ($userRol == 4);
        echo view('layout/navbar', $data);
        return view('turnoVista', $data);
    }
    public function search(){
        $session = \Config\Services::session();
        $turnoModel = new TurnoModel();
        $pacienteModel = new PacienteModel();
        $usuarioModel = new UsuarioModelo();
        $estadoModel = new EstadoModel();
        $HorarioModel = new HorarioModelo();

        $userId = $session->get('user_id');
        $userRol = $session->get('user_rol');
        $user = $pacienteModel->find($userId);
        $estados = $estadoModel->findAll();
        $horarios = $HorarioModel->findAll();
        $search = $this->request->getPost('search');
        $idPaciente = $pacienteModel->where('dni', $search)->findAll();
        if (!$search == null) {
            return redirect()->back();
        } else {
            $idPaciente = $pacienteModel->where('dni', $search)->findAll();
            if (!$idPaciente == null) {
                return redirect()->back()->with('error', 'Paciente no encontrado.');
            } else{
                // $idPaciente = $pacienteModel->where('dni', $search)->findAll();
                $turnos = $turnoModel->where('id_paciente', $idPaciente['id_Paciente'])->findAll();
            }    
        }

        $estadosMap = [];
        foreach ($estados as $estado) {
            $estadosMap[$estado['id_Estado']] = $estado['estado'];
        }     
        $usuariosTurnos = [];
        foreach ($turnos as $turno) {
            $usuariosTurnos[$turno['id_Usuario']] = $usuarioModel->find($turno['id_Usuario']);
        }
        $pacienteTurnos = [];
        foreach ($turnos as $turno){
            $pacienteTurnos[$turno['id_paciente']] = $pacienteModel->find($turno['id_paciente']);
        }

        foreach ($turnos as &$turno) {
            $paciente = $pacienteModel->find($turno['id_paciente']);
            if ($paciente) {
                $turno['paciente'] = $paciente['nombre'];
            } else {
                $turno['paciente'] = 'Desconocido';
            }
            if (isset($estadosMap[$turno['id_estado']])) {
                $turno['estado'] = $estadosMap[$turno['id_estado']];
            } else {
                $turno['estado'] = 'Desconocido';
            }
        }

        $data['usuarios'] = $user;
        $data['turnos'] = $turnos;
        $data['horarios'] = $horarios;
        $data['usuariosTurno'] = $usuariosTurnos;
        $data['pacienteTurno'] = $pacienteTurnos;

        $userRol = $session->get('user_rol');
        $data['showAdmin'] = ($userRol == 2);
        $data['showMedico'] = ($userRol == 4);
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
        $data['showMedico'] = ($userRol == 4);
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
            $HorarioModel = new HorarioModelo();
    
            $id = $session->get('user_id');
            $horarios = $HorarioModel->findAll();
            $idPaciente = $pacienteModel->getPacientePorUsuarioID($id);
    
            $horario = $HorarioModel->getHorario($this->request->getPost('id_Horario'));
            function getRandomHex($num_bytes = 4) { //Genera el codigo del turno
                return bin2hex(openssl_random_pseudo_bytes($num_bytes));
            }
    
            $codigoturno = getRandomHex(4);
    
            $dato = [
                'id_metodop' => $this->request->getPost('id_Metpago'),
                'monto' => 5000,
                'id_Usuario' => $id
            ];
            $id_Detpago = $detpagoModel->insertarDatos($dato);
    
            $data = [
                'fecha_hora' => $this->request->getPost('id_Horario'),
                'codigo_turno' => $codigoturno,
                'id_Usuario' => $this->request->getPost('id_Medico'),
                'id_paciente' => $idPaciente['id_Paciente'],
                'id_estado' => 1
            ];
    
            $turnoModel->insertarDatos($data);
    
            $id_Metpago = $this->request->getPost('id_Metpago'); // Dependiendo del tipo de pago elegido se redireccionara a una pagina
            switch ($id_Metpago) {
                case 1:
                    $session->set('codigoturno' , $codigoturno);
                    $session->set('horario' , $horario['id_Horario']);
                    return redirect()->to('pay');
                case 2:
                    return redirect()->to('pagina')->with('message', 'Por favor diríjase a recepción para efectuar el pago.');
                case 3:
                    $session->set('codigoturno' , $codigoturno);
                    $session->set('horario' , $horario['id_Horario']);
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
