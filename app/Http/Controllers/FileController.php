<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function showEvidenceFile($filename)
    {
        // Correct the path construction by removing 'private' from the $path string
        $path = 'evidence_files/' . $filename;  // Ensure the path doesn't repeat 'private'
        
        // Use Storage::exists() to check if the file exists
        if (Storage::exists($path)) {
            // Get the full system path using Storage::path()
            $fullPath = Storage::path($path);
    
            // Log the resolved file path for debugging
            \Log::info('Resolved file path: ' . $fullPath);
    
            // Return the file using response()->file()
            return response()->file($fullPath);
        }
    
        // Log an error if the file is not found
        \Log::error('File not found at: ' . Storage::path($path));
    
        // Throw a 404 error
        abort(404, 'File not found.');
    }
}