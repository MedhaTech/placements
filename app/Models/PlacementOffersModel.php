<?php

namespace App\Models;

use CodeIgniter\Model;

class PlacementOffersModel extends Model
{
    protected $table = 'students_placement_offers';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'student_id',
        'company_name',
        'job_title',
        'offered_salary',
        'status',
        'offer_status',
        'created_by',
        'created_on',
        'updated_by',
        'updated_on'
    ];
}
