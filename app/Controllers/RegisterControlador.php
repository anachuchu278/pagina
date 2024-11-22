<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UsuarioModelo;

class RegisterControlador extends Controller
{
    public function index()
    {
        return view('registerVista');
    }

    public function registrarse()
    {
        $UsuarioModelo = new UsuarioModelo();

        $name = $this->request->getPost('nombre');
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $imagen = $this->request->getPost('imagen_ruta');
        $id_rol = 1;

        $existingEmail = $UsuarioModelo->where('email', $email)->first();
        if ($existingEmail) {
            return redirect()->back()->with('error', 'El email ya está registrado.')->withInput();
        }

         
        if ($name){

            if (preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]*$/", $name)) {
                echo "El nombre es válido: " . htmlspecialchars($name);
            } else {
                return redirect()->back()->with('error', 'El nombre no puede contener numeros.')->withInput();
            }
        }
        $existingName = $UsuarioModelo->where('nombre', $name)->first();
        if ($existingName) {
            return redirect()->back()->with('error', 'El nombre de usuario ya está registrado.')->withInput();
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        if (empty($imagen)) { 
            $imagen = '/img/imagen.png';
        }

        $data = [
            'nombre' => $name,
            'email' => $email,
            'password' => $hashedPassword,
            'id_rol' => $id_rol,
            'imagen_ruta' => $imagen

        ];

        $UsuarioModelo->insert($data);
        return redirect()->to('loginVista')->with('success', 'Se ha registrado correctamente.');
    }
    
}
