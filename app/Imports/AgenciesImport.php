<?php

namespace App\Imports;

use App\Models\Agency;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AgenciesImport implements ToModel
{
    /**
     * Transform the data from each row of the Excel file into an Agency model.
     *
     * @param array $row
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        try {
            return new Agency([
                'name' => $row[0] ?? null,
                'address' => $row[1] ?? null,
                'contact_person' => $row[2] ?? null,
                'contact_number' => $row[3] ?? null,
            ]);
        } catch (\Exception $e) {
            \Log::error('Error importing row:', ['row' => $row, 'error' => $e->getMessage()]);
            return null; // Skip this row
        }
    }

}
