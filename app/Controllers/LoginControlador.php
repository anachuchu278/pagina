<?php

namespace App\Controllers;

use CodeIgniter\Controller; 
use App\Models\UsuarioModelo;
use App\Models\PacienteModel;

class LoginControlador extends BaseController{ 
    public function index()
    {
        return view('loginVista'); 
    }

    public function loguearse()
    {
        $session = \Config\Services::session();
        $result = new UsuarioModelo();
        $pacienteModel = new PacienteModel(); 

        $email = $this->request->getPost('email'); 
        $password = $this->request->getPost('password'); 

        $user = $result->where('email', $email)->first(); 
        
        if ($user) {
            if (password_verify($password, $user['password'])) {
                $session->set('user_rol', $user['id_rol']);
                $session->set('user_id', $user['id_Usuario']); 
                $session->set('name' , $user['nombre']);
                $session->set('email' , $user['email']);

                $id = $user['id_Usuario'];
                $idPaciente = $pacienteModel->getPacientePorUsuarioID($id);
                if ($user['id_rol'] == 1 OR $user['id_rol'] == 3 OR $user['id_rol'] == 4) {
                    if (!$idPaciente){
                        return redirect()->to('newPacienteView');
                        // return redirect()->to('editPaciente/', $id);
                    } else {
                    // Redirigir a la URL guardada o a una ruta predeterminada después del login
                    $redirect_url = $session->get('redirect_url') ?? 'pagina';
                    return redirect()->to($redirect_url); }
                } else {
                return redirect()->to('pagina');}
                $redirect_url = $session->get('redirect_url') ?? 'pagina';
                return redirect()->to($redirect_url);
            } else {
                return redirect()->back()->with('error', 'Credenciales incorrectas.');
            }
        } else {
            return redirect()->back()->with('error', 'Credenciales incorrectas.');
        }
    }
    public function logout()
    {
        $session = \Config\Services::session();
        $this->session->destroy();
        return redirect()->to('loginVista');
    } 
    
}
