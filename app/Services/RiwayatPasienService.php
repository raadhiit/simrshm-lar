<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

/**
 * Class Services
 * @author rivald 
 */
class RiwayatPasienService
{
    public function getData($param)
    {
        //dd($param->all());
        $tableName = 'smis_rwt_antrian_' . $param->ruangan;
        $getData = DB::table($tableName)->where([
            ['prop', ''],
            ['waktu', '>=', $param->dari],
            ['waktu', '<=', $param->sampai]
        ]);
        if (isset($param->nrm))
            $getData->where('nrm_pasien', $param->nrm);
        if (isset($param->noreg))
            $getData->where('no_register', $param->noreg);
        if (isset($param->keluar))
            $getData->where('cara_keluar', $param->keluar);

        return $getData;
    }

    public function getRuangan()
    {
        return DB::table('smis_adm_prototype')->get();
    }
}
