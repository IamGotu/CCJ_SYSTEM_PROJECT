<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentOffenseCount extends Model
{
    use HasFactory;

    // Define the table name if it's not the default plural form
    protected $table = 'student_offense_counts';

    // Specify fillable fields
    protected $fillable = ['student_id_number', 'minor_offense_count', 'major_offense_count'];

   public function student() { 
    return $this->belongsTo(Student::class, 'student_id_number', 'student_id_number'); 
}
}
