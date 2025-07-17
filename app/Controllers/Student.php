<?php

namespace App\Controllers;
use App\Models\UserModel;
use CodeIgniter\Controller;
use CodeIgniter\Database\Config;
use Config\Database;
use App\Libraries\GlobalData;
use App\Models\StudentModel;



class Student extends Controller
{
        public function login()
    {
        if (session()->get('isStudentLoggedIn')) {
            return redirect()->to('/student/dashboard');
        }
        return view('student/login');
    }

    public function loginUser()
    {
        $session = session();
        $model = new \App\Models\StudentModel();  // Make sure this model uses the `users` table

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $student = $model
                    ->where('email', $email)
                    ->where('role', 'student') // ✅ Restrict to students only
                    ->first();

        if ($student) {
            if (password_verify($password, $student['password'])) {
                $session->set([
                    'student_id' => $student['id'],
                    'email'      => $student['email'],
                    'isStudentLoggedIn' => true,
                ]);
                return redirect()->to('/student/dashboard');
            } else {
                return redirect()->back()->withInput()->with('error', 'Wrong password.');
            }
        } else {
            return redirect()->back()->withInput()->with('error', 'Student not found.');
        }
    }


        public function dashboard()
    {
        if (!session()->get('isStudentLoggedIn')) {
            return redirect()->to('/student');
        }
        return view('student/dashboard');
        
    }
        public function logout()
    {
        session()->destroy();
        return redirect()->to('/student');

    }

public function profilePreview()
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
        'completionPercentage' => $completionPercentage // add this
]);
    

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
}
