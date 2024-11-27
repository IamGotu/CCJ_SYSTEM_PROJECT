<?php

namespace App\Imports;

use App\Models\Coordinator;
use Maatwebsite\Excel\Concerns\ToModel;

class CoordinatorsImport implements ToModel
{
    /**
     * Transform the data from each row of the Excel file into a Coordinator model.
     *
     * @param array $row
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Coordinator([
            'name' => $row[0],      // Assuming the first column is the name
            'contact' => $row[1],   // Assuming the second column is the contact
            'email' => $row[2],     // Assuming the third column is the email
            'address' => $row[3],   // Assuming the fourth column is the address
            'username' => $row[4],  // Assuming the fifth column is the username
            // Add any other fields here based on your coordinator model
        ]);
    }
}
