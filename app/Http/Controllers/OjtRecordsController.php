<?php

namespace App\Http\Controllers;

use App\Models\OjtRecord;
use App\Models\Coordinator;

use Illuminate\Http\Request;

class OjtRecordsController extends Controller
    {
        public function index(Request $request)
        {
            // Start the query builder for OjtRecord
            $ojtRecords = OjtRecord::query();

            // Apply search filter if requested
            if ($search = $request->get('search')) {
                $ojtRecords->where('name', 'like', "%{$search}%")
                    ->orWhere('student_number', 'like', "%{$search}%");
            }

            // Apply year level filter if requested
            if ($yearLevel = $request->get('year_level')) {
                $ojtRecords->where('year_level', $yearLevel);
            }

            // Paginate the results
            $ojtRecords = $ojtRecords->paginate(10);

            // Return the view with the filtered records
            return view('ojt_records.index', compact('ojtRecords'));
        }

        // App\Http\Controllers\OjtRecordController.php
        public function create()
        {
            $coordinators = Coordinator::all();
            return view('ojt_records.create', compact('coordinators'));
        }

        public function edit(OjtRecord $ojtRecord)
        {
            $coordinators = Coordinator::all();
            return view('ojt_records.edit', compact('ojtRecord', 'coordinators'));
        }

        public function store(Request $request)
        {
            $request->validate([
                'student_number' => 'required',
                'name' => 'required',
                'agency_assigned' => 'required',
                'credit_hours' => 'required|numeric',
                'coordinator_id' => 'nullable|exists:coordinators,id',
            ]);

            OjtRecord::create($request->all());
            return redirect()->route('ojt_records.index')->with('success', 'OJT Record created successfully.');
        }

        public function update(Request $request, OjtRecord $ojtRecord)
        {
            $request->validate([
                'student_number' => 'required',
                'name' => 'required',
                'agency_assigned' => 'required',
                'credit_hours' => 'required|numeric',
                'coordinator_id' => 'nullable|exists:coordinators,id',
            ]);

            $ojtRecord->update($request->all());
            return redirect()->route('ojt_records.index')->with('success', 'OJT Record updated successfully.');
        }


        public function destroy(OjtRecord $ojtRecord)
        {
            $ojtRecord->delete();

            return redirect()->route('ojt_records.index')->with('success', 'OJT Record deleted successfully.');
        }
    }
