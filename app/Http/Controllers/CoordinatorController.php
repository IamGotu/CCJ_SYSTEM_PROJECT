<?php

namespace App\Http\Controllers;

use App\Models\Coordinator;
use Illuminate\Http\Request;

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


    public function create()
    {
        return view('coordinators.create');
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'contact' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:coordinators',
            'address' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:coordinators',
        ]);

        // Create the coordinator
        Coordinator::create($validatedData);

        // Redirect to the coordinators index page with a success message
        return redirect()->route('coordinators.index')->with('success', 'Coordinator added successfully!');
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
}
