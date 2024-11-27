<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agency extends Model
{
    use HasFactory;

    // Define the fillable attributes for mass assignment
    protected $fillable = [
        'name',
        'address',
        'contact_person',
        'contact_number',
    ];

    public function ojtRecords()
    {
        return $this->hasMany(OjtRecord::class);
    }
}

