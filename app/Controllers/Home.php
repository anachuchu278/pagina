<?php

namespace App\Controllers;
use App\Models\DetPagoModelo;
class Home extends BaseController
{
    public function pay(){
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
