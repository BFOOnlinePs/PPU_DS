<?php

namespace App\Imports;

use App\Models\Major;
use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;

class UsersImport implements ToModel
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
        if (empty($row[$this->additionalData['student_id']]) || empty($row[$this->additionalData['student_name']])) {
           return null; // Skip this row if student_id or student_name is empty
        }
        $user = User::where('u_username' , $row[$this->additionalData['student_id']])
                    ->where('name' , $row[$this->additionalData['student_name']])
                    ->exists();
        if($user) {
            return null;
        }
        $major = Major::where('m_name' , $row[$this->additionalData['major_name']])
            ->where('m_reference_code' , $row[$this->additionalData['major_id']])
            ->first();
        $return_user = new User([
            'u_username' => $row[$this->additionalData['student_id']],
            'name' => $row[$this->additionalData['student_name']],
            'password' => bcrypt("123456789"),
            'email' => $row[$this->additionalData['student_id']] . '@ppu.edu.ps',
            'u_role_id' => 2,
            'u_major_id' => $major->m_id,
            'u_status' => 1
        ]);
        if($return_user->save()) {
            $this->cnt++;
            array_push($this->students_numbers, $row[$this->additionalData['student_id']]);
            array_push($this->students_names, $row[$this->additionalData['student_name']]);
            return $return_user;
        }
        else {
            return null;
        }
    }
    public function getCount()
    {
        return $this->cnt;
    }
    public function getArrayStudentsNumbers()
    {
        return $this->students_numbers;
    }
    public function getArrayStudentsNames()
    {
        return $this->students_names;
    }
}
