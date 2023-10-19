<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $table = 'companies';
    protected $primaryKey = 'c_id';

    public function companyBranch()
    {
        return $this->hasMany(companyBranch::class, 'b_company_id', 'c_id');
    }

    public function companyCategories()
    {
        return $this->belongsTo(CompaniesCategory::class, 'cc_id', 'c_category_id');
    }

    // the company has many trainings
    public function trainings()
    {
        return $this->hasMany(StudentCompany::class, 'sc_company_id', 'c_id');
    }
}
