<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Intern;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $students = Student::latest()->get();
        $interns = Intern::latest()->get();
        $schools = Intern::distinct()->pluck('school')->toArray();

        return view('dashboard', compact('students', 'interns', 'schools'));
    }
} 