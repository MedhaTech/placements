<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use CodeIgniter\Database\Config;
use Config\Database;
use App\Libraries\GlobalData;
use App\Models\StudentModel;
use App\Models\FamilyDetailModel;
use App\Models\ExperienceDetailModel;
use App\Models\EducationDetailModel;
use App\Models\CertificationModel;
use App\Models\ProjectsPublicationsModel;
use App\Models\PlacementOffersModel;
use App\Models\StudentLanguageModel;

use PhpOffice\PhpSpreadsheet\IOFactory;


class StudentController extends Controller
{
    public function studentLogin()
    {
        if (session()->get('isStudentLoggedIn')) {
            return redirect()->to('/student/dashboard');
        }
        return view('student/login');
    }

    public function loginStudentUser()
    {
        $session = session();
        $model = new StudentModel();

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $student = $model->where('official_email', $email)->first();

        if ($student && password_verify($password, $student['password'])) {
            $session->set([
                'student_id' => $student['id'],
                'reg_no'     => $student['reg_no'], // ✅ Add this
                'email' => $student['official_email'],
                'isStudentLoggedIn' => true
            ]);
            return redirect()->to('/student/dashboard');
        }

        return redirect()->back()->withInput()->with('error', 'Invalid credentials.');
    }


    public function studentDashboard()
    {
        if (!session()->get('isStudentLoggedIn')) {
            return redirect()->to('/student');
        }
        return view('student/dashboard');
    }

    public function studentLogout()
    {
        session()->destroy();
        return redirect()->to('/student');
    }

    public function fillMissingPasswords()
{
    $model = new StudentModel();

    // Fetch students with missing or empty passwords
    $students = $model->where('password', null)
                      ->orWhere('password', '')
                      ->findAll();

    $updated = 0;

    foreach ($students as $student) {
        if (!empty($student['mobile_no'])) {
            $hashedPassword = password_hash($student['mobile_no'], PASSWORD_DEFAULT);
            $model->update($student['id'], ['password' => $hashedPassword]);
            $updated++;
        }
    }

    return "Updated $updated student record(s) with missing passwords.";
}

public function overwriteAllPasswordsWithMobile()
{
    $model = new StudentModel();
    $students = $model->findAll();

    $updated = 0;

    foreach ($students as $student) {
        if (!empty($student['mobile_no'])) {
            $hashedPassword = password_hash($student['mobile_no'], PASSWORD_DEFAULT);
            $model->update($student['id'], ['password' => $hashedPassword]);
            $updated++;
        }
    }

    return "Overwritten passwords for $updated student record(s).";
}

