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
        $turnoModel = new TurnoModel();
        $pacienteModel = new PacienteModel();
        $usuarioModel = new UsuarioModelo();
        // $estadoModel = new EstadoModel();

        $userId = $session->get('user_id');
        $user = $pacienteModel->find($userId);

        $turnos = $turnoModel->getTurnosPorUsuario($userId);

        // Cargar la información de especialidad para cada usuario en los turnos
        // foreach ($turnos as $turno) {
        //     $usuario = $usuarioModel->find($turno['id_usuario']);
        //     $turno['id_especialidad'] = $usuario->especialidad;
        // }
        $data['usuario'] = $user;
        $data['turnos'] = $turnos;

        $userRol = $session->get('user_rol'); // Cambiar a 'user_rol' en lugar de 'user_id_rol'
        $data['showAdmin'] = ($userRol == 2); // Simplificar la lógica para mostrar el admin

        echo view('layout/navbar.php', $data);
        return view('turnoVista.php', $data);
    }
    public function newVista() { // Vista para agendar un turno
        $session = \Config\Services::session();
        $turnoModel = new TurnoModel();
        $pacienteModel = new PacienteModel();
        $usuarioModel = new UsuarioModelo();
        $userId = $session->get('user_id');

        $user = $pacienteModel->getPaciente($userId);
        $turnos = $turnoModel->getTurnosPorUsuario($userId);

        $data['userId'] = $userId;
        $data['turnos'] = $turnos;

        //echo view('layout/navbar.php', $data);
        return view('TurnoNew.php', $data);
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
                'fecha_hora' => $this->request->getPost('fecha_hora'),
                'codigo_turno' => $codigoturno,
                'id_usuario' => 1,
                'id_paciente' => 1,
                'id_estado' => 1,
                'id_pago' => 1,
            ];
            $turnoModel->insertarTurno($data);
            return redirect()->to('turnos');
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
