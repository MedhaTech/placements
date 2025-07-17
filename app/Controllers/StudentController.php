<?php

namespace App\Controllers;

use App\Models\StudentModel;
use CodeIgniter\Controller;
use App\Libraries\GlobalData;

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

        $student = $model->where('email', $email)->first();

        if ($student && password_verify($password, $student['password'])) {
            $session->set([
                'student_id' => $student['id'],
                'email' => $student['email'],
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
        $globals = new GlobalData();
        $data['relationTypes'] = $globals->getRelationTypes();

        return view('student/student_profile_preview', $data);
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
}
