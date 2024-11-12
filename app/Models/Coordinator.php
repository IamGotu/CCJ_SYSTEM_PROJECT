<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Coordinator extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name', 'contact', 'email', 'address', 'username',
    ];

    public function ojtRecords()
    {
        return $this->hasMany(OjtRecord::class);
    }
}
