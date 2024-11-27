<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\DerogatoryRecord;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Complaint;
class DerogatoryRecordController extends Controller
{
    // Show the details of a specific derogatory record
    public function show($student_id)
    {
        $student = Student::where('student_id_number', $student_id)->firstOrFail();
        $records = $student->derogatoryRecords; // Assuming you have a relationship defined
        $complaints = Complaint::where('student_id_number', $student->student_id_number)->get();
        return view('derogatory_records.show', compact('student', 'records', 'complaints'));
    }
    
    

    // List all derogatory records
    public function index()
    {
        // Eager load the student information along with derogatory records
        $derogatoryRecords = DerogatoryRecord::with('student')->get();
        return view('derogatory_records.index', compact('derogatoryRecords'));
    }

    // Show the form to create a new derogatory record
    public function create()
    {
        return view('derogatory_records.create');
    }

    // Store a newly created derogatory record
    public function store(Request $request)
    {
        Log::info($request->all());

        // Validate the incoming request
        $validated = $request->validate([
            'violation' => 'required|string|max:255',
            'action_taken' => 'required|string|max:255',
            'sanction' => 'nullable|string|max:255',
            'settled' => 'required|boolean',
            'student_id_number' => 'required|exists:students,student_id_number',  // Ensure the student exists
        ]);
    
        // Check if the student already has a derogatory record
        $existingRecord = DerogatoryRecord::where('student_id_number', $request->student_id_number)->first();
    
        if ($existingRecord) {
            // Update the existing record
            $existingRecord->update([
                'violation' => $validated['violation'],
                'action_taken' => $validated['action_taken'],
                'sanction' => $validated['sanction'],
                'settled' => $validated['settled'],
            ]);
            $message = 'Record updated successfully.';
        } else {
            // Create a new derogatory record
            DerogatoryRecord::create([
                'student_id_number' => $request->student_id_number,
                'violation' => $validated['violation'],
                'action_taken' => $validated['action_taken'],
                'sanction' => $validated['sanction'],
                'settled' => $validated['settled'],
            ]);
            $message = 'Record added successfully.';
        }
    
        // Redirect back with success message
        return redirect()->route('derogatory_records.index')->with('success', $message);
    }
    

    // Show the form to edit an existing derogatory record
    public function edit($id)
    {
        $record = DerogatoryRecord::findOrFail($id);
        return view('derogatory_records.edit', compact('record'));
    }

    // Update the specified derogatory record
    // In the update method
    public function update(Request $request, $id)
    {
        // Validate the incoming data
        $request->validate([
            'violation' => 'required|string|max:255',
            'action_taken' => 'required|string|max:255',
            'sanction' => 'required|string|max:255',
            'settled' => 'required|boolean',
        ]);
    
        // Find the existing record
        $record = DerogatoryRecord::findOrFail($id);
    
        // Update the record with the validated data
        $record->update([
            'violation' => $request->input('violation'),
            'action_taken' => $request->input('action_taken'),
            'sanction' => $request->input('sanction'),
            'settled' => $request->input('settled'),
        ]);
    
        // Redirect back to the student's derogatory record page using student_id_number
        return redirect()->route('derogatory_records.show', ['student_id' => $record->student->student_id_number])
                         ->with('success', 'Record updated successfully.');
    }
    

    // Handle deleting a derogatory record
    public function destroy($id)
    {
        $record = DerogatoryRecord::findOrFail($id);
        $record->delete();

        return redirect()->route('derogatory_records.index')->with('success', 'Record deleted successfully');
    }

    // Show all derogatory records for a specific student
    public function showRecords($id)
    {
        $student = Student::findOrFail($id); // Assuming you have a Student model.
        $records = DerogatoryRecord::where('student_id', $id)->get(); // Get related derogatory records.

        return view('derogatory_records.show_records', compact('student', 'records'));
    }

    // Add a derogatory record for a student
    public function addRecord(Request $request, $id)
    {
        $request->validate([
            'violation' => 'required|string|max:255',
            'action_taken' => 'required|string|max:255',
            'sanction' => 'nullable|string|max:255',
            'settled' => 'required|boolean',
        ]);

        DerogatoryRecord::create([
            'student_id' => $request->student_id, // Add student_id to the record
            'violation' => $request->violation,
            'action_taken' => $request->action_taken,
            'sanction' => $request->sanction,
            'settled' => $request->settled,
        ]);

        return redirect()->route('derogatory_records.show_records', $id)->with('success', 'Record added successfully!');
    }
}
