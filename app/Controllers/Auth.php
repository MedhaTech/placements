<?php

namespace App\Controllers;
use App\Models\UserModel;
use CodeIgniter\Controller;

class Auth extends Controller
{
    public function login()
    {
        helper(['form']);
        echo view('auth/login');
    }

    public function loginUser()
    {
        $session = session();
        $model = new UserModel();
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $data = $model->where('email', $email)->first();

        if ($data) {
            $pass = $data['password'];
            if (password_verify($password, $pass)) {
                $session->set([
                    'email' => $data['email'],
                    'isLoggedIn' => true,
                ]);
                return redirect()->to('/dashboard');
            } else {
                return redirect()->back()->with('error', 'Wrong password.');
            }
        } else {
            return redirect()->back()->with('error', 'Email not found.');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
