<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

/**
 * Class Services
 * @author rivald 
 */
class LaporanLabaRugiService
{

    public function getData($nomorAkun, $saldoNormal, $tanggal = [])
    {
        $selectRaw;

        if (strlen($nomorAkun) > 1) {
            $selectRaw = DB::raw('SUBSTRING(detail_transaksi.nomor_account, 1, 3) AS awalan');
        } else {
            $selectRaw = DB::raw('SUBSTRING(detail_transaksi.nomor_account, 1, 1) AS awalan');
        }

        $getData = DB::table('smis_ac_transaksi_detail as detail_transaksi')
            ->join('smis_ac_transaksi as header_transaksi', 'detail_transaksi.id_transaksi', 'header_transaksi.id')
            ->select(
                $selectRaw,
                DB::raw('sum(detail_transaksi.debet) as debet_total'),
                DB::raw('sum(detail_transaksi.kredit) as kredit_total')
            )
            ->where([
                [DB::raw('date(detail_transaksi.tanggal)'), '>=', date('Y-m-d', strtotime($tanggal['tanggal_dari']))],
                [DB::raw('date(detail_transaksi.tanggal)'), '<=', date('Y-m-d', strtotime($tanggal['tanggal_sampai']))],
                ['detail_transaksi.nomor_account', 'LIKE', $nomorAkun . '%'],
                ['detail_transaksi.keterangan', '<>', 'Jurnal Penutup'],
                ['detail_transaksi.prop', ''],
                ['header_transaksi.prop', '']
            ])->groupBy('awalan')->first();

        if ($saldoNormal == 'kredit')
            return ($getData->kredit_total ?? 0) - ($getData->debet_total ?? 0);

        return ($getData->debet_total ?? 0) - ($getData->kredit_total ?? 0);
    }
}
