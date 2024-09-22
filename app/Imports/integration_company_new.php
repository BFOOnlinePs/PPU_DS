<?php

namespace App\Imports;

use App\Models\Company;
use App\Models\Course;
use App\Models\Major;
use App\Models\Registration;
use App\Models\StudentCompany;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class integration_company_new implements ToModel , WithStartRow
{
    protected $request;

    public function __construct($request)
    {
        $this->request = $request;
    }
    /**
    * @param Collection $collection
    */
    public function model(array $row)
    {
        $major = null;
        $course = null;
        $student_number = null;
        $supervisor = null;
        $companies = null;
        $registration = null;
        $student_company = null;

        $course = Course::firstOrCreate(
            ['c_course_code' => $this->request->course_id],
            [
                'c_name' => $this->request->course_name,
                'c_hours' => 3,
                'c_description' => $this->request->course_name,
                'c_course_type' => 0,
                'c_reference_code' => $this->request->course_id,
            ]
        );
        
        if (!empty($row[6])) {
            $major = Major::firstOrCreate(['m_name' => $row[6]]);
        }

        if (!empty($row[1])) {
            $student_number = User::firstOrCreate(
                ['u_username' => $row[1]], // Correct syntax: key-value pair in an array
                [
                    'u_username' => $row[1],
                    'name' => $row[2],
                    'email' => $row[1] . '@ppu.edu.ps',
                    'password' => bcrypt('123456789'), // Hash the password
                    'u_phone1' => $row[8] ?? '',
                    'u_address' => $row[4],
                    'u_date_of_birth' => $row[9] ?? '',
                    'u_gender' => $row[3] == 'انثى' ? 0 : ($row[3] == 'ذكر' ? 1 : null),                    
                    'u_major_id' => $major ? $major->m_id : null,
                    'u_role_id' => 2,
                    'u_status' => 1,
                    'u_tawjihi_gpa' => $row[7],
                ]
            );
        }

        if(!empty($row[10]) && !empty($row[11])){
            $supervisor = User::firstOrCreate(
                [
                    'name' => $row[10],
                    'email' => $row[11],
                ]
            ,[
                    'u_username' => $row[11],
                    'password' => bcrypt('987654321'), // Hash the password
                    'u_date_of_birth' => $row[9] ?? '',
                    'u_gender' => $row[3] == 'انثى' ? 0 : ($row[3] == 'ذكر' ? 1 : null),                    
                    'u_major_id' => $major ? $major->m_id : null,
                    'u_role_id' => 10,
                    'u_status' => 1,
            ]);
        }

        if(!empty($row[12]) && !empty($row[13])){
            $manager_company = User::firstOrCreate([
                'name' => $row[12],
                'email' => $row[13],
            ],[
                'name' => $row[12],
                'u_username' => $row[15] ?? $row[14],
                'email' => $row[15] ?? ($row[14] . '@ppu.edu.ps'),
                'password' => Hash::make('12345678'),
                'u_phone1' => $row[14],
                'u_role_id' => 6,
                'u_status' => 1,
            ]);
        }

        if(!empty($row[12])){
            $compaines = Company::firstOrCreate(
                [
                    'c_name' => $row[12]
                ]
            ,[
                    'c_name' => $row[12],
                    'c_english_name' => $row[12],
                    'c_manager_id' => $manager_company->u_id,
            ]);
        }

        $student_id = $student_number->u_id ?? optional(User::where('u_username', $row[1])->first())->u_id;
        if ($student_id) {
            $registration = Registration::firstOrCreate(
                [
                    'r_student_id' => $student_id,
                    'r_course_id' => $course->c_id,
                    'r_semester' => $this->request->semester,
                    'r_year' => $this->request->year,
                ],
                [
                    'supervisor_id' => $supervisor->u_id,
                ]
            );
        }

        if ($registration && $student_number->u_id && $compaines->c_id) {
            $student_company = StudentCompany::firstOrCreate([
                'sc_registration_id' => $registration->r_id,
                'sc_student_id' => $student_number->u_id,
                'sc_company_id' => $compaines->c_id,
            ],[
                'sc_assistant_id' => $manager_company->u_id,
                'sc_status' => 1,
            ]);
        }
    }

    public function startRow(): int
    {
        return 2;
    }

}
