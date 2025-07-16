<?php

namespace App\Controllers;
use App\Models\UserModel;
use CodeIgniter\Controller;

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
        $model = new \App\Models\StudentModel(); // Ensure model exists

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
}
