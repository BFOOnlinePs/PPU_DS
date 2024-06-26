<?php

namespace App\Imports;

use App\Models\Company;
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
        if (empty($row[$this->additionalData['student_id']]) || empty($row[$this->additionalData['student_name']]) || empty($row[$this->additionalData['student_gender']])) {
           return null; // Skip this row if student_id or student_name is empty
        }
        $gender = null;
        if($row[$this->additionalData['student_gender']] == "أنثى" || $row[$this->additionalData['student_gender']] == "انثى" || $row[$this->additionalData['student_gender']] == "Female" || $row[$this->additionalData['student_gender']] == "female") {
            $gender = 1;
        }
        else if($row[$this->additionalData['student_gender']] == "ذكر" || $row[$this->additionalData['student_gender']] == "Male" || $row[$this->additionalData['student_gender']] == "male") {
            $gender = 0;
        }
        $user = User::where('u_username' , $row[$this->additionalData['student_id']])
                    ->where('name' , $row[$this->additionalData['student_name']])
                    ->where('u_gender' , $gender)
                    ->exists();
        if($user) {
            return null;
        }

        $check_company_id_if_exist = Company::where('c_name',$row[12])->first();
        if (empty($check_company_id_if_exist)) {
            $new_company = new Company();
            $new_company->c_name = $row[12];
            $new_company->save();
            $company_id = $new_company->c_id;
        } else {
            $company_id = $check_company_id_if_exist->c_id;
        }
        $major = Major::where('m_name' , $row[$this->additionalData['major_name']])
            ->where('m_reference_code' , $row[$this->additionalData['major_id']])
            ->first();
        $return_user = new User([
            'u_username' => $row[$this->additionalData['student_id']],
            'name' => $row[$this->additionalData['student_name']],
            'u_gender' => $gender ,
            'password' => bcrypt("123456789"),
            'email' => $row[$this->additionalData['student_id']] . '@ppu.edu.ps',
            'u_role_id' => 2,
            'u_major_id' => $major->m_id,
            'u_status' => 1,
            'u_tawjihi_gpa' => $row[$this->additionalData['u_tawjihi_gpa']],
            'u_company_id' => $company_id,
            'u_phone1' => $row[10],
            'u_date_of_birth' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[11])->format('Y-m-d')

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
