<?php namespace App\Models;

use CodeIgniter\Model;

class JobRequirementModel extends Model
{
    protected $table         = 'job_requirements';
    protected $primaryKey    = 'requirement_id';
    protected $allowedFields = [
        'company_id',
        'job_profile',
        'vacancies',
        'job_location',
        'ctc_package',
        'eligibility_criteria',
    ];
    protected $useTimestamps = false; // set true if you add created_at/updated_at in DB
}
