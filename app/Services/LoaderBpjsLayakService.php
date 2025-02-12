<?php

namespace App\Services;

use App\Imports\LoaderBpjsLayakImport;
use App\Models\KlaimBpjsLayakDetail;
use App\Models\KlaimBpjsLayakHeader;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Throwable;

/**
 * Class Services
 * @author rivald
 */
class LoaderBpjsLayakService
{
    /**
     * undocumented function
     *
     * @return void
     */
    public function getJurnalNum($id)
    {
        $result =  DB::table('smis_ac_draft_jurnal')->where('id', $id)->select('nomor')->first();
        return $result->nomor ?? '';
    }


    /**
     * undocumented function
     *
     * @return void
     */
    public function statusJurnal($id_draft_jurnal, $id_header = 0)
    {
        if (isset($id_draft_jurnal)) {

            $result = DB::table('smis_ac_draft_jurnal')->where('id', $id_draft_jurnal)->select('is_jurnal_balik', 'lock_draft', 'lock_acc')->first();
            $result_generate = KlaimBpjsLayakDetail::where('id_header', $id_header)
                ->whereNull('id_detail_draft')
                ->exists();

            if ($result->lock_draft === 1 && $result->lock_acc === 0)
                $status = 'Diajukan';
            if ($result->lock_draft === 1 && $result->lock_acc === 1)
                $status = 'Diterima';
            if ($result->lock_draft === 0 && $result->lock_acc === 0)
                $status = 'Ditolak';
            if (($result->lock_draft == 0 || $result->lock_draft == 99) && $result_generate)
                $status = 'Gagal Generate';

            return $status ?? '';
        }
        return null;
    }

    public function getData()
    {
        return KlaimBpjsLayakHeader::orderBy('id', 'DESC');
    }

    public function getDataDetail($id)
    {
        return KlaimBpjsLayakDetail::where('id_header', $id);
    }

    /**
     * undocumented function
     *
     * @return void
     */
    public function store($param)
    {
        try {
            KlaimBpjsLayakHeader::create($param);
            return 'sukses';
        } catch (Throwable $e) {
            return $e->getMessage();
        }
    }

    /**
     * undocumented function
     *
     * @return void
     */
    public function getDataGenerate($param)
    {
        $dataHeader = KlaimBpjsLayakHeader::where('id', $param)->first();
        $dataDetail = KlaimBpjsLayakDetail::where('id_header', $param)->where('id_detail_draft', null)->get();

        $result = array(
            'header' => $dataHeader,
            'detail' => $dataDetail
        );

        return $result;
    }

    /**
     * undocumented function
     *
     * @return void
     */
    public function import($param)
    {
        try {
            try {
                Excel::import(new LoaderBpjsLayakImport($param->id_header), $param->file('file_xlsx'));
            } catch (Throwable $e) {
                return $e->getMessage();
            }
            KlaimBpjsLayakHeader::where('id', $param->id_header)->update([
                'user_upload' =>  Auth::user()->realname,
                'tanggal_upload' => date('Y-m-d h:i:s')
            ]);
            return 'sukses';
        } catch (Throwable $e) {
            return $e->getMessage();
        }
    }

    public function destroyData($id)
    {
        try {
            try {
                KlaimBpjsLayakHeader::where('id', $id)->update(['prop' => 'del']);
            } catch (Throwable $e) {
                return $e->getMessage();
            }
            KlaimBpjsLayakHeader::where('id', $id)->update([
                'user_hapus' =>  Auth::user()->realname,
                'tanggal_hapus' => date('Y-m-d h:i:s')
            ]);
            return 'sukses';
        } catch (Throwable $e) {
            return $e->getMessage();
        }
    }

