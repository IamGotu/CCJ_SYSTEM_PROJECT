<?php

namespace App\Http\Controllers;

use App\Models\OjtRecord;
use App\Models\Coordinator;
use App\Models\Student;
use App\Models\Agency; 
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
        $agencies = Agency::all(); 
        return view('ojt_records.edit', compact('ojtRecord', 'coordinators', 'agencies'));
    }


    public function update(Request $request, OjtRecord $ojtRecord)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'student_number' => 'required|string|max:255',
            'agency_id' => 'nullable|exists:agencies,id',  // Validate agency_id
            'credit_hours' => 'required|numeric',
            'year_level' => 'required|string|max:255',
            'school_year' => 'nullable|string|max:255',
            'coordinator_id' => 'nullable|exists:coordinators,id',
            'roster_number' => 'nullable|string|max:255',
        ]);

        // Update the OJT record with the validated data
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

}
