<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompaniesCategory extends Model
{
    use HasFactory;
    protected $table = 'companies_categories';
    protected $primaryKey = 'cc_id';

    public function companies(){
        return $this->hasMany(Company::class, 'c_category_id', 'cc_id');
    }
}

