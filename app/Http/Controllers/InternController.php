<?php

namespace App\Http\Controllers;

use App\Models\Intern;
use App\Models\Student;
use Illuminate\Http\Request;

class InternController extends Controller
{
    public function index(Request $request)
    {
        $query = Intern::query();

        // Apply search filter if search term exists
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('student_number', 'like', '%' . $search . '%')
                  ->orWhere('first_name', 'like', '%' . $search . '%')
                  ->orWhere('last_name', 'like', '%' . $search . '%');
            });
        }

        // Always filter for active 3rd and 4th year students
        $interns = $query->where('status', 'active')
                        ->whereIn('year_level', ['3RD', '4TH'])
                        ->orderBy('student_number')
                        ->get();

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

    public function edit(Intern $intern)
    {
        // Remove quotes when displaying in edit form
        $currentDocuments = $intern->documents;
        if ($currentDocuments && $currentDocuments !== 'No documents') {
            $currentDocuments = trim($currentDocuments, '"');
            $currentDocuments = explode(', ', $currentDocuments);
        } else {
            $currentDocuments = [];
        }

        return view('intern_profile.edit', compact('intern', 'currentDocuments'));
    }

    public function update(Request $request, Intern $intern)
    {
        $validated = $request->validate([
            'roster_number' => 'required|string|max:255',
            'documents' => 'nullable|array'
        ]);

        try {
            // Properly quote the documents string
            $selectedDocuments = $request->input('documents', []);
            $documentsString = !empty($selectedDocuments) 
                ? '"' . implode(', ', $selectedDocuments) . '"'  // Add quotes around the string
                : 'No documents';

            $intern->update([
                'roster_number' => $validated['roster_number'],
                'documents' => $documentsString
            ]);

            \Log::info('Documents updated:', [
                'intern_id' => $intern->id,
                'documents' => $documentsString
            ]);

            return redirect()->route('intern.profile')
                ->with('success', 'Intern updated successfully');
        } catch (\Exception $e) {
            \Log::error('Update error:', [
                'message' => $e->getMessage(),
                'intern_id' => $intern->id
            ]);

            return back()
                ->withInput()
                ->with('error', 'Failed to update documents. Please try again.');
        }
    }

    public function destroy($id)
    {
        $intern = Intern::findOrFail($id);
        $intern->delete();
        
        return redirect()->route('intern.profile')
            ->with('success', 'Student record deleted successfully');
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
} 