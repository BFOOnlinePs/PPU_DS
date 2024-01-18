<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $table = 'payments';
    protected $primaryKey = 'p_id';
    public function userStudent()
    {
        return $this->belongsTo(User::class, 'p_student_id', 'u_id');
    }
    public function userInsertedById()
    {
        return $this->belongsTo(User::class, 'p_inserted_by_id', 'u_id');
    }
    public function currency()
    {
        return $this->belongsTo(Currency::class, 'p_currency_id' , 'c_id');
    }
    public function payments()
    {
        return $this->belongsTo(Company::class, 'p_company_id' , 'c_id');
    }
}
