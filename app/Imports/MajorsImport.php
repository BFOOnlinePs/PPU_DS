<?php

namespace App\Imports;

use App\Models\Major;
use Maatwebsite\Excel\Concerns\ToModel;

class MajorsImport implements ToModel
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
        $major = Major::where('m_reference_code' , $row[$this->additionalData['major_id']])
                        ->where('m_name' , $row[$this->additionalData['major_name']])
                        ->exists();
        if ($major || empty($row[$this->additionalData['major_id']]) || empty($row[$this->additionalData['major_name']])) {
            return null; // Skip this row
        }
        return new Major([
            'm_name' => $row[$this->additionalData['major_name']],
            'm_description' => '',
            'm_reference_code' => $row[$this->additionalData['major_id']],
        ]);
    }
}
