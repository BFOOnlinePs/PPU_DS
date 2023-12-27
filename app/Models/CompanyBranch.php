<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyBranch extends Model
{
    use HasFactory;

    protected $table = 'company_branches';
    protected $primaryKey = 'b_id';

    public function studentCompanies()
    {
        return $this->hasMany(StudentCompany::class, 'sc_branch_id', 'b_id');
    }
    public function companyDepartments()
    {
        return $this->hasMany(CompanyDepartment::class, 'd_company_id', 'b_id');
    }
    public function companies()
    {
        return $this->belongsTo(Company::class, 'b_company_id', 'c_id');
    }

    public function companyBranchLocation()
    {
        return $this->hasMany(CompanyBranchLocation::class, 'bl_branch_id', 'b_id');
    }

    public function manager(){
        return $this->hasOne(User::class, 'u_id', 'b_manager_id');
    }
}
