<?php

namespace App\Http\Controllers;

use App\Models\Violation;
use Illuminate\Http\Request;

class ViolationController extends Controller
{
    public function store(Request $request)
    {
        // Log incoming request data for debugging purposes
        \Log::debug('Store request data:', $request->all());
        
        // Validate the input data
        $validatedData = $request->validate([
            'violation_name' => 'required|string|max:255',
            'violation_type' => 'required|in:major,minor',
            'grounds' => 'nullable|string',  // grounds is optional
        ]);
        
        // Create a new violation
        Violation::create([
            'violation_name' => $validatedData['violation_name'],
            'violation_type' => $validatedData['violation_type'],
            'grounds' => $validatedData['grounds'] ?? null,  // grounds is optional
        ]);
        
        // Redirect or return a response
        return back()->with('success', 'Violation created successfully!');
    }
    
}    

