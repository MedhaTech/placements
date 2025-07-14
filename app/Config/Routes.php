<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Auth::login');
$routes->get('/login', 'Auth::login');
$routes->post('/login-user', 'Auth::loginUser');
$routes->get('/logout', 'Auth::logout');
$routes->get('/dashboard', 'Dashboard::index');


