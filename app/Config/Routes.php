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
$routes->get('crudPaciente', 'PacienteControlador::index');
$routes->get('newPacienteView', 'PacienteControlador::newVista');
$routes->post('newPaciente', 'PacienteControlador::new');
$routes->get('editPaciente/(:num)', 'PacienteControlador::editView/$1');
$routes->post('editarPaciente/(:num)', 'PacienteControlador::edit/$1');
$routes->get('eliminarPaciente/(:num)', 'PacienteControlador::delete/$1');
//Usuario
$routes->get('/','RegisterControlador::index'); 
$routes->post('register', 'RegisterControlador::registrarse'); 
$routes->get('login', 'RegisterControlador::registrarse'); 
$routes->post('login1', 'LoginControlador::loguearse'); //Loguea
$routes->get('loginVista','LoginControlador::index');
$routes->get('logout', 'LoginControlador::logout'); // Logout
$routes->get('test', 'LoginControlador::loguearse');
//Turnos
$routes->get('turnos', 'TurnoControlador::index'); // Pagina principal con turnos del usuario
$routes->get('newTurno', 'TurnoControlador::newVista');// Vista para añadir nuevos turnos
$routes->post('newTurno1', 'TurnoControlador::new');
$routes->get('PDFTurno/(:num)', 'TurnoControlador::PDF/$1'); /* Crear PDF para el turno */
//Medico
$routes->get('NewMedView', 'RecepcionControlador::newMedVista');
$routes->get('horario_medico', 'RecepcionControlador::horMed'); // Vista para añadir horarios de medico
$routes->post('guardarH', 'RecepcionControlador::guardarHorario'); // Guardar horarios
$routes->get('turnos_disp', 'RecepcionControlador::turnoDisp'); // Vista de turnos disponibles

//Creacion de Admins 
$routes->get('vistaAdmin', 'adminController::Admin'); 
$routes->post('nuevoadmin', 'adminController::nuevoAdmin');

$routes->get('pay', 'Home::pay');