<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

//Student Routes
// Default route for student login
$routes->get('/', 'StudentController::studentLogin');
$routes->get('/student', 'StudentController::studentLogin');
$routes->get('/placements', 'StudentController::studentLogin');

// Student login and dashboard
$routes->post('/student-login', 'StudentController::loginStudentUser');
$routes->get('/student/dashboard', 'StudentController::studentDashboard');
$routes->get('/student/logout', 'StudentController::studentLogout');

//Change password 
$routes->get('/student/student_pwd', 'StudentController::changePasswordForm');
$routes->post('/student/student_pwd', 'StudentController::updatePassword');

// to fill missing password rows 
$routes->get('student/fill-missing-passwords', 'StudentController::fillMissingPasswords');

//Overwrite all password column to mobile no as password(hashed) 
$routes->get('student/overwrite-all-passwords-with-mobile', 'StudentController::overwriteAllPasswordsWithMobile');

// Excel tables upload 
$routes->get('student/upload', 'StudentController::uploadExcelView');
$routes->post('student/uploadExcel', 'StudentController::uploadExcel');
$routes->get('student/uploadExcel', 'StudentController::uploadExcelForm');



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


$routes->post('student/uploadDocument', 'StudentController::uploadDocument');


//Admin Routes

// Admin login and dashboard
$routes->get('/admin', 'AdminController::adminLogin');
$routes->post('/admin-login', 'AdminController::loginAdminUser');
$routes->get('/admin/dashboard', 'AdminController::adminDashboard');
$routes->get('/admin/logout', 'AdminController::adminLogout');



//upload excel
$routes->get('admin/uploadExcel', 'AdminController::uploadExcelForm');  // Form page
$routes->post('admin/uploadExcel', 'AdminController::uploadExcel');     // Form submit
$routes->get('admin/upload', 'AdminController::uploadExcelView');       // (Optional view, unused?)




// Student Family Details Save
$routes->post('/student/save-family-details', 'StudentController::saveFamilyDetails');

$routes->get('/admin/change_pwd', 'AdminController::changePasswordForm');
$routes->post('/admin/change_pwd', 'AdminController::updatePassword');

//Student Experience Details save
$routes->post('/student/save-experience-details', 'StudentController::saveExperienceDetails');

//Student Education Details save
$routes->post('student/save-education-details', 'StudentController::saveEducationDetails');

//Student Certifications Save
$routes->post('/student/save-certification', 'StudentController::saveCertification');

//Student Projects Save
$routes->post('/save-projects-publications', 'StudentController::saveProjectsPublications');

//Student Placement offers save
$routes->post('student/savePlacementOffer', 'StudentController::savePlacementOffer');

//Student Languages Save
$routes->post('student/save-language', 'StudentController::saveLanguage');

//Student Family details Edit and Delete
$routes->post('/student/save-family-detail', 'StudentController::saveFamilyDetail');
$routes->post('/student/delete-family-detail', 'StudentController::deleteFamilyDetail');

//language 
$routes->post('student/update-language', 'StudentController::updateLanguage');
$routes->post('student/delete-language-detail', 'StudentController::deleteLanguageDetail');

//project and publication
$routes->post('/student/update-project-publication', 'StudentController::updateProjectPublication');
$routes->post('student/delete-project', 'StudentController::deleteProject');


//placement offer
$routes->post('/student/update-placement-offer', 'StudentController::updatePlacementOffer');
$routes->post('/student/delete-placement-offer', 'StudentController::deletePlacementOffer');

// Experience edit and delete Details
$routes->post('/student/update-experience', 'StudentController::updateExperience');
$routes->post('/student/delete-experience', 'StudentController::deleteExperience');

// Education edit and delete Details
$routes->post('/student/update-education', 'StudentController::updateEducation');
$routes->post('/student/delete-education', 'StudentController::deleteEducation');

// Licenses & Certifications edit and delete
$routes->post('/student/update-certification', 'StudentController::updateCertification');
$routes->post('/student/delete-certification', 'StudentController::deleteCertification');

//Admin company registration
$routes->get('enroll-company', 'AdminController::enrollCompanyForm'); 
$routes->post('submit-company-registration', 'AdminController::submitCompanyRegistration');


