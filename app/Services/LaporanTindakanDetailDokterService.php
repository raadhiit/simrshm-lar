<?php


namespace App\Services;

use Illuminate\Support\Facades\DB;

/**
 * Class Services
 * @author rivald 
 */
class LaporanTindakanDetailDokterService
{

    public function getDataByFilter($param, $role)
    {
        $getData = DB::table('smis_rg_layananpasien as pasien')
            ->join('smis_ksr_kolektif as kolektif', 'pasien.id', '=', 'kolektif.noreg_pasien')
            ->select(
                'pasien.tanggal',
                'pasien.nama_pasien',
                'pasien.nama_rujukan',
                'pasien.nama_dokter',
                'kolektif.nama_tagihan',
                'kolektif.nilai'
            )
            ->where([
                ['pasien.prop', ' '],
                ['pasien.selesai', 1],
                [DB::raw('DATE(pasien.tanggal)'), '>=', $param->tanggal_dari_conv],
                [DB::raw('DATE(pasien.tanggal)'), '<=', $param->tanggal_sampai_conv]
            ])->orderBy('pasien.tanggal', 'ASC');

        if ($role == "operator") {
            $getData->where('pasien.nama_dokter', $param->nama_dokter);
        } else {
            $getData->where('pasien.nama_rujukan', $param->nama_dokter);
        }

        return $getData;
    }

    public function getDokterName()
    {
        $nameDokter = DB::table('smis_rg_layananpasien')->select(DB::raw('DISTINCT(nama_dokter)'));
        return $nameDokter;
    }
}
