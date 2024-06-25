<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();

        // Verificar si el usuario está logueado
        if (!$session->has('user_id')) {
            // Guardar la URL actual para redirigir después de login
            $session->set('redirect_url', current_url());

            // Redirigir a la página de login con mensaje
            return redirect()->to('/loginVista')->with('error', 'Debe iniciar sesión para acceder a esta página.');
        }

        return $request;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No se necesita después de procesar la solicitud
    }
}
