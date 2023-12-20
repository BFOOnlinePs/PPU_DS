<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyDepartment extends Model
{
    use HasFactory;
    protected $table = 'company_departments';
    protected $primaryKey = 'd_id';
    // public function studentCompany()
    // {
    //     return $this->hasMany(StudentCompany::class, 'sc_department_id', 'd_id');
    // }
}
