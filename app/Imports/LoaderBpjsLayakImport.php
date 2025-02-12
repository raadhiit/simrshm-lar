<?php

namespace App\Imports;

use App\Models\KlaimBpjsLayakDetail;
use Exception;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class LoaderBpjsLayakImport implements ToCollection, WithHeadingRow
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
            if ($row['nosep'] != null && $row['tgl_verifikasi'] != null &&  $row['biaya_riil_rs']  != null && $row['biaya_diajukan'] && $row['biaya_disetujui'] != null) {
                $format_date = strtotime($row['tgl_verifikasi']);
                if ($format_date) {
                    KlaimBpjsLayakDetail::create([
                        'id_header' => $this->id,
                        'no_sep' => $row['nosep'],
                        'tgl_verifikasi' => date('Y-m-d', strtotime($row['tgl_verifikasi'])),
                        'biaya_rs' => $row['biaya_riil_rs'],
                        'biaya_diajukan' => $row['biaya_diajukan'],
                        'biaya_disetujui' => $row['biaya_disetujui']
                    ]);
                } else {
                    throw new Exception("Format tanggal verifikasi tidak sesuai pada No SEP " . $row['nosep'] . " pastikan format YYYY-MM-DD");
                }
            }
        }
    }
}
