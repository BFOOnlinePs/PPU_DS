<?php

namespace App\Imports;

use App\Models\Company;
use App\Models\Course;
use App\Models\Major;
use App\Models\Registration;
use App\Models\StudentCompany;
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
        $company_id = 0;
        $major_id = 0;
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


//        $return_user = new User([
//            'u_username' => $row[$this->additionalData['student_id']],
//            'name' => $row[$this->additionalData['student_name']],
//            'u_gender' => $gender ,
//            'password' => bcrypt("123456789"),
//            'email' => $row[$this->additionalData['student_id']] . '@ppu.edu.ps',
//            'u_role_id' => 2,
//            'u_major_id' => $major_id,
//            'u_status' => 1,
//            'u_tawjihi_gpa' => $row[$this->additionalData['u_tawjihi_gpa']],
//            'u_company_id' => $company_id,
//            'u_phone1' => $row[10],
//            'u_date_of_birth' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[11])->format('Y-m-d'),
//        ]);
        $return_user = new User();
        $return_user->u_username = $row[$this->additionalData['student_id']];
        $return_user->name = $row[$this->additionalData['student_name']];
        $return_user->u_gender = $gender;
        $return_user->password = bcrypt("123456789");
        $return_user->email = $row[$this->additionalData['student_id']] . '@ppu.edu.ps';
        $return_user->u_role_id = 2;
        $return_user->u_major_id = $major_id;
        $return_user->u_status = 1;
        $return_user->u_tawjihi_gpa = $row[$this->additionalData['u_tawjihi_gpa']];
        $return_user->u_company_id = $company_id;
        $return_user->u_phone1 = $row[10];
        $return_user->u_date_of_birth = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[11])->format('Y-m-d');

        if($return_user->save()) {
            $check_course_id_if_exist = Company::where('c_name',$row[12])->first();
            if (empty($check_course_id_if_exist)) {
                $new_course = new Course();
                $new_course->c_name = $row[12];
                $new_course->save();
                $course_id = $new_course->c_id;
                $registration = new Registration();
                $registration->r_course_id = $course_id;
                $registration->r_student_id = $return_user->u_id;
                $registration->save();
            } else {
                $course_id = $check_course_id_if_exist->c_id;
                $registration = new Registration();
                $registration->r_course_id = $course_id;
                $registration->r_student_id = $return_user->u_id;
                $registration->save();
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

//        $major = Major::where('m_name' , $row[$this->additionalData['major_name']])
//            ->where('m_reference_code' , $row[$this->additionalData['major_id']])
//            ->first();
            $check_major_id_if_exist = Major::where('m_name' , $row[$this->additionalData['major_name']])
                ->where('m_reference_code' , $row[$this->additionalData['major_id']])
                ->first();
            if (empty($check_major_id_if_exist)) {
                $new_major = new Major();
                $new_major->m_name = $row[8];
                $new_major->m_reference_code = $row[7];
                $new_major->save();
                $major_id = $new_major->m_id;
            } else {
                $major_id = $check_major_id_if_exist->c_id;
            }

            if (!empty($row[13]) && !empty($row[14])) {
                $user_manager = new User();
                $user_manager->u_username = $row[13];
                $user_manager->name = $row[14];
                $user_manager->email = $row[13];
                $user_manager->password = bcrypt($row[16]);
                $user_manager->u_phone1 = $row[15];
                $user_manager->u_role_id = 6;
                $user_manager->save();

                $user_company_manager = new Company();
                $user_company_manager->c_name = $row[14];
                $user_company_manager->save();
            }

            if (!empty($user) && !empty($registration) && !empty($check_company_id_if_exist) && !empty($user_company_manager)){
                $data = new StudentCompany();
                $data->sc_registration_id = $registration->r_id;
                $data->sc_student_id = $return_user->u_id;
                $data->sc_company_id = $check_company_id_if_exist->c_id;
                $data->sc_status = 1;
                $data->save();
            }

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
