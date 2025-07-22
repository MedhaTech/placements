<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;
use CodeIgniter\Database\Config;
use Config\Database;
use App\Libraries\GlobalData;
use App\Models\StudentModel;

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


    // 6. Education Details (✅ ALL entries must be complete)
        $educationDetails = $db->table('students_education')
                            ->where('student_id', $student_id)
                            ->get()
                            ->getResultArray();

        $hasAllEducationComplete = true;

        if (empty($educationDetails)) {
            $hasAllEducationComplete = false;
        } else {
            foreach ($educationDetails as $entry) {
                if (
                    empty($entry['qualification_type']) ||
                    empty($entry['institution_name']) ||
                    empty($entry['board_university']) ||
                    empty($entry['course_specialization']) ||
                    empty($entry['course_type']) ||
                    empty($entry['year_of_passing']) ||
                    empty($entry['grade_percentage']) ||
                    empty($entry['result_status'])
                ) {
                    $hasAllEducationComplete = false;
                    break;
                }
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
        $projects = $db->table('students_projects_publications')
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


    // 10. Current Academic Info (Strict check)
        $academicInfo = $db->table('students_academics')
                        ->where('student_id', $student_id)
                        ->get()
                        ->getRowArray();

        $hasAcademicInfoComplete = true;

        if (empty($academicInfo)) {
            $hasAcademicInfoComplete = false;
        } else {
            $requiredFields = [
                'pursuing_degree', 'department_id', 'year_of_joining', 'type_of_entry', 
                'mode_of_admission', 'sem1_sgpa_cgpa', 'active_backlogs', 
                'backlog_history', 'year_back', 'academic_gaps'
            ];

            foreach ($requiredFields as $field) {
                if (empty($academicInfo[$field]) && $academicInfo[$field] !== "0") {
                    $hasAcademicInfoComplete = false;
                    break;
                }
            }
        }

        if ($hasAcademicInfoComplete) {
            $completion += 7;
        } else {
            $incompleteSections[] = ['name' => 'Current Academic Information', 'percent' => 7];
        }



    // 11. Placement Preferences (strict)
        $placement = $db->table('students_placement_preferences')
                        ->where('student_id', $student_id)
                        ->get()
                        ->getRowArray();

        $hasPlacementPreferences = true;

        $requiredFields = [
            'interested_in_placements',
            'preferred_jobs',
            'interested_in_higher_studies',
            'placement_coordinator_name',
            'coordinator_department',
            'coordinator_mobile'
        ];

        if (empty($placement)) {
            $hasPlacementPreferences = false;
        } else {
            foreach ($requiredFields as $field) {
                if (!isset($placement[$field]) || $placement[$field] === '') {
                    $hasPlacementPreferences = false;
                    break;
                }
            }
        }

        if ($hasPlacementPreferences) {
            $completion += 7;
        } else {
            $incompleteSections[] = ['name' => 'Placement Preferences', 'percent' => 7];
        }


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
        'incompleteSections' => $incompleteSections // pass to view
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

    public function deleteSkill()
    {
        if ($this->request->isAJAX()) {
            $skillId = $this->request->getPost('skill_id');
            $studentId = session()->get('student_id');

            $db = \Config\Database::connect();
            $builder = $db->table('students_key_skills');

            $builder->where('id', $skillId)->where('student_id', $studentId);
            $deleted = $builder->delete();

            return $this->response->setJSON(['status' => $deleted ? 'success' : 'error']);
        }
    }


    public function __construct()
    {
        $this->db = Database::connect(); // ✅ This sets up $this->db
    }

    public function addSkill()
    {
        $skill = $this->request->getPost('skill_name');
        $studentId = session()->get('student_id');

        if (!empty($skill) && $studentId) {
            $builder = $this->db->table('students_key_skills');
            $builder->insert([
                'student_id' => $studentId,
                'skill_name' => $skill,
                'created_by' => 'self'
            ]);
        }

        return redirect()->to('/student/profile-preview')->with('success', 'Skill added successfully');
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
            'sem1_sgpa_cgpa'      => $this->request->getPost('sem1_sgpa_cgpa'),
            'sem2_sgpa_cgpa'      => $this->request->getPost('sem2_sgpa_cgpa'),
            'sem3_sgpa_cgpa'      => $this->request->getPost('sem3_sgpa_cgpa'),
            'sem4_sgpa_cgpa'      => $this->request->getPost('sem4_sgpa_cgpa'),
            'sem5_sgpa_cgpa'      => $this->request->getPost('sem5_sgpa_cgpa'),
            'sem6_sgpa_cgpa'      => $this->request->getPost('sem6_sgpa_cgpa'),
            'sem7_sgpa_cgpa'      => $this->request->getPost('sem7_sgpa_cgpa'),
            'sem8_sgpa_cgpa'      => $this->request->getPost('sem8_sgpa_cgpa'),
            'sem9_sgpa_cgpa'      => $this->request->getPost('sem9_sgpa_cgpa'),
            'sem10_sgpa_cgpa'     => $this->request->getPost('sem10_sgpa_cgpa'),
            'active_backlogs'     => $this->request->getPost('active_backlogs'),
            'backlog_history'     => $this->request->getPost('backlog_history'),
            'year_back'           => $this->request->getPost('year_back') === 'Yes' ? 1 : 0,
            'academic_gaps'       => $this->request->getPost('academic_gaps'),
            'updated_by'          => 'self'
        ];

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
        $session = session();
        $studentId = $session->get('student_id');

        if (!$this->request->is('post')) {
            return redirect()->back()->with('error', 'Invalid request method');
        }

        $documentType = $this->request->getPost('document_type');
        $file = $this->request->getFile('document_file');

        if (!$file || !$file->isValid()) {
            return redirect()->back()->with('error', 'Please upload a valid file.');
        }

        // ✅ Get reg_no from session
        $regNo = $session->get('reg_no');
        if (empty($regNo)) {
            return redirect()->back()->with('error', 'Student registration number not found in session.');
        }

        // ✅ Construct folder path (use WRITEPATH fallback if FCPATH is blank)
        $basePath = rtrim(FCPATH ?: WRITEPATH . '../public/', '/') . '/assets/Stu_Docs/';
        $studentFolder = $basePath . $regNo . '/';

        // ✅ Create folder if not exists
        if (!is_dir($studentFolder)) {
            if (!mkdir($studentFolder, 0777, true) && !is_dir($studentFolder)) {
                return redirect()->back()->with('error', 'Failed to create folder: ' . $studentFolder);
            }
        }

        // ✅ Rename file: e.g. AADHAR_210720251854.jpg
        $prefix = strtoupper(explode(' ', $documentType)[0]); // "AADHAR"
        $datetime = date('dmYHi');
        $extension = $file->getExtension();
        $newFileName = $prefix . '_' . $datetime . '.' . $extension;

        // ✅ Move the uploaded file
        if (!$file->move($studentFolder, $newFileName)) {
            return redirect()->back()->with('error', 'Failed to move uploaded file.');
        }

        // ✅ Construct relative path for DB
        $relativePath = 'assets/Stu_Docs/' . $regNo . '/' . $newFileName;

        // ✅ Save in DB using your StudentModel method
        $studentModel = new \App\Models\StudentModel();
        $studentModel->saveStudentDocument($studentId, $documentType, $relativePath);

        return redirect()->back()->with('success', 'Document uploaded successfully.');
    }


}
