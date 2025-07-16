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
        return view('student/student_profile_preview'); // or adjust if it's inside a subfolder like 'student/profile_preview'
    }

}
