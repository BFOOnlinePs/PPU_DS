<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;
    protected $table = 'registration';
    protected $primaryKey = 'r_id';

    protected $fillable = [
        'r_student_id',
        'r_course_id',
        'r_grade',
        'r_semester',
        'r_year'
    ];

    public function courses(){
        return $this->belongsTo(Course::class, 'r_course_id','c_id');
    }

    public function users(){
        return $this->belongsTo(User::class, 'r_student_id','u_id');
    }
}
