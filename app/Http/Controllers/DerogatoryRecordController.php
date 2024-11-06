<?php

namespace App\Http\Controllers;

use App\Models\DerogatoryRecord;
use Illuminate\Http\Request;

class DerogatoryRecordController extends Controller
{
    public function show($id)
{
    $record = DerogatoryRecord::findOrFail($id);
    \Log::info('Record Data:', (array) $record); // This logs the data to the log file
    return response()->json($record); // Return JSON response
}

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
        // Validate the incoming request data
        $validated = $request->validate([
            'student_number' => 'required|unique:derogatory_records,student_number',
            'last_name' => 'required',
            'first_name' => 'required',
            'middle_name' => 'nullable',
            'year_graduated' => 'nullable|numeric',
            'violation' => 'nullable',
            'action_taken' => 'nullable',
            'settled' => 'nullable|boolean',
            'sanction' => 'nullable|in:suspension,expulsion,verbal_warning,written_warning,others',
        ]);

        // Convert 'yes'/'no' to boolean for settled
        $validated['settled'] = ($validated['settled'] === 'yes');

        // Insert the validated data into the database
        try {
            DerogatoryRecord::create($validated);
            return redirect()->route('derogatory_records.index')->with('success', 'Record added successfully');
        } catch (\Exception $e) {
            \Log::error('Error inserting data: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
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
        // Log the request data
        \Log::info($request->all());

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

        // Update the derogatory record with validated data
        $record = DerogatoryRecord::findOrFail($id);
        $record->update($validated);

        // Redirect with a success message
        return redirect()->route('derogatory_records.index')->with('success', 'Record updated successfully');
    }

    // Handle deleting a derogatory record
    public function destroy($id)
    {
        $record = DerogatoryRecord::findOrFail($id);
        $record->delete();

        return redirect()->route('derogatory_records.index')->with('success', 'Record deleted successfully');
    }
}