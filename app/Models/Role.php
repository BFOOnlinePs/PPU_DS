<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $primaryKey = "r_id";

    // relations:
    public function users()
    {

        return $this->hasMany(User::class, 'u_role_id', 'r_id');

    }
}
