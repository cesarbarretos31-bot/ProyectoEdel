<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('usuario/prueba', 'UsuarioController::prueba');
$routes->get('testdb', 'TestDB::index');
$routes->get('carrusel', 'Carrusel::index');
$routes->get('formulario', 'Formulario::index');
$routes->post('formulario/procesar', 'Formulario::procesar');
$routes->get('formulario/test_db', 'Formulario::test_db');
$routes->get('formulario/test_folder', 'Formulario::test_folder');
$routes->get('registro', 'AuthController::registroForm');
$routes->post('registro', 'AuthController::registro');
$routes->get('carrusel', 'Carrusel::index');
$routes->get('carrusel/nuevo', 'Carrusel::nuevo');   // Ruta para ver el formulario
$routes->post('carrusel/guardar', 'Carrusel::guardar'); 
    $routes->get('usuarios', 'UsuarioController::index');
$routes->get('usuarios/crear', 'UsuarioController::crear');
$routes->post('usuarios/guardar', 'UsuarioController::guardar');

$routes->get('usuarios/editar/(:num)', 'UsuarioController::editar/$1');
$routes->post('usuarios/actualizar/(:num)', 'UsuarioController::actualizar/$1');

$routes->get('usuarios/eliminar/(:num)', 'UsuarioController::eliminar/$1');// Ruta para procesar el envío
$routes->set404Override(function () {
    return view('errors/error_custom');

 

});






