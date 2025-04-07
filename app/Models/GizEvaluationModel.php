<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GizEvaluationModel extends Model
{
    use HasFactory;

    protected $table = 'giz_evaluations';
    protected $primaryKey = 'e_id';
}
