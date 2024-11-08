<?php

namespace App\Controllers;
use App\Models\DetPagoModelo;
class Home extends BaseController
{
    public function pay(){
        $session = \Config\Services::session();
        $userRol = $session->get('user_rol'); // Cambiar a 'user_rol' en lugar de 'user_id_rol'
        $data['showAdmin'] = ($userRol == 2); // Simplificar la lógica para mostrar el admin
        $data['showMedico'] = ($userRol == 4);
        echo view('layout/navbar', $data);
        return view('pagar');
    }
    public function detpago(){
        $detpagoModel = new DetPagoModelo();
        $data = [
            'monto'=> 5000,
            'id_met_pago' => $this->request->getPost('id_met_pago')
        ];
        $detpagoModel->insertarDatos($data);
        return redirect()->to('pagina');
    }
}
