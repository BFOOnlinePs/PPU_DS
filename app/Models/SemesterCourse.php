<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SemesterCourse extends Model
{
    use HasFactory;
    protected $table = 'semester_courses';
    protected $primaryKey = 'sc_id';


    public function courses()
    {
        return $this->hasOne(Course::class, 'c_id', 'sc_course_id');
    }
}
