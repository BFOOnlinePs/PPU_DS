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
        return $this->hasOne(Company::class, 'cc_id','c_category_id');
    }
}