    public function studentProfilePreview()
    {
        if (!session()->get('isStudentLoggedIn')) {
            return redirect()->to('/student');
        }

        $student_id = session()->get('student_id');

        $db = \Config\Database::connect();
        $global = new \App\Libraries\GlobalData(); // ✅ FIXED

        $student = $db->table('students')->where('id', $student_id)->get()->getRowArray();

        $skills = $db->table('students_key_skills')
            ->where('student_id', $student_id)
            ->get()
            ->getResultArray();

        $academic = (new \App\Models\StudentModel())->getAcademicInfo($student_id);

        $departments = $db->table('departments')->get()->getResultArray();

        $preferences = $db->table('students_placement_preferences')
            ->where('student_id', $student_id)
            ->get()
            ->getRowArray() ?? [];
       
        // Fetch placement training info
        $training = $this->db->table('students_placement_training')
            ->where('student_id', $student_id)
            ->get()
            ->getRowArray();

        // ✅ Added relation types
        $relationTypes = ['Father', 'Mother', 'Guardian', 'Brother', 'Sister'];
   
    $preferences = $db->table('students_placement_preferences')
                  ->where('student_id', $student_id)
                  ->get()
                  ->getRowArray() ?? [];
    
    
    // Fetch placement training info
    $training = $this->db->table('students_placement_training')
        ->where('student_id', $student_id)
        ->get()
        ->getRowArray();

    // ✅ Added relation types
    $relationTypes = ['Father', 'Mother', 'Guardian', 'Brother', 'Sister'];

    
    // ✅ Fetch profile photo from students_documents table
    $photo = $db->table('students_documents')
        ->where('student_id', $student_id)
        ->where('document_type', 'PHOTO')
        ->get()
        ->getRowArray();

    $photoUrl = $photo && !empty($photo['file_path'])
        ? base_url($photo['file_path'])
        : base_url('assets/default_user.png'); // fallback image
   
     // ✅ Calculate profile completion
    $incompleteSections = [];
    $completion = 0;

    // 1. Profile Summary
    if (!empty($student['profile_summary'])) $completion += 7;
    else $incompleteSections[] = ['name' => 'Profile Summary', 'percent' => 7];

    // 2. Personal Info (All fields required)
    if (
        !empty($student['full_name']) &&
        !empty($student['mobile_no']) &&
        !empty($student['whatsapp_no']) &&
        !empty($student['personal_email']) &&
        !empty($student['official_email']) &&
        !empty($student['gender']) &&
        !empty($student['date_of_birth']) &&
        !empty($student['native_place'])
    ) {
        $completion += 7;
    } else {
        $incompleteSections[] = ['name' => 'Personal Information', 'percent' => 7];
    }


    // 3. Family Details (✅ ALL entries must be complete)
        $familyDetails = $db->table('students_family_details')
                            ->where('student_id', $student_id)
                            ->get()
                            ->getResultArray();

        $hasAllFamilyComplete = true;

        if (empty($familyDetails)) {
            $hasAllFamilyComplete = false;
        } else {
            foreach ($familyDetails as $entry) {
                if (
                    empty($entry['relation']) ||
                    empty($entry['name']) ||
                    empty($entry['contact']) ||
                    empty($entry['occupation']) ||
                    empty($entry['mobile']) ||
                    empty($entry['email']) ||
                    empty($entry['salary'])
                ) {
                    $hasAllFamilyComplete = false;
                    break;
                }
            }
        }

        if ($hasAllFamilyComplete) {
            $completion += 7;
        } else {
            $incompleteSections[] = ['name' => 'Family Details', 'percent' => 7];
        }


    // 4. Experience Details (✅ All entries must be complete)
        $experienceDetails = $db->table('students_experience')
                                ->where('student_id', $student_id)
                                ->get()
                                ->getResultArray();

        $hasAllExperienceComplete = true;

        if (empty($experienceDetails)) {
            $hasAllExperienceComplete = false;
        } else {
            foreach ($experienceDetails as $entry) {
                if (
                    empty($entry['title']) ||
                    empty($entry['employment_type']) ||
                    empty($entry['organization']) ||
                    empty($entry['joining_date']) ||
                    (empty($entry['end_date']) && empty($entry['is_current'])) || // either end date or current must be there
                    empty($entry['location']) ||
                    empty($entry['location_type']) ||
                    empty($entry['remarks'])
                ) {
                    $hasAllExperienceComplete = false;
                    break;
                }
            }
        }

        if ($hasAllExperienceComplete) {
            $completion += 7;
        } else {
            $incompleteSections[] = ['name' => 'Experience Details', 'percent' => 7];
        }

    // 5. Key Skills
    $skills = $db->table('students_key_skills')
             ->where('student_id', $student_id)
             ->get()
             ->getResultArray();


        if (!empty($skills)) {
            $completion += 7;
        } else {
            $incompleteSections[] = ['name' => 'Key Skills', 'percent' => 7];
        }


    // 6. Education Details (✅ STRICT: All 8 fields must be filled for every row)
        $educationDetails = $db->table('students_education')
                            ->where('student_id', $student_id)
                            ->get()
                            ->getResultArray();

        $hasAllEducationComplete = true;

        if (empty($educationDetails)) {
            $hasAllEducationComplete = false;
        } else {
            foreach ($educationDetails as $entry) {
                // List of strictly required fields
                $requiredFields = [
                    'qualification_type',
                    'institution_name',
                    'board_university',
                    'course_specialization',
                    'course_type',
                    'year_of_passing',
                    'grade_percentage',
                    'result_status'
                ];

                // Check each field is non-empty
                foreach ($requiredFields as $field) {
                    if (!isset($entry[$field]) || trim($entry[$field]) === '') {
                        $hasAllEducationComplete = false;
                        break 2; // break from both loops immediately
                    }
                }

                // (Optional) Add pair logic here if needed
            }
        }

        if ($hasAllEducationComplete) {
            $completion += 7;
        } else {
            $incompleteSections[] = ['name' => 'Education Details', 'percent' => 7];
        }



    // 7. Licenses & Certifications (✅ ALL entries must be complete)
        $certifications = $db->table('students_certifications')
                            ->where('student_id', $student_id)
                            ->get()
                            ->getResultArray();

        $hasAllCertificationsComplete = true;

        if (empty($certifications)) {
            $hasAllCertificationsComplete = false;
        } else {
            foreach ($certifications as $entry) {
                if (
                    empty($entry['certificate_name']) ||
                    empty($entry['issuing_organization']) ||
                    empty($entry['issue_date']) ||
                    empty($entry['expiry_date']) ||
                    empty($entry['reg_no']) ||
                    empty($entry['url'])
                ) {
                    $hasAllCertificationsComplete = false;
                    break;
                }
            }
        }

        if ($hasAllCertificationsComplete) {
            $completion += 7;
        } else {
            $incompleteSections[] = ['name' => 'Licenses & Certifications', 'percent' => 7];
        }


    // 8. Projects & Publications (✅ ALL entries must be complete)
        $projectsPublications = $db->table('students_projects_publications')
                    ->where('student_id', $student_id)
                    ->get()
                    ->getResultArray();

        $hasAllProjectsComplete = true;

        if (empty($projects)) {
            $hasAllProjectsComplete = false;
        } else {
            foreach ($projects as $entry) {
                if (
                    empty($entry['title']) ||
                    empty($entry['publishing_type']) ||
                    empty($entry['publisher']) ||
                    empty($entry['completion_date']) ||
                    empty($entry['authors']) ||
                    empty($entry['publication_url']) ||
                    empty($entry['description'])
                ) {
                    $hasAllProjectsComplete = false;
                    break;
                }
            }
        }

        if ($hasAllProjectsComplete) {
            $completion += 7;
        } else {
            $incompleteSections[] = ['name' => 'Projects & Publications', 'percent' => 7];
        }


    // 9. Languages (✅ ALL entries must be complete)
        $languages = $db->table('students_languages')
                        ->where('student_id', $student_id)
                        ->get()
                        ->getResultArray();

        $hasAllLanguagesComplete = true;

        if (empty($languages)) {
            $hasAllLanguagesComplete = false;
        } else {
            foreach ($languages as $entry) {
                if (
                    empty($entry['language_name']) ||
                    empty($entry['proficiency']) ||
                    (
                        empty($entry['can_read']) &&
                        empty($entry['can_write']) &&
                        empty($entry['can_speak'])
                    )
                ) {
                    $hasAllLanguagesComplete = false;
                    break;
                }
            }
        }

        if ($hasAllLanguagesComplete) {
            $completion += 7;
        } else {
            $incompleteSections[] = ['name' => 'Languages Known', 'percent' => 7];
        }


    // 10. Current Academic Information (✅ Must be completely filled + SGPA till current sem + Entrance Rank conditionally)
        $academicInfo = $db->table('students_academics')
                        ->where('student_id', $student_id)
                        ->get()
                        ->getRowArray();

        $hasAcademicInfoComplete = true;

        if (!$academicInfo) {
            $hasAcademicInfoComplete = false;
        } else {
            // Basic required fields
            $requiredFields = [
                'pursuing_degree',
                'department_id',
                'year_of_joining',
                'type_of_entry',
                'mode_of_admission',
                'active_backlogs',
                'backlog_history',
                'year_back',
                'academic_gaps'
            ];

            foreach ($requiredFields as $field) {
                if (!isset($academicInfo[$field]) || trim($academicInfo[$field]) === '') {
                    $hasAcademicInfoComplete = false;
                    break;
                }
            }

            // Entrance Rank required if admission is through entrance
            if (
                $hasAcademicInfoComplete &&
                strtolower(trim($academicInfo['mode_of_admission'])) === 'through entrance' &&
                (empty($academicInfo['entrance_rank']) && $academicInfo['entrance_rank'] !== '0')
            ) {
                $hasAcademicInfoComplete = false;
            }

            // SGPA/CGPA fields validation till current semester
            if ($hasAcademicInfoComplete) {
                $currentSem = 0;

                for ($i = 1; $i <= 10; $i++) {
                    $field = 'sem' . $i . '_sgpa_cgpa';
                    if (!empty($academicInfo[$field])) {
                        $currentSem = $i;
                    } else {
                        break;
                    }
                }

                for ($i = 1; $i <= $currentSem; $i++) {
                    $field = 'sem' . $i . '_sgpa_cgpa';
                    if (!isset($academicInfo[$field]) || trim($academicInfo[$field]) === '') {
                        $hasAcademicInfoComplete = false;
                        break;
                    }
                }
            }
        }

        if ($hasAcademicInfoComplete) {
            $completion += 7;
        } else {
            $incompleteSections[] = ['name' => 'Current Academic Information', 'percent' => 7];
        }

//placement preferences
   $studentId = session()->get('student_id');
    $db = \Config\Database::connect();

    // Fetch placement preferences
    $placement = $db->table('students_placement_preferences')
                    ->where('student_id', $studentId)
                    ->get()
                    ->getRowArray();



   // 12. Placement Training (strict)
        $training = $db->table('students_placement_training')
                    ->where('student_id', $student_id)
                    ->get()
                    ->getRowArray();

        $hasTrainingData = true;

        if (empty($training) ||
            empty($training['training_attendance']) ||
            empty($training['training_score']) ||
            empty($training['px_certificates'])) {
            $hasTrainingData = false;
        }

        if ($hasTrainingData) {
            $completion += 7;
        } else {
            $incompleteSections[] = ['name' => 'Placement Training', 'percent' => 7];
        }


    // 13. Placement Offers (✅ STRICT: All entries must be fully filled including Offer Status)
        $offers = $db->table('students_placement_offers')
                    ->where('student_id', $student_id)
                    ->get()
                    ->getResultArray();

        $hasAllOffersComplete = true;

        if (empty($offers)) {
            $hasAllOffersComplete = false;
        } else {
            foreach ($offers as $offer) {
                if (
                    empty($offer['company_name']) ||
                    empty($offer['job_title']) ||
                    empty($offer['offered_salary']) ||
                    empty($offer['status']) ||              // Eligible / Applied / Selected etc.
                    empty($offer['offer_status'])           // Accepted / Rejected / On Hold etc.
                ) {
                    $hasAllOffersComplete = false;
                    break;
                }
            }
        }

        if ($hasAllOffersComplete) {
            $completion += 7;
        } else {
            $incompleteSections[] = ['name' => 'Placement Offers', 'percent' => 7];
        }

    

    // 14. Documents (✅ STRICT: All entries must have document_type and file_path)
        $documents = $db->table('students_documents')
                        ->where('student_id', $student_id)
                        ->get()
                        ->getResultArray();

        $hasAllDocumentsComplete = true;

        if (empty($documents)) {
            $hasAllDocumentsComplete = false;
        } else {
            foreach ($documents as $doc) {
                if (
                    empty($doc['document_type']) ||
                    empty($doc['file_path'])
                ) {
                    $hasAllDocumentsComplete = false;
                    break;
                }
            }
        }

        if ($hasAllDocumentsComplete) {
            $completion += 7;
        } else {
            $incompleteSections[] = ['name' => 'Documents', 'percent' => 7];
        }

        // 15. Resume Upload (✅ 2% if resume_url is uploaded)
    if (!empty($student['resume_url'])) {
        $completion += 2;
    } else {
        $incompleteSections[] = ['name' => 'Resume Upload', 'percent' => 2];
    }



    $completionPercentage = $completion . '%';

        return view('student/student_profile_preview', [
        'student' => $student,
        'skills' => $skills,
        'academic' => $academic,
        'preferences' => $preferences, 
        'training' => $training,
        'departments' => $departments,
        'pursuingDegrees' => $global->getPursuingDegrees(),
        'entryTypes' => $global->getEntryTypes(),
        'admissionModes' => $global->getAdmissionModes(),
        'yesNoOptions' => $global->getYesNoOptions(),
        'completionPercentage' => $completionPercentage, // ✅ Comma added here
        'relationTypes' => $relationTypes,               // ✅ This line is now valid
        'incompleteSections' => $incompleteSections, // pass to view
        'photoUrl' => $photoUrl, 
        'familyDetails' => $familyDetails,
        'experienceDetails' => $experienceDetails,
        'educationDetails' => $educationDetails,
        'licensesCertifications' => $certifications,
        'projectsPublications' => $projectsPublications,
        'placementOffers' => $offers,
        'placement' => $placement , // ✅ ADD THIS HERE
        'studentLanguages' => $languages,
    ]);

    }

