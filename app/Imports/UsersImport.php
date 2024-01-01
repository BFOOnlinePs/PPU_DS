<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;

class UsersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    protected $additionalData , $startRow;

    public function __construct($additionalData)
    {
        $this->additionalData = $additionalData;
        $this->startRow = 1;
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
        return new User([
            'u_username' => $row[$this->additionalData['student_id']],
            'name' => $row[$this->additionalData['student_name']],
            'password' => bcrypt("123456789"),
            'email' => $row[$this->additionalData['student_id']] . '@ppu.edu.ps',
            'u_role_id' => 1,
            'u_status' => 1
        ]);
    }
}
