<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Imports\StudentsImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Models\Intern;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $query = Student::query();
    
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
        $validated = $request->validate([
            'year_level' => 'required|string',
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
            'graduation_date' => 'nullable|date',
        ]);

        // Update student record
        $student->update($validated);

        // Sync with interns table
        if (in_array($validated['year_level'], ['3RD', '4TH'])) {
            // Update or create intern record
            Intern::updateOrCreate(
                ['student_number' => $validated['student_id_number']],
                [
                    'first_name' => $student->first_name,
                    'middle_name' => $student->middle_name,
                    'last_name' => $student->last_name,
                    'year_level' => $validated['year_level'], // Use the new year level
                    'guardian' => $student->guardian_name ?? 'Not Specified',
                    'guardian_contact' => $student->guardian_contact ?? 'Not Specified',
                    'status' => 'active'
                ]
            );
        } else {
            // If not 3rd or 4th year, remove from interns
            Intern::where('student_number', $validated['student_id_number'])->delete();
        }

        // Add debugging
        \Log::info('Student Update:', [
            'student_id' => $validated['student_id_number'],
            'old_year_level' => $student->getOriginal('year_level'),
            'new_year_level' => $validated['year_level']
        ]);

        return redirect()->route('student.profile')
            ->with('success', 'Student updated successfully');
    }    

    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->route('students.index')->with('success', 'Student profile deleted successfully.');
    }
}