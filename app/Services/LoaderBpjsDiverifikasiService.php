<?php

namespace Services;

namespace App\Services;

use App\Imports\LoaderBpjsDiverifikasiImport;
use App\Models\LoaderBpjsDiverifikasiDetail;
use App\Models\LoaderBpjsDiverifikasiHeader;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Throwable;

/**
 * Class Services
 * @author rivald
 */
class LoaderBpjsDiverifikasiService
{

    public function getJurnalNum($id)
    {
        $result =  DB::table('smis_ac_draft_jurnal')->where('id', $id)->select('nomor')->first();
        return $result->nomor ?? '';
    }

    public function statusJurnal($id_draft_jurnal, $id_header = 0)
    {
        if (isset($id_draft_jurnal)) {

            $result = DB::table('smis_ac_draft_jurnal')->where('id', $id_draft_jurnal)->select('is_jurnal_balik', 'lock_draft', 'lock_acc')->first();
            $result_generate = LoaderBpjsDiverifikasiDetail::where('id_header', $id_header)
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
        $dataDtail = $this->getDataDetail($id_header)->where('noreg', null)->count();

        return $dataDtail < 1 ? 'Belum Generate' : 'Lengkapi Data';
    }

    public function getDataGenerate($param)
    {
        $dataHeader = LoaderBpjsDiverifikasiHeader::where('id', $param)->first();
        $dataDetail = LoaderBpjsDiverifikasiDetail::where('id_header', $param)->where('id_detail_draft', null)->get();

        $result = array(
            'header' => $dataHeader,
            'detail' => $dataDetail
        );

        return $result;
    }

    public function getData()
    {
        return LoaderBpjsDiverifikasiHeader::orderBy('id', 'DESC');
    }

    public function getDataDetail($id)
    {
        return LoaderBpjsDiverifikasiDetail::where('id_header', $id);
    }

    public function getDataDetailById($id)
    {
        return LoaderBpjsDiverifikasiDetail::where('id', $id)->first();
    }

    public function store($param)
    {
        try {
            LoaderBpjsDiverifikasiHeader::create($param);
            return 'sukses';
        } catch (Throwable $e) {
            return $e->getMessage();
        }
    }

    public function updateDetail($param)
    {
        try {
            LoaderBpjsDiverifikasiDetail::where('id', $param->id)->update($param->except('_method', '_token', 'id'));
            return 'sukses';
        } catch (Throwable $e) {
            return $e->getMessage();
        }
    }

    public function generateDetail($param)
    {
        $getDataDetail = $this->getDataDetail($param->id_header)->get();
        if (count($getDataDetail) < 1) {
            return 'Data tidak ditemukan silahkan hubungi admin / cek data';
        }
        foreach ($getDataDetail as $value) {
            $getSmisRgLayananpasien = DB::table('smis_rg_layananpasien')
                ->when($param->uri == 1, function ($query) use ($value) {
                    return $query->where('no_sep_ri', $value->sep);
                })
                ->when($param->uri == 0, function ($query) use ($value) {
                    return $query->where('no_sep_rj', $value->sep);
                })
                ->select('inacbg_bpjs', 'plafon_bpjs', 'total_hpp', 'id')
                ->first();
            if (isset($getSmisRgLayananpasien)) {
                try {
                    LoaderBpjsDiverifikasiDetail::where('sep', $value->sep)
                        ->update([
                            'noreg' => $getSmisRgLayananpasien->id,
                            'inacbgs' => $getSmisRgLayananpasien->inacbg_bpjs,
                            'plafon_bpjs' => $getSmisRgLayananpasien->plafon_bpjs,
                            'total_hpp' => $getSmisRgLayananpasien->total_hpp,
                            'selisih' => ($getSmisRgLayananpasien->plafon_bpjs - $getSmisRgLayananpasien->total_hpp)
                        ]);
                } catch (Throwable $e) {
                    return $e->getMessage();
                }
            }
        }
        return 'sukses';
    }

    public function destroyData($id)
    {
        try {
            try {
                LoaderBpjsDiverifikasiHeader::where('id', $id)->update(['prop' => 'del']);
            } catch (Throwable $e) {
                return $e->getMessage();
            }
            LoaderBpjsDiverifikasiHeader::where('id', $id)->update([
                'user_hapus' =>  Auth::user()->realname,
                'tanggal_hapus' => date('Y-m-d h:i:s')
            ]);
            return 'sukses';
        } catch (Throwable $e) {
            return $e->getMessage();
        }
    }

    public function import($param)
    {
        try {
            try {
                Excel::import(new LoaderBpjsDiverifikasiImport($param->id_header), $param->file('file_xlsx'));
            } catch (Throwable $e) {
                return $e->getMessage();
            }
            LoaderBpjsDiverifikasiHeader::where('id', $param->id_header)->update([
                'user_upload' =>  Auth::user()->realname,
                'tanggal_upload' => date('Y-m-d h:i:s')
            ]);
            return 'sukses';
        } catch (Throwable $e) {
            return $e->getMessage();
        }
    }

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
                        'j_jurnal' => 'Piutang Diverifikasi',
                        'operator' => Auth::user()->realname,
                        'tanggal_input' => date('Y-m-d H:i:s'),
                        'jenis' => '',
                        'tanggal' => $param->tanggal_jurnal,
                        'nomor' => '',
                        'keterangan' => 'Klaim Diverifikasi BPJS Kesehatan - ' . convertMonthYear($param->bulan_klaim) . ' - ' . ($param->jenis_layanan == 1 ? 'Rawat Inap' : 'Rawat Jalan') . ' - ID Data ' . $param->id,
                        'nilai' => $this->getDataDetail($param->id)->sum('plafon_bpjs'),
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
                            'j_jurnal' => 'Piutang Diverifikasi',
                            'operator' => Auth::user()->realname,
                            'tanggal_input' => date('Y-m-d H:i:s'),
                            'jenis' => '',
                            'tanggal' => $param->tanggal_jurnal,
                            'nomor' => '',
                            'keterangan' => 'Klaim Diverifikasi BPJS Kesehatan - ' . convertMonthYear($param->bulan_klaim) . ' - ' . ($param->jenis_layanan == 1 ? 'Rawat Inap' : 'Rawat Jalan') . ' - ID Data ' . $param->id,
                            'nilai' => $this->getDataDetail($param->id)->sum('plafon_bpjs'),
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
            LoaderBpjsDiverifikasiHeader::where('id', $param->id)->update([
                'user_generate' =>  Auth::user()->realname,
                'tanggal_generate' => date('Y-m-d H:i:s'),
                'id_draft_jurnal' => $id_jurnal
            ]);
            return ['id' => $id_jurnal, 'message' => 'sukses'];
        } catch (Throwable $e) {
            return $e->getMessage();
        }
    }

    public function generateDraftDetailJurnal($param)
    {
        $data_1 = 0;
        $data_2 = 0;
        $data_3 = 0;
        $data_4 = 0;
        $done_proces;
        //Note : if nothing column in array insert that is not filled (null/default)
        try {
            if (session('jenis_layanan') == 0) {
                DB::transaction(function () use ($param, $data_1, $data_2, $data_3, $data_4) {
                    $data_1 = DB::table('smis_ac_detail_draft_jurnal')->insertGetId([
                        'id_draft_jurnal' => $param->id_draft,
                        'nomor_account' => '1.1.04.01.02.02.01.02',
                        'nama_account' => 'Piutang Usaha - Pasien RAJAL (BPJS) Terverifikasi',
                        'keterangan' => 'Klaim BPJS Kesehatan Diverifikasi - ' . session('bulan_klaim') . ' - Rawat Jalan - ID Data ' . $param->id . '- ' . $param->no_sep . ' - ID ' . $param->id_draft,
                        'debet' => $param->plafon_bpjs,
                        'kredit' => '0',
                        'id_akun' => 42,
                        'id_tipeakun' => 2,
                        'nama_tipeakun' => 'Piutang usaha',
                        'j_jurnal' => 'Piutang Diverifikasi'
                    ]);

                    $data_2 = DB::table('smis_ac_detail_draft_jurnal')->insertGetId([
                        'id_draft_jurnal' => $param->id_draft,
                        'nomor_account' => '5.1.01.01',
                        'nama_account' => 'Pendapatan BPJS',
                        'keterangan' => 'Klaim BPJS Kesehatan Diverifikasi - ' . session('bulan_klaim') . ' - Rawat Jalan - ID Data ' . $param->id . '- ' . $param->no_sep . ' - ID ' . $param->id_draft,
                        'debet' => '0',
                        'kredit' => $param->plafon_bpjs,
                        'id_akun' => 252,
                        'id_tipeakun' => 17,
                        'nama_tipeakun' => 'Pendapatan',
                        'j_jurnal' => 'Piutang Diverifikasi'
                    ]);

                    $data_3 = DB::table('smis_ac_detail_draft_jurnal')->insertGetId([
                        'id_draft_jurnal' => $param->id_draft,
                        'nomor_account' => '5.1.01.01',
                        'nama_account' => 'Pendapatan BPJS',
                        'keterangan' => 'Klaim BPJS Kesehatan Diverifikasi - ' . session('bulan_klaim') . ' - Rawat Jalan - ID Data ' . $param->id . '- ' . $param->no_sep . ' - ID ' . $param->id_draft,
                        'debet' => $param->total_hpp,
                        'kredit' => '0',
                        'id_akun' => 252,
                        'id_tipeakun' => 17,
                        'nama_tipeakun' => 'Pendapatan',
                        'j_jurnal' => 'Piutang Diverifikasi'
                    ]);

                    $data_4 = DB::table('smis_ac_detail_draft_jurnal')->insertGetId([
                        'id_draft_jurnal' => $param->id_draft,
                        'nomor_account' => '1.1.04.01.02.02.01.01',
                        'nama_account' => 'Piutang Usaha - Pasien RAJAL (BPJS) Diajukan',
                        'keterangan' => 'Klaim BPJS Kesehatan Diverifikasi - ' . session('bulan_klaim') . ' - Rawat Jalan - ID Data ' . $param->id . '- ' . $param->no_sep . ' - ID ' . $param->id_draft,
                        'debet' => '0',
                        'kredit' => $param->total_hpp,
                        'id_akun' => 41,
                        'id_tipeakun' => 2,
                        'nama_tipeakun' => 'Piutang usaha',
                        'j_jurnal' => 'Piutang Diverifikasi'
                    ]);

                    LoaderBpjsDiverifikasiDetail::where('id', $param->id)->update([
                        'id_detail_draft' => $data_1 . ',' . $data_2 . ',' . $data_3 . ',' . $data_4
                    ]);
                });
            } else {
                DB::transaction(function () use ($param, $data_1, $data_2, $data_3, $data_4) {
                    $data_1 = DB::table('smis_ac_detail_draft_jurnal')->insertGetId([
                        'id_draft_jurnal' => $param->id_draft,
                        'nomor_account' => '1.1.04.01.01.02.01.02',
                        'nama_account' => 'Piutang Usaha - Pasien RANAP (BPJS) Terverifikasi',
                        'keterangan' => 'Klaim BPJS Kesehatan Diverifikasi - ' . session('bulan_klaim') . ' - Rawat Inap - ID Data ' . $param->id . '- ' . $param->no_sep . ' - ID ' . $param->id_draft,
                        'debet' => $param->plafon_bpjs,
                        'kredit' => '0',
                        'id_akun' => 24,
                        'id_tipeakun' => 2,
                        'nama_tipeakun' => 'Piutang usaha',
                        'j_jurnal' => 'Piutang Diverifikasi'
                    ]);

                    $data_2 = DB::table('smis_ac_detail_draft_jurnal')->insertGetId([
                        'id_draft_jurnal' => $param->id_draft,
                        'nomor_account' => '5.1.01.01',
                        'nama_account' => 'Pendapatan BPJS',
                        'keterangan' => 'Klaim BPJS Kesehatan Diverifikasi - ' . session('bulan_klaim') . ' - Rawat Inap - ID Data ' . $param->id . '- ' . $param->no_sep . ' - ID ' . $param->id_draft,
                        'debet' => '0',
                        'kredit' => $param->plafon_bpjs,
                        'id_akun' => 252,
                        'id_tipeakun' => 17,
                        'nama_tipeakun' => 'Pendapatan',
                        'j_jurnal' => 'Piutang Diverifikasi'
                    ]);

                    $data_3 = DB::table('smis_ac_detail_draft_jurnal')->insertGetId([
                        'id_draft_jurnal' => $param->id_draft,
                        'nomor_account' => '5.1.01.01',
                        'nama_account' => 'Pendapatan BPJS',
                        'keterangan' => 'Klaim BPJS Kesehatan Diverifikasi - ' . session('bulan_klaim') . ' - Rawat Inap - ID Data ' . $param->id . '- ' . $param->no_sep . ' - ID ' . $param->id_draft,
                        'debet' => $param->total_hpp,
                        'kredit' => '0',
                        'id_akun' => 252,
                        'id_tipeakun' => 17,
                        'nama_tipeakun' => 'Pendapatan',
                        'j_jurnal' => 'Piutang Diverifikasi'
                    ]);

                    $data_4 = DB::table('smis_ac_detail_draft_jurnal')->insertGetId([
                        'id_draft_jurnal' => $param->id_draft,
                        'nomor_account' => '1.1.04.01.01.02.01.01',
                        'nama_account' => 'Piutang Usaha - Pasien RANAP (BPJS) Diajukan',
                        'keterangan' => 'Klaim BPJS Kesehatan Diverifikasi - ' . session('bulan_klaim') . ' - Rawat Inap - ID Data ' . $param->id . '- ' . $param->no_sep . ' - ID ' . $param->id_draft,
                        'debet' => '0',
                        'kredit' => $param->total_hpp,
                        'id_akun' => 34,
                        'id_tipeakun' => 2,
                        'nama_tipeakun' => 'Piutang Usaha',
                        'j_jurnal' => 'Piutang Diverifikasi'
                    ]);

                    LoaderBpjsDiverifikasiDetail::where('id', $param->id)->update([
                        'id_detail_draft' => $data_1 . ',' .  $data_2 . ',' . $data_3 . ',' . $data_4
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
}
