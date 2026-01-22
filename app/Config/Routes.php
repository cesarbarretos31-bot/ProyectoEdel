<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('testdb', 'TestDB::index');
$routes->get('usuario/prueba', 'UsuarioController::prueba');
$routes->get('registro', 'AuthController::registroForm');
$routes->post('registro', 'AuthController::registro');
$routes->get('testdb', 'TestDB::index');



