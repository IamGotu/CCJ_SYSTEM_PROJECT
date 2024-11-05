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
        $query = Student::query();
    
        // Search filter
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('student_id_number', 'like', "%$search%")
                  ->orWhere('first_name', 'like', "%$search%")
                  ->orWhere('middle_name', 'like', "%$search%")
                  ->orWhere('last_name', 'like', "%$search%");
            });
        }
    
        // Year Level filter
        if ($request->filled('year_level')) {
            $query->where('year_level', $request->input('year_level'));
        }
    
        $students = $query->paginate(10);
    
        return view('student_profile.index', compact('students'));
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