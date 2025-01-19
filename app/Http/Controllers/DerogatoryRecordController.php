<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\DerogatoryRecord;
use App\Models\DerogatoryRecordHistory;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Complaint;
use App\Models\StudentOffenseCount;
use App\Models\Violation;
use App\Events\DerogatoryRecordUpdated;
class DerogatoryRecordController extends Controller
{
    // Show the details of a specific derogatory record
    public function show($student_id)
    {
        $student = Student::where('student_id_number', $student_id)->firstOrFail();
        $records = $student->derogatoryRecords; // Assuming you have a relationship defined
        $complaints = Complaint::where('student_id_number', $student->student_id_number)->get();
        $violations = Violation::all();
        $record = $records->first();
     // In your show method, check that historyRecords has the 'id' field
     $historyRecords = DerogatoryRecordHistory::with('student', 'violation')->where('student_id_number', $student->student_id_number)->get();


    
        return view('derogatory_records.show', compact('student', 'records', 'complaints', 'violations', 'historyRecords'));
    }

// List all derogatory records
public function index()
{
    // Fetch students along with their derogatory record histories and complaints
    $studentsWithRecords = Student::with(['derogatoryRecordHistories', 'complaints'])->get();

    foreach ($studentsWithRecords as $student) {
        logger()->info("Student ID: {$student->student_id_number}, Derogatory Record Histories: {$student->derogatoryRecordHistories->count()}, Complaints: {$student->complaints->count()}");
    }

    return view('derogatory_records.index', compact('studentsWithRecords'));
}
    // Show the form to create a new derogatory record
    public function create()
    {
        return view('derogatory_records.create');
    }

