<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FrequentlyAskedQuestionModel extends Model
{
    use HasFactory;

    protected $table = 'frequently_asked_questions';
    protected $primaryKey = 'faq_id';
}
