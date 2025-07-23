<?php

namespace App\Models;

use CodeIgniter\Model;

class EducationDetailModel extends Model
{
    protected $table = 'students_education';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'student_id',
        'qualification_type',
        'institution_name',
        'board_university',
        'course_specialization',
        'course_type',
        'year_of_passing',
        'grade_percentage',
        'result_status',
        'created_by',
        'created_on',
        'updated_by',
        'updated_on',
    ];
}
