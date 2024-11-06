<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OjtRecord extends Model
{
    use HasFactory;

    // Add name to fillable properties for mass assignment
    protected $fillable = [
        'name',
        'student_number',
        'agency_assigned',
        'credit_hours',
        'coordinator_id',
        'year_level',
    ];

    public function coordinator()
    {
        return $this->belongsTo(Coordinator::class);
    }
}