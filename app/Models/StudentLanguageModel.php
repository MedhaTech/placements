<?php

namespace App\Models;

use CodeIgniter\Model;

class StudentLanguageModel extends Model
{
    protected $table = 'students_languages';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'student_id', 'language_name', 'proficiency',
        'can_read', 'can_write', 'can_speak',
        'created_by', 'created_on', 'updated_by', 'updated_on'
    ];

    public $timestamps = false; // since your DB auto-handles timestamps
}
