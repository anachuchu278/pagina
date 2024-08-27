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
        $idUsuario = $session->get('user_id');
        $userModel = new UsuarioModelo();
        if(!$idUsuario || $idUsuario == 0) {
            return redirect()->to('');
        } else {
            $session = session(); 
            $id= $idUsuario;
            $user = $userModel->getUsuario($id);
            // $user = [
            //     'user_id' ->this->request->getPost('id_Usuario'),
            //     'nombre' ->this->request->getPost('nombre'),
            //     'email' ->this->request->getPost('email'),
            //     'id_rol' ->this->request->getPost('id_rol'),
            // ];
            

            $data['user'] = $user;  
            //var_dump($user);

            return view('perfil', $data);
        }

    } 
    public function preguntas(){
        return view('preguntasFrecuentes');
    }
}