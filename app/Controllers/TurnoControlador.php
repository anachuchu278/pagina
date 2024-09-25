<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\TurnoModel;
use App\Models\PacienteModel;
use App\Models\UsuarioModelo;
use App\Models\PagoModel;
use App\Models\HorarioModelo;
use App\Models\EstadoModel;
use Dompdf\Dompdf;
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
        //$turnos = $turnoModel->getTurnosPorUsuario($userId); 
        $turnos = $turnoModel->findAll();
        $horarios = $HorarioModel->findAll();

        $data['usuarios'] = $user;
        $data['turnos'] = $turnos;
        $data['horarios'] = $horarios;

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
        $userId = $session->get('user_id');

        $user = $pacienteModel->getPaciente($userId);
        $turnos = $turnoModel->getTurnosPorUsuario($userId);
        $data['horarios'] = $HorarioModel->findAll();
        $data['medicos'] = $usuarioModel->findAll();
        $data['usuario'] = $user;
        $data['turnos'] = $turnos;

        $userRol = $session->get('user_rol');
        $data['showAdmin'] = ($userRol == 2);
        echo view('layout/navbar', $data);
        return view('TurnoNew', $data);
    }
    public function new(){ // Guardar datos del nuevo turno
        $session = \Config\Services::session();
        if ($session->get('user_id')) {
            $turnoModel = new TurnoModel();
            $pacienteModel = new PacienteModel();
            $usuarioModel = new UsuarioModelo();
            // TODO Revisar como añadir el id_pago  -!- Cambiar relacion id_turno -> tabla Pago, no id_pago ->Tabla Turno
            $id = $session->get('user_id');
            $idPaciente = $pacienteModel->getPacientePorUsuarioID($id);
            function getRandomHex($num_bytes=4) {
                return bin2hex(openssl_random_pseudo_bytes($num_bytes));
            }
            $codigoturno = getRandomHex(4);
            $data = [
                'fecha_hora' => $this->request->getPost('id_Horario'),
                'codigo_turno' => $codigoturno,
                'id_Usuario' => $this->request->getPost('id_Medico'),
                'id_paciente' => $id,
                'id_estado' => 1,
                'id_pago' => null
            ];
            
            $turnoModel->insertarDatos($data);
            return redirect()->to('pagina');
        } else {
            return redirect()->to('/');
        }
    }
    public function PDF($id){ 
        $dompdf = new Dompdf();
        $turnoModelo = new TurnoModel();
        $turno = $turnoModelo->asObject()->find($id);
        $query = $turnoModelo->asObject()->select("t.*, u.email, u.especialidad")
                                                                // ->join("turno as t", "t.id_Turno ");
                                                                ->join("usuarios as u", "t.id_usuario = id_Usuario");
        $data = [
            'turno' => $turno,
            'turnoPDF' => $query->where('id_Turno', $id)
        ];
        $dompdf->loadHTML(view('layout/turno-pdf.php', $data));
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream();
    }
}
