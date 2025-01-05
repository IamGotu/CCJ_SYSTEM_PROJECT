<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Violation extends Model
{
    use HasFactory;

    // Define the table name if it's not the default plural form
    protected $table = 'violations';

    // If you need to specify the fillable fields
    protected $fillable = ['violation_type', 'violation_name', 'grounds'];

   public function studentOffenseCounts() 
   { return $this->hasMany(StudentOffenseCount::class); }
}
