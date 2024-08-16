<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

//Pagina Principal
$routes->get('pagina', 'PaginaController::Ingresar'); 
$routes->get('calendario','PaginaController::calendario' );
$routes->get('perfil','PaginaController::perfil');  
$routes->get('preguntas','PaginaController::preguntas');

//Paciente
$routes->get('crudPaciente', 'PacienteControlador::index', ['filter' => 'auth']);
$routes->get('newPacienteView', 'PacienteControlador::newVista', ['filter' => 'auth']);
$routes->post('newPaciente', 'PacienteControlador::new', ['filter' => 'auth']);
$routes->get('editPaciente/(:num)', 'PacienteControlador::editView/$1', ['filter' => 'auth']);
$routes->post('editarPaciente/(:num)', 'PacienteControlador::edit/$1', ['filter' => 'auth']);
$routes->get('eliminarPaciente/(:num)', 'PacienteControlador::delete/$1', ['filter' => 'auth']);
//Usuario
$routes->get('/','RegisterControlador::index'); 
$routes->post('register', 'RegisterControlador::registrarse'); 
$routes->get('login', 'RegisterControlador::registrarse'); 
$routes->post('login1', 'LoginControlador::loguearse'); //Loguea
$routes->get('loginVista','LoginControlador::index');
$routes->get('Logout', 'LoginControlador::logout'); // Logout
$routes->get('test', 'LoginControlador::loguearse');
//Turnos
$routes->get('turnos', 'TurnoControlador::index', ['filter' => 'auth']); // Pagina principal con turnos del usuario
$routes->get('newTurno', 'TurnoControlador::newVista');// Vista para añadir nuevos turnos
$routes->post('newTurno1', 'TurnoControlador::new');
$routes->get('PDFTurno/(:num)', 'TurnoControlador::PDF/$1'); /* Crear PDF para el turno */
//Medico
$routes->get('NewMedView', 'RecepcionControlador::newMedVista');
