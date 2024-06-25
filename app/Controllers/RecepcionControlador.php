<?php
namespace App\Controllers;
use App\Models\UsuarioModelo;
use CodeIgniter\Controller;
use App\Models\PacienteModel;
use App\Models\TurnoModel;

class RecepcionControlador extends BaseController{
    public function index(){
        $session = \Config\Services::session();
        if ($session->get('user_id')) {
            $rol= $session->get('user_rol');
            if ($rol == 3 && $rol == 2) {
                $pacienteModel = new PacienteModel();
                $turnoModel = new TurnoModel();
                $data['pacientes'] = $pacienteModel->findAll();
                $data['turnos'] = $turnoModel->findAll();
    
                echo view('layout/navbar.css');
                return view('Recepcion');
            } else {
                return redirect()->to('#');
            }
        } else {
            return redirect()->to('/');
        }
    }
    public function newMedVista()
    {
        return view('newMedVista');
    }
    public function newMed()
    {
        $session = \Config\Services::session();
        $usuarioModelo= new UsuarioModelo();

        $data=[
            'id_Usuario' => $this->request->getPost('id_usuario'),
            'id_especialidad' => $this->request->getPost('id_especialidad'),
            'id_rol' => 4
        ];
        $usuarioModelo->editarUsuario($data);
        return redirect()->to('crudPaciente');
    }
    public function delMed($id)
    {
        $usuarioModelo= new UsuarioModelo();

        $data=[
            'id_especialidad'=> null,
            'id_rol'=> 1
        ];
        $usuarioModelo->editarUsuario($id,$data);
        return redirect()->to('crudPaciente');
    }
}