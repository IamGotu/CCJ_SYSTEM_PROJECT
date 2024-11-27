<?php

namespace App\Http\Controllers;

use App\Models\OjtRecord;
use App\Models\Coordinator;
use App\Models\Student;
use Illuminate\Http\Request;


class OjtRecordsController extends Controller
{
    public function index(Request $request)
    {
        // Start building the query for OJT records
        $query = OjtRecord::query();

        // Search by name or student number if the search query is provided
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('student_number', 'like', '%' . $request->search . '%');
            });
        }

        // Filter by school year if provided
        if ($request->filled('school_year') && $request->school_year !== '') {
            $query->where('school_year', $request->school_year);
        }

        // Paginate the results
        $ojtRecords = $query->paginate(10);

        // Pass the current school year filter to the view for persistence
        return view('ojt_records.index', [
            'ojtRecords' => $ojtRecords,
            'currentSchoolYear' => $request->school_year,
        ]);
    }


    public function edit(OjtRecord $ojtRecord)
    {
        // Retrieve all coordinators to display in the dropdown
        $coordinators = Coordinator::all();
        return view('ojt_records.edit', compact('ojtRecord', 'coordinators'));
    }


    public function update(Request $request, OjtRecord $ojtRecord)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'student_number' => 'required|string|max:255',
            'agency_assigned' => 'nullable|string|max:255',
            'credit_hours' => 'required|numeric',
            'year_level' => 'required|string|max:255',
            'school_year' => 'nullable|string|max:255',
            'coordinator_id' => 'nullable|exists:coordinators,id', // Ensure coordinator exists
            'roster_number' => 'nullable|string|max:255', // Validate roster number
        ]);

        // Update the OJT Record
        $ojtRecord->update($validated);

        return redirect()->route('ojt_records.index')
            ->with('success', 'OJT Record updated successfully.');
    }



    public function destroy(OjtRecord $ojtRecord)
    {
        // Delete the OJT record
        $ojtRecord->delete();

        // Redirect to the index page with a success message
        return redirect()->route('ojt_records.index')->with('success', 'OJT Record deleted successfully.');
    }


    public function integrateFourthYearStudents()
    {
        // Get all 4th-year students from the student_profile table
        $fourthYearStudents = Student::where('year_level', '4th')->get();

        // Check if no 4th-year students were found
        if ($fourthYearStudents->isEmpty()) {
            return redirect()->route('ojt_records.index')->with('error', 'No 4th Year Students found to integrate.');
        }

        // Counter for tracking new records added
        $addedCount = 0;

        foreach ($fourthYearStudents as $student) {
            // Skip if the student already exists in ojt_records
            if (OjtRecord::where('student_number', $student->student_id_number)->exists()) {
                continue;
            }

            // Create a new OJT Record
            OjtRecord::create([
                'student_number' => $student->student_id_number,
                'name' => $student->first_name . ' ' . $student->last_name,
                'agency_assigned' => $student->agency_assigned ?? 'N/A', // Default to 'N/A' if not set
                'credit_hours' => 0, // Placeholder or default value
                'roster_number' => $student->roster_number, // Placeholder or default value
                'school_year' => $student->school_year, // Replace with appropriate school year
                'year_level' => '4th',
            ]);

            $addedCount++;
        }

        // Provide feedback based on the result
        if ($addedCount > 0) {
            return redirect()->route('ojt_records.index')->with('success', "{$addedCount} 4th Year Student(s) Integrated Successfully.");
        }

        return redirect()->route('ojt_records.index')->with('error', 'No new 4th Year Students were added. All students are already integrated.');
    }




}
