<?php

namespace App\Http\Controllers\apisControllers\data_integration;

use App\Http\Controllers\Controller;
use App\Models\CitiesModel;
use App\Models\Course;
use App\Models\Major;
use App\Models\Registration;
use App\Models\SemesterCourse;
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

        // if students exists
        if (count($students) == 0) {
            return response()->json(['message' => 'No students found']);
        }

        // todo check semester-course depend of semester and year fields
        $semester = $system_settings->ss_semester_type;
        $year = $system_settings->ss_year;
        $semester_course = SemesterCourse::where('sc_semester', $semester)
            ->where('sc_year', $year)
            ->first();

        $semesterText = match ($semester) {
            1 => 'الأول',
            2 => 'الثاني',
            3 => 'الصيفي',
            default => 'غير معروف',
        };

        // Generate the course name
        $courseName = "تدريب عملي $year للفصل $semesterText";
        $courseDescription = "مقرر تدريب عملي للعام $year في الفصل $semesterText.";


        if (!$semester_course) {
            // add course
            $course = Course::create([
                'c_name' => $courseName,
                'c_course_code' => '',
                'c_hours' => 3,
                'c_description' => $courseDescription,
                'c_course_type' => 1,
                'c_reference_code' => '',
            ]);

            // Update the course with the generated ID
            $course->update([
                'c_course_code' => $course->c_id,
                'c_reference_code' => $course->c_id,
            ]);

            // add semester course
            $semester_course = SemesterCourse::create([
                'sc_semester' => $system_settings->ss_semester_type,
                'sc_year' => $system_settings->ss_year,
                'sc_course_id' => $course->c_id,
            ]);
        }

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
                    'password' => ' '
                ]
            );

            // todo add registration for each student, if not exists
            $registration = Registration::where('r_student_id', $student->u_id)
                ->where('r_course_id', $semester_course->sc_course_id)
                ->where('r_semester', $semester)
                ->where('r_year', $year)
                ->first();

            // if registration exists, skip
            if ($registration) {
                continue;
            }

            $registration = Registration::create([
                'r_student_id' => $student->u_id,
                'r_course_id' => $semester_course->sc_course_id,
                'r_semester' => $semester,
                'r_year' => $year,
            ]);
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
