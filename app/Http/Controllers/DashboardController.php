<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\DerogatoryRecord;
use App\Models\Intern;
use App\Models\OjtRecord;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'totalStudents' => Student::count(),
            'totalDerogatory' => DerogatoryRecord::count(),
            'totalInterns' => Intern::where('status', 'Active')->count(),
            'totalOJT' => OjtRecord::count(),
        ]);
    }
} 