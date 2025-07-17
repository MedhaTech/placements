<?php

namespace App\Controllers;

use App\Models\AdminModel;
use CodeIgniter\Controller;

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
}
