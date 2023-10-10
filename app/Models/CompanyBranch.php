<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyBranch extends Model
{
    use HasFactory;

    protected $table = 'company_branches';
    protected $primaryKey = "b_id";

    public function studentCompanies(){
        return $this->hasMany(StudentCompany::class);
    }

    // public function companies(){
    //     return $this->belongsTo(Company::class, 'b_company_id', 'c_id');
    // }
}