    // Optional: If used globally, this function should move to GlobalData instead
    public function getSpecificChoices()
    {
        return [
            'Yes',
            'Software/IT Job',
            'Core domain job',
            'Sales/Marketing/Business Development',
            'No',
            'Higher Studies',
            'Govt. Jobs',
            'Business'
        ];
    }
    public function updateProfileSummary()
    {
        $id = session()->get('student_id');
        $summary = $this->request->getPost('summary');

        $model = new \App\Models\StudentModel();
        $model->updateProfileSummary($id, $summary);

        return redirect()->to('/student/profile')->with('success', 'Profile summary updated successfully.');
    }
    public function updatePersonalInfo()
    {
        $id = session()->get('student_id');
        $data = $this->request->getPost();


    $data['updated_on'] = date('Y-m-d H:i:s');

    $model = new \App\Models\StudentModel();

        $model->updatePersonalInfo($id, $data);

        return redirect()->to('/student/profile')->with('success', 'Personal information updated successfully.');
    }
    public function updateSkills()
    {
        $id = session()->get('student_id');
        $skills = $this->request->getPost('skills'); // array of skills

        $model = new \App\Models\StudentModel();
        $model->updateKeySkills($id, $skills);

        return redirect()->to('/student/profile')->with('success', 'Skills updated successfully.');
    }

