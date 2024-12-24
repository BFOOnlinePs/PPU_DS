<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FAQModel extends Model
{
    use HasFactory;

    protected $table = 'frequently_asked_questions';

    protected $primaryKey = 'faq_id';

    public function category()
    {
        return $this->belongsTo(FAQCategoryModel::class);
    }
}
