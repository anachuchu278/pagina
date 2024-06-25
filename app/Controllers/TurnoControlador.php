<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\TurnoModel;
use App\Models\PacienteModel;
use App\Models\UsuarioModelo;
use App\Models\PagoModel;
use App\Models\EstadoModel;
use Dompdf\Dompdf;
class TurnoControlador extends BaseController{
    public function index(){
        $session = \Config\Services::session();
        if ($session->get('user_id')) {
            $turnoModel = new TurnoModel();
            $pacienteModel = new PacienteModel();
            $usuarioModel = new UsuarioModelo();
            // $estadoModel = new EstadoModel();
            
            $userId = $session->get('user_id');
            $user = $pacienteModel->find($userId);
            
            $turnos = $turnoModel->getTurnosPorPaciente($userId);
            
            // Cargar la información de especialidad para cada usuario en los turnos
            // foreach ($turnos as $turno) {
            //     $usuario = $usuarioModel->find($turno['id_usuario']);
            //     $turno['id_especialidad'] = $usuario->especialidad;
            // }
            $data['usuario'] = $user;
            $data['turnos'] = $turnos;
            
            echo view('layout/navbar.php');
            return view('turnoVista.php', $data);
        } else {
            // Usuario no logueado, redirige a la página de inicio de sesión u otra página
            return redirect()->to('/');
        }
    }
    public function newVista(){ // Vista para agendar un turno
        $session = \Config\Services::session();
        if ($session->get('user_id')) {
            $turnoModel = new TurnoModel();
            $pacienteModel = new PacienteModel();
            $usuarioModel = new UsuarioModelo();
            $userId = $session->get('user_id');
            // $usuario = $usuarioModel->getMedicos();
            $user = $pacienteModel->getPaciente($userId);
            
            $data['usuario'] = $user;
            echo view('layout/navbar.php');
            return view('TurnoNew.php', $data);
        } else {
            return redirect()->to('/');
        }
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
            $codigoturno = rand(1, 999999);
            $data = [
                'fecha_hora' => $this->request->getPost('fecha_hora'),
                'codigo turno' => $codigoturno,
                'id_usuario' => $this->request->getPost('medico'),
                'id_paciente' => $idPaciente,
                'id_estado' => 1
            ];
        
        } else {
            // Usuario no logueado, redirige a la página de inicio de sesión u otra página
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