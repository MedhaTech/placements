<?php

namespace App\Models;

use CodeIgniter\Model;

class ProjectsPublicationsModel extends Model
{
    protected $table = 'students_projects_publications';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'student_id',
        'title',
        'publishing_type',
        'publisher',
        'completion_date',
        'authors',
        'publication_url',
        'description',
        'created_by',
        'created_on',
        'updated_by',
        'updated_on'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_on';
    protected $updatedField  = 'updated_on';
}