    public function addSkill()
{
    $skill = $this->request->getPost('skill_name');
    $studentId = session()->get('student_id');

    if (!empty($skill) && $studentId) {
        $this->db->table('students_key_skills')->insert([
            'student_id' => $studentId,
            'skill_name' => $skill,
            'created_by' => 'self'
        ]);
        return $this->response->setStatusCode(200)->setBody('success');
    }

    return $this->response->setStatusCode(400)->setBody('error');
}

public function deleteSkill()
{
    if ($this->request->isAJAX()) {
        $skillId = $this->request->getPost('skill_id');
        $studentId = session()->get('student_id');

        $deleted = $this->db->table('students_key_skills')
                            ->where('id', $skillId)
                            ->where('student_id', $studentId)
                            ->delete();

        return $this->response->setJSON(['status' => $deleted ? 'success' : 'error']);
    }
}


    public function __construct()
    {
        $this->db = Database::connect(); // ✅ This sets up $this->db
    }


   public function updateAcademicInfo()
{
    $studentId = session()->get('student_id');
    $model = new StudentModel();

    $data = [
        'pursuing_degree'     => $this->request->getPost('pursuing_degree'),
        'department_id'       => $this->request->getPost('department_id'),
        'year_of_joining'     => $this->request->getPost('year_of_joining'),
        'type_of_entry'       => $this->request->getPost('type_of_entry'),
        'mode_of_admission'   => $this->request->getPost('mode_of_admission'),
        'entrance_rank'       => $this->request->getPost('entrance_rank'),
        'active_backlogs'     => $this->request->getPost('active_backlogs'),
        'backlog_history'     => $this->request->getPost('backlog_history'),
        'year_back'           => $this->request->getPost('year_back') === 'Yes' ? 1 : 0,
        'academic_gaps'       => $this->request->getPost('academic_gaps'),
        'updated_by'          => 'self'
    ];

    // Map the sem_sgpa_cgpa[] array into sem1_sgpa_cgpa, sem2_sgpa_cgpa...
    $semesters = $this->request->getPost('sem_sgpa_cgpa');
    if (is_array($semesters)) {
        foreach ($semesters as $index => $value) {
            $key = 'sem' . ($index + 1) . '_sgpa_cgpa';
            $data[$key] = trim($value);
        }
    }

    $model->saveAcademicInfo($studentId, $data);

    return redirect()->to('/student/profile')->with('success', 'Academic info updated successfully.');
}


