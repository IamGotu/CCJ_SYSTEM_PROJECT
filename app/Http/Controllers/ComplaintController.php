<?php

namespace App\Http\Controllers;
use App\Models\DerogatoryRecord;
use App\Models\Complaint;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ComplaintController extends Controller
{
    // Show a specific complaint
    public function showOrEdit($id, $mode = 'view')
    {
        $complaint = Complaint::findOrFail($id);
        return view('complaints.show_edit', compact('complaint', 'mode'));
    }
    
    public function update(Request $request, $id)
    {
        $complaint = Complaint::findOrFail($id);
        $complaint->update($request->all());
    
        return redirect()->route('complaints.showOrEdit', ['id' => $id])->with('success', 'Complaint updated successfully.');
    }
// Edit a specific complaint
public function edit($id)
{
    $complaint = Complaint::findOrFail($id);
    return view('complaints.edit', compact('complaint'));
}

// Delete a specific complaint
public function destroy($id)
{
    $complaint = Complaint::findOrFail($id);

    // Get the associated student_id_number before deleting the complaint
    $student_id_number = $complaint->student_id_number;

    // Delete the complaint
    $complaint->delete();

    // Redirect to the derogatory records page with the student_id
    return redirect()->route('derogatory_records.show', ['student_id' => $student_id_number])
        ->with('success', 'Complaint deleted successfully.');
}
    // Display the complaint creation form
    public function create($student_id_number)
    {
        // Retrieve the student based on the student_id_number
        $student = Student::where('student_id_number', $student_id_number)->firstOrFail();
        $complaints = Complaint::where('student_id_number', $student->student_id_number)->get();
        // Pass student data to the view
        return view('complaints.create', compact('student', 'complaints'));
    }

    // Store a new complaint in the database
 // Store a new complaint in the database
public function store(Request $request)
{
    Log::info('Request data:', $request->all());  // Log all request data
    
    // Validate incoming request data
    $validatedData = $request->validate([
        'student_id_number' => 'required|string|exists:students,student_id_number',
        'complainant_name' => 'required|string|max:255',
        'complainant_position' => 'required|string|max:255',
        'complainant_contact' => 'required|string|max:255',
        'incident_date' => 'required|date',
        'incident_time' => 'required|date_format:H:i',
        'incident_location' => 'required|string|max:255',
        'complaint_details' => 'required|string',
        'violation_type' => 'required|string',
        'minor_offense' => 'nullable|boolean',
        'major_offense' => 'nullable|boolean',
        'evidence_files.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048', // Validate each file
        'previous_incidents' => 'nullable|string',
        'action_taken' => 'required|string', // New validation rule for action taken
        'requested_action' => 'nullable|string',
        'complainant_type' => 'required|string',
       'complainant_student_id' => 'required_if:complainant_type,student|string|nullable', // Required if the complainant type is 'student'
        'complainant_email' => 'required|string|email',
    ]);
    
    try {
        // Create a new complaint and prefill student details
        $complaint = new Complaint();
        
        // Retrieve student details using the validated ID number
        $student = Student::where('student_id_number', $validatedData['student_id_number'])->firstOrFail();
        
        $complaint->student_id_number = $validatedData['student_id_number'];
        $complaint->student_name = $student->first_name . " " . $student->last_name;  // Assuming you have these fields
        $complaint->year_level = $student->year_level;  // Adjust this if necessary
        
        // Fill other complaint fields from validated data
        $complaint->fill($validatedData);
        
        // Handle file upload for evidence files if necessary
        if ($request->hasFile('evidence_files')) {
            $paths = [];
            foreach ($request->file('evidence_files') as $file) {
                $path = $file->store('evidence_files'); 
                // Store paths in an array or as needed
                $paths[] = $path;
            }
            // Store paths as JSON if your database column is set up for it
            $complaint->evidence_files = json_encode($paths); 
            // If you have already set up casts in the model, just do:
            // $complaint->evidence_files = $paths; 
        }
        
        // Save the complaint to the database
        $complaint->save();
        
        Log::info('Complaint saved successfully', ['complaint_id' => $complaint->id]);
        
        // Increment view count for this student
        Complaint::where('student_id_number', $validatedData['student_id_number'])->increment('view_count');
        
        return redirect()->route('derogatory_records.show', ['student_id' => $student->student_id_number])
        ->with('success', 'Record updated successfully.');
    } catch (\Exception $e) {
        Log::error('Error saving complaint', ['error' => $e->getMessage()]);
        
        return back()->withErrors(['error' => 'There was an error saving your complaint. Please try again.']);
    }
}
}