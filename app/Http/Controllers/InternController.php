<?php

namespace App\Http\Controllers;

use App\Models\Intern;
use Illuminate\Http\Request;

class InternController extends Controller
{
    public function index(Request $request)
    {
        $query = Intern::query();
        
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('student_number', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('first_name', 'like', "%{$search}%");
            });
        }
        
        $interns = $query->get();
        return view('intern_profile.index', compact('interns'));
    }

    public function create()
    {
        return view('intern_profile.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_number' => 'required|unique:interns',
            'last_name' => 'required',
            'first_name' => 'required',
            'middle_name' => 'nullable',
            'age' => 'required|numeric',
            'address' => 'required',
            'guardian' => 'required',
            'guardian_contact' => 'required',
            'roster_number' => 'required',
            'documents' => 'nullable|array'
        ]);

        Intern::create($validated);
        
        return redirect()->route('intern.profile')
            ->with('success', 'Intern created successfully.');
    }

    public function edit($id)
    {
        $intern = Intern::findOrFail($id);
        return view('intern_profile.edit', compact('intern'));
    }

    public function update(Request $request, $id)
    {
        $intern = Intern::findOrFail($id);
        
        $validated = $request->validate([
            'student_number' => 'required|unique:interns,student_number,' . $id,
            'last_name' => 'required',
            'first_name' => 'required',
            'middle_name' => 'nullable',
            'age' => 'required|numeric',
            'address' => 'required',
            'guardian' => 'required',
            'guardian_contact' => 'required',
            'roster_number' => 'required',
            'documents' => 'nullable|array'
        ]);

        $intern->update($validated);
        
        return redirect()->route('intern.profile')
            ->with('success', 'Intern updated successfully');
    }

    public function destroy($id)
    {
        $intern = Intern::findOrFail($id);
        $intern->delete();
        
        return redirect()->route('intern.profile')
            ->with('success', 'Student record deleted successfully');
    }
} 