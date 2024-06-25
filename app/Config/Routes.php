<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// $routes->get('/', 'Home::index');
//Paciente
$routes->get('crudPaciente', 'PacienteControlador::index', ['filter' => 'auth']);
$routes->get('newPacienteView', 'PacienteControlador::newVista', ['filter' => 'auth']);
$routes->post('newPaciente', 'PacienteControlador::new', ['filter' => 'auth']);
$routes->get('editPaciente/(:num)', 'PacienteControlador::editView/$1', ['filter' => 'auth']);
$routes->post('editarPaciente', 'PacienteControlador::edit', ['filter' => 'auth']);
$routes->get('eliminarPaciente/(:num)', 'PacienteControlador::delete/$1', ['filter' => 'auth']);
//Usuario
$routes->get('/','RegisterControlador::index'); 
$routes->post('register', 'RegisterControlador::registrarse'); 
$routes->get('login', 'RegisterControlador::registrarse'); 
$routes->post('login1', 'LoginControlador::loguearse'); //Loguea
$routes->get('loginVista','LoginControlador::index');
$routes->get('Logout', 'LoginControlador::logout'); // Logout
// $routes->get('test', 'LoginControlador::loguearse');
//Turnos
$routes->get('turnos', 'TurnoControlador::index'); // Pagina principal con turnos del usuario
$routes->get('newTurno', 'TurnoControlador::newVista'); // Vista para añadir nuevos turnos
$routes->get('PDFTurno/(:num)', 'TurnoControlador::PDF/$1'); /* Crear PDF para el turno */
