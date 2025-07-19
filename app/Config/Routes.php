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

$routes->get('/student/student_pwd', 'StudentController::changePasswordForm');
$routes->post('/student/student_pwd', 'StudentController::updatePassword');

// Static preview page
/*$routes->get('/preview', function () {
    return view('student/student_profile_preview');
});*/
$routes->get('/student/profile-preview', 'StudentController::studentProfilePreview');

//profile summary

$routes->get('/student/profile', 'StudentController::studentProfilePreview');
$routes->post('/student/update-profile-summary', 'StudentController::updateProfileSummary');

//personal information
$routes->post('/student/update-personal-info', 'StudentController::updatePersonalInfo');

//key skills
$routes->post('/student/update-skills', 'StudentController::updateSkills');
$routes->post('/student/delete-skill', 'StudentController::deleteSkill');
$routes->post('/student/add-skill', 'StudentController::addSkill');

//Academics info
$routes->post('/student/update-academic-info', 'StudentController::updateAcademicInfo');

//placement preferences
$routes->post('student/update-placement-preferences', 'StudentController::updatePlacementPreferences');
$routes->get('/preview', 'StudentController::studentProfilePreview');

// Admin login and dashboard
$routes->get('/admin', 'AdminController::adminLogin');
$routes->post('/admin-login', 'AdminController::loginAdminUser');
$routes->get('/admin/dashboard', 'AdminController::adminDashboard');
$routes->get('/admin/logout', 'AdminController::adminLogout');


// Student Family Details Save
$routes->post('/student/save-family-details', 'StudentController::saveFamilyDetails');

$routes->get('/admin/change_pwd', 'AdminController::changePasswordForm');
$routes->post('/admin/change_pwd', 'AdminController::updatePassword');