    public function updatePlacementPreferences()
    {
        $studentId = session()->get('student_id');

        $data = [
            'interested_in_placements' => $this->request->getPost('interested_in_placements'),
            'preferred_jobs' => $this->request->getPost('preferred_jobs') ?? '', // comma separated string
            'interested_in_higher_studies' => $this->request->getPost('interested_in_higher_studies'),
            'updated_by' => 'self'
        ];

        $model = new StudentModel();
        $model->savePlacementPreferences($studentId, $data);

        return redirect()->to('/student/profile')->with('success', 'Placement preferences updated successfully.');
    }  
    public function changePasswordForm()
    {
        return view('student/student_pwd', [
            'errors' => [],
            'values' => [],
        ]);
    }

    public function updatePassword()
    {
        $session = session();
        $studentId = $session->get('student_id'); // ✅ assuming session has student_id
        $Model = new \App\Models\StudentModel(); // ✅ updated model

        $current = $this->request->getPost('current_password');
        $new = $this->request->getPost('new_password');
        $confirm = $this->request->getPost('confirm_password');

        $errors = [];

        // 1️⃣ Empty field validation
        if (empty($current)) {
            $errors['current_password'] = 'Current password is required.';
        }

        if (empty($new)) {
            $errors['new_password'] = 'New password is required.';
        }

        if (empty($confirm)) {
            $errors['confirm_password'] = 'Please confirm the new password.';
        }

        // 2️⃣ Additional validations
        if (empty($errors)) {
            $dbUser = $Model->find($studentId);

            if (!$dbUser || !password_verify($current, $dbUser['password'])) {
                $errors['current_password'] = 'Current password is incorrect.';
            }

            if ($new === $current) {
                $errors['new_password'] = 'New password must be different from the current password.';
            }

            if ($new !== $confirm) {
                $errors['confirm_password'] = 'Passwords do not match.';
            }
        }


        // 3️⃣ Return if errors
        if (!empty($errors)) {
            return view('student/student_pwd', [
                'errors' => $errors,
                'values' => $this->request->getPost()
            ]);
        }

        // 4️⃣ Hash and update password
        $hashedPassword = password_hash($new, PASSWORD_DEFAULT);
        $Model->update($studentId, ['password' => $hashedPassword]);

        // 5️⃣ Redirect with toaster success
        return redirect()
            ->to('student/dashboard')
            ->with('success', 'Password changed successfully.');
    }


