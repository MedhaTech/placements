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
$routes->get('/preview', function () {
    return view('student_profile_preview');
});
$routes->get('/student/profile-preview', 'Student::profilePreview');

//profile summary
$routes->get('/student/profile', 'Student::profilePreview');
$routes->post('/student/update-profile-summary', 'Student::updateProfileSummary');

//personal information
$routes->post('/student/update-personal-info', 'Student::updatePersonalInfo');

//key skills
$routes->post('/student/update-skills', 'Student::updateSkills');
$routes->post('/student/delete-skill', 'Student::deleteSkill');
$routes->post('/student/add-skill', 'Student::addSkill');

//Academics info
$routes->post('/student/update-academic-info', 'Student::updateAcademicInfo');

//placement preferences
$routes->post('student/update-placement-preferences', 'Student::updatePlacementPreferences');
$routes->get('/preview', 'StudentController::studentProfilePreview');

// Admin login and dashboard
$routes->get('/admin', 'AdminController::adminLogin');
$routes->post('/admin-login', 'AdminController::loginAdminUser');
$routes->get('/admin/dashboard', 'AdminController::adminDashboard');
$routes->get('/admin/logout', 'AdminController::adminLogout');
