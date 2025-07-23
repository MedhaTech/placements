<?php

namespace App\Models;
use CodeIgniter\Model;

class StudentModel extends Model
{
    // 🔹 Used for login (users table)
    protected $table = 'students';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'reg_no', 'full_name', 'mobile_no', 'whatsapp_no', 'personal_email', 'password',
        'official_email', 'gender', 'date_of_birth', 'native_place',
        'communication_address', 'communication_state', 'communication_pincode',
        'permanent_address', 'permanent_state', 'permanent_pincode',
        'pan_number', 'aadhar_number', 'appar_id', 'profile_summary',
        'linkedin', 'github', 'created_by', 'created_on', 'updated_by', 'updated_on'
    ];

    // 🔹 Handle profile summary from 'students' table
    public function getStudentById($id)
    {
        return $this->db->table('students')
            ->where('id', $id)
            ->get()
            ->getRowArray();
    }

    public function updateProfileSummary($id, $summary)
    {
        return $this->db->table('students')
            ->where('id', $id)
            ->update(['profile_summary' => $summary]);
    }
    public function updatePersonalInfo($id, $data)
{
    $data['updated_on'] = date('Y-m-d H:i:s');

    return $this->db->table('students')
        ->where('id', $id)
        ->update([
            'full_name' => $data['full_name'],
            'mobile_no' => $data['mobile_no'],
            'whatsapp_no' => $data['whatsapp_no'],
            'personal_email' => $data['personal_email'],
            'official_email' => $data['official_email'],
            'gender' => $data['gender'],
            'date_of_birth' => $data['date_of_birth'],
            'native_place' => $data['native_place'],
            'communication_address' => $data['communication_address'],
            'communication_state' => $data['communication_state'],
            'communication_pincode' => $data['communication_pincode'],
            'permanent_address' => $data['permanent_address'],
            'permanent_state' => $data['permanent_state'],
            'permanent_pincode' => $data['permanent_pincode'],
            'pan_number' => $data['pan_number'],
            'aadhar_number' => $data['aadhar_number'],
            'appar_id' => $data['appar_id'],
            'linkedin' => $data['linkedin'],
            'github' => $data['github'],
            'updated_on' => $data['updated_on'],
        ]);
}
public function updateKeySkills($student_id, $skills)
{
    $db = \Config\Database::connect();
    $builder = $db->table('students_key_skills');

    // Remove old skills
    $builder->where('student_id', $student_id)->delete();

    // Insert new ones
    foreach ($skills as $skill) {
        $builder->insert([
            'student_id' => $student_id,
            'skill_name' => $skill,
            'created_by' => 'self'
        ]);
    }
}
 public function deleteSkillById($skillId, $studentId)
{ 
    return $this->db->table('students_key_skills')
                    ->where('id', $skillId)
                    ->where('student_id', $studentId)
                    ->delete();
}
public function getAcademicInfo($studentId)
{
    return $this->db->table('students_academics sa')
        ->select('sa.*, d.department_name')  // Include department_name
        ->join('departments d', 'd.id = sa.department_id', 'left')
        ->where('sa.student_id', $studentId)
        ->get()
        ->getRowArray();
}


public function saveAcademicInfo(array $data)
{
    $builder = $this->db->table('student_academics');
    $existing = $builder->where('student_id', $data['student_id'])->get()->getRow();

    if ($existing) {
        $builder->where('student_id', $data['student_id'])->update($data);
    } else {
        $builder->insert($data);
    }
}


public function savePlacementPreferences($studentId, $data)
{
    $builder = $this->db->table('students_placement_preferences');

    // Check if already exists
    $exists = $builder->where('student_id', $studentId)->get()->getRowArray();

    if ($exists) {
        $builder->where('student_id', $studentId)->update($data);
    } else {
        $data['student_id'] = $studentId;
        $data['created_by'] = 'self';
        $builder->insert($data);
    }
}

// 📁 Save or update student document
public function saveStudentDocument($studentId, $documentType, $filePath)
{
    $builder = $this->db->table('students_documents');

    // If it's a photo (replace type)
    if ($documentType === 'Photo') {
        $existing = $builder->where('student_id', $studentId)
                            ->where('document_type', $documentType)
                            ->get()
                            ->getRowArray();

        $data = [
            'student_id'    => $studentId,
            'document_type' => $documentType,
            'file_path'     => $filePath,
            'updated_by'    => $studentId,
            'updated_on'    => date('Y-m-d H:i:s')
        ];

        if ($existing) {
            // Replace old
            return $builder->where('id', $existing['id'])->update($data);
        } else {
            // Insert new
            $data['created_by'] = $studentId;
            $data['created_on'] = date('Y-m-d H:i:s');
            return $builder->insert($data);
        }
    }

    // 📌 For other documents (allow multiple)
    return $builder->insert([
        'student_id'    => $studentId,
        'document_type' => $documentType,
        'file_path'     => $filePath,
        'created_by'    => $studentId,
        'created_on'    => date('Y-m-d H:i:s')
    ]);
}

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