  public function uploadDocument()
{
    date_default_timezone_set('Asia/Kolkata'); // ✅ Ensure correct local time

    $session = session();
    $studentId = $session->get('student_id');
    $regNo = trim($session->get('reg_no'));

    // 🔴 Check session data
    if (empty($regNo)) {
        return redirect()->back()->with('error', '❌ Registration number missing in session.');
    }

    // 🔴 Only POST requests allowed
    if (!$this->request->is('post')) {
        return redirect()->back()->with('error', '❌ Invalid request method.');
    }

    $documentType = strtoupper($this->request->getPost('document_type'));
    $file = $this->request->getFile('document_file');

    // 🔴 File validation
    if (!$file || !$file->isValid()) {
        return redirect()->back()->with('error', '❌ Please upload a valid file.');
    }

    // ✅ Upload folder path
    $uploadPath = FCPATH . 'assets/Stu_Docs/' . $regNo . '/';

    // 🔧 Create folder if not exists
    if (!is_dir($uploadPath)) {
        try {
            mkdir($uploadPath, 0777, true);
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', '❌ Failed to create folder: ' . $uploadPath);
        }
    }

   // ✅ Format: MMDDYYYY + HHMM (24-hour format, no underscore)
        $timestamp = date('mdY') . date('Hi'); // 'Hi' = HourMinute in 24hr format
        $ext = $file->getExtension();
        $newFileName = $documentType . '_' . $timestamp . '.' . $ext;
        $fullPath = $uploadPath . $newFileName;


    // ✅ If PHOTO: delete old file(s)
    if ($documentType === 'PHOTO') {
        $existingFiles = glob($uploadPath . 'PHOTO_*');
        foreach ($existingFiles as $oldFile) {
            if (is_file($oldFile)) {
                unlink($oldFile);
            }
        }
        // No need to delete DB — handled in model
    }

    // ✅ Move the uploaded file
    if (!$file->move($uploadPath, $newFileName)) {
        return redirect()->back()->with('error', '❌ Failed to move uploaded file.');
    }

    // ✅ Save relative path to DB
    $relativePath = 'assets/Stu_Docs/' . $regNo . '/' . $newFileName;

    // ✅ Save/Replace in DB
    $studentModel = new \App\Models\StudentModel();
    $studentModel->saveStudentDocument($studentId, $documentType, $relativePath);

    return redirect()->back()->with('success', '✅ Document uploaded successfully!');

}

