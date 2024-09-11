<?php 
namespace App\Controllers;

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
}