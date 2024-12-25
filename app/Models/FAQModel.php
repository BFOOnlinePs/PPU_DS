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

    public function added_by(){
        return $this->belongsTo(User::class, 'faq_added_by');
    }
}