 public function uploadExcelForm()
{
    return view('student/upload_excel'); // adjust path if needed
}

public function uploadExcel()
{
    helper(['form']);
    $file = $this->request->getFile('excel_file');

    if ($file && $file->isValid()) {
        $ext = $file->getClientExtension();

        if ($ext === 'xlsx') {
            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file->getTempName());
            $sheet = $spreadsheet->getActiveSheet()->toArray();

            $studentModel = new \App\Models\StudentModel();

            foreach ($sheet as $index => $row) {
                if ($index == 0) continue; // skip header

                // Get fields (default empty except mobile)
                $reg_no                = $row[0] ?? '';
                $full_name             = $row[1] ?? '';
                $mobile_no             = $row[2] ?? '';
                $whatsapp_no           = $row[3] ?? '';
                $personal_email        = $row[4] ?? '';
                $official_email        = $row[6] ?? '';
                $gender                = $row[7] ?? '';
                $date_of_birth         = $row[8] ?? '';
                $native_place          = $row[9] ?? '';
                $communication_address = $row[10] ?? '';
                $communication_state   = $row[11] ?? '';
                $communication_pincode = $row[12] ?? '';
                $permanent_address     = $row[13] ?? '';
                $permanent_state       = $row[14] ?? '';
                $permanent_pincode     = $row[15] ?? '';
                $pan_number            = $row[16] ?? '';
                $aadhar_number         = $row[17] ?? '';
                $appar_id              = $row[18] ?? '';
                $profile_summary       = $row[19] ?? '';
                $linkedin              = $row[20] ?? '';
                $github                = $row[21] ?? '';

                // Required check for mobile_no
                if (empty($mobile_no)) continue; // skip row if mobile_no missing

                // Password based on mobile number
                $password_raw = $row[5] ?? $mobile_no;

                $studentModel->save([
                    'reg_no'                => $reg_no,
                    'full_name'             => $full_name,
                    'mobile_no'             => $mobile_no,
                    'whatsapp_no'           => $whatsapp_no,
                    'personal_email'        => $personal_email,
                    'password'              => password_hash($password_raw, PASSWORD_DEFAULT),
                    'official_email'        => $official_email,
                    'gender'                => $gender,
                    'date_of_birth'         => $date_of_birth,
                    'native_place'          => $native_place,
                    'communication_address' => $communication_address,
                    'communication_state'   => $communication_state,
                    'communication_pincode' => $communication_pincode,
                    'permanent_address'     => $permanent_address,
                    'permanent_state'       => $permanent_state,
                    'permanent_pincode'     => $permanent_pincode,
                    'pan_number'            => $pan_number,
                    'aadhar_number'         => $aadhar_number,
                    'appar_id'              => $appar_id,
                    'profile_summary'       => $profile_summary,
                    'linkedin'              => $linkedin,
                    'github'                => $github,
                    'created_by'            => 'admin',
                    'created_on'            => date('Y-m-d H:i:s'),
                ]);
            }

            return redirect()->to('student/uploadExcel')->with('success', 'Data imported successfully.');
        }
    }

