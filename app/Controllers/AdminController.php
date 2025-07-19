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


    public function changePasswordForm()
    {
        return view('admin/change_pwd', [
            'title' => 'Change Password',
            'errors' => [],
            'values' => [],
        ]);
    }

    public function updatePassword()
{
    $session = session();
    $userId = $session->get('user_id'); // ✅ Use session instead of hardcoded ID
    $Model = new \App\Models\AdminModel(); // ✅ Ensure correct model

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

    // 2️⃣ Additional checks only if no empty field errors
    if (empty($errors)) {
        $dbUser = $Model->find($userId);

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

    // 3️⃣ If any errors, return view with error messages + form values
    if (!empty($errors)) {
        return view('admin/change_pwd', [
            'title' => 'Change Password',
            'errors' => $errors,
            'values' => $this->request->getPost()
        ]);
    }

    // 4️⃣ Hash password and update
    $hashedPassword = password_hash($new, PASSWORD_DEFAULT);
    $Model->update($userId, ['password' => $hashedPassword]);

    // ✅ 5. Flash success message and redirect
    return redirect()
        ->to('admin/dashboard')
        ->with('success', 'Password changed successfully.');
}
}


