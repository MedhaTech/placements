<?php
namespace App\Models;

use CodeIgniter\Model;

class FamilyDetailModel extends Model
{
    protected $table = 'students_family_details';
    protected $allowedFields = [
        'student_id', 'relation', 'name', 'contact',
        'occupation', 'mobile', 'email', 'salary'
    ];
    protected $returnType = 'array';
}
