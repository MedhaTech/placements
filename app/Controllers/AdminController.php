<?php

namespace App\Controllers;

use App\Models\AdminModel;
use CodeIgniter\Controller;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Models\StudentModel;



class AdminController extends Controller
{
    public function adminLogin()
    {
        return view('admin/login');
    }

  public function loginAdminUser()
{
    $session = session();
    $model = new \App\Models\AdminModel();

    $email = $this->request->getPost('email');
    $password = $this->request->getPost('password');

    $admin = $model->where('email', $email)->first();

    if (!$admin) {
        echo "Invalid email";
        return redirect()->to('/admin')->with('error', 'Invalid email.');
    }

    if (!password_verify($password, $admin['password'])) {
        echo "Incorrect password";
        return redirect()->to('/admin')->with('error', 'Incorrect password.');
    }

    if (!in_array($admin['role'], ['1', '2'])) {
        echo "You are not an admin";
        return redirect()->to('/admin')->with('error', 'You are not an admin.');
    }

    // Success: set session
    $session->set([
        'admin_id' => $admin['id'],
        'admin_email' => $admin['email'],
        'role' => $admin['role'],
        'isAdminLoggedIn' => true
    ]);

    echo "Redirecting to dashboard...";
    return redirect()->to('/admin/dashboard');
}



    
public function adminDashboard()
{
    if (!session()->get('isAdminLoggedIn') || !in_array(session()->get('role'), ['1', '2'])) {
        return redirect()->to('/admin');
    }

    $data = [
        'title' => 'Admin Dashboard'
    ];

    return view('admin/dashboard', $data);
}




    public function adminLogout()
    {
        session()->destroy();
        return redirect()->to('/admin')->with('success', 'Logged out.');
    }


    public function changePasswordForm()
    {
        return view('admin/change_pwd', [
            'title' => 'Change Password',
            'errors' => [],
            'values' => [],
        ]);
    }

