<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class VisiteDokterImport implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {
            DB::table('smis_mjm_visite')->insert([
                'carabayar' => $row['carabayar'],
                'nama_visite' => $row['nama_visite'],
                'kelas' => $row['kelas'],
                'margin' => $row['margin'],
                'jasa_lain_lain' => $row['jasa_lain_lain'] ?? 0,
                'jasa_bhp' => $row['jasa_bhp'] ?? 0,
                'jasa_sewa_alat' => $row['jasa_sewa_alat'] ?? 0,
                'jasa_pelayanan' => $row['jasa_pelayanan'] ?? 0,
                'jasa_asisten' => $row['jasa_asisten'] ?? 0,
                'jasa_dokter' => $row['jasa_dokter'] ?? 0,
                'jasa_rs' => $row['jasa_rs'] ?? 0,
                'tarif' => $row['margin'] + ($row['jasa_lain_lain'] ?? 0) + ($row['jasa_bhp'] ?? 0) + ($row['jasa_sewa_alat'] ?? 0) + ($row['jasa_pelayanan'] ?? 0) + ($row['jasa_asisten'] ?? 0) + ($row['jasa_dokter'] ?? 0) + ($row['jasa_rs'] ?? 0)
            ]);
        }
    }
}
