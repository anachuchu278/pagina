<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UsuarioModelo;

class RegisterControlador extends Controller {
    public function index() {
        return view('registerVista');
    }

    public function registrarse() {
        $UsuarioModelo = new UsuarioModelo();

        $name = $this->request->getPost('nombre');
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $id_rol = 1;

        // Verificar si el email ya está registrado
        $existingEmail = $UsuarioModelo->where('email', $email)->first();
        if ($existingEmail) {
            return redirect()->back()->with('error', 'El email ya está registrado.')->withInput();
        }

        // Verificar si el nombre de usuario ya está registrado
        $existingName = $UsuarioModelo->where('nombre', $name)->first();
        if ($existingName) {
            return redirect()->back()->with('error', 'El nombre de usuario ya está registrado.')->withInput();
        }

        // Hash de la contraseña después de todas las verificaciones
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $data = [
            'nombre' => $name,
            'email' => $email,
            'password' => $hashedPassword,
            'id_rol' => $id_rol
        ];

        $UsuarioModelo->insert($data);
        return redirect()->to('loginVista')->with('success', 'Se ha registrado correctamente.');
    }
}
