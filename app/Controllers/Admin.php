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

        $user = $model->where('email', $email)->first();

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
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'admin') {
            return redirect()->to('/admin');
        }

        return view('admin/dashboard');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/admin')->with('success', 'Logged out.');
    }
}
