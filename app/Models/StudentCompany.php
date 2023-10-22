<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentCompany extends Model
{
    use HasFactory;

    protected $table = 'students_companies';
    protected $primaryKey = 'sc_id';


    public function users()
    {
        return $this->hasMany(User::class, 'u_id', 'sc_student_id');
    }

    public function companyBranch()
    {
        return $this->belongsTo(CompanyBranch::class, 'sc_branch_id', 'b_id');
    }

    // the training belongs to one company
    public function company()
    {
        return $this->belongsTo(Company::class, 'sc_company_id', 'c_id');
    }

    public function attendance()
    {
        return $this->hasMany(StudentAttendance::class, 'sa_student_company_id', 'sc_id');
    }
}
