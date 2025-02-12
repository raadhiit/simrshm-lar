<?php

namespace App\Services;

use App\Models\SMIS_LayananPasien;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;

/**
 * Class LaporanDetailHppService.
 */
class LaporanDetailHppService
{

    private function getKolektif($layananPasienData, $listNoreg)
    {
        $ksrKolektifData = DB::table('smis_ksr_kolektif')
            ->whereIn('noreg_pasien', $listNoreg)
            ->where([
                ['prop', ''],
                ['ruangan', '<>', 'depo_farmasi']
            ])
            ->select('noreg_pasien', 'nama_tagihan', 'total', 'hpp')
            ->get();

        $results = $ksrKolektifData->map(function ($item) use ($layananPasienData) {

            $noreg = $item->noreg_pasien;

            $item->nama_pasien = $layananPasienData[$noreg]->nama_pasien;
            $item->nrm = $layananPasienData[$noreg]->nrm;

            return $item;
        });

        return $results;
    }

    private function getPenjualanObatJadi($layananPasienData, $listNoreg)
    {
        $penjualanObatJadiData = DB::table('smis_dfm_penjualan_resep as resep')
            ->join('smis_dfm_penjualan_obat_jadi as obat_jadi', 'resep.id', 'obat_jadi.id_penjualan_resep')
            ->where([
                ['resep.dibatalkan', 0],
                ['resep.prop', ''],
                ['obat_jadi.prop', '']
            ])
            ->whereIn('noreg_pasien', $listNoreg)
            ->select(
                'resep.noreg_pasien',
                'obat_jadi.nama_obat as nama_tagihan',
                'obat_jadi.subtotal as total',
                DB::raw('( obat_jadi.hpp * obat_jadi.jumlah ) as hpp')
            )->get();


        $results = $penjualanObatJadiData->map(function ($item) use ($layananPasienData) {

            $noreg = $item->noreg_pasien;

            $item->nama_pasien = $layananPasienData[$noreg]->nama_pasien;
            $item->nrm = $layananPasienData[$noreg]->nrm;

            return $item;
        });

        return $results;
    }

    private function getBahanPakaiObatRacikan($layananPasienData, $listNoreg)
    {
        $penjualanObatRacikan = DB::table('smis_dfm_penjualan_resep as resep')
            ->join('smis_dfm_penjualan_obat_racikan as obat_racikan', 'resep.id', 'obat_racikan.id_penjualan_resep')
            ->where([
                ['resep.prop', ''],
                ['resep.dibatalkan', 0],
                ['obat_racikan.prop', '']
            ])
            ->whereIn('noreg_pasien', $listNoreg)
            ->select(
                'resep.noreg_pasien',
                'obat_racikan.id as id_obat_racikan',
            )->get()
            ->keyBy('id_obat_racikan');

        $listIdPenjualanObatRacikan = $penjualanObatRacikan->pluck('id_obat_racikan');

        $bahanPakaiObatRacikanData = DB::table('smis_dfm_bahan_pakai_obat_racikan')
            ->where('prop', '')
            ->whereIn('id_penjualan_obat_racikan', $listIdPenjualanObatRacikan)
            ->select(
                'id_penjualan_obat_racikan',
                'nama_obat as nama_tagihan',
                'harga as total',
                DB::raw('hpp * jumlah as hpp')
            )
            ->get();

        $results = $bahanPakaiObatRacikanData->map(function ($item) use ($layananPasienData, $penjualanObatRacikan) {

            $idObatRacik = $item->id_penjualan_obat_racikan;
            $noreg = $penjualanObatRacikan[$idObatRacik]->noreg_pasien;

            $item->noreg_pasien = $noreg;
            $item->nama_pasien = $layananPasienData[$noreg]->nama_pasien;
            $item->nrm = $layananPasienData[$noreg]->nrm;

            return $item;
        });

        return $results;
    }

    private function getDreturPenjualanResep($layananPasienData, $listNoreg)
    {
        $dreturPenjualanResepData = DB::table('smis_dfm_retur_penjualan_resep as resep')
            ->join('smis_dfm_dretur_penjualan_resep as dresep', 'resep.id', 'dresep.id_penjualan_resep')
            ->join('smis_dfm_stok_obat as stok', 'stok.id', 'dresep.id_stok_obat')
            ->where([
                ['resep.dibatalkan', 0],
                ['resep.prop', ''],
                ['dresep.prop', '']
            ])
            ->whereIn('noreg_pasien', $listNoreg)
            ->select(
                'noreg_pasien',
                'stok.nama_obat as nama_tagihan',
                'dresep.subtotal as total',
                DB::raw('( dresep.hpp * dresep.jumlah ) as hpp')
            )->get();

        $results = $dreturPenjualanResepData->map(function ($item) use ($layananPasienData) {

            $noreg = $item->noreg_pasien;

            $item->nama_pasien = $layananPasienData[$noreg]->nama_pasien;
            $item->nrm = $layananPasienData[$noreg]->nrm;

            return $item;
        });

        return $results;
    }

    /**
     * undocumented function
     *
     * @return void
     */
    public function getData($request, $paginate = true)
    {
        $tanggal_dari = date('Y-m-d', strtotime($request['tanggal_dari'] ?? date('Y-m-d')));
        $tanggal_sampai = date('Y-m-d', strtotime($request['tanggal_sampai'] ?? date('Y-m-d')));

        $layananPasienData = SMIS_LayananPasien::where([
            ['prop', ''],
            ['tanggal', '>=', $tanggal_dari],
            ['tanggal', '<=', $tanggal_sampai]
        ])
            ->when($request['nama'] ?? null, function ($query) use ($request) {
                return $query->where('nama_pasien', 'like', '%' . $request['nama'] . '%');
            })
            ->when($request['nrm'] ?? null, function ($query) use ($request) {
                return $query->where('nrm', $request['nrm']);
            })
            ->when($request['noreg'] ?? null, function ($query) use ($request) {
                return $query->where('id', $request['noreg']);
            })
            ->select('id', 'nama_pasien', 'nrm')
            ->get()
            ->keyBy('id');

        $listNoreg = $layananPasienData->pluck('id');

        // ----- Ksr Kolektif -----
        $resultsKolektif = $this->getKolektif($layananPasienData, $listNoreg);

        // ---- Penjualan Obat Jadi ----
        $resultsPenjualanObatJadi = $this->getPenjualanObatJadi($layananPasienData, $listNoreg);

        // ----- Bahan Pakai Obat Racikan -----
        $resultsBahanPakaiObatRacikan = $this->getBahanPakaiObatRacikan($layananPasienData, $listNoreg);

        // ---- dretur penjualan resep ----
        $resultsDreturPenjualanResep = $this->getDreturPenjualanResep($layananPasienData, $listNoreg);

        $results = $resultsKolektif->merge($resultsPenjualanObatJadi)->merge($resultsBahanPakaiObatRacikan)->merge($resultsDreturPenjualanResep);

        if ($paginate) {

            $perPage = 10;
            $currentPage = Paginator::resolveCurrentPage() ?? 1;
            $currentItems = $results->slice(($currentPage - 1) * $perPage, $perPage)->values();

            $paginatedResults = new LengthAwarePaginator(
                $currentItems,
                $results->count(),
                $perPage,
                $currentPage,
                ['path' => request()->url(), 'query' => request()->query()]
            );

            return $paginatedResults;
        } else {
            return $results;
        }
    }
}
