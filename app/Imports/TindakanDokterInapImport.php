<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TindakanDokterInapImport implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {
            DB::table('smis_mjm_tindakan_dokter')->insert([
                'jenis_pasien' => $row['jenis_pasien'],
                'nama' => $row['nama_tindakan_dokter'],
                'kelas' => $row['kelas'],
                'uri' => 1,
                'margin' => $row['margin'],
                'bhp' => $row['bhp'] ?? 0,
                'sewa_alat' => $row['sewa_alat'] ?? 0,
                'jaspel' => $row['jaspel'] ?? 0,
                'lain_lain' => $row['lain_lain'] ?? 0,
                'operator' => $row['operatordokter'] ?? 0,
                'asisten' => $row['asisten'] ?? 0,
                'rs' => $row['rs'] ?? 0,
                'tarif' => $row['margin'] + ($row['bhp'] ?? 0) + ($row['sewa_alat'] ?? 0) + ($row['jaspel'] ?? 0) + ($row['lain_lain'] ?? 0) + ($row['operatordokter'] ?? 0) + ($row['asisten'] ?? 0) + ($row['rs'] ?? 0)
            ]);
        }
    }
}
