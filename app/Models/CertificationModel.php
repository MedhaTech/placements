<?php

namespace App\Models;

use CodeIgniter\Model;

class CertificationModel extends Model
{
    protected $table = 'students_certifications';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'student_id',
        'certificate_name',
        'issuing_organization',
        'issue_date',
        'expiry_date',
        'reg_no',
        'url',
        'created_by',
        'created_on',
        'updated_by',
        'updated_on'
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_on';
    protected $updatedField = 'updated_on';
}
