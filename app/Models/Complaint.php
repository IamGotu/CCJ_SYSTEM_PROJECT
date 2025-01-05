<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id_number', 
        'student_name', 
        'year_level', 
        'complainant_name', 
        'complainant_position',
        'complainant_contact',
        'incident_date',
        'incident_time',
        'incident_location',
        'complaint_details',
        'violation_type',
        'minor_offense',
        'major_offense',
        'previous_incidents',
        'action_taken',
        'requested_action',
        'evidence_files',
        'view_count',
    ];
    protected $casts = [
        'evidence_files' => 'array', // This will allow you to store it as an array in JSON format
    ];

    // Define the relationship with the Student model
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id_number', 'student_id_number');
    }
}