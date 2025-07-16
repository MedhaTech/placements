<?php

namespace App\Controllers;
use App\Models\UserModel;
use CodeIgniter\Controller;

class Admin extends Controller
{
    public function login()
    {
        return view('admin/login');
    }

    public function loginUser()
    {
        $session = session();
       $model = new \App\Models\AdminModel();


        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $model
        ->where('email', $email)
        ->where('role', 'admin') // ✅ Restrict to admins only
        ->first();


        if ($user) {
            if (password_verify($password, $user['password'])) {
                if ($user['role'] !== 'admin') {
                    return redirect()->back()->withInput()->with('error', 'Access denied.');
                }

                $session->set([
                    'user_id' => $user['id'],
                    'email' => $user['email'],
                    'role' => $user['role'],
                    'isLoggedIn' => true,
                ]);

                return redirect()->to('/admin/dashboard');
            } else {
                return redirect()->back()->withInput()->with('error', 'Wrong password.');
            }
        } else {
            return redirect()->back()->withInput()->with('error', 'Email not found.');
        }
    }

        public function dashboard()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/admin');
        }

        $data = [
            'title' => 'Admin Dashboard'
        ];

        return view('admin/dashboard', $data); // ✅ Make sure this is the admin view
    }
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/admin')->with('success', 'Logged out.');
    }
}
