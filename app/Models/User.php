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


    protected static function boot()
{
    parent::boot();

    static::creating(function ($user) {
        // Attempt to find a user with the provided email
        $existingUser = self::where('email', $user->email)->first();

        // If the user with the email exists, skip this record
        if ($existingUser) {
            return false; // This will skip the current record and proceed to the next
        }

        // If the user doesn't exist, proceed with the insertion
        return true; // This will allow the insertion of the current record
    });
}

    //relations:

    public function role()
    {
        return $this->belongsTo(Role::class, 'u_role_id', 'r_id');
    }


    // student has many company training
    public function studentCompanies(){
        return $this->hasMany(StudentCompany::class, 'sc_student_id', 'u_id');
    }

    public function registrations()
    {
        return $this->hasMany(Registration::class, 'r_student_id', 'u_id');
    }

    public function majorSupervisors()
    {
        return $this->hasMany(MajorSupervisor::class, 'ms_super_id', 'u_id');
    }
    // manager of companyBranch
    public function managerOf()
    {
        return $this->hasMany(CompanyBranch::class, 'b_manager_id', 'u_id');
    }

    public function major()
    {
        return $this->belongsTo(Major::class, 'u_major_id', 'm_id');
    }

    public function studentCompaniesMentorTrainer(){
        return $this->hasMany(StudentCompany::class, 'sc_mentor_id', 'u_id');
    }

    public function studentCompaniesAssistant(){
        return $this->hasMany(StudentCompany::class, 'sc_assistant_id', 'u_id');
    }

    public function companyManager(){
        return $this->hasOne(Company::class, 'c_manager_id','u_id');
    }

    public function paymentStudent()
    {
        return $this->hasMany(Payment::class, 'p_student_id', 'u_id');
    }
    public function paymentUser()
    {
        return $this->hasMany(Payment::class, 'p_inserted_by_id', 'u_id');
    }

    public function studentAttendances(){
        return $this->hasMany(StudentAttendance::class, 'sa_student_id', 'u_id');
    }

    public function studentReports(){
        return $this->hasMany(StudentReport::class, 'sr_student_id', 'u_id');
    }
    public function assistants(){
        return $this->hasMany(SupervisorAssistant::class, 'sa_assistant_id', 'u_id');
    }
    public function supervisors(){
        return $this->hasMany(SupervisorAssistant::class, 'sa_supervisor_id', 'u_id');
    }
}