    return redirect()->back()->with('error', 'Invalid file.');
}
public function saveFamilyDetails()
{
    $familyModel = new FamilyDetailModel();

    $data = [
        'student_id' => session('student_id'),
        'relation'   => $this->request->getPost('relation'),
        'name'       => $this->request->getPost('name'),
        'contact'    => $this->request->getPost('contact'),
        'occupation' => $this->request->getPost('occupation'),
        'mobile'     => $this->request->getPost('mobile'),
        'email'      => $this->request->getPost('email'),
        'salary'     => $this->request->getPost('salary'),
    ];

    if (!empty($data['relation']) && !empty($data['name'])) {
        $familyModel->insert($data);
        return redirect()->back()->with('success', 'Family detail saved.');
    }

    return redirect()->back()->with('error', 'Failed to save family detail.');
}
public function studentProfile()
{
    $studentId = session('student_id');
    $familyModel = new FamilyDetailMode();

    $data['familyDetails'] = $familyModel->where('student_id', $studentId)->findAll();
    // Load your profile view and pass $data
    return view('student/student_profile_preview', $data);
    return redirect()->to('/student/profile'); // or whatever your route is
}
public function saveExperienceDetails()
{
    $experienceModel = new ExperienceDetailModel();

    $data = [
        'student_id'       => session('student_id'),
        'title'            => $this->request->getPost('title'),
        'employment_type'  => $this->request->getPost('employment_type'),
        'organization'     => $this->request->getPost('organization'),
        'joining_date'     => $this->request->getPost('joining_date'),
        'is_current'       => $this->request->getPost('is_current') ? 1 : 0,
        'end_date'         => $this->request->getPost('end_date'),
        'location'         => $this->request->getPost('location'),
        'location_type'    => $this->request->getPost('location_type'),
        'remarks'          => $this->request->getPost('remarks'),
    ];

    $experienceModel->insert($data);

    return redirect()->to('/student/profile');
}
public function saveEducationDetails()
{
    $model = new EducationDetailModel();
    $studentId = session('student_id');

    $data = [
        'student_id' => $studentId,
        'qualification_type' => $this->request->getPost('qualification_type'),
        'institution_name' => $this->request->getPost('institution_name'),
        'board_university' => $this->request->getPost('board_university'),
        'course_specialization' => $this->request->getPost('course_specialization'),
        'course_type' => $this->request->getPost('course_type'),
        'year_of_passing' => $this->request->getPost('year_of_passing'),
        'grade_percentage' => $this->request->getPost('grade_percentage'),
        'result_status' => $this->request->getPost('result_status'),
        'created_by' => session('student_name'),
        'created_on' => date('Y-m-d H:i:s'),
    ];

    $model->save($data);
    return redirect()->to('/student/profile');
}
public function saveCertification()
{
    $model = new \App\Models\CertificationModel();

    $data = [
        'student_id' => session('student_id'),
        'certificate_name' => $this->request->getPost('certificate_name'),
        'issuing_organization' => $this->request->getPost('issuing_organization'),
        'issue_date' => $this->request->getPost('issue_date'),
        'expiry_date' => $this->request->getPost('expiry_date'),
        'reg_no' => $this->request->getPost('reg_no'),
        'url' => $this->request->getPost('url'),
        'created_by' => session('user_id') ?? 'system',
        'updated_by' => session('user_id') ?? 'system',
    ];

    $model->save($data);
    return redirect()->to('/student/profile');
}
public function saveProjectsPublications()
{
    $model = new ProjectsPublicationsModel();

    $data = [
        'student_id'       => session()->get('student_id'),
        'title'            => $this->request->getPost('title'),
        'publishing_type'  => $this->request->getPost('publishing_type'),
        'publisher'        => $this->request->getPost('publisher'),
        'completion_date'  => $this->request->getPost('completion_date'),
        'authors'          => $this->request->getPost('authors'),
        'publication_url'  => $this->request->getPost('publication_url'),
        'description'      => $this->request->getPost('description'),
        'created_by'       => session()->get('username'),
        'updated_by'       => session()->get('username')
    ];

    if ($model->save($data)) {
        return $this->response->setJSON(['status' => 'success']);
    } else {
        return $this->response->setJSON([
            'status' => 'error',
            'message' => $model->errors()
        ]);
    }
}

public function savePlacementOffer()
{
    $session = session();
    $studentId = $session->get('student_id'); // assumes login session
    if (!$studentId) {
        return redirect()->to('/student')->with('error', 'Login required.');
    }

    $model = new \App\Models\PlacementOffersModel();

    $data = [
        'student_id'     => $studentId,
        'company_name'   => $this->request->getPost('company_name'),
        'job_title'      => $this->request->getPost('job_title'),
        'offered_salary' => $this->request->getPost('offered_salary'),
        'status'         => $this->request->getPost('status'),
        'offer_status'   => $this->request->getPost('offer_status'),
        'created_by'     => $session->get('user_id') ?? 'system',
        'created_on'     => date('Y-m-d H:i:s'),
    ];

    $model->save($data);

    return redirect()->back()->with('success', 'Placement offer saved successfully.');
}
public function saveLanguage()
{
    $session = session();
    $studentId = $session->get('student_id');
    if (!$studentId) {
        return redirect()->to('/student')->with('error', 'Login required.');
    }

    $model = new \App\Models\StudentLanguageModel();

    $data = [
        'student_id'   => $studentId,
        'language_name'=> $this->request->getPost('language_name'),
        'proficiency'  => $this->request->getPost('proficiency'),
        'can_read'     => $this->request->getPost('can_read') ? 1 : 0,
        'can_write'    => $this->request->getPost('can_write') ? 1 : 0,
        'can_speak'    => $this->request->getPost('can_speak') ? 1 : 0,
        'created_by'   => $session->get('user_id') ?? 'system',
        'created_on'   => date('Y-m-d H:i:s'),
    ];

    $model->save($data);

    return redirect()->back()->with('success', 'Language added successfully.');
}



}
