<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('usuario/prueba', 'UsuarioController::prueba');
$routes->get('registro', 'AuthController::registroForm');
$routes->post('registro', 'AuthController::registro');
$routes->get('testdb', 'TestDB::index');
$routes->get('carrusel', 'Carrusel::index');
$routes->get('formulario', 'Formulario::index');
$routes->post('formulario/procesar', 'Formulario::procesar');
$routes->get('formulario/test_db', 'Formulario::test_db');
$routes->get('formulario/test_folder', 'Formulario::test_folder');


