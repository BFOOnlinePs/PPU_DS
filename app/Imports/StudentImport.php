<?php

namespace App\Imports;

use App\Models\Major;
use App\Models\User;
use Ramsey\Uuid\Uuid;
use Maatwebsite\Excel\Concerns\ToModel;

class StudentImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    protected $additionalData , $startRow , $cnt , $students_numbers , $students_names;

    public function __construct($additionalData)
    {
        $this->additionalData = $additionalData;
        $this->startRow = 1;
        $this->cnt = 0;
        $this->students_numbers = array();
        $this->students_names = array();
    }
    public function model(array $row)
    {
        if ($this->startRow == 1) {
            $this->startRow++;
            return null;
        }
        if (empty($row[$this->additionalData['student_number']]) || empty($row[$this->additionalData['student_name']]) || empty($row[$this->additionalData['student_major']]) || empty($row[$this->additionalData['student_phone']])) {
            return null; // Skip this row if student_number , student_name , student_major or student_phone is empty
        }
        $major = Major::where('m_name' , $row[$this->additionalData['student_major']])
        ->exists();
        if(!($major)) {
            $major = new Major();
            $major->m_name = $row[$this->additionalData['student_major']];
            $major->save();
        }

        $major = Major::where('m_name' , $row[$this->additionalData['student_major']])
        ->first();
        $email = $row[$this->additionalData['student_number']] . '@ppu.edu.ps';
        $user = User::where('u_username' , $row[$this->additionalData['student_number']])
                    ->where('name' , $row[$this->additionalData['student_name']])
                    ->where('email' , $email)
                    ->exists();
        if($user) {
            return null;
        }
        $this->cnt++;
        $password = Uuid::uuid4()->toString(); // Generates a random UUID version 4
        return new User([
            'u_username' => $row[$this->additionalData['student_number']] ,
            'name' => $row[$this->additionalData['student_name']] ,
            'email' => $row[$this->additionalData['student_number']] . '@ppu.edu.ps' ,
            'password' => $password ,
            'u_phone1' => $row[$this->additionalData['student_phone']] ,
            'u_major_id' => $major->m_id ,
            'u_role_id' => 2 ,
            'u_gender' => 3 ,
            'u_status' => 1
        ]);
    }
    public function getCount()
    {
        return $this->cnt;
    }
    public function getArrayStudentsNames()
    {
        return $this->students_names;
    }
}
