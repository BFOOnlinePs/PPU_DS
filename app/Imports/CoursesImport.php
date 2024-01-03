<?php

namespace App\Imports;

use App\Models\Course;
use Maatwebsite\Excel\Concerns\ToModel;

class CoursesImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    protected $additionalData , $startRow , $cnt , $courses_array;
    public function __construct($additionalData)
    {
        $this->additionalData = $additionalData;
        $this->startRow = 1;
        $this->cnt = 0;
        $this->courses_array = array();
    }
    public function model(array $row)
    {
        if ($this->startRow == 1) {
            $this->startRow++;
            return null;
        }
        $course = Course::where('c_course_code' , $row[$this->additionalData['course_id']])
                        ->where('c_name' , $row[$this->additionalData['course_name']])
                        ->exists();
        if ($course || empty($row[$this->additionalData['course_id']]) || empty($row[$this->additionalData['course_name']])) {
            return null; // Skip this row if title or description is empty
        }
        $return_course = new Course([
            'c_course_code' => $row[$this->additionalData['course_id']],
            'c_name' => $row[$this->additionalData['course_name']],
            'c_hours' => 3,
            'c_description' => '',
            'c_course_type' => 1,
            'c_reference_code' => ''
        ]);
        if($return_course->save()) {
            $this->cnt++;
            array_push($this->courses_array , $row[$this->additionalData['course_id']]);
            array_push($this->courses_array , $row[$this->additionalData['course_name']]);
            return $return_course;
        }
        else {
            return null;
        }
    }
    public function getCount()
    {
        return $this->cnt;
    }
    public function getCoursesArray()
    {
        return $this->courses_array;
    }
}
