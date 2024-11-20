<?php

namespace App\Http\Controllers;

use App\Models\Intern;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InternController extends Controller
{
    public function index(Request $request)
    {
        $query = DB::table('students')
            ->select(
                'student_id_number as student_number',
                'last_name',
                'first_name',
                'middle_name',
                'year_level',
                'roster_number',
                'documents',
                DB::raw("CASE 
                    WHEN year_level = 'GRADUATE' THEN 'Graduated'
                    ELSE 'Active'
                    END as status")
            )
            ->where(function($q) {
                $q->where('year_level', '4TH')
                  ->orWhere('year_level', 'GRADUATE');
            });

        // Handle search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('student_id_number', 'LIKE', "%{$search}%")
                  ->orWhere('first_name', 'LIKE', "%{$search}%")
                  ->orWhere('last_name', 'LIKE', "%{$search}%")
                  ->orWhere('middle_name', 'LIKE', "%{$search}%");
            });
        }

        // Handle filter
        if ($request->filled('filter') && $request->filter !== 'all') {
            if ($request->filter === 'graduated') {
                $query->where('year_level', 'GRADUATE');
            } elseif ($request->filter === '4th') {
                $query->where('year_level', '4TH');
            }
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

    public function edit($student_number)
    {
        $intern = DB::table('students')
            ->select(
                'id',
                'student_id_number as student_number',
                'first_name',
                'middle_name',
                'last_name',
                'year_level',
                'roster_number',
                'documents'
            )
            ->where('student_id_number', $student_number)
            ->first();

        if (!$intern) {
            return redirect()->route('intern.index')
                ->with('error', 'Intern not found');
        }

        // Initialize empty documents array if null
        $currentDocuments = [];
        if ($intern->documents) {
            $currentDocuments = json_decode($intern->documents, true) ?? [];
        }

        return view('intern_profile.edit', [
            'intern' => $intern,
            'currentDocuments' => $currentDocuments
        ]);
    }

    public function update(Request $request, $student_number)
    {
        $request->validate([
            'roster_number' => 'nullable|string|max:255',
            'documents' => 'nullable|array'
        ]);

        $updateData = [
            'roster_number' => $request->roster_number,
            'documents' => $request->has('documents') ? json_encode($request->documents) : null
        ];

        DB::table('students')
            ->where('student_id_number', $student_number)
            ->update($updateData);

        return redirect()->route('intern.index')
            ->with('success', 'Intern information updated successfully');
    }

    public function destroy($student_number)
    {
        DB::table('students')
            ->where('student_id_number', $student_number)
            ->delete();

        return redirect()->route('intern.index')
            ->with('success', 'Intern deleted successfully');
    }

    public function updateStatus(Intern $intern)
    {
        try {
            $intern->update([
                'status' => 'inactive',
                'graduation_year' => now()->year
            ]);

            return back()->with('success', 'Intern marked as graduated successfully');
        } catch (\Exception $e) {
            \Log::error('Failed to update intern status:', [
                'intern_id' => $intern->id,
                'error' => $e->getMessage()
            ]);

            return back()->with('error', 'Failed to update intern status');
        }
    }

    public function uploadDocument(Request $request, Intern $intern)
    {
        $request->validate([
            'document' => 'required|mimes:pdf,doc,docx|max:2048' // Adjust file types and size as needed
        ]);

        if ($request->hasFile('document')) {
            // Store the file
            $file = $request->file('document');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('intern_documents', $fileName, 'public');

            // Update the intern's documents field
            $intern->update([
                'documents' => $filePath
            ]);

            return redirect()->back()->with('success', 'Document uploaded successfully');
        }

        return redirect()->back()->with('error', 'No document was uploaded');
    }

    public function updated(Student $student)
    {
        // If the student is or was a 4th year student
        if ($student->year_level === 'GRADUATE' || $student->getOriginal('year_level') === '4TH') {
            Intern::updateOrCreate(
                ['student_number' => $student->student_number],
                [
                    'year_level' => $student->year_level,
                    'first_name' => $student->first_name,
                    'last_name' => $student->last_name,
                    // ... other fields ...
                ]
            );
        }
    }
} 