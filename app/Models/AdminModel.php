<?php

namespace App\Models;
use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['email', 'password', 'role'];

    public function getUserById($id)
    {
        return $this->where('id', $id)->first();
    }

   
    public function getPassword($id)
    {
        $user = $this->select('password')->where('id', $id)->first();
        return $user['password'] ?? null;
    }

   
    public function updatePassword($id, $hashedPassword)
    {
        return $this->update($id, ['password' => $hashedPassword]);
    }
}
