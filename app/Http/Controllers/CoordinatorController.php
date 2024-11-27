<?php

namespace App\Http\Controllers;

use App\Models\Coordinator;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\CoordinatorsImport;

class CoordinatorController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search'); // Get the search query

        // Query to search coordinators by name, contact, or email if a search term is provided
        $coordinators = Coordinator::when($search, function ($query, $search) {
            return $query->where('name', 'like', "%{$search}%")
                        ->orWhere('contact', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
        })->get();

        // Pass the coordinators and search term to the view
        return view('coordinators.index', compact('coordinators', 'search'));
    }

    public function edit(Coordinator $coordinator)
    {
        return view('coordinators.edit', compact('coordinator'));
    }

    public function update(Request $request, Coordinator $coordinator)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'contact' => 'required|string|max:20',
            'email' => 'required|email|unique:coordinators,email,' . $coordinator->id,
            'address' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:coordinators,username,' . $coordinator->id,
        ]);

        // Update the coordinator without password
        $coordinator->update($validated);

        return redirect()->route('coordinators.index')->with('success', 'Coordinator updated successfully.');
    }

    public function destroy(Coordinator $coordinator)
    {
        $coordinator->delete();

        return redirect()->route('coordinators.index')->with('success', 'Coordinator deleted successfully.');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:2048',
        ]);

        try {
            Excel::import(new CoordinatorsImport, $request->file('file'));

            // Show success message
            return redirect()->route('coordinators.index')->with('success', 'Coordinators imported successfully.');
        } catch (\Exception $e) {
            // Show error message if the import fails
            return redirect()->route('coordinators.index')->with('error', 'Error importing file: ' . $e->getMessage());
        }
    }

}
