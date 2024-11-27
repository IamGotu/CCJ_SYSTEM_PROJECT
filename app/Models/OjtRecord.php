<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OjtRecord extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'student_number',
        'roster_number',
        'agency_assigned',
        'school_year',
        'year_level',
        'coordinator_id',
        'credit_hours',
        'created_at',
        'updated_at',
    ];

    public function coordinator()
    {
        return $this->belongsTo(Coordinator::class, 'coordinator_id');
    }
}