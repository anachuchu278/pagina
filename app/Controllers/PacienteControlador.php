<?php

namespace App\Controllers;

use App\Models\UsuarioModelo;
use CodeIgniter\Controller;
use App\Models\PacienteModel;
use App\Models\ObraSModel;
use App\Models\TipoSModel;
use App\Models\EspecialidadModel;

class PacienteControlador extends BaseController
{
    public function __construct()
    {
        $session = \Config\Services::session();
        if (!$session->get('is_logged_in')) {
            return redirect()->to('/login');
        }
    }

    public function index()
    {
        $session = \Config\Services::session();
        $usuarioModel = new UsuarioModelo();
        $obraModel = new ObraSModel();
        $tiposanModel = new TipoSModel();
        $pacienteModel = new PacienteModel();

        $pacientes = $pacienteModel->findAll();
        $obras = $obraModel->findAll();
        $tiposSangre = $tiposanModel->findAll();

        $obrasMap = [];
        foreach ($obras as $obra) {
            $obrasMap[$obra['id_Obra']] = $obra['nombre'];
        }

        $tiposSangreMap = [];
        foreach ($tiposSangre as $tipo) {
            $tiposSangreMap[$tipo['id_Sangre']] = $tipo['tipo'];
        }

        foreach ($pacientes as &$paciente) {
            if ($paciente['RH_tipo_sangre'] == '1') {
                $paciente['RH_tipo_sangre'] = '+';
            } else {
                $paciente['RH_tipo_sangre'] = '-';
            }

            $usuario = $usuarioModel->find($paciente['id_Usuario']);
            if ($usuario) {
                $paciente['usuario_email'] = $usuario['email'];
            } else {
                $paciente['usuario_email'] = 'Desconocido';
            }

            if (isset($obrasMap[$paciente['id_Obra']])) {
                $paciente['obra_nombre'] = $obrasMap[$paciente['id_Obra']];
            } else {
                $paciente['obra_nombre'] = 'Desconocido';
            }

            if (isset($tiposSangreMap[$paciente['id_Sangre']])) {
                $paciente['tipo_sangre'] = $tiposSangreMap[$paciente['id_Sangre']];
            } else {
                $paciente['tipo_sangre'] = 'Desconocido';
            }
        }

        $data['pacientes'] = $pacientes; 

        $userRol = $session->get('user_rol'); 
        $data['showAdmin'] = ($userRol == 2); 
        $data['showMedico'] = ($userRol == 4);

        echo view('layout/navbar', $data);
        echo view('crudPaciente', $data); 
    }

    public function newVista($id = null)
    {
        $session = \Config\Services::session();
        $obra = new ObraSModel();
        $tiposan = new TipoSModel();
        $usuario = new UsuarioModelo();
        $espec = new EspecialidadModel();
        
        $data['obras'] = $obra->findAll();
        $data['usuarios'] = $usuario->findAll();
        $data['tiposans'] = $tiposan->findAll();
        $data['especialidades'] = $espec->findAll();

        $data['paciente'] = [];

        if ($id) {
            $pacienteModel = new PacienteModel();
            $data['paciente'] = $pacienteModel->find($id);

            if ($session->get('user_rol') != 1 && $session->get('user_id') != $data['paciente']['id_usuario']) {
                return redirect()->to('crudPaciente')->with('error', 'No tienes permiso para editar este paciente.');
            }
        }

        return view('NewEditPaciente', $data);
    }

    public function new()
    {
        $session = \Config\Services::session();
        $pacienteModel = new PacienteModel();
        $usuarioModel = new UsuarioModelo();
        $data = [
            'id_Usuario' => $this->request->getPost('id_Usuario'),
            'nombre' => $this->request->getPost('nombre'),
            'apellido' => $this->request->getPost('apellido'),
            'dni' => $this->request->getPost('dni'),
            'edad' => $this->request->getPost('edad'),
            'altura_cm' => $this->request->getPost('altura_cm'),
            'peso' => $this->request->getPost('peso'),
            'historia_clinica' => $this->request->getPost('historia_clinica'),
            'id_Obra' => $this->request->getPost('id_Obra'),
            'id_Sangre' => $this->request->getPost('id_Sangre'),
            'RH_tipo_sangre' => $this->request->getPost('rh') ? 1 : 0
        ];

        $idEspecialidad = $this->request->getPost('especialidad');

        if ($this->request->getPost('id_Paciente')) {
            $pacienteId = $this->request->getPost('id_Paciente');
            $paciente = $pacienteModel->find($pacienteId);

            if ($session->get('user_rol') != 1 && $session->get('user_id') != $paciente['id_usuario']) {
                return redirect()->to('crudPaciente')->with('error', 'No tienes permiso para editar este paciente.');
            }

            $pacienteModel->update($pacienteId, $data);
            $usuarioModel->update($data['id_Usuario'], ['id_especialidad' => $idEspecialidad]);
        } else {
            if ($session->get('user_rol') == 2) {
                $pacienteModel->insertarPaciente($data);
                $usuarioModel->update($data['id_Usuario'], ['id_especialidad' => $idEspecialidad]);
            } else {
                $pacienteModel->insertarPaciente($data);
                return redirect()->to('crudPaciente')->with('error', 'No tienes permiso para añadir un nuevo paciente.');
            }
            return redirect()->to('crudPaciente');
        }

        return redirect()->to('crudPaciente');
    }

    public function editView($id)
    {
        $obra = new ObraSModel();
        $tiposan = new TipoSModel();
        $usuario = new UsuarioModelo();
        $espec = new EspecialidadModel();

        $data['obras'] = $obra->findAll();
        $data['usuarios'] = $usuario->findAll();
        $data['tiposans'] = $tiposan->findAll();
        $data['especialidades'] = $espec->findAll();

        $pacienteModel = new PacienteModel();
        $data['paciente'] = $pacienteModel->find($id);

        $session = \Config\Services::session();

        return view('NewEditPaciente', $data);
    }

    public function edit($id)
    {
        $pacienteModel = new PacienteModel();
        $usuarioModel = new UsuarioModelo();

        $data = [
            'id_Usuario' => $this->request->getPost('id_Usuario'),
            'nombre' => $this->request->getPost('nombre'),
            'apellido' => $this->request->getPost('apellido'),
            'dni' => $this->request->getPost('dni'),
            'edad' => $this->request->getPost('edad'),
            'altura_cm' => $this->request->getPost('altura_cm'),
            'peso' => $this->request->getPost('peso'),
            'historia_clinica' => $this->request->getPost('historia_clinica'),
            'id_Obra' => $this->request->getPost('id_obra'),
            'id_Sangre' => $this->request->getPost('id_tipo_sangre')
        ];
        $idEspecialidad = $this->request->getPost('especialidad');

        $pacienteModel->editarPaciente($id, $data);

        return redirect()->to('crudPaciente');
    }

    public function delete($id)
    {
        $pacienteModel = new PacienteModel();
        $pacienteModel->deletePaciente($id);

        return redirect()->to('crudPaciente');
    }
}
