<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// Default route for student login
$routes->get('/', 'Student::login');
$routes->get('/student', 'Student::login');
$routes->get('/placements', 'Student::login');

// Student login and dashboard
$routes->post('/student-login', 'Student::loginUser');
$routes->get('/student/dashboard', 'Student::dashboard');
$routes->get('/student/logout', 'Student::logout');

// Admin login and dashboard
$routes->get('/admin', 'Admin::login');
$routes->post('/admin-login', 'Admin::loginUser');
$routes->get('/admin/dashboard', 'Admin::dashboard');
$routes->get('/admin/logout', 'Admin::logout');

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
