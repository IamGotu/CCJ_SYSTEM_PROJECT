<?php

namespace App\Http\Controllers;

use App\Models\DerogatoryRecordHistory;
use Illuminate\Http\Request;

class DerogatoryRecordHistoryController extends Controller
{
    // Display edit form
    public function edit($id)
    {
        $history = DerogatoryRecordHistory::find($id);
        return view('derogatory_records.edit', compact('history'));
    }

    // Update history record
    public function update(Request $request, $id)
    {
        $history = DerogatoryRecordHistory::find($id);
    
        // Validate request data
        $validatedData = $request->validate([
            'violation' => 'required',
            'action_taken' => 'required',
            'settled' => 'required|boolean',
            'approved_by' => 'nullable|string',  // Allow optional approved_by field
        ]);
    
        // If settled is 'No', reset approved_by
        if ($request->settled == 0) {
            $validatedData['approved_by'] = null;
        }
    
        // Update history record
        $history->update($validatedData);
    
        // Redirect
        return redirect()->route('derogatory_records.show', $history->student_id_number)
                         ->with('success', 'Derogatory record history updated successfully.');
    }
    
}
