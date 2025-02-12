<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PeriksaDokterImport implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {
            DB::table('smis_mjm_periksa')->insert([
                'carabayar' => $row['carabayar'],
                'nama_periksa' => $row['nama_periksa'],
                'kelas' => $row['kelas'] ?? 0,
                'margin' => $row['margin'] ?? 0,
                'tarif' => $row['margin'] ?? 0
            ]);
        }
    }
}
