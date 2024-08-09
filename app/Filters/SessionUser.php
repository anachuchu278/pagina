<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class SessionUser implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    { 
        if(!session('id_Usuario') == '0') {
            return redirect()->to(base_url('login'));
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No se necesita después de procesar la solicitud
    }
}
