<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'PaginaController::Ingresar'); 
$routes->get('calendario','PaginaController::calendario' );