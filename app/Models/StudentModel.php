<?php

namespace App\Models;
use CodeIgniter\Model;

class StudentModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['email', 'password', 'role'];
}