    public function updatePassword()
{
    $session = session();
    $userId = $session->get('user_id'); // ✅ Use session instead of hardcoded ID
    $Model = new \App\Models\AdminModel(); // ✅ Ensure correct model

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

    // 2️⃣ Additional checks only if no empty field errors
    if (empty($errors)) {
        $dbUser = $Model->find($userId);

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

    // 3️⃣ If any errors, return view with error messages + form values
    if (!empty($errors)) {
        return view('admin/change_pwd', [
            'title' => 'Change Password',
            'errors' => $errors,
            'values' => $this->request->getPost()
        ]);
    }

    // 4️⃣ Hash password and update
    $hashedPassword = password_hash($new, PASSWORD_DEFAULT);
    $Model->update($userId, ['password' => $hashedPassword]);

    // ✅ 5. Flash success message and redirect
    return redirect()
        ->to('admin/dashboard')
        ->with('success', 'Password changed successfully.');
}

 public function uploadExcelForm()
{
    $data['title'] = 'Bulk Upload';
    return view('admin/upload_excel'); // adjust path if needed
}

public function uploadExcel()
{
    $file = $this->request->getFile('excel_file');

    if ($file && $file->isValid() && !$file->hasMoved()) {
        $spreadsheet = IOFactory::load($file->getTempName());
        $sheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

        $model = new StudentModel();

        for ($i = 2; $i <= count($sheet); $i++) {
            $row = $sheet[$i];

            // ✅ Mandatory field check - SKIP if any are missing
            if (
                empty($row['A']) || // reg_no
                empty($row['B']) || // full_name
                empty($row['C']) || // mobile_no
                empty($row['E']) || // personal_email
                empty($row['G'])    // official_email
            ) {
                continue; // Skip this row
            }

            $email = trim($row['E']);

            // 🔍 Check if this email already exists in DB
            $existing = $model->where('personal_email', $email)->first();

            if ($existing) {
                continue; // Skip if duplicate found
            }

            $password = trim($row['F'] ?? '');
            $mobile_no = trim($row['C']);

            if ($password === '') {
                $password = password_hash($mobile_no, PASSWORD_DEFAULT);
            } elseif (strpos($password, '$2y$') !== 0) {
                $password = password_hash($password, PASSWORD_DEFAULT);
            }

            $data = [
                'reg_no' => trim($row['A']),
                'full_name' => trim($row['B']),
                'mobile_no' => $mobile_no,
                'whatsapp_no' => trim($row['D'] ?? ''),
                'personal_email' => $email,
                'password' => $password,
                'official_email' => trim($row['G']),
                'gender' => trim($row['H'] ?? ''),
                'date_of_birth' => trim($row['I'] ?? ''),
                'native_place' => trim($row['J'] ?? ''),
                'communication_address' => trim($row['K'] ?? ''),
                'communication_state' => trim($row['L'] ?? ''),
                'communication_pincode' => trim($row['M'] ?? ''),
                'permanent_address' => trim($row['N'] ?? ''),
                'permanent_state' => trim($row['O'] ?? ''),
                'permanent_pincode' => trim($row['P'] ?? ''),
                'pan_number' => trim($row['Q'] ?? ''),
                'aadhar_number' => trim($row['R'] ?? ''),
                'appar_id' => trim($row['S'] ?? ''),
                'profile_summary' => trim($row['T'] ?? ''),
                'linkedin' => trim($row['Y'] ?? ''),
                'github' => trim($row['Z'] ?? ''),
                'created_by' => 'admin',
                'created_on' => date('Y-m-d H:i:s'),
                'updated_by' => 'admin',
                'updated_on' => date('Y-m-d H:i:s'),
            ];

            $model->insert($data);
        }

        return redirect()->back()->with('success', 'Excel data uploaded successfully (duplicates skipped).');
    } else {
        return redirect()->back()->with('error', 'Please upload a valid Excel file.');
    }
}

public function enrollCompanyForm()
{
    return view('admin/Enroll_company', [
        'title' => 'Enroll Company'
    ]);
}

public function submitCompanyRegistration()
{
    $jobModel = new \App\Models\AdminModel(); // Make sure this model has insertBatchJobRequirements()

    // Step 1: Collect posted data
    $jobProfiles = $this->request->getPost('job_profiles');
    $vacancies   = $this->request->getPost('vacancies');
    $locations   = $this->request->getPost('locations');
    $ctcPackages = $this->request->getPost('salary');
    $eligibility = $this->request->getPost('eligibility');

    // Step 2: Prepare data for insertBatch
    $data = [];

    if ($jobProfiles && is_array($jobProfiles)) {
        for ($i = 0; $i < count($jobProfiles); $i++) {
            if (!empty($jobProfiles[$i])) {
                $data[] = [
                    'job_profile'          => $jobProfiles[$i],
                    'vacancies'            => $vacancies[$i] ?? null,
                    'job_location'         => $locations[$i] ?? null,
                    'ctc_package'          => $ctcPackages[$i] ?? null,
                    'eligibility_criteria' => $eligibility[$i] ?? null,
                    'company_id'           => $this->request->getPost('company_id') // ✅ if needed
                ];
            }
        }
    }

    // Step 3: Insert to DB
    if (!empty($data)) {
        $jobModel->insertBatchJobRequirements($data); // 🔁 make sure this method exists in AdminModel
        session()->setFlashdata('success', 'Company registration saved successfully!');
        return redirect()->to('/admin/dashboard');
    } else {
        session()->setFlashdata('error', 'Please fill in all job details.');
        return redirect()->to('/admin/enroll-company');
    }
}
public function searchStudent()
{
    $regNo = $this->request->getGet('reg_no');

    if (empty($regNo)) {
        return redirect()->back()->with('error', 'Please enter a registration number.');
    }

    $studentModel = new \App\Models\StudentModel();
    $student = $studentModel->getStudentIdByRegNo($regNo);

    if ($student) {
        // Admins can preview any student's profile
        return redirect()->to('/student/profile-preview/' . $student['id']);
    } else {
        return redirect()->back()->with('error', 'Student not found.');
    }
}
public function adminViewProfile($student_id)
{
    $db = \Config\Database::connect();
    $global = new \App\Libraries\GlobalData();

    $student = $db->table('students')->where('id', $student_id)->get()->getRowArray();

    if (!$student) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Student not found");
    }
          

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
        $training = $db->table('students_placement_training')
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
    $training = $db->table('students_placement_training')
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

    $data['photoUrl'] = $photoUrl;    

    // ✅ Fetch resume document (only one allowed)
    $resumeDoc = $db->table('students_documents')
        ->where('student_id', $student_id)
        ->where('document_type', 'RESUME')
        ->get()
        ->getRowArray();

    $resumeUrl = $resumeDoc && !empty($resumeDoc['file_path'])
        ? base_url($resumeDoc['file_path'])
        : null; // null means no resume uploaded


     // ✅ Calculate profile completion
    $incompleteSections = [];
    $completion = 0;
    
    // 1. Profile Summary
    if (!empty($student['profile_summary'])) {
        $completion += 7;
    } else {
        $incompleteSections[] = ['name' => 'Profile Summary', 'percent' => 7];
    }

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
    if (!empty($resumeUrl)) {
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
        'resumeUrl'=> $resumeUrl, // ✅ Pass resume download link
        'familyDetails' => $familyDetails,
        'experienceDetails' => $experienceDetails,
        'educationDetails' => $educationDetails,
        'licensesCertifications' => $certifications,
        'projectsPublications' => $projectsPublications,
        'placementOffers' => $offers,
        'placement' => $placement , // ✅ ADD THIS HERE
        'studentLanguages' => $languages,
    ]);



    // Now copy the same code from `studentProfilePreview()` here...
    // Just **replace** every `session()->get('student_id')` with `$student_id`

    // And return the same `view('student/student_profile_preview', [...])` as before
}

}


