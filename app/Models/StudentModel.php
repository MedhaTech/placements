<?php

namespace App\Models;
use CodeIgniter\Model;

class StudentModel extends Model
{
    // 🔹 Used for login (users table)
    protected $table = 'students';
    protected $allowedFields = ['official_email', 'password']; // only needed if you're using `save()`, not raw query

    protected $primaryKey = 'id';

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
            'reg_no' => $data['reg_no'],
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

public function saveAcademicInfo($studentId, $data)
{
    $builder = $this->db->table('students_academics');

    $existing = $builder->where('student_id', $studentId)->get()->getRow();

    if ($existing) {
        return $builder->where('student_id', $studentId)->update($data);
    } else {
        $data['student_id'] = $studentId;
        return $builder->insert($data);
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

public function saveStudentDocument($studentId, $documentType, $filePath)
{
    $builder = $this->db->table('students_documents');
    $upperType = strtoupper($documentType); // Make it consistent

    // For PHOTO and RESUME — only one file allowed (replace if already exists)
    if (in_array($upperType, ['PHOTO', 'RESUME'])) {
        $existing = $builder->where('student_id', $studentId)
                            ->where('document_type', $upperType) // ✅ Use actual type (not hardcoded PHOTO)
                            ->get()
                            ->getRowArray();

        $data = [
            'student_id'    => $studentId,
            'document_type' => $upperType,
            'file_path'     => $filePath,
            'updated_by'    => $studentId,
            'updated_on'    => date('Y-m-d H:i:s')
        ];

        if ($existing) {
            // ✅ Update the existing PHOTO or RESUME
            return $builder->where('id', $existing['id'])->update($data);
        } else {
            // ✅ Insert new PHOTO or RESUME
            $data['created_by'] = $studentId;
            $data['created_on'] = date('Y-m-d H:i:s');
            return $builder->insert($data);
        }
    }

    // All other document types (multiple uploads allowed)
    return $builder->insert([
        'student_id'    => $studentId,
        'document_type' => $upperType,
        'file_path'     => $filePath,
        'created_by'    => $studentId,
        'created_on'    => date('Y-m-d H:i:s')
    ]);
}

public function insertExperienceDetail($data)
{
    return $this->db->table('students_experience')->insert($data);
}

public function getExperienceDetails($studentId)
{
    return $this->db->table('students_experience')->where('student_id', $studentId)->get()->getResultArray();
}

public function getUploadedDocumentTypes($studentId)
{
    $result = $this->db->table('students_documents')
        ->select('DISTINCT UPPER(document_type) AS document_type')
        ->where('student_id', $studentId)
        ->get()
        ->getResultArray();

    // Convert to simple array of UPPERCASE document types
    return array_column($result, 'document_type');
}

}


