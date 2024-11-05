<?php

namespace App\Imports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudentsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Find the student by ID number or create a new one
        $student = Student::firstOrNew(['student_id_number' => $row['student_id_number']]);

        // Update student details
        $student->first_name = $row['first_name'];
        $student->middle_name = $row['middle_name'];
        $student->last_name = $row['last_name'];
        $student->suffix = $row['suffix'];
        $student->birthdate = $row['birthdate'];
        $student->purok = $row['purok'];
        $student->street_num = $row['street_num'];
        $student->street_name = $row['street_name'];
        $student->barangay = $row['barangay'];
        $student->city = $row['city'];
        $student->state = $row['state'];
        $student->contact_number = $row['contact_number'];
        $student->father_name = $row['father_name'];
        $student->mother_name = $row['mother_name'];
        $student->guardian_name = $row['guardian_name'];
        $student->father_contact = $row['father_contact'];
        $student->mother_contact = $row['mother_contact'];
        $student->guardian_contact = $row['guardian_contact'];
        $student->year_level = $row['year_level'];
        $student->graduation_date = $row['graduation_date'];

        $student->save();
        return $student;
    }
}