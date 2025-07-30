<?php

namespace App\Controllers;

use App\Models\AdminModel;
use CodeIgniter\Controller;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Models\StudentModel;
use App\Models\CompanyModel;
use App\Models\RecruiterModel;
use App\Models\HrContactModel;  
use App\Models\JobRequirementModel;


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

            $email = trim($row['E']); // personal_email column

            // 🔍 Check if this email already exists in DB
            $existing = $model->where('personal_email', $email)->first();

            if ($existing) {
                continue; // Skip if duplicate found
            }

            $password = trim($row['F'] ?? '');
            $mobile_no = trim($row['C'] ?? '');

            if ($password === '') {
                $password = password_hash($mobile_no, PASSWORD_DEFAULT);
            } elseif (strpos($password, '$2y$') !== 0) {
                $password = password_hash($password, PASSWORD_DEFAULT);
            }

            $data = [
                'reg_no' => trim($row['A']),
                'full_name' => trim($row['B']),
                'mobile_no' => $mobile_no,
                'whatsapp_no' => trim($row['D']),
                'personal_email' => $email,
                'password' => $password,
                'official_email' => trim($row['G']),
                'gender' => trim($row['H']),
                'date_of_birth' => trim($row['I']),
                'native_place' => trim($row['J']),
                'communication_address' => trim($row['K']),
                'communication_state' => trim($row['L']),
                'communication_pincode' => trim($row['M']),
                'permanent_address' => trim($row['N']),
                'permanent_state' => trim($row['O']),
                'permanent_pincode' => trim($row['P']),
                'pan_number' => trim($row['Q']),
                'aadhar_number' => trim($row['R']),
                'appar_id' => trim($row['S']),
                'profile_summary' => trim($row['T']),
                'created_by' => 'admin',
                'created_on' => date('Y-m-d H:i:s'),
                'updated_by' => 'admin',
                'updated_on' => date('Y-m-d H:i:s'),
                'linkedin' => trim($row['Y']),
                'github' => trim($row['Z']),
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
    helper(['form']);

    // --- Basic validation ---
    $rules = [
        'company_name'    => 'required|min_length[2]',
        'company_address' => 'required',
        'poc_name'        => 'required',
        'poc_designation' => 'required',
        'poc_email'       => 'required|valid_email',
        'poc_contact'     => 'required',
    ];

    if (!$this->validate($rules)) {
        return redirect()
            ->back()
            ->with('errors', $this->validator->getErrors())
            ->withInput();
    }

    // --- Collect POST data ---
    $companyName    = $this->request->getPost('company_name');
    $website        = $this->request->getPost('company_website');
    $industrySector = $this->request->getPost('industry_sector');
    $address        = $this->request->getPost('company_address');

    // POC (we’ll store POC as one of the recruiters)
    $poc = [
        'full_name'      => $this->request->getPost('poc_name'),
        'designation'    => $this->request->getPost('poc_designation'),
        'email'          => $this->request->getPost('poc_email'),
        'contact_number' => $this->request->getPost('poc_contact'),
        'signature'      => null,
    ];

    // Recruiters list from the dynamic fields
    $recruiters = $this->request->getPost('recruiters') ?? [];
    $recruiterRows = [];

    foreach ($recruiters as $rec) {
        if (!empty($rec['name']) || !empty($rec['email'])) {
            $recruiterRows[] = [
                'full_name'      => $rec['name'] ?? null,
                'designation'    => $rec['designation'] ?? null,
                'email'          => $rec['email'] ?? null,
                'contact_number' => $rec['contact'] ?? null,
                'signature'      => $rec['signature'] ?? null,
            ];
        }
    }

    // Make sure POC is included as a recruiter (first item)
    array_unshift($recruiterRows, $poc);

    // Job requirements arrays
    $jobProfiles = (array) $this->request->getPost('job_profiles');
    $vacancies   = (array) $this->request->getPost('vacancies');
    $locations   = (array) $this->request->getPost('locations');
    $ctcPackages = (array) $this->request->getPost('salary');
    $eligibility = (array) $this->request->getPost('eligibility');

    $jobRows = [];
    $max = max(count($jobProfiles), count($vacancies), count($locations), count($ctcPackages), count($eligibility));
    for ($i = 0; $i < $max; $i++) {
        $profile = trim((string)($jobProfiles[$i] ?? ''));
        if ($profile === '') {
            continue; // skip empty rows
        }
        $jobRows[] = [
            'job_profile'          => $profile,
            'vacancies'            => isset($vacancies[$i]) ? (int)$vacancies[$i] : null,
            'job_location'         => $locations[$i]   ?? null,
            'ctc_package'          => $ctcPackages[$i] ?? null,
            'eligibility_criteria' => $eligibility[$i] ?? null,
        ];
    }

    $db = db_connect();
    $db->transBegin();

    try {
        // 1) Insert company
        $companyModel = new CompanyModel();
        $companyModel->insert([
            'company_name'      => $companyName,
            'industry_sector'   => $industrySector,
            'website'           => $website,
            'address'           => $address,
            'num_of_recruiters' => count($recruiterRows), // includes POC
        ]);

        $companyId = $companyModel->getInsertID();
        if (!$companyId) {
            $dbError = $db->error();
            log_message('error', 'Company insert failed. DB Error: {err}', ['err' => json_encode($dbError)]);
            throw new \RuntimeException('Failed to create company (no insert ID).');
        }

        // 2) Insert HR / POC into hr_contacts
        $hrModel = new \App\Models\HrContactModel();
        $hrModel->insert([
            'company_id'      => $companyId,
            'poc_name'        => $this->request->getPost('poc_name'),
            'poc_designation' => $this->request->getPost('poc_designation'),
            'poc_email'       => $this->request->getPost('poc_email'),
            'poc_contact'     => $this->request->getPost('poc_contact'),
        ]);

        // 3) Insert recruiters (batch)
        $recruiterModel = new RecruiterModel();
        foreach ($recruiterRows as &$r) {
            $r['company_id'] = $companyId;
        }
        unset($r);

        if (!empty($recruiterRows)) {
            $recruiterModel->insertBatch($recruiterRows);
        }

        // 4) Insert job requirements (batch) // NEW
        if (!empty($jobRows)) { // NEW
            foreach ($jobRows as &$j) { // NEW
                $j['company_id'] = $companyId; // NEW
            } // NEW
            unset($j); // NEW

            // Use the dedicated model // NEW
            $jobModel = new \App\Models\JobRequirementModel(); // NEW
            $jobModel->insertBatch($jobRows); // NEW
        } // NEW

        $db->transCommit();

        return redirect()
            ->to('/admin/dashboard')
            ->with('success', 'Company registration saved successfully!');
    } catch (\Throwable $e) {
        $db->transRollback();
        log_message('error', 'Company Registration failed: {msg}', ['msg' => $e->getMessage()]);
        return redirect()
            ->back()
            ->with('errors', ['save' => 'Failed to save. Please try again.'])
            ->withInput();
    }
}

