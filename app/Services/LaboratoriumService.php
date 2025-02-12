<?php

namespace App\Services;

use App\Models\Smis_Lab_Layanan;
use App\Models\SMIS_LabPesanan;

class LaboratoriumService {

    function get_nama_pesanan($noreg){
        $master = Smis_Lab_Layanan::where('prop' , '')->get();
        $select = SMIS_LabPesanan::where('noreg_pasien', $noreg)->first();

        if (is_null($select)) {
            return '';
        }

        $periksa = json_decode($select->periksa, true);
        $temp = [];

        foreach ($master as $m) {
            if (isset($periksa[$m->slug])) {
                if ($periksa[$m->slug] == 1) {
                    array_push($temp, trim($m->nama));
                }
            }
        }

        $result = implode(', ', $temp);
        return $result;
    }

}