    // Show the form to edit an existing derogatory record
    public function edit($id)
    {
        // Fetch the derogatory record you want to edit using the ID
        $record = DerogatoryRecordHistory::findOrFail($id); 
    
        // Fetch the list of violations, if needed
        $violations = Violation::all();
    
        // Pass the data to the view
        return view('derogatory_records.edit', compact('record', 'violations'));
    }
    
    
// Update the specified derogatory record
public function update(Request $request, $id)
{
    \Log::debug('Update request data:', $request->all());

    // Validate incoming request
    $request->validate([
        'violation_id' => 'required|exists:violations,id',
        'action_taken' => 'required|string|max:255',
        'settled' => 'required|boolean',
        'student_id_number' => 'required|exists:students,student_id_number',
        'approved_by' => 'nullable|string|max:255', // Added validation for approved_by
    ]);
     // Ensure violation_id is not null or default before proceeding
     $violationId = $request->input('violation_id');
     if (empty($violationId) || $violationId === 'default_violation_id') {
         // Handle the case where violation_id is invalid
         return redirect()->back()->with('error', 'Please select a valid violation.');
     }

    // Fetch the violation and record
    $violation = Violation::findOrFail($request->input('violation_id'));
    $record = DerogatoryRecord::findOrFail($id);

    // Increment offense counts based on violation type
    $this->incrementOffenseCount($request->input('student_id_number'), $violation->violation_type);

    // Calculate penalty based on updated counts
    $penalty = ($violation->violation_type === 'minor')
        ? $this->getMinorOffensePenalty($request->input('student_id_number'))['penalty']
        : $this->getMajorOffensePenalty($request->input('student_id_number'))['penalty'];

    // Update the record
    $record->update([
        'violation_id' => $request->input('violation_id'),
        'penalty' => $penalty,
        'action_taken' => $request->input('action_taken'),
        'settled' => (bool)$request->input('settled'),
    ]);

    // Check if 'settled' is Yes and there's an 'approved_by' value
    $approvedBy = null;
    if ((bool)$request->input('settled') && $request->has('approved_by')) {
        $approvedBy = $request->input('approved_by');
    }

    // Check for existing history record before creating a new one
    $existingHistory = DerogatoryRecordHistory::where([
        ['student_id_number', '=', $request->input('student_id_number')],
        ['violation_id', '=', $request->input('violation_id')]
    ])->first();

    if ($existingHistory) {
        // Optionally update existing history record instead of creating a new one
        $existingHistory->update([
            'penalty' => $penalty,
            'action_taken' => $request->input('action_taken'),
            'settled' => (bool)$request->input('settled'),
            'approved_by' => $approvedBy, // Update the approved_by field
            'updated_at' => now(),
        ]);
    } else {
        // Create a new history record if none exists
        DerogatoryRecordHistory::create([
            'student_id_number' => $request->input('student_id_number'),
            'violation_id' => $request->input('violation_id'),
            'penalty' => $penalty,
            'action_taken' => $request->input('action_taken'),
            'settled' => (bool)$request->input('settled'),
            'approved_by' => $approvedBy, // Add the approved_by field
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

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
    $student = Student::findOrFail($id); 
    $records = DerogatoryRecord::where('student_id', $id)->get(); 

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
        'student_id' => $request->student_id, 
        'violation' => $request->violation,
        'action_taken' => $request->action_taken,
        'sanction' => $request->sanction,
        'settled' => $request->settled,
    ]);

    return redirect()->route('derogatory_records.show_records', $id)->with('success', 'Record added successfully!');
}

// Increment offense count based on violation type
private function incrementOffenseCount($studentId, $violationType)
{
    if ($violationType === 'minor') {
        StudentOffenseCount::updateOrCreate(
            ['student_id_number' => $studentId],
            ['minor_offense_count' => DB::raw('minor_offense_count + 1')]
        );
    } else if ($violationType === 'major') {
        StudentOffenseCount::updateOrCreate(
            ['student_id_number' => $studentId],
            ['major_offense_count' => DB::raw('major_offense_count + 1')]
        );
    }
}

// Get penalty based on minor offense count without incrementing counts
private function getMinorOffensePenalty($studentId)
{
    if (!$studentId) {
        throw new \InvalidArgumentException('Student ID cannot be null');
    }

    // Retrieve existing offense count without incrementing
    $studentOffense = StudentOffenseCount::where('student_id_number', $studentId)->first();
    
    if (!$studentOffense) {
        return ['penalty' => 'No Offenses', 'offenseCount' => 0];
    }

    switch ($studentOffense->minor_offense_count) {
        case 1:
            return ['penalty' => 'Warning/Reprimand', 'offenseCount' => 1];
        case 2:
            return ['penalty' => 'Probation (Guidance Center)', 'offenseCount' => 2];
        default:
            return ['penalty' => 'Major Offense', 'offenseCount' => 3];
    }
}

private function getMajorOffensePenalty($studentId)
{
    if (!$studentId) {
        throw new \InvalidArgumentException('Student ID cannot be null');
    }

    // Retrieve existing offense count without incrementing
    $studentOffense = StudentOffenseCount::where('student_id_number', $studentId)->first();

    if (!$studentOffense) {
        return ['penalty' => 'No Offenses', 'offenseCount' => 0];
    }

    switch ($studentOffense->major_offense_count) {
        case 1:
            return ['penalty' => 'Suspension', 'offenseCount' => 1];
        case 2:
            return ['penalty' => 'Exclusion', 'offenseCount' => 2];
        default:
            return ['penalty' => 'Expulsion', 'offenseCount' => 3];
    }
}

public function getPenalty(Request $request)
{
   // Ensure valid parameters are provided
   if (!$request->has(['studentId', 'violationId'])) {
       return response()->json(['error' => 'Invalid parameters'], 400);
   }

   // Fetch penalty information without modifying counts in DB
   return response()->json(
       Violation::findOrFail($request->query('violationId'))->violation_type === 'minor'
           ? $this->getMinorOffensePenalty($request->query('studentId'))
           : $this->getMajorOffensePenalty($request->query('studentId'))
   );
}

}

// public function store(Request $request)
// {
//     $validated = $request->validate([
//         'student_id_number' => 'required|exists:students,student_id_number',
//         'violation_id' => 'required|exists:violations,id',
//     ]);

//     $violation = Violation::find($validated['violation_id']);

//     // Fetch or create offense count record
//     $offenseCount = StudentOffenseCount::firstOrCreate(
//         ['student_id_number' => $validated['student_id_number']]
//     );

//     if ($violation->violation_type === 'minor') {
//         $offenseCount->minor_offense_count += 1;
//         $penalty = $this->getMinorPenalty($offenseCount->minor_offense_count);
//     } elseif ($violation->violation_type === 'major') {
//         $offenseCount->major_offense_count += 1;
//         $penalty = $this->getMajorPenalty($offenseCount->major_offense_count);
//     }

//     $offenseCount->save();

//     // Save derogatory record
//     DerogatoryRecord::create([
//         'student_id_number' => $validated['student_id_number'],
//         'violation_id' => $violation->id,
//         'penalty' => $penalty,
//     ]);

//     return redirect()->route('derogatory_records.index')->with('success', 'Record added successfully!');
// }

// private function getMinorPenalty($count)
// {
//     switch ($count) {
//         case 1: return 'Warning/Reprimand';
//         case 2: return 'Probation (Guidance Center)';
//         default: return 'Escalated to Major Offense';
//     }
// }

// private function getMajorPenalty($count)
// {
//     switch ($count) {
//         case 1: return 'Suspension';
//         case 2: return 'Exclusion';
//         default: return 'Expulsion';
//     }
// }