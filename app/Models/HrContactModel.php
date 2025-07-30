<?php
namespace App\Models;

use CodeIgniter\Model;

class HrContactModel extends Model
{
    protected $table            = 'hr_contacts';
    protected $primaryKey       = 'hr_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'company_id', 'poc_name', 'poc_designation', 'poc_email', 'poc_contact'
    ];
    protected $useTimestamps = false; // change to true if you later add created_at/updated_at
}
