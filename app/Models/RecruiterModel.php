<?php

namespace App\Models;

use CodeIgniter\Model;

class RecruiterModel extends Model
{
    protected $table            = 'recruiters';
    protected $primaryKey       = 'recruiter_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'company_id', 'full_name', 'designation', 'email', 'contact_number', 'signature'
    ];
    protected $useTimestamps = false;
}