public function showRegisteredCompanies()
{
    $db = db_connect();

    // --- Pick ONE HR contact (latest by MAX(hr_id)) per company ---
    $oneHrPerCompanySql = $db->table('hr_contacts')
        ->select('company_id, MAX(hr_id) AS hrid')
        ->groupBy('company_id')
        ->getCompiledSelect();

    // --- Companies + single POC via LEFT JOINs ---
    $companies = $db->table('companies c')
        ->select([
            'c.company_id AS id',
            'c.company_name',
            'c.website AS company_website',
            'c.address AS company_address',
            'c.industry_sector',
            'c.is_active',
            'h.hr_id AS hr_id', 
            'h.poc_name',
            'h.poc_email',
            'h.poc_designation',
            'h.poc_contact',
        ])
        ->join("({$oneHrPerCompanySql}) hc", 'hc.company_id = c.company_id', 'left', false)
        ->join('hr_contacts h', 'h.hr_id = hc.hrid', 'left')
        ->orderBy('c.company_name', 'ASC')
        ->get()
        ->getResultArray();

    // Defaults so the view never sees undefined indexes
    $jobRequirementsByCompany = [];
    $recruitersByCompany      = [];

    if (! empty($companies)) {
        $companyIds = array_column($companies, 'id');

        // --- Job requirements (alias salary if your column is named differently, e.g., `ctc AS salary`) ---
        $jobs = $db->table('job_requirements')
            ->select([
                'company_id',
                'job_profile',
                'vacancies',
                'job_location AS location',
                'ctc_package AS salary', // change to 'ctc AS salary' if needed
                'eligibility_criteria AS eligibility',
            ])
            ->whereIn('company_id', $companyIds)
            ->orderBy('company_id', 'ASC')
            ->get()
            ->getResultArray();

        foreach ($jobs as $row) {
            $jobRequirementsByCompany[$row['company_id']][] = $row;
        }

        // --- Recruiters list ---
        $recs = $db->table('recruiters')
            ->select([
                'company_id',
                'full_name AS name',
                'email',
                'designation',
                'contact_number AS contact',
                'signature',
            ])
            ->whereIn('company_id', $companyIds)
            ->orderBy('company_id', 'ASC')
            ->get()
            ->getResultArray();

        foreach ($recs as $row) {
            $recruitersByCompany[$row['company_id']][] = $row;
        }
    }
  
    return view('admin/company_list', [
        'companies'       => $companies,
        'jobRequirements' => $jobRequirementsByCompany,
        'recruiters'      => $recruitersByCompany,
    ]);
}

