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
        return $this->belongsTo(StudentCompany::class, 'u_id', 'sc_student_id');
    }

    public function registrations(){
        return $this->hasMany(Registration::class, 'r_student_id', 'u_id');
    }

    public function majorSupervisors(){
        return $this->hasMany(MajorSupervisor::class, 'ms_super_id', 'u_id');
    }
    // manager of companyBranch
    public function managerOf(){
        return $this->belongsTo(CompanyBranch::class, 'u_id', 'b_manager_id');
    }

    public function companyManager(){
        return $this->hasOne(Company::class, 'c_manager_id','u_id');
    }
}
