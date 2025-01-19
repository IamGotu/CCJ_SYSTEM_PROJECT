<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DerogatoryRecordHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id_number',
        'violation_id',
        'penalty',
        'action_taken',
        'settled',
        'approved_by',
    ];

    // Define relationship with Student
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id_number', 'student_id_number');
    }

    // Define relationship with Violation
    public function violation()
    {
        return $this->belongsTo(Violation::class, 'violation_id');
    }
    
}