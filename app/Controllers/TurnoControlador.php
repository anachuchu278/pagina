<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\TurnoModel;
use App\Models\PacienteModel;
use App\Models\UsuarioModelo;
use App\Models\PagoModel;
use App\Models\HorarioModelo;
use App\Models\EstadoModel;
use App\Models\MetPagoModel;
use Dompdf\Dompdf;
class TurnoControlador extends BaseController{
    public function index() {
        $session = \Config\Services::session();
        $turnoModel = new TurnoModel();
        $pacienteModel = new PacienteModel();
        $usuarioModel = new UsuarioModelo();
        $estadoModel = new EstadoModel();
        $HorarioModel = new HorarioModelo();
    
        $userId = $session->get('user_id'); 
        $user = $pacienteModel->find($userId);
        
        $turnos = $turnoModel->findAll();
        $horarios = $HorarioModel->findAll();
    
        // Almacenar usuarios de los turnos
        $usuariosTurnos = [

        ];
        foreach ($turnos as $turno) {
            $usuariosTurnos[$turno['id_Usuario']] = $usuarioModel->find($turno['id_Usuario']);
        }
    
        $data['usuarios'] = $user;
        $data['turnos'] = $turnos;
        $data['horarios'] = $horarios;
        $data['usuariosTurnos'] = $usuariosTurnos;
    
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

        $id = $session->get('user_id');
        $idPaciente = $pacienteModel->getPacientePorUsuarioID($id);
        $fechahora = $this->request->getPost('fecha_hora');
        function getRandomHex($num_bytes = 4) {
            return bin2hex(openssl_random_pseudo_bytes($num_bytes));
        }
        
        $id_pago = $this->request->getPost('id_pago');
        if ($id_pago === null) {
            $id_pago = 0;
        }

        $codigoturno = getRandomHex(4);

        $data = [
            'fecha_hora' => $fechahora,
            'codigo_turno' => $codigoturno,
            'id_Usuario' => $this->request->getPost('id_Medico'),
            'id_paciente' => $id,
            'id_estado' => 1,
            'id_pago' => $id_pago
        ];

        var_dump($fechahora);
        return;
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

        $id_Metpago = $this->request->getPost('id_Metpago');
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

    
    // public function PDF($id){ 
    //     $dompdf = new Dompdf();
    //     $turnoModelo = new TurnoModel();
    //     $turno = $turnoModelo->asObject()->find($id);
    //     $query = $turnoModelo->asObject()->select("t.*, u.email, u.especialidad")
    //                                                             // ->join("turno as t", "t.id_Turno ");
    //                                                             ->join("usuarios as u", "t.id_usuario = id_Usuario");
    //     $data = [
    //         'turno' => $turno,
    //         'turnoPDF' => $query->where('id_Turno', $id)
    //     ];
    //     $dompdf->loadHTML(view('layout/turno-pdf.php', $data));
    //     $dompdf->setPaper('A4', 'portrait');
    //     $dompdf->render();
    //     $dompdf->stream();
    // }
}
