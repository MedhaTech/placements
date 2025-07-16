<?php

namespace App\Controllers;
use App\Models\UserModel;
use CodeIgniter\Controller;

class Auth extends Controller
{
    public function login()
    {
        helper(['form']);  
        return view('auth/login'); // You used `echo`, better to return it
    }

    public function loginUser()
    {
        $session = session();
        $model = new UserModel();

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $model->where('email', $email)->first();

        if ($user) {
            if (password_verify($password, $user['password'])) {
                // Set session
                $session->set([
                    'user_id' => $user['id'],
                    'email'   => $user['email'],
                    'isLoggedIn' => true,
                ]);

                // Optional: Set flashdata
                $session->setFlashdata('success', 'Welcome back!');

                return redirect()->to('/dashboard');
            } else {
                return redirect()->back()->withInput()->with('error', 'Wrong password.');
            }
        } else {
            return redirect()->back()->withInput()->with('error', 'Email not found.');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login')->with('success', 'You have been logged out.');
    }
}