    /**
     * undocumented function
     *
     * @return void
     */
    public function generateDraftDetailJurnal($param)
    {
        $data_1 = 0;
        $data_2 = 0;
        $done_proces;
        //Note : if nothing column in array insert that is not filled (null/default)
        try {
            if (session('jenis_layanan') == 0) {
                DB::transaction(function () use ($param, $data_1, $data_2) {
                    $data_1 = DB::table('smis_ac_detail_draft_jurnal')->insertGetId([
                        'id_draft_jurnal' => $param->id_draft,
                        'nomor_account' => '1.1.04.01.02.02.01.03',
                        'nama_account' => 'Piutang Usaha - Pasien RAJAL (BPJS) Layak',
                        'keterangan' => 'Klaim Layak BPJS Kesehatan - ' . session('bulan_klaim') . ' - Rawat Jalan - ID Data ' . $param->id . '- ' . $param->no_sep . ' - ID ' . $param->id_draft,
                        'debet' => $param->biaya_disetujui,
                        'kredit' => '0',
                        'id_akun' => 43,
                        'id_tipeakun' => 2,
                        'nama_tipeakun' => 'Piutang usaha',
                        'j_jurnal' => 'Piutang Layak'
                    ]);

                    $data_2 = DB::table('smis_ac_detail_draft_jurnal')->insertGetId([
                        'id_draft_jurnal' => $param->id_draft,
                        'nomor_account' => '1.1.04.01.02.02.01.02',
                        'nama_account' => 'Piutang Usaha - Pasien RAJAL (BPJS) Terverifikasi',
                        'keterangan' => 'Klaim Layak BPJS Kesehatan - ' . session('bulan_klaim') . ' - Rawat Jalan - ID Data ' . $param->id . '- ' . $param->no_sep . ' - ID ' . $param->id_draft,
                        'debet' => '0',
                        'kredit' => $param->biaya_disetujui,
                        'id_akun' => 24,
                        'id_tipeakun' => 2,
                        'nama_tipeakun' => 'Piutang usaha',
                        'j_jurnal' => 'Piutang Layak'
                    ]);

                    KlaimBpjsLayakDetail::where('id', $param->id)->update([
                        'id_detail_draft' => $data_1 . ',' . $data_2
                    ]);
                });
            } else {
                DB::transaction(function () use ($param, $data_1, $data_2) {
                    $data_1 = DB::table('smis_ac_detail_draft_jurnal')->insertGetId([
                        'id_draft_jurnal' => $param->id_draft,
                        'nomor_account' => '1.1.04.01.01.02.01.03',
                        'nama_account' => 'Piutang Usaha - Pasien RANAP (BPJS) Layak',
                        'keterangan' => 'Klaim Layak BPJS Kesehatan - ' . session('bulan_klaim') . ' - Rawat Inap - ID Data ' . $param->id . '- ' . $param->no_sep . ' - ID ' . $param->id_draft,
                        'debet' => $param->biaya_disetujui,
                        'kredit' => '0',
                        'id_akun' => 24,
                        'id_tipeakun' => 2,
                        'nama_tipeakun' => 'Piutang usaha',
                        'j_jurnal' => 'Piutang Layak'
                    ]);

                    $data_2 = DB::table('smis_ac_detail_draft_jurnal')->insertGetId([
                        'id_draft_jurnal' => $param->id_draft,
                        'nomor_account' => '1.1.04.01.01.02.01.02',
                        'nama_account' => 'Piutang Usaha - Pasien RANAP (BPJS) Terverifikasi',
                        'keterangan' => 'Klaim Layak BPJS Kesehatan - ' . session('bulan_klaim') . ' - Rawat Inap - ID Data ' . $param->id . '- ' . $param->no_sep . ' - ID ' . $param->id_draft,
                        'debet' => '0',
                        'kredit' => $param->biaya_disetujui,
                        'id_akun' => 24,
                        'id_tipeakun' => 2,
                        'nama_tipeakun' => 'Piutang usaha',
                        'j_jurnal' => 'Piutang Layak'
                    ]);

                    KlaimBpjsLayakDetail::where('id', $param->id)->update([
                        'id_detail_draft' => $data_1 . ',' . $data_2
                    ]);
                });
            }

            if ($param->length_data == ($param->index_data + 1)) {
                DB::table('smis_ac_draft_jurnal')->where('id', $param->id_draft)->update(['lock_draft' => 1]);
                $done_proces = 'diajukan';
            } else {
                DB::table('smis_ac_draft_jurnal')->where('id', $param->id_draft)->update(['lock_draft' => 0]);
                $done_proces = 'gagal';
            }

            return ['message' => 'sukses', 'status' => $done_proces];
        } catch (\Throwable $e) {
            try {
                DB::table('smis_ac_draft_jurnal')->where('id', $param->id_draft)->update(['lock_draft' => 99]);
            } catch (Throwable $e) {
                return '<h3 style="color:red;">Terdapat error insert data ke draft_detail dan gagal melakukan update lock_draft, Silahkan hubungi admin </h3>';
            }
            return $e->getMessage();
        }
    }

