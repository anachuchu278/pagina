<?php 
namespace App\Controllers;

use App\Models\UsuarioModelo;
use CodeIgniter\Controller;

class PaginaController extends Controller{
    public function Ingresar() {
        $session = \Config\Services::session();
        return view('pagina-main');
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