<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DerogatoryRecordController extends Controller
{
    public function store(Request $request)
    {
        DerogatoryRecord::create($request->all());
        return redirect()->route('derogatory_records.index')->with('success', 'Record added successfully');
    }
    
    public function update(Request $request, $id)
    {
        $record = DerogatoryRecord::findOrFail($id);
        $record->update($request->all());
        return redirect()->route('derogatory_records.index')->with('success', 'Record updated successfully');
    }
    
    public function destroy($id)
    {
        DerogatoryRecord::destroy($id);
        return redirect()->route('derogatory_records.index')->with('success', 'Record deleted successfully');
    }
    
}
