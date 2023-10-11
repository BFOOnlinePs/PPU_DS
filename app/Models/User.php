<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'u_username',
        'name',
        'email',
        'password',
        'u_role_id',
        'u_major_id',
        'remember_token',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $primaryKey = 'u_id';

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    //relations:

    public function role(){
        return $this->belongsTo(Role::class, 'u_role_id', 'r_id');
    }

    // student belongs to company training
    public function studentCompanies(){
        return $this->belongsTo(StudentCompany::class);
    }


}
