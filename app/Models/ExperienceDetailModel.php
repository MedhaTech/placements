<?php

namespace App\Models;

use CodeIgniter\Model;

class ExperienceDetailModel extends Model
{
    protected $table = 'students_experience';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'student_id', 'title', 'employment_type', 'organization',
        'joining_date', 'is_current', 'end_date', 'location',
        'location_type', 'remarks'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_on';
    protected $updatedField = 'updated_on';
}
