<?php

namespace App\Imports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Carbon\Carbon;

class StudentsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Parse the date fields and normalize them to Y-m-d format
        $birthdate = $this->parseDate($row['birthdate']);
        $graduationDate = $this->parseDate($row['graduation_date']);

        // Find the student by ID number or create a new one
        $student = Student::firstOrNew(['student_id_number' => $row['student_id_number']]);

        // Update student details
        $student->first_name = $row['first_name'];
        $student->middle_name = $row['middle_name'];
        $student->last_name = $row['last_name'];
        $student->suffix = $row['suffix'];
        $student->birthdate = $birthdate;
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
        $student->graduation_date = $graduationDate;

        $student->save();
        return $student;
    }

    /**
     * Parse a date string into Y-m-d format.
     *
     * @param string|null $date
     * @return string|null
     */
    private function parseDate($date)
    {
        if (!$date) {
            return null; // Return null if the date is empty
        }

        try {
            // Try to parse the date and format it as Y-m-d
            return Carbon::parse($date)->format('Y-m-d');
        } catch (\Exception $e) {
            // Handle parsing failure, optionally log the issue
            return null;
        }
    }
}