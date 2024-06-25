<?php 
namespace App\Controllers;

use CodeIgniter\Controller;

class PaginaController extends Controller{
    public function Ingresar() {
        return view('pagina-main');
    } 
    public function Calendario(){
        return view('calendario');
    } 
    public function perfil(){
        return view('perfil');
    }
}