<?php

namespace App\Services;

use App\Models\Smis_Rad_Layanan;
use App\Models\Smis_Rad_Pesanan;

class RadiologiService{

    function get_nama_pesanan($noreg){
        $master = Smis_Rad_Layanan::where('prop', '')->get();

        $select = Smis_Rad_Pesanan::where('noreg_pasien', $noreg)->first();

        if (is_null($select)) {
            return '';
        }

        $temp = [];
        $periksa = json_decode($select->periksa, true);

        foreach ($master as $m) {
            if (isset($periksa['rad_'.$m->id])) {
                if ($periksa['rad_'.$m->id] == 1) {
                    array_push($temp, trim($m->nama));
                }
            }
        }

        $result = implode(', ', $temp);
        return $result;
    }

}