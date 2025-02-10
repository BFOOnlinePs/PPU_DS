<?php

namespace App\Http\Controllers\apisControllers\data_integration;

use App\Http\Controllers\Controller;
use App\Models\CitiesModel;
use App\Models\Major;
use App\Models\SystemSetting;
use App\Models\User;
use App\Services\CustomIdentityServerProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DataIntegrationController extends Controller
{
    protected $customIdentityServerProvider;

    public function __construct(CustomIdentityServerProvider $customIdentityServerProvider)
    {
        $this->customIdentityServerProvider = $customIdentityServerProvider;
    }


    public function syncMajors()
    {
        $accessToken = request()->query('access_token');

        $majors = $this->customIdentityServerProvider->getMajors($accessToken);
        Log::info('syncMajors:' . $majors);
        $majors = $majors['data'];

        foreach ($majors as $major) {
            $major = Major::updateOrCreate(
                ['m_id' => $major['majorNo']], // Condition to find existing record
                [
                    'm_reference_code' => $major['majorNo'],
                    'm_name' => $major['majorArabicName']
                ] // Values to update or insert
            );
        }

        return response()->json(['message' => 'Majors synced successfully']);
    }


    public function syncCities()
    {
        $accessToken = request()->query('access_token');

        $cities = $this->customIdentityServerProvider->getAllCities($accessToken);
        Log::info('syncCities:' . $cities);
        $cities = $cities['data'];

        foreach ($cities as $city) {
            $city = CitiesModel::updateOrCreate(
                ['id' => $city['rid']],
                [
                    'city_name_ar' => $city['raname'],
                    'city_name_en' => $city['raname']
                ]
            );
        }

        return response()->json(['message' => 'Cities synced successfully']);
    }


    public function syncStudents()
    {
        $accessToken = request()->query('access_token');

        $system_settings = SystemSetting::first();

        $academicYear = $system_settings->ss_year;
        $semester = $system_settings->ss_semester_type;

        $students = $this->customIdentityServerProvider->getDsStudentsByYear($accessToken, $academicYear, $semester);
        Log::info('syncStudents:' . $students);
        $students = $students['data'];

        foreach ($students as $student) {
            Log::info('student number: ' . $student['studentNo']);
            $student = User::updateOrCreate(
                // ['u_id' => $student['studentNo']],
                ['u_username' => $student['studentNo']],
                [
                    // 'u_username' => $student['studentNo'],
                    'name' => $student['studentNameArabic'],
                    'u_tawjihi_gpa' => $student['studentTawjihiGrade'],
                    'u_date_of_birth' => $student['studentBirthDate'],
                    'u_gender' => $student['studentSex'],
                    'u_phone1' => $student['studentMobile'],
                    'email' => $student['studentNo'] . '@ppu.edu.ps', // i append the domain to the email
                    'u_address' => $student['studentStreet'],
                    'u_major_id' => $student['majorNo'],
                    'u_role_id' => 2, // student role
                    'password'=> ' '
                ]
            );
        }
        return response()->json(['message' => 'Students synced successfully']);
    }


    public function syncAll()
    {
        $this->syncMajors();
        $this->syncCities();
        $this->syncStudents();
        return response()->json(['message' => 'All data synced successfully']);
    }
}
