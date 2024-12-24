<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FAQCategoryModel extends Model
{
    use HasFactory;

    protected $table = 'faq_categories';

    protected $primaryKey = 'c_id';

    public function FAQ(){
        return $this->hasMany(FAQModel::class);
    }
}
