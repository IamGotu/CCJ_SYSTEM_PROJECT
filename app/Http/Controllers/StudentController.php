<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();
        return view('student_profile.index', compact('students'));
    }

    public function create()
    {
        return view('student_profile.create');
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
            'graduated' => 'required|boolean',
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
        $request->validate([
            'student_id_number' => 'required|unique:students,student_id_number,' . $student->id,
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
            'graduated' => 'required|boolean',
            'graduation_date' => 'nullable|date',
        ]);

        $student->update($request->all());

        return redirect()->route('students.index')->with('success', 'Student profile updated successfully.');
    }

    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->route('students.index')->with('success', 'Student profile deleted successfully.');
    }
}