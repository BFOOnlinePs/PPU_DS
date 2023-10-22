<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentReport extends Model
{
    use HasFactory;
    protected $table = 'student_reports';
    protected $primaryKey = 'sr_id';

    protected $fillable = [
        'sr_student_attendance_id',
        'sr_student_id',
        'sr_report_text',
        'sr_attached_file',
        'sr_submit_longitude',
        'sr_submit_latitude'
    ];
}
