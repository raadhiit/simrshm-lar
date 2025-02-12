<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

/**
 * Class PenerimaanKasirService 
 * @author rivaldo 
 */

class PenerimaanKasirService
{
    public function getItemByFilter($param)
    {
        $item = DB::table('smis_ksr_kolektif')
            ->select(DB::raw('distinct(nama_tagihan)'))
            ->where([
                ['noreg_pasien', $param],
            ])
            ->get();
        return $item;
    }

    public function getPaymentByFilter($param)
    {
        $item = DB::table('smis_ksr_bayar')
            ->select('metode', 'nama_bank', 'nama_asuransi', 'keterangan', 'nilai')
            ->where([
                ['noreg_pasien', $param],
            ])
            ->get();

        $arrMetode = [];
        $postArr = [];
        $cash = 0;
        $asuransi = 0;
        $qr = 0;
        $transfer = 0;
        $setoranTunai = 0;
        $bankKartuKredit = 0;
        $bankKartuDebit = 0;

        foreach ($item as $value) {
            if (!in_array($value->metode, $arrMetode)) {
                $arrMetode[] = $value->metode;
                $postArr[] = [$value->metode, $value->nama_bank, $value->nama_asuransi, $value->keterangan];
            }
            if ($value->metode == "cash") {
                $cash += $value->nilai;
            }
            if ($value->metode == "asuransi") {
                $asuransi += $value->nilai;
            }
            if ($value->keterangan == "QR") {
                $qr += $value->nilai;
            }
            if ($value->keterangan == "Transfer") {
                $transfer += $value->nilai;
            }
            if ($value->keterangan == "Setoran Tunai") {
                $setoranTunai += $value->nilai;
            }
            if ($value->keterangan == "Bank Kartu Debit") {
                $bankKartuDebit += $value->nilai;
            }
            if ($value->keterangan == "Bank Kartu Kredit") {
                $bankKartuKredit += $value->nilai;
            }
        }

        return [
            "payment" => $postArr,
            "cash" => $cash,
            "asuransi" => $asuransi,
            "qr" => $qr,
            "transfer" => $transfer,
            "setoran_tunai" => $setoranTunai,
            "bank_kartu_kredit" => $bankKartuKredit,
            "bank_kartu_debit" => $bankKartuKredit
        ];
    }

    public function getByFilter($param)
    {
        $filter = DB::table('smis_rg_layananpasien as pasien')
            ->join('smis_rg_asuransi as asuransi', 'pasien.asuransi', '=', 'asuransi.id')
            ->join(DB::raw('(select noreg_pasien,no_kwitansi, metode, nama_bank, nama_asuransi, keterangan, sum(nilai) as total_bayar
              from smis_ksr_bayar
              where prop = " " group by noreg_pasien) AS bayar'), 'bayar.noreg_pasien', '=', 'pasien.id')
            ->join(DB::raw('(select noreg_pasien, nama_tagihan, sum(nilai) as total_tagihan
              from smis_ksr_kolektif
              where prop = " " group by noreg_pasien) AS kolektif'), 'kolektif.noreg_pasien', '=', 'pasien.id')
            ->select(
                'pasien.id',
                'pasien.tanggal',
                'pasien.nama_pasien',
                'pasien.jenislayanan',
                'bayar.no_kwitansi',
                'bayar.metode',
                'bayar.nama_bank',
                'bayar.nama_asuransi',
                'bayar.total_bayar',
                'bayar.keterangan',
                //'bayar.nama_perusahaan',
                'kolektif.total_tagihan',
                'asuransi.nama as nama_asuransi'
                //'kolektif.nama_tagihan',
                //DB::raw('SUM(kolektif.nilai) as total_tagihan')
            )
            ->where([
                ['pasien.prop', ' '],
                ['pasien.selesai', 1],
                [DB::raw('DATE(pasien.tanggal)'), '>=', $param->tanggal_dari_conv],
                [DB::raw('DATE(pasien.tanggal)'), '<=', $param->tanggal_sampai_conv]
            ]);
        return $filter;
    }
}
