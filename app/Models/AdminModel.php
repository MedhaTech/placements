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

    // ✅ Insert multiple job requirements at once
    public function insertBatchJobRequirements($data)
    {
        $db = \Config\Database::connect();
        return $db->table('job_requirements')->insertBatch($data);
    }

    // ✅ Get all job requirements
    public function getAllJobRequirements()
    {
        $db = \Config\Database::connect();
        return $db->table('job_requirements')->get()->getResultArray();
    }

    // ✅ Get job requirements for a specific company
    public function getJobRequirementsByCompany($company_id)
    {
        $db = \Config\Database::connect();
        return $db->table('job_requirements')
                  ->where('company_id', $company_id)
                  ->get()
                  ->getResultArray();
    }
}
