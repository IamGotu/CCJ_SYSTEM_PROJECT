<?php

namespace App\Imports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudentsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
<<<<<<< Updated upstream
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
=======
        try {
            // Debug row data
            \Log::info('Processing row:', $row);

            // Basic validation
            if (empty($row['student_id_number'])) {
                \Log::warning('Skipping row - missing student ID number');
                return null;
            }

            // Create or update student
            $student = Student::firstOrNew(['student_id_number' => $row['student_id_number']]);
>>>>>>> Stashed changes

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
<<<<<<< Updated upstream
=======

    private function safeParseDate($date)
    {
        if (empty($date)) {
            return null;
        }

        try {
            // Try multiple date formats
            $formats = ['d/m/Y', 'Y-m-d', 'm/d/Y', 'd-m-Y'];
            
            foreach ($formats as $format) {
                try {
                    return Carbon::createFromFormat($format, trim($date))->format('Y-m-d');
                } catch (\Exception $e) {
                    continue;
                }
            }

            // If no format works, try parsing directly
            return Carbon::parse($date)->format('Y-m-d');
        } catch (\Exception $e) {
            \Log::warning("Could not parse date: {$date}");
            return null;
        }
    }

    private function getValidEnrollmentStatus($status)
    {
        $validStatuses = ['Enrolled', 'Not Enrolled', 'Graduate'];
        $status = trim($status ?? '');
        return in_array($status, $validStatuses) ? $status : 'Not Enrolled';
    }

    private function getValidYearLevel($yearLevel)
    {
        $validYearLevels = ['1ST', '2ND', '3RD', '4TH', 'GRADUATE'];
        $yearLevel = strtoupper(trim($yearLevel ?? ''));
        return in_array($yearLevel, $validYearLevels) ? $yearLevel : '1ST';
    }
>>>>>>> Stashed changes
}