<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

/**
 * Class Services
 * @author rivald_ideplex_team
 */
class LapRiwayatAccJurnalService
{
    /**
     * undocumented function
     *
     * @return void
     */
    public function getData($request)
    {

        $tanggal['dari'] = $request['tanggal_dari'] ? date('Y-m-d', strtotime($request['tanggal_dari'])) : '';
        $tanggal['sampai'] = $request['tanggal_sampai'] ? date('Y-m-d', strtotime($request['tanggal_sampai'])) : '';

        $statusInput = $request['status'];

        $getQuery = DB::table('smis_ac_draft_jurnal')
            ->select(
                'j_jurnal as jenis_jurnal',
                'operator',
                'tanggal_input',
                DB::raw("DATE_FORMAT(tanggal_input, '%d-%m-%Y %H:%i') as tanggal_input"),
                DB::raw("DATE_FORMAT(tanggal, '%d-%m-%Y %H:%i') as tanggal_jurnal"),
                'keterangan as keterangan',
                'nomor as nomor_jurnal',
                DB::raw("
                     CASE
                         WHEN lock_draft = 0 AND lock_acc = 0 THEN 'Belum Dikunci'
                         WHEN lock_draft = 1 AND lock_acc = 0 THEN 'Belum Di ACC'
                         WHEN lock_draft = 1 AND lock_acc = 1 THEN 'Sudah Di ACC'
                     END AS status
                ")
            )
            ->when($tanggal['dari'] != '' && $tanggal['sampai'] != '', function ($query) use ($tanggal) {
                return $query->where([
                    [DB::raw('date(tanggal)'), '>=', $tanggal['dari']],
                    [DB::raw('date(tanggal)'), '<=', $tanggal['sampai']],
                ]);
            })
            ->when($statusInput != 'semua', function ($query) use ($statusInput) {
                return $query->where(function ($query) use ($statusInput) {
                    if ($statusInput == "belum_dikunci") {
                        $query->where('lock_draft', '=', 0)
                            ->where('lock_acc', '=', 0);
                    } elseif ($statusInput == "belum_di_acc") {
                        $query->where('lock_draft', '=', 1)
                            ->where('lock_acc', '=', 0);
                    } elseif ($statusInput == "sudah_di_acc") {
                        $query->where('lock_draft', '=', 1)
                            ->where('lock_acc', '=', 1);
                    }
                });
            })
            ->get();

        return $getQuery;
    }
}
