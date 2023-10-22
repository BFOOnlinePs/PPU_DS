<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentAttendance extends Model
{
    use HasFactory;
    protected $table = 'students_attendance';
    protected $primaryKey = 'sa_id';

    public function report()
    {
        return $this->hasOne(StudentReport::class, 's_student_attendance_id', 'sa_id');
    }

    public function training()
    {
        return $this->belongsTo(StudentCompany::class, 'sa_student_company_id', 'sc_id');
    }
}
