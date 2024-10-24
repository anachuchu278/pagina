<?php 
namespace App\Controllers;

use App\Models\EstadoModel;
use App\Models\UsuarioModelo;
use App\Models\TurnoModel;
use CodeIgniter\Controller;

class PaginaController extends Controller{
    public function Ingresar() {
        $session = \Config\Services::session();
        $userRol = $session->get('user_rol'); // Cambiar a 'user_rol' en lugar de 'user_id_rol'
        $data['showAdmin'] = ($userRol == 2);
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
        $codigoIngresado = $this->request->getPost('codigo_turno'); 
        $turnoModel = new TurnoModel(); 
        $estadoModel = new EstadoModel();
    
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
                return redirect()->to('confirmacion');
            } else {
                return redirect()->back()->with('error', 'No se encontró el estado "confirmado".');
            }
        } else {
            return redirect()->back()->with('error', 'El código no coincide.');
        }
    }
    
}