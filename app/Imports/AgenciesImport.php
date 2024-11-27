<?php

namespace App\Imports;

use App\Models\Agency;
use Maatwebsite\Excel\Concerns\ToModel;

class AgenciesImport implements ToModel
{
    public function model(array $row)
    {
        // Assuming the Excel columns match the database columns
        return new Agency([
            'name'           => $row[0], // Column 1
            'address'        => $row[1], // Column 2
            'contact_person' => $row[2], // Column 3
            'contact_number' => $row[3], // Column 4
        ]);
    }
}


