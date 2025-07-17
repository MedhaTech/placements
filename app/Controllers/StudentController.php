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
    $completionPercentage = '5%';
    
    // Fetch placement training info
    $training = $this->db->table('students_placement_training')
        ->where('student_id', $student_id)
        ->get()
        ->getRowArray();

    // ✅ Added relation types
    $relationTypes = ['Father', 'Mother', 'Guardian', 'Brother', 'Sister'];

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
        'relationTypes' => $relationTypes                // ✅ This line is now valid
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
}




