<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinalReportsSubmissions extends Model
{
    use HasFactory;

    protected $table = 'final_reports_submissions';
    protected $primaryKey = 'id';

    protected $fillable = [
        'frs_registration_id',
        'frs_name',
        'frs_real_name',
        'frs_insert_at',
        'frs_notes',
    ];
}
