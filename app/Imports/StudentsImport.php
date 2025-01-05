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

            // Basic validation
            if (empty($row['student_id_number'])) {
                \Log::warning('Skipping row - missing student ID number');
                return null;
            }

            // Create or update student
            $student = Student::firstOrNew(['student_id_number' => $row['student_id_number']]);

            // Set values with defaults
            $student->fill([
                'first_name' => $row['first_name'] ?? '',
                'middle_name' => $row['middle_name'] ?? '',
                'last_name' => $row['last_name'] ?? '',
                'suffix' => $row['suffix'] ?? '',
                'birthdate' => $this->safeParseDate($row['birthdate'] ?? null),
                'purok' => $row['purok'] ?? '',
                'street_num' => $row['street_num'] ?? '',
                'street_name' => $row['street_name'] ?? '',
                'barangay' => $row['barangay'] ?? '',
                'city' => $row['city'] ?? '',
                'state' => $row['state'] ?? '',
                'contact_number' => $row['contact_number'] ?? '',
                'father_name' => $row['father_name'] ?? '',
                'mother_name' => $row['mother_name'] ?? '',
                'guardian_name' => $row['guardian_name'] ?? '',
                'father_contact' => $row['father_contact'] ?? '',
                'mother_contact' => $row['mother_contact'] ?? '',
                'guardian_contact' => $row['guardian_contact'] ?? '',
                'enrollment_status' => 'Not Enrolled', // Default value
                'school_year' => $row['school_year'] ?? date('Y').'-'.(date('Y')+1),
                'year_level' => $this->getValidYearLevel($row['year_level'] ?? null),
                'graduation_date' => $this->safeParseDate($row['graduation_date'] ?? null)
            ]);

            // Update enrollment status if provided
            if (isset($row['enrollment_status'])) {
                $student->enrollment_status = $this->getValidEnrollmentStatus($row['enrollment_status']);
            }

            $student->save();
            return $student;

        } catch (\Exception $e) {
            \Log::error('Import error: ' . $e->getMessage());
            \Log::error('Row data: ', $row);
            throw $e;
        }
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