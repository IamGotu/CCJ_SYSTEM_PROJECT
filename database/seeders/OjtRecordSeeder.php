<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Models\OjtRecord;

class OjtRecordSeeder extends Seeder
{
    public function run()
    {
        // Get all 4th year students from the database
        $students = Student::where('year_level', '4TH')->get();  // Filter students by year_level

        foreach ($students as $student) {
            // Create an OJT record for each 4th-year student
            OjtRecord::create([
                'name' => $student->first_name . ' ' . $student->last_name,  // You can customize this as needed
                'student_number' => $student->student_id_number,
                'agency_assigned' => '', // You need to populate this based on your logic
                'roster_number' => null, // Optional
                'school_year' => $student->school_year,
                'year_level' => $student->year_level,
                'credit_hours' => 0, // Default value or you can calculate this based on your logic
            ]);
        }
    }
}