    /**
     * undocumented function
     *
     * @return void
     */
    public function generateDraftJurnal($param)
    {
        session()->forget('bulan_klaim');
        session()->forget('jenis_layanan');
        session()->put('bulan_klaim', convertMonthYear($param->bulan_klaim)); // Put session for keterangan on the detai draft store
        session()->put('jenis_layanan', $param->jenis_layanan); // Put session for keterangan on the detai draft store
        $id_jurnal = 0;
        try {
            try {
                if (is_null($param->id_draft_jurnal)) {
                    $id = DB::table('smis_ac_draft_jurnal')->insertGetId([
                        'prop' => '',
                        'id_jurnal' => '',
                        'j_jurnal' => 'Piutang Layak',
                        'operator' => Auth::user()->realname,
                        'tanggal_input' => date('Y-m-d H:i:s'),
                        'jenis' => '',
                        'tanggal' => $param->tanggal_jurnal,
                        'nomor' => '',
                        'keterangan' => 'Klaim Layak BPJS Kesehatan - ' . convertMonthYear($param->bulan_klaim) . ' - ' . ($param->jenis_layanan == 1 ? 'Rawat Inap' : 'Rawat Jalan') . ' - ID Data ' . $param->id,
                        'nilai' => $this->getDataDetail($param->id)->sum('biaya_disetujui'),
                        'is_jurnal_balik' => 0,
                        'lock_draft' => 1,
                        'lock_acc' => 0,
                    ]);

                    $id_jurnal = $id;
                } else {
                    DB::table('smis_ac_draft_jurnal')->updateOrInsert(
                        ['id' => $param->id_draft_jurnal],
                        [
                            'prop' => '',
                            'id_jurnal' => '',
                            'j_jurnal' => 'Piutang Layak',
                            'operator' => Auth::user()->realname,
                            'tanggal_input' => date('Y-m-d H:i:s'),
                            'jenis' => '',
                            'tanggal' => $param->tanggal_jurnal,
                            'nomor' => '',
                            'keterangan' => 'Klaim Layak BPJS Kesehatan - ' . convertMonthYear($param->bulan_klaim) . ' - ' . ($param->jenis_layanan == 1 ? 'Rawat Inap' : 'Rawat Jalan') . ' - ID Data ' . $param->id,
                            'nilai' => $this->getDataDetail($param->id)->sum('biaya_disetujui'),
                            'is_jurnal_balik' => 0,
                            'lock_draft' => 1,
                            'lock_acc' => 0,
                        ]
                    );

                    $id_jurnal = $param->id_draft_jurnal;
                }
            } catch (Throwable $e) {
                return $e->getMessage();
            }
            KlaimBpjsLayakHeader::where('id', $param->id)->update([
                'user_generate' =>  Auth::user()->realname,
                'tanggal_generate' => date('Y-m-d H:i:s'),
                'id_draft_jurnal' => $id_jurnal
            ]);
            return ['id' => $id_jurnal, 'message' => 'sukses'];
        } catch (Throwable $e) {
            return $e->getMessage();
        }
    }
}
