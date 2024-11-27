<?php

// app/Models/DerogatoryRecord.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DerogatoryRecord extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'derogatory_records';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'student_id_number',
        'last_name',
        'first_name',
        'middle_name',
        'year_graduated',
        'violation',
        'action_taken',
        'settled',
        'sanction',
        'year_level',
        'school_year',
        'enrollment_status',
        'graduation_date',
    ];
    
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'year_graduated' => 'integer',
        'settled' => 'boolean',
    ];
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id_number', 'student_id_number');
    }
    

}

