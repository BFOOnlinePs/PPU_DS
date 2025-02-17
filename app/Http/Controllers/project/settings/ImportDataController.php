<?php

namespace App\Http\Controllers\project\settings;

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

class ImportDataController extends Controller
{
    protected $customIdentityServerProvider;

    public function __construct(CustomIdentityServerProvider $customIdentityServerProvider)
    {
        $this->customIdentityServerProvider = $customIdentityServerProvider;
    }

    public function importData()
    {
        $accessToken = session('auth_token');
        $this->syncMajors($accessToken);
        $this->syncCities($accessToken);
        $this->syncStudents($accessToken);
        return view('import.success', ['message' => 'Data imported successfully!']);
    }

    private function syncMajors($accessToken)
    {
        $majors = $this->customIdentityServerProvider->getMajors($accessToken)['data'];
        foreach ($majors as $major) {
            Major::updateOrCreate(
                ['m_id' => $major['majorNo']],
                ['m_reference_code' => $major['majorNo'], 'm_name' => $major['majorArabicName']]
            );
        }
    }

    private function syncCities($accessToken)
    {
        $cities = $this->customIdentityServerProvider->getAllCities($accessToken)['data'];
        foreach ($cities as $city) {
            CitiesModel::updateOrCreate(
                ['id' => $city['rid']],
                ['city_name_ar' => $city['raname'], 'city_name_en' => $city['raname']]
            );
        }
    }

    private function syncStudents($accessToken)
    {
        $system_settings = SystemSetting::first();
        $academicYear = $system_settings->ss_year;
        $semester = $system_settings->ss_semester_type;
        $students = $this->customIdentityServerProvider->getDsStudentsByYear($accessToken, $academicYear, $semester)['data'];

        if (empty($students)) {
            return;
        }

        $semester_course = $this->getOrCreateSemesterCourse($academicYear, $semester);

        foreach ($students as $student) {
            $user = User::updateOrCreate(
                ['u_username' => $student['studentNo']],
                [
                    'name' => $student['studentNameArabic'],
                    'u_tawjihi_gpa' => $student['studentTawjihiGrade'],
                    'u_date_of_birth' => $student['studentBirthDate'],
                    'u_gender' => $student['studentSex'],
                    'u_phone1' => $student['studentMobile'],
                    'email' => $student['studentNo'] . '@ppu.edu.ps',
                    'u_address' => $student['studentStreet'],
                    'u_major_id' => $student['majorNo'],
                    'u_role_id' => 2, // Student role
                    'password' => bcrypt('password123'),
                ]
            );

            Registration::firstOrCreate([
                'r_student_id' => $user->u_id,
                'r_course_id' => $semester_course->sc_course_id,
                'r_semester' => $semester,
                'r_year' => $academicYear,
            ]);
        }
    }

    private function getOrCreateSemesterCourse($academicYear, $semester)
    {
        $semester_course = SemesterCourse::where('sc_semester', $semester)
            ->where('sc_year', $academicYear)
            ->first();

        if (!$semester_course) {
            $semesterText = match ($semester) {
                1 => 'الأول',
                2 => 'الثاني',
                3 => 'الصيفي',
                default => 'غير معروف',
            };

            $courseName = "تدريب عملي $academicYear للفصل $semesterText";
            $courseDescription = "مقرر تدريب عملي للعام $academicYear في الفصل $semesterText.";

            $course = Course::create([
                'c_name' => $courseName,
                'c_course_code' => '',
                'c_hours' => 3,
                'c_description' => $courseDescription,
                'c_course_type' => 1,
                'c_reference_code' => '',
            ]);

            $course->update([
                'c_course_code' => $course->c_id,
                'c_reference_code' => $course->c_id,
            ]);

            $semester_course = SemesterCourse::create([
                'sc_semester' => $semester,
                'sc_year' => $academicYear,
                'sc_course_id' => $course->c_id,
            ]);
        }

        return $semester_course;
    }
}