public function deleteCompany()
    {
        // CSRF is validated automatically if enabled in Filters
        $id = (int) $this->request->getPost('id');

        if ($id <= 0) {
            return redirect()->back()->with('error', 'Invalid company ID.');
        }

        $db = db_connect();

        try {
            $db->transBegin();

            // If you don't have ON DELETE CASCADE FKs, delete children first:
            $db->table('recruiters')->where('company_id', $id)->delete();
            $db->table('hr_contacts')->where('company_id', $id)->delete();
            $db->table('job_requirements')->where('company_id', $id)->delete();

            // Delete the company row
            $db->table('companies')->where('company_id', $id)->delete();

            if ($db->transStatus() === false) {
                $db->transRollback();
                return redirect()->back()->with('error', 'Failed to delete the company. Please try again.');
            }

            $db->transCommit();

            return redirect()
                ->to(site_url('registered-companies')) // <-- change to your listing route
                ->with('success', 'Company deleted successfully.');

        } catch (\Throwable $e) {
            if ($db->transStatus()) {
                $db->transRollback();
            }
            // Log the error if you have logging set up
            log_message('error', 'Delete company failed: {msg}', ['msg' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Unexpected error while deleting the company.');
        }
    }

    public function toggleCompanyStatus()
{
    $id = (int)$this->request->getPost('id');
    $current = $this->request->getPost('current_status');

    if ($id <= 0) {
        return redirect()->back()->with('error', 'Invalid company ID.');
    }

    // Normalize current to boolean
    $isActive = false;
    if (is_numeric($current)) {
        $isActive = ((int)$current === 1);
    } elseif (is_string($current)) {
        $val = strtolower(trim($current));
        $isActive = in_array($val, ['active','1','yes','true'], true);
    }

    // Flip it
    $newStatusBool = $isActive ? 0 : 1;

    // If your table uses "status" text values:
    // $data = ['status' => $newStatusBool ? 'Active' : 'Inactive'];
    // If it uses "is_active" tinyint:
    $data = ['is_active' => $newStatusBool];

    $db = db_connect();
    $ok = $db->table('companies')->where('company_id', $id)->update($data);

    if (! $ok) {
        return redirect()->back()->with('error', 'Could not update status.');
    }
    return redirect()->back()->with('success', 'Status updated.');
}

// app/Controllers/Admin/AdminController.php
public function updateCompany()
{
    $id = (int) $this->request->getPost('id');
    if ($id <= 0) {
        return redirect()->back()->with('error', 'Invalid company ID.');
    }

    $companyData = [
        'company_name'     => trim((string)$this->request->getPost('company_name')),
        'website'          => trim((string)$this->request->getPost('company_website')),
        'address'          => trim((string)$this->request->getPost('company_address')),
        'industry_sector'  => trim((string)$this->request->getPost('industry_sector')),
        'is_active'        => (int) ($this->request->getPost('is_active') ? 1 : 0),
    ];

    // HR POC (optional – only if you show these fields)
    $hrId     = (int) ($this->request->getPost('hr_id') ?? 0);
    $pocData  = [
        'poc_name'        => trim((string)$this->request->getPost('poc_name')),
        'poc_email'       => trim((string)$this->request->getPost('poc_email')),
        'poc_designation' => trim((string)$this->request->getPost('poc_designation')),
        'poc_contact'     => trim((string)$this->request->getPost('poc_contact')),
    ];

    $db = db_connect();
    try {
        $db->transBegin();

        // Update companies
        $db->table('companies')->where('company_id', $id)->update($companyData);

        // Update POC if hr_id is present; otherwise insert a new POC row (optional)
        if ($hrId > 0) {
            $db->table('hr_contacts')->where('hr_id', $hrId)->update($pocData);
        } else {
            // If you want to ensure at least one POC exists:
            $pocData['company_id'] = $id;
            $db->table('hr_contacts')->insert($pocData);
        }

        if (! $db->transStatus()) {
            $db->transRollback();
            return redirect()->back()->with('error', 'Failed to update company.');
        }
        $db->transCommit();

        return redirect()->to(site_url('registered-companies'))->with('success', 'Company updated successfully.');
    } catch (\Throwable $e) {
        if ($db->transStatus()) {
            $db->transRollback();
        }
        log_message('error', 'Update company failed: {msg}', ['msg' => $e->getMessage()]);
        return redirect()->back()->with('error', 'Unexpected error while updating company.');
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

}
  
}



