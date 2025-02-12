<?php

namespace App\Imports;

use App\Models\LoaderBpjsDiverifikasiDetail;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class LoaderBpjsDiverifikasiImport implements ToCollection, WithHeadingRow
{
    private $id;
    /**
     * @param $id
     */
    public function __construct($id)
    {
        $this->id = $id;
    }
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {
            //dd($row);
            if (
                $row['kelas_rawat'] != null
                && $row['ptd'] != null
                && $row['admission_date']  != null
                && $row['discharge_date'] != null
                && $row['birth_date'] != null
                && $row['nama_pasien'] != null
                && $row['mrn'] != null
                && $row['umur_tahun'] != null
                && $row['dpjp'] != null
                && $row['sep'] != null
            ) {
                $format_date_admission = strtotime($row['admission_date']);
                $format_date_discharge = strtotime($row['discharge_date']);
                $format_date_birth = strtotime($row['birth_date']);
                if ($format_date_admission && $format_date_discharge && $format_date_birth) {
                    LoaderBpjsDiverifikasiDetail::create([
                        'id_header' => $this->id,
                        'kelas_rawat' => $row['kelas_rawat'],
                        'ptd' => $row['ptd'],
                        'admission_date' => $row['admission_date'],
                        'discharge_date' => $row['discharge_date'],
                        'birth_date' => $row['birth_date'],
                        'nama_pasien' => $row['nama_pasien'],
                        'mrn' => $row['mrn'],
                        'umur_tahun' => $row['umur_tahun'],
                        'dpjp' => $row['dpjp'],
                        'sep' => $row['sep'],
                    ]);
                } else {
                    throw new Exception("Terdapat format tanggal yang tidak sesuai pada No SEP " . $row['nosep'] . " pastikan format YYYY-MM-DD");
                }
            }
        }
    }
}
