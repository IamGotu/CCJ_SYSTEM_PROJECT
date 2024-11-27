<?php

namespace App\Http\Controllers;

use App\Models\Agency;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\AgenciesImport;

class AgencyController extends Controller
{
    // Display a form for creating a new agency
    public function create()
    {
        return view('agencies.create');
    }

    // Store a new agency in the database
    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'contact_person' => 'required|string|max:255',
            'contact_number' => 'required|string|max:50',
        ]);

        // Create the agency
        Agency::create([
            'name' => $request->name,
            'address' => $request->address,
            'contact_person' => $request->contact_person,
            'contact_number' => $request->contact_number,
        ]);

        // Redirect to the list of agencies with a success message
        return redirect()->route('agencies.index')->with('success', 'Agency created successfully.');
    }

    // Display a list of all agencies
    public function index(Request $request)
    {
        $query = Agency::query();

        // If there's a search term, filter the results
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $agencies = $query->get();

        return view('agencies.index', compact('agencies'));
    }

    public function import(Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'file' => 'required|mimes:xlsx,csv,ods|max:2048', // 2MB max file size
        ]);

        // Import the file using the AgenciesImport class
        if ($request->hasFile('file')) {
            Excel::import(new AgenciesImport, $request->file('file'));
        }

        return redirect()->route('agencies.index')->with('success', 'Agencies imported successfully');
    }

}
