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
        // Ensure valid enrollment_status
        $enrollmentStatus = $this->getValidEnrollmentStatus($row['enrollment_status']);
        
        // Ensure valid year_level
        $yearLevel = $this->getValidYearLevel($row['year_level']);
        
        // Handle the birthdate and graduation_date
        $birthdate = Carbon::createFromFormat('d/m/Y', $row['birthdate'])->format('Y-m-d');
        $graduationDate = $row['graduation_date'] ? Carbon::createFromFormat('d/m/Y', $row['graduation_date'])->format('Y-m-d') : null;

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
        $student->enrollment_status = $enrollmentStatus;
        $student->school_year = $row['school_year'];
        $student->year_level = $yearLevel;
        $student->graduation_date = $graduationDate;

        $student->save();
        return $student;
    }

    /**
     * Validate enrollment status to ensure it's one of the acceptable values.
     */
    private function getValidEnrollmentStatus($status)
    {
        $validStatuses = ['Enrolled', 'Not Enrolled', 'Graduate'];
        return in_array($status, $validStatuses) ? $status : 'Not Enrolled'; // Default to 'Not Enrolled' if invalid
    }

    /**
     * Validate year level to ensure it's one of the acceptable values.
     */
    private function getValidYearLevel($yearLevel)
    {
        $validYearLevels = ['1ST', '2ND', '3RD', '4TH', 'GRADUATE'];
        return in_array($yearLevel, $validYearLevels) ? $yearLevel : '1ST'; // Default to '1ST' if invalid
    }
    private function parseDate($date)
    {
        // Check if the date is a valid value
        if (!$this->isValidDate($date)) {
            Log::error("Invalid date format: " . $date);
            return null;  // Return null or handle as needed
        }

        try {
            return Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d');
        } catch (\Exception $e) {
            Log::error("Error parsing date: " . $date . " - " . $e->getMessage());
            return null;
        }
    }

    /**
     * Validate if the date is in a correct format.
     */
    private function isValidDate($date)
    {
        return preg_match('/\d{2}\/\d{2}\/\d{4}/', $date);  // Matches d/m/Y format
    }

}