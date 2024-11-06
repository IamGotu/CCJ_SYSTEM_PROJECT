<?php

namespace App\Http\Controllers;

use App\Models\DerogatoryRecord;
use Illuminate\Http\Request;

class DerogatoryRecordController extends Controller
{
    // Show the form to create a new derogatory record
    
    public function index(Request $request)
{
    // Fetch records based on search query if provided
    $query = DerogatoryRecord::query();

    if ($request->has('search') && $request->search != '') {
        $search = $request->search;
        $query->where(function ($q) use ($search) {
            $q->where('student_number', 'like', "%{$search}%")
                ->orWhere('last_name', 'like', "%{$search}%")
                ->orWhere('first_name', 'like', "%{$search}%");
        });
    }

    $derogatoryRecords = $query->get();
    return view('derogatory_records.index', compact('derogatoryRecords'));
}
public function create()
    {
        return view('derogatory_records.create');
    }

    // Store a newly created derogatory record in storage
    public function store(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'student_number' => 'required|unique:derogatory_records,student_number',
            'last_name' => 'required',
            'first_name' => 'required',
            'middle_name' => 'nullable',
            'year_graduated' => 'nullable|numeric',
            'violation' => 'required',
            'action_taken' => 'nullable',
            'settled' => 'nullable|boolean',
            'sanction' => 'nullable',
        ]);

        // Store the new derogatory record with validated data
        DerogatoryRecord::create($validated);

        // Redirect with a success message
        return redirect()->route('derogatory_records.index')->with('success', 'Record added successfully');
    }

    // Show the form to edit an existing derogatory record
    public function edit($id)
    {
        $record = DerogatoryRecord::findOrFail($id);
        return view('derogatory_records.edit', compact('record'));
    }

    // Update the specified derogatory record in storage
    public function update(Request $request, $id)
    {
        // Validate the incoming request, including exception for the current record's student_number
        $validated = $request->validate([
            'student_number' => 'required|unique:derogatory_records,student_number,' . $id,
            'last_name' => 'required',
            'first_name' => 'required',
            'middle_name' => 'nullable',
            'year_graduated' => 'nullable|numeric',
            'violation' => 'required',
            'action_taken' => 'nullable',
            'settled' => 'nullable|boolean',
            'sanction' => 'nullable',
        ]);

        // Find the existing derogatory record and update it with validated data
        $record = DerogatoryRecord::findOrFail($id);
        $record->update($validated);

        // Redirect with a success message
        return redirect()->route('derogatory_records.index')->with('success', 'Record updated successfully');
    }

    // Delete the specified derogatory record from storage
    public function destroy($id)
    {
        // Delete the derogatory record by its ID
        DerogatoryRecord::destroy($id);

        // Redirect with a success message
        return redirect()->route('derogatory_records.index')->with('success', 'Record deleted successfully');
    }
}
