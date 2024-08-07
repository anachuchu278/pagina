<?php 
namespace App\Controllers;

use App\Models\UsuarioModelo;
use CodeIgniter\Controller;

class PaginaController extends Controller{
    public function Ingresar() {
        $session = \Config\Services::session();
        $userRol = $session->get('user_rol'); // Cambiar a 'user_rol' en lugar de 'user_id_rol'
        $data['showAdmin'] = ($userRol == 2);
        echo view('pagina-main', $data); 
        return view('layout/footer');
    } 
    public function Calendario(){
        return view('calendario');
    } 
    public function perfil(){ 
        $session = \Config\Services::session();
        return view('perfil');
    } 
    public function preguntas(){
        return view('preguntasFrecuentes');
    }
}