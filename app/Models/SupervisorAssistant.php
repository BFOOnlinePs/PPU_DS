<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupervisorAssistant extends Model
{
    use HasFactory;
    protected $table = 'supervisor_assistants';
    protected $primaryKey = 'sa_id';
}
