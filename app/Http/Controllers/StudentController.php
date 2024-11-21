<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Imports\StudentsImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
class StudentController extends Controller
{
    public function index(Request $request)
    {
/*************  ✨ Codeium Command ⭐  *************/
    /**
     * Display a listing of students filtered by search term and year level.
     *
     * This method retrieves students from the database based on optional search
     * and year level filters provided in the request. The results are sorted
     * by student ID number and passed to the 'student_profile.index' view.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
/******  421bdfe4-86e6-47f0-8760-1e7f254e2553  *******/        $query = Student::query();
    
        // Filter by search term and year level if provided
        if ($request->has('search') && $request->search != '') {
            $query->where('student_id_number', 'LIKE', '%' . $request->search . '%')
                  ->orWhere('first_name', 'LIKE', '%' . $request->search . '%')
                  ->orWhere('last_name', 'LIKE', '%' . $request->search . '%');
        }
    
        if ($request->has('year_level') && $request->year_level != '') {
            $query->where('year_level', $request->year_level);
        }
    
        // Get students and sort by student_id_number
        $students = $query->orderBy('student_id_number')->get();
    
        return view('student_profile.index', compact('students'));
    }

    public function show($id)
    {
        $student = Student::findOrFail($id);
        return view('student_profile.view-profile', compact('student'));
    }

    
    public function create()
    {
        return view('student_profile.create');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        Excel::import(new StudentsImport, $request->file('file'));

        return redirect()->route('students.index')->with('success', 'Student data imported successfully.');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'student_id_number' => 'required|unique:students',
            'first_name' => 'required',
            'middle_name' => 'nullable',
            'last_name' => 'required',
            'suffix' => 'nullable',
            'birthdate' => 'required|date',
            'purok' => 'nullable',
            'street_num' => 'nullable',
            'street_name' => 'nullable',
            'barangay' => 'nullable',
            'city' => 'nullable',
            'state' => 'nullable',
            'postal_num' => 'nullable',
            'contact_number' => 'nullable',
            'father_name' => 'nullable',
            'mother_name' => 'nullable',
            'guardian_name' => 'nullable',
            'father_contact' => 'nullable',
            'mother_contact' => 'nullable',
            'guardian_contact' => 'nullable',
            'enrollment_status' => 'nullable|string|max:255',
            'school_year' => 'nullable',
            'year_level' => 'required',
            'graduation_date' => 'nullable|date',
        ]);

        Student::create($request->all());

        return redirect()->route('students.index')->with('success', 'Student profile created successfully.');
    }

    public function edit(Student $student)
    {
        return view('student_profile.edit', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'student_id_number' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'suffix' => 'nullable|string|max:255',
            'birthdate' => 'required|date',
            'purok' => 'nullable|string|max:255',
            'street_num' => 'nullable|string|max:255',
            'street_name' => 'nullable|string|max:255',
            'barangay' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'postal_num' => 'nullable|string|max:255',
            'contact_number' => 'nullable|string|max:255',
            'father_name' => 'nullable|string|max:255',
            'mother_name' => 'nullable|string|max:255',
            'guardian_name' => 'nullable|string|max:255',
            'father_contact' => 'nullable|string|max:255',
            'mother_contact' => 'nullable|string|max:255',
            'guardian_contact' => 'nullable|string|max:255',
            'enrollment_status' => 'nullable|string|max:255',
            'school_year' => 'nullable|string|max:255',
            'year_level' => 'required|string',
            'graduation_date' => 'nullable|date',
        ]);
    
        // Update the student record
        $student->update($validatedData);
    
        // Redirect back with a success message
        return redirect()->route('students.index')->with('success', 'Student profile updated successfully.');
    }    

    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->route('students.index')->with('success', 'Student profile deleted successfully.');
    }
}