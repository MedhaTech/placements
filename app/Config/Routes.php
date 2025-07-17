<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Default route for student login
$routes->get('/', 'StudentController::studentLogin');
$routes->get('/student', 'StudentController::studentLogin');
$routes->get('/placements', 'StudentController::studentLogin');

// Student login and dashboard
$routes->post('/student-login', 'StudentController::loginStudentUser');
$routes->get('/student/dashboard', 'StudentController::studentDashboard');
$routes->get('/student/logout', 'StudentController::studentLogout');

// Static preview page
$routes->get('/preview', 'StudentController::studentProfilePreview');

// Admin login and dashboard
$routes->get('/admin', 'AdminController::adminLogin');
$routes->post('/admin-login', 'AdminController::loginAdminUser');
$routes->get('/admin/dashboard', 'AdminController::adminDashboard');
$routes->get('/admin/logout', 'AdminController::adminLogout');
