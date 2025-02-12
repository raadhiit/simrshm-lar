<?php

namespace App\Http\Controllers;

use App\Http\Requests\DokumenKunjunganPasienRequest;
use App\Models\DokumenKunjungan;
use App\Models\Mjkn_Patient;
use App\Models\SMIS_Diagnosa;
use App\Models\SMIS_Er_Resep;
use App\Models\SMIS_LabPesanan;
use App\Models\Smis_Mr_Icd;
use App\Models\Smis_Rad_Pesanan;
use App\Models\SmisAdmPrototype;
use App\Models\SmisHrdEmployee;
use App\Services\AntrianPoliService;
use App\Services\ERekamMedisService;
use App\Services\JurnalService;
use App\Services\ResepService;
use Illuminate\Http\Request;
use App\Http\Controllers\CheckinController;
use App\Models\Antrian;
use App\Models\AntrianPendaftaran;
use App\Models\SMIS_Rg_Asuransi;
use App\Models\JadwalPoli;
use App\Models\JenisPasien;
use App\Models\SMIS_Rg_Perusahaan;
use App\Models\SMIS_LayananPasien;
use App\Http\Requests\PasienUmumRequest;
use App\Http\Requests\PasienBpjsRequest;
use App\Models\ERekamMedis;
use App\Models\SMIS_Er_Dresep;
use App\Services\AntrianPendaftaranService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\SMIS_Pasien;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\DataTables;

class AjaxRequestController extends Controller
{
    function employee(Request $req)
    {
        $query = SmisHrdEmployee::join('smis_hrd_job', 'smis_hrd_job.id', 'smis_hrd_employee.jabatan')
            ->select('smis_hrd_employee.id', 'smis_hrd_employee.nama', 'smis_hrd_job.nama as nama_jabatan');
        if ($req->keyword != '') {
            $query->where('smis_hrd_employee.nama', 'like', '%' . $req->keyword . '%');
        }
        return DataTables::of($query->get())->toJson();
    }

    function dokter(Request $req)
    {
        $query = SmisHrdEmployee::join('smis_hrd_job', 'smis_hrd_job.id', 'smis_hrd_employee.jabatan')
            ->select('smis_hrd_employee.id', 'smis_hrd_employee.nama', 'smis_hrd_job.nama as nama_jabatan')
            ->where('smis_hrd_job.nama', 'dokter');
        if ($req->keyword != '') {
            $query->where('smis_hrd_employee.nama', 'like', '%' . $req->keyword . '%');
        }
        return DataTables::of($query->get())->toJson();
    }

    function petugas(Request $req)
    {
        $query = SmisHrdEmployee::join('smis_hrd_job', 'smis_hrd_job.id', 'smis_hrd_employee.jabatan')
            ->select('smis_hrd_employee.id', 'smis_hrd_employee.nama', 'smis_hrd_job.nama as nama_jabatan')
            ->where('smis_hrd_job.nama', '!=', 'dokter');
        if ($req->keyword != '') {
            $query->where('smis_hrd_employee.nama', 'like', '%' . $req->keyword . '%');
        }
        return DataTables::of($query->get())->toJson();
    }

    function perawat(Request $req)
    {
        $query = SmisHrdEmployee::join('smis_hrd_job', 'smis_hrd_job.id', 'smis_hrd_employee.jabatan')
            ->select('smis_hrd_employee.id', 'smis_hrd_employee.nama', 'smis_hrd_job.nama as nama_jabatan')
            ->where('smis_hrd_job.nama', '=', 'Perawat');
        if ($req->keyword != '') {
            $query->where('smis_hrd_employee.nama', 'like', '%' . $req->keyword . '%');
        }
        return DataTables::of($query->get())->toJson();
    }

    function kamar(Request $req)
    {
        $query = SmisAdmPrototype::where('prop', '!=', 'del')->where('jenis_ruangan', 'URI');
        if ($req->keyword != '') {
            $query->where('nama', 'like', '%' . $req->keyword . '%');
        }
        return DataTables::of($query->get())->toJson();
    }

    function unit(Request $req)
    {
        $query = SmisAdmPrototype::where('prop', '!=', 'del')->where('parent', 'rawat');
        if ($req->keyword != '') {
            $query->where('nama', 'like', '%' . $req->keyword . '%');
        }
        return DataTables::of($query->get())->toJson();
    }

    function get_dokter(Request $req)
    {
        if ($req['query'] != '') {
            $key = "%" . $req['query'] . "%";
            $query = SmisHrdEmployee::where('nama', 'like', $key)->where('jabatan', '1')
                ->where('keluar', '0')->where('prop', '')->limit(10)->get();
            if (sizeof($query) > 0) {
                foreach ($query as $q) {
                    $output['suggestions'][] = [
                        'value' => $q->nama,
                        'nama' => $q->nama
                    ];
                }
            }
            if (!empty($output)) {
                echo json_encode($output);
            }
        }
    }

    function get_perawat(Request $req)
    {
        if ($req['query'] != '') {
            $key = "%" . $req['query'] . "%";
            $query = SmisHrdEmployee::where('nama', 'like', $key)->where('jabatan', '2')
                ->where('keluar', '0')->where('prop', '')->limit(10)->get();
            if (sizeof($query) > 0) {
                foreach ($query as $q) {
                    $output['suggestions'][] = [
                        'value' => $q->nama,
                        'nama' => $q->nama
                    ];
                }
            }
            if (!empty($output)) {
                echo json_encode($output);
            }
        }
    }

    function diagnosa(Request $req)
    {
        $query = Smis_Mr_Icd::select('*');
        if ($req->keyword != '') {
            $query->where('icd', 'like', $req->keyword)->orWhere('nama', 'like', $req->keyword);
        }
        return DataTables::of($query->get())->toJson();
    }

    function perujuk()
    {
        $data = DB::table('smis_rg_perujuk')->select('smis_rg_perujuk.id', 'smis_rg_perujuk.nama');
        return DataTables::of($data)->toJson();
    }

    function perujuk_by_kodedokter(Request $req)
    {
        $data = JadwalPoli::join('smis_rg_perujuk', 'smis_rg_perujuk.nama', 'smis_rg_jadwal_poli.nama_dokter')
            ->select('smis_rg_perujuk.id', 'smis_rg_perujuk.nama')
            ->where('smis_rg_jadwal_poli.kodedokter_bpjs', $req->kodedokter)->first();
        return response()->json($data);
    }
    function data_master_form_pendaftaran(Request $req)
    {
        $data['pasien'] = SMIS_Pasien::where('prop', '')->where(function ($q) use ($req) {
            $q->where('id', $req->nomor)->orWhere('ktp', $req->nomor);
        })->first();
        $data['poli'] = JadwalPoli::select('kodepoli_bpjs', 'nama_poli')->groupBy(['kodepoli_bpjs', 'nama_poli'])->get();
        $data['jenispasien'] = JenisPasien::where('prop', '')->get();
        $data['asuransi'] = SMIS_Rg_Asuransi::where('prop', '')->get();
        $data['perusahaan'] = SMIS_Rg_Perusahaan::where('prop', '')->get();
        $data['layanan'] = SMIS_LayananPasien::where('nrm', $data['pasien']->id)->orderBy('id', 'desc')->first();
        return response()->json($data);
    }

    function tambah_pasien_umum(PasienUmumRequest $req, AntrianPendaftaranService $aps)
    {
        try {
            $hasil = $aps->insert_pasien_anjungan_mandiri($req);
            return response()->json([
                'status' => true,
                'message' => 'No. rekam medis anda ' . $hasil->nrm . ' tersebut hanya bersifat sementara. Harap datang ke admisi untuk verifikasi & melengkapi data rekam medis dengan membawa kartu identitas, pastikan data anda benar-benar valid & belum pernah terdaftar di RS Harapan Mulia',
                'code' => 200
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
                'code' => 500
            ]);
        }
    }

    function tambah_pasien_bpjs(PasienBpjsRequest $req, AntrianPendaftaranService $aps)
    {
        try {
            $hasil = $aps->insert_pasien_anjungan_mandiri($req);
            return response()->json([
                'status' => true,
                'message' => 'No. rekam medis anda ' . $hasil->nrm . ' tersebut hanya bersifat sementara. Harap datang ke admisi untuk verifikasi & melengkapi data rekam medis dengan membawa kartu identitas, pastikan data anda benar-benar valid & belum pernah terdaftar di RS Harapan Mulia',
                'code' => 200
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
                'code' => 500
            ]);
        }
    }

    function pasien_daftar(Request $req, AntrianPendaftaranService $aps)
    {
        $valid = Validator::make($req->all(), [
            'tanggalperiksa' => "required|date_format:Y-m-d",
            'kodepoli' => 'required',
            'kodedokter' => 'required',
            'jampraktek' => 'required',
            'jenis_kunjungan' => "required"
        ], [
            'tanggalperiksa.required' => 'Pilih tanggal periksa dahulu',
            'tanggalperiksa.date_format' => 'Format tanggal periksa tidak sesuai',
            'kodepoli.required' => 'Pilih poli dahulu',
            'kodedokter.required' => 'Pilih dokter dahulu',
            'jampraktek.required' => 'Pilih jam terlebih dahulu',
            'jenis_kunjungan.required' => 'Jenis kunjungan harus diisi'
        ]);

        try {
            $hasil = $aps->pasien_daftar($req);
            return response()->json($hasil);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
                'code' => 201
            ]);
        }
    }

    function select_mjkn_patient(Request $req)
    {
        $data = Mjkn_Patient::findOrFail($req->pasien);
        return response()->json($data);
    }

    function get_antrian_selesai_poli(Request $req, AntrianPoliService $aps)
    {
        $data = $aps->antrian_selesai();
        return response()->json($data);
    }

    function pasien_mjkn(Request $req)
    {
        $data = Mjkn_Patient::where('origin_updated', 'mobile-jkn')->get();
        return response()->json($data);
    }

    function ambil_antrian_farmasi(Request $req)
    {
        $waktu = strtotime(now()) . '000';
        $data = Antrian::where('kodebooking', $req->kodebooking)->where('taskid', 4)->first();

        if (!$data) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan (sudah mengambil antrian sebelumnya)'
            ]);
        }
        $obj_bpjs = new CheckinController();
        $hit_bpjs = $obj_bpjs->update_waktu_antrian(5, $data->kodebooking, $waktu);
        if (!$hit_bpjs['status']) {
            return response()->json([
                'status' => false,
                'message' => $hit_bpjs['message']
            ]);
        }

        Antrian::where('id', $data->id)->update([
            'taskid' => 5,
            'waktu_taskid_lima' => $waktu,
            'jenis_obat' => $req->jenis_obat
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Ambil antrian farmasi berhasil'
        ]);
    }

    function antrian_obat(Request $req)
    {
        $statusPriorities = [6, 5, 7];
        $query = Antrian::leftJoin('smis_rg_patient', 'smis_rg_patient.id', 'antrians.norm')
            ->select('antrians.*', 'smis_rg_patient.nama as pasien', 'smis_rg_patient.ktp', 'smis_rg_patient.nobpjs', 'antrians.taskid')
            ->where(function ($q) {
                $q->where('taskid', 5)->orWhere('taskid', 6)->orWhere('taskid', 7);
            })->whereDate('tanggalperiksa', date('Y-m-d'))
            ->where('jenis_obat', $req->jenis);
        if (isset($req->display)) {
            $query->where('antrians.keterangan', 'farmasi');
        }
        if ($req->keyword != '' && $req->keyword != null) {
            $key = $req->keyword;
            $query->where(function ($q) use ($key) {
                $q->where('norm', 'like', '%' . $key . '%')->orWhere('smis_rg_patient.nama', 'like', '%' . $key . '%');
            });
        }
        $data = $query->where('smis_rg_patient.prop', '')->get();
        $data = $data->sortBy(function ($order) use ($statusPriorities) {
            return array_search($order['taskid'], $statusPriorities);
        })->values()->all();
        return response()->json($data);
    }

    function antrian_manual(Request $req)
    {
        $data = AntrianPendaftaran::where('tanggal', date('Y-m-d'))->where('jenis', $req->jenis)->first();
        return response()->json($data);
    }

    function patient_and_history_by_nrm(Request $req)
    {
        $query_pasien = SMIS_Pasien::select('*');
        $query_history = SMIS_LayananPasien::with('diagnosa')->leftjoin('smis_rg_patient', 'smis_rg_patient.id', 'smis_rg_layananpasien.nrm')
            // ->leftJoin('smis_mr_diagnosa', 'smis_rg_layananpasien.id', 'smis_mr_diagnosa.noreg_pasien')
            ->select('smis_rg_layananpasien.id', 'smis_rg_layananpasien.nrm', 'smis_rg_layananpasien.tanggal', 'smis_rg_layananpasien.jenislayanan');
        if ($req->nrm != '' && $req->nrm != null) {
            $query_pasien->where('id', $req->nrm);
            $query_history->where('smis_rg_layananpasien.nrm', $req->nrm);
        }
        $data['patient'] = $query_pasien->first();
        $data['history'] = $query_history->groupBy('smis_rg_layananpasien.id')->orderBy('tanggal', 'desc')->get();
        return response()->json($data);
    }

    function dokumen_kunjungan(Request $req)
    {
        $tanggal = explode(' ', $req->tanggal);
        $query = DokumenKunjungan::with(['general_consent'])
            ->where('nrm', $req->nrm);
        if ($req->profile != '') {
            $query->where('profile_number', $req->profile);
        }
        $data = $query->where('tanggal', $tanggal[0])->where('prop', '')->get();
        return response()->json($data);
    }

    function create_dokumen_kunjungan(DokumenKunjunganPasienRequest $req)
    {
        $pasien = SMIS_Pasien::where('nrm', $req->nrm)->first();
        $cek = DokumenKunjungan::where('tanggal', date('Y-m-d', strtotime($req->tanggal)))->where('noreg', $req->noreg)->where('nama_dokumen', $req->jenis)->where('prop', '')->first();
        if (!is_null($cek)) {
            return response()->json([
                'status' => false,
                'message' => 'Dokumen sudah pernah dibuat'
            ]);
        }
        try {
            DokumenKunjungan::updateOrCreate([
                'tanggal' => $req->tanggal,
                'noreg' => $req->noreg,
                'nama_dokumen' => $req->jenis
            ], [
                'nrm' => $req->nrm,
                'nama_pasien' => $pasien ? $pasien->nama : "",
                'status' => 0,
                'id_verifikator' => 0,
                'nama_verifikator' => '',
                'tanggal_update' => date('Y-m-d H:i:s'),
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Dokumen ' . $req->jenis . ' berhasil dibuat'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ]);
        }
    }

    function dokumen_kunjungan_by_noreg(Request $req)
    {
        $data['dokumen'] = DokumenKunjungan::where('noreg', $req->noreg)->where('prop', '')->get();
        $data['layanan'] = SMIS_LayananPasien::where('id', $req->noreg)->first();
        return response()->json($data);
    }

    function dokumen_kunjungan_rajal(Request $req)
    {
        $data['dokumen'] = DokumenKunjungan::where('noreg', $req->noreg)->where('prop', '')->get();
        if (count($data['dokumen']) > 0 && !$data['dokumen']->contains('nama_dokumen', "Program Pelayanan Fisioterapi")) {
            $cek_exist = DokumenKunjungan::where('noreg', '<=', $req->noreg)
                ->where('nrm', '=', $data['dokumen'][0]->nrm)
                ->where('nama_dokumen', 'like', '%Program Pelayanan Fisioterapi%')
                ->orderBy('id', 'desc')
                ->first();
            if (isset($cek_exist)) {
                if ($cek_exist->noreg_selesai == null || $cek_exist->noreg_selesai >= $req->noreg) {
                    $data['dokumen2'] = $cek_exist;
                }
            }
        }
        $data['layanan'] = SMIS_LayananPasien::where('id', $req->noreg)->first();
        return response()->json($data);
    }

    function diagnosa_by_noreg(Request $req)
    {
        $data = SMIS_Diagnosa::leftJoin('smis_hrd_employee', 'smis_hrd_employee.id', 'smis_mr_diagnosa.id_dokter')
            ->where('noreg_pasien', $req->noreg)->select('smis_mr_diagnosa.*', 'smis_hrd_employee.nip')->first();
        return response()->json($data);
    }

    function diagnosa_by_id(Request $req)
    {
        $data = SMIS_Diagnosa::leftJoin('smis_hrd_employee', 'smis_hrd_employee.id', 'smis_mr_diagnosa.id_dokter')
            ->where('smis_mr_diagnosa.id', $req->id)->select('smis_mr_diagnosa.*', 'smis_hrd_employee.nip')->first();
        return response()->json($data);
    }

    function autocomplete_diagnosa(Request $req)
    {
        if ($req['query'] != '') {
            $key = "%" . $req['query'] . "%";
            $query = Smis_Mr_Icd::where('icd', 'like', $key)->orWhere('nama', 'like', $key)->limit(10)->get();
            if (sizeof($query) > 0) {
                foreach ($query as $q) {
                    $output['suggestions'][] = [
                        'value' => $q->icd . ' - ' . $q->nama,
                        'icd' => $q->icd,
                        'nama' => $q->nama
                    ];
                }
            }
            if (!empty($output)) {
                echo json_encode($output);
            }
        }
    }

    function autocomplete_dokter(Request $req)
    {
        if ($req['query'] != '') {
            $key = "%" . $req['query'] . "%";
            $query = SmisHrdEmployee::leftJoin('smis_hrd_job', 'smis_hrd_job.id', 'smis_hrd_employee.jabatan')
                ->where('jabatan', '1')
                ->where('smis_hrd_employee.nama', 'like', $key)
                ->select('smis_hrd_employee.nama as nama', 'smis_hrd_employee.id', 'smis_hrd_job.nama as jabatan', 'nip', 'no_ijin')
                ->limit(10)
                ->get();
            // $query = Smis_Mr_Icd::where('icd', 'like', $key)->orWhere('nama', 'like', $key)->limit(10)->get();
            if (sizeof($query) > 0) {
                foreach ($query as $q) {
                    $output['suggestions'][] = [
                        'value' => $q->nama,
                        'nama' => $q->nama
                    ];
                }
            }
            if (!empty($output)) {
                echo json_encode($output);
            }
        }
    }

    function update_diagnosa(Request $req)
    {
        // dd($req->all());
        $dokumen = DokumenKunjungan::join('smis_rg_patient', 'smis_rg_patient.id', 'dokumen_kunjungan_pasien.nrm')
            ->select(
                'dokumen_kunjungan_pasien.*',
                'smis_rg_patient.nama_provinsi',
                'smis_rg_patient.nama_kabupaten',
                'smis_rg_patient.nama_kecamatan',
                'smis_rg_patient.nama_kelurahan',
                'smis_rg_patient.alamat',
                'smis_rg_patient.sebutan',
                'smis_rg_patient.profile_number',
                'smis_rg_patient.kelamin',
                'smis_rg_patient.tgl_lahir',
                'smis_rg_patient.id as nrm',
            )->where('dokumen_kunjungan_pasien.id', $req->dokumen)->first();
        try {
            $diagnosa = Smis_Mr_Icd::where('nama', $req->diagnosa)->first();
            $diagnosa_pembanding = Smis_Mr_Icd::where('nama', $req->diagnosa_pembanding)->first();
            $diagnosa_pra_bedah = Smis_Mr_Icd::where('nama', $req->diagnosa_pra_bedah)->first();
            $diagnosa_pasca_bedah = Smis_Mr_Icd::where('nama', $req->diagnosa_pasca_bedah)->first();
            DB::table('smis_mr_diagnosa')->updateOrInsert([
                'noreg_pasien' => $req->noreg,
            ], [
                'tanggal' => $req->tanggal,
                'diagnosa' => $req->diagnosa,
                'diagnosa_sekunder1' => $req->diagnosa_sekunder_satu ? $req->diagnosa_sekunder_satu : '',
                'diagnosa_sekunder2' => $req->diagnosa_sekunder_dua ? $req->diagnosa_sekunder_dua : '',
                'diagnosa_sekunder3' => $req->diagnosa_sekunder_tiga ? $req->diagnosa_sekunder_tiga : '',
                'diagnosa_sekunder4' => $req->diagnosa_sekunder_empat ? $req->diagnosa_sekunder_empat : '',
                'diagnosa_sekunder5' => $req->diagnosa_sekunder_lima ? $req->diagnosa_sekunder_lima : '',
                'diagnosa_tindakan' => $req->diagnosa_tindakan_satu ? $req->diagnosa_tindakan_satu : '',
                'diagnosa_tindakan2' => $req->diagnosa_tindakan_dua ? $req->diagnosa_tindakan_dua : '',
                'diagnosa_tindakan3' => $req->diagnosa_tindakan_tiga ? $req->diagnosa_tindakan_tiga : '',
                'diagnosa_kematian' => $req->diagnosa_kematian ? $req->diagnosa_kematian : '',
                'id_dokter' => $req->id_dokter,
                'nama_dokter' => $req->dokter,
                'nama_icd' => $diagnosa ? $diagnosa->nama : '',
                'kode_icd' => $diagnosa ? $diagnosa->icd : '',
                'kode_icd_tindakan' => $req->kode_icd_tindakan ? $req->kode_icd_tindakan : '',
                'sebab_sakit' => $req->penyebab ? $req->penyebab : '',
                'ruangan' => $req->ruangan,
                'nrm_pasien' => $dokumen ? $dokumen->nrm : '',
                'nama_pasien' => $dokumen ? $dokumen->nama_pasien : '',
                'time_updated' => date('Y-m-d H:i:s'),
                'origin' => 'rshm',
                'duplicate' => 0,
                'autonomous' => '[rshm]',
                'origin_updated' => 'rshm',
                'propinsi' => $dokumen ? $dokumen->nama_provinsi : '',
                'kabupaten' => $dokumen ? $dokumen->nama_kabupaten : '',
                'kecamatan' => $dokumen ? $dokumen->nama_kecamatan : '',
                'kelurahan' => $dokumen ? $dokumen->nama_kelurahan : '',
                'alamat' => $dokumen ? $dokumen->alamat : '',
                'sebutan' => $dokumen ? $dokumen->sebutan : '',
                'profile_number' => $dokumen ? $dokumen->profile_number : '',
                'jk' => $dokumen ? $dokumen->kelamin : '',
                'tgl_lahir' => $dokumen ? $dokumen->tgl_lahir : '',
                'diagnosa_pembanding' => $req->diagnosa_pembanding ? $req->diagnosa_pembanding : '',
                'nama_diagnosa_pembanding' => $diagnosa_pembanding ? $diagnosa_pembanding->nama : '',
                'kode_icd_diagnosa_pembanding' => $diagnosa_pembanding ? $diagnosa_pembanding->icd : '',
                'diagnosa_pra_bedah' => $req->diagnosa_pra_bedah ? $req->diagnosa_pra_bedah : '',
                'nama_diagnosa_pra_bedah' => $diagnosa_pra_bedah ? $diagnosa_pra_bedah->nama : '',
                'kode_icd_diagnosa_pra_bedah' => $diagnosa_pra_bedah ? $diagnosa_pra_bedah->icd : '',
                'diagnosa_pasca_bedah' => $req->diagnosa_pasca_bedah ? $req->diagnosa_pasca_bedah : '',
                'nama_diagnosa_pasca_bedah' => $diagnosa_pasca_bedah ? $diagnosa_pasca_bedah->nama : '',
                'kode_icd_diagnosa_pasca_bedah' => $diagnosa_pasca_bedah ? $diagnosa_pasca_bedah->icd : ''
            ]);
            $last = SMIS_Diagnosa::leftJoin('smis_hrd_employee', 'smis_hrd_employee.id', 'smis_mr_diagnosa.id_dokter')
                ->where('noreg_pasien', $req->noreg)->select('smis_mr_diagnosa.*', 'smis_hrd_employee.nip')->first();
            return response()->json([
                'status' => true,
                'message' => 'Ok',
                'data' => $last,
                'kode_sekunder1' => Smis_Mr_Icd::where('nama', $last->diagnosa_sekunder1)->first(),
                'kode_sekunder2' => Smis_Mr_Icd::where('nama', $last->diagnosa_sekunder2)->first(),
                'kode_sekunder3' => Smis_Mr_Icd::where('nama', $last->diagnosa_sekunder3)->first(),
                'kode_sekunder4' => Smis_Mr_Icd::where('nama', $last->diagnosa_sekunder4)->first(),
                'kode_sekunder5' => Smis_Mr_Icd::where('nama', $last->diagnosa_sekunder5)->first(),
                'kode_diagnosa_pra_bedah' => Smis_Mr_Icd::where('nama', $last->diagnosa_pra_bedah)->first(),
                'kode_diagnosa_pasca_bedah' => Smis_Mr_Icd::where('nama', $last->diagnosa_pasca_bedah)->first(),
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }

    function update_diagnosa_by_id(Request $req)
    {
        $dokumen = DokumenKunjungan::join('smis_rg_patient', 'smis_rg_patient.id', 'dokumen_kunjungan_pasien.nrm')
            ->select(
                'dokumen_kunjungan_pasien.*',
                'smis_rg_patient.nama_provinsi',
                'smis_rg_patient.nama_kabupaten',
                'smis_rg_patient.nama_kecamatan',
                'smis_rg_patient.nama_kelurahan',
                'smis_rg_patient.alamat',
                'smis_rg_patient.sebutan',
                'smis_rg_patient.profile_number',
                'smis_rg_patient.kelamin',
                'smis_rg_patient.tgl_lahir',
                'smis_rg_patient.id as nrm',
            )->where('dokumen_kunjungan_pasien.id', $req->dokumen)->first();
        try {
            $diagnosa = Smis_Mr_Icd::where('nama', $req->diagnosa)->first();
            $diagnosa_pembanding = Smis_Mr_Icd::where('nama', $req->diagnosa_pembanding)->first();
            $diagnosa_pra_bedah = Smis_Mr_Icd::where('nama', $req->diagnosa_pra_bedah)->first();
            $diagnosa_pasca_bedah = Smis_Mr_Icd::where('nama', $req->diagnosa_pasca_bedah)->first();
            DB::table('smis_mr_diagnosa')->updateOrInsert([
                'id' => $req->id_diagnosa,
            ], [
                'noreg_pasien' => $req->noreg,
                'tanggal' => $req->tanggal,
                'diagnosa' => $req->diagnosa,
                'diagnosa_sekunder1' => $req->diagnosa_sekunder_satu ? $req->diagnosa_sekunder_satu : '',
                'diagnosa_sekunder2' => $req->diagnosa_sekunder_dua ? $req->diagnosa_sekunder_dua : '',
                'diagnosa_sekunder3' => $req->diagnosa_sekunder_tiga ? $req->diagnosa_sekunder_tiga : '',
                'diagnosa_sekunder4' => $req->diagnosa_sekunder_empat ? $req->diagnosa_sekunder_empat : '',
                'diagnosa_sekunder5' => $req->diagnosa_sekunder_lima ? $req->diagnosa_sekunder_lima : '',
                'diagnosa_tindakan' => $req->diagnosa_tindakan_satu ? $req->diagnosa_tindakan_satu : '',
                'diagnosa_tindakan2' => $req->diagnosa_tindakan_dua ? $req->diagnosa_tindakan_dua : '',
                'diagnosa_tindakan3' => $req->diagnosa_tindakan_tiga ? $req->diagnosa_tindakan_tiga : '',
                'diagnosa_kematian' => $req->diagnosa_kematian ? $req->diagnosa_kematian : '',
                'id_dokter' => $req->id_dokter,
                'nama_dokter' => $req->dokter,
                'nama_icd' => $diagnosa ? $diagnosa->nama : '',
                'kode_icd' => $diagnosa ? $diagnosa->icd : '',
                'kode_icd_tindakan' => $req->kode_icd_tindakan ? $req->kode_icd_tindakan : '',
                'sebab_sakit' => $req->penyebab ? $req->penyebab : '',
                'ruangan' => $req->ruangan,
                'nrm_pasien' => $dokumen ? $dokumen->nrm : '',
                'nama_pasien' => $dokumen ? $dokumen->nama_pasien : '',
                'time_updated' => date('Y-m-d H:i:s'),
                'origin' => 'rshm',
                'duplicate' => 0,
                'autonomous' => '[rshm]',
                'origin_updated' => 'rshm',
                'propinsi' => $dokumen ? $dokumen->nama_provinsi : '',
                'kabupaten' => $dokumen ? $dokumen->nama_kabupaten : '',
                'kecamatan' => $dokumen ? $dokumen->nama_kecamatan : '',
                'kelurahan' => $dokumen ? $dokumen->nama_kelurahan : '',
                'alamat' => $dokumen ? $dokumen->alamat : '',
                'sebutan' => $dokumen ? $dokumen->sebutan : '',
                'profile_number' => $dokumen ? $dokumen->profile_number : '',
                'jk' => $dokumen ? $dokumen->kelamin : '',
                'tgl_lahir' => $dokumen ? $dokumen->tgl_lahir : '',
                'diagnosa_pembanding' => $req->diagnosa_pembanding ? $req->diagnosa_pembanding : '',
                'nama_diagnosa_pembanding' => $diagnosa_pembanding ? $diagnosa_pembanding->nama : '',
                'kode_icd_diagnosa_pembanding' => $diagnosa_pembanding ? $diagnosa_pembanding->icd : '',
                'diagnosa_pra_bedah' => $req->diagnosa_pra_bedah ? $req->diagnosa_pra_bedah : '',
                'nama_diagnosa_pra_bedah' => $diagnosa_pra_bedah ? $diagnosa_pra_bedah->nama : '',
                'kode_icd_diagnosa_pra_bedah' => $diagnosa_pra_bedah ? $diagnosa_pra_bedah->icd : '',
                'diagnosa_pasca_bedah' => $req->diagnosa_pasca_bedah ? $req->diagnosa_pasca_bedah : '',
                'nama_diagnosa_pasca_bedah' => $diagnosa_pasca_bedah ? $diagnosa_pasca_bedah->nama : '',
                'kode_icd_diagnosa_pasca_bedah' => $diagnosa_pasca_bedah ? $diagnosa_pasca_bedah->icd : ''
            ]);
            if ($req->id_diagnosa == 0) {
                $last = SMIS_Diagnosa::leftJoin('smis_hrd_employee', 'smis_hrd_employee.id', 'smis_mr_diagnosa.id_dokter')
                    ->where('noreg_pasien', $req->noreg)->select('smis_mr_diagnosa.*', 'smis_hrd_employee.nip')->orderBy('id', 'desc')->first();
            } else {
                $last = SMIS_Diagnosa::leftJoin('smis_hrd_employee', 'smis_hrd_employee.id', 'smis_mr_diagnosa.id_dokter')
                    ->where('smis_mr_diagnosa.id', $req->id_diagnosa)->select('smis_mr_diagnosa.*', 'smis_hrd_employee.nip')->first();
            }

            if($req->erm && (boolean) $req->erm){
                DB::table($req->tabel)->where('id_dokumen', $req->dokumen)->update([
                    'id_diagnosa' => $last->id
                ]);
            }

            return response()->json([
                'status' => true,
                'message' => 'Ok',
                'data' => $last,
                'kode_sekunder1' => Smis_Mr_Icd::where('nama', $last->diagnosa_sekunder1)->first(),
                'kode_sekunder2' => Smis_Mr_Icd::where('nama', $last->diagnosa_sekunder2)->first(),
                'kode_sekunder3' => Smis_Mr_Icd::where('nama', $last->diagnosa_sekunder3)->first(),
                'kode_sekunder4' => Smis_Mr_Icd::where('nama', $last->diagnosa_sekunder4)->first(),
                'kode_sekunder5' => Smis_Mr_Icd::where('nama', $last->diagnosa_sekunder5)->first(),
                'kode_diagnosa_pra_bedah' => Smis_Mr_Icd::where('nama', $last->diagnosa_pra_bedah)->first(),
                'kode_diagnosa_pasca_bedah' => Smis_Mr_Icd::where('nama', $last->diagnosa_pasca_bedah)->first(),
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }

    function select_kunjungan(Request $req)
    {
        $query = SMIS_LayananPasien::leftJoin('smis_rg_asuransi', 'smis_rg_asuransi.id', 'smis_rg_layananpasien.asuransi')
            ->select('smis_rg_layananpasien.*', 'smis_rg_asuransi.nama as nama_asuransi')
            ->where('smis_rg_layananpasien.id', $req->noreg)->where('smis_rg_layananpasien.prop', '')->first();
        return response()->json($query);
    }

    function select_resep(Request $req)
    {
        $query = SMIS_Er_Resep::with('detail')->join('smis_rg_layananpasien', 'smis_rg_layananpasien.id', 'smis_er_resep.noreg_pasien')
            ->leftJoin('smis_rg_asuransi', 'smis_rg_asuransi.id', 'smis_rg_layananpasien.asuransi')
            ->select('smis_er_resep.*', 'smis_rg_layananpasien.nama_perusahaan', 'smis_rg_asuransi.nama as nama_asuransi')->where('smis_er_resep.id', $req->id)->first();
        return response()->json($query);
    }

    function list_obat(Request $req)
    {
        if (is_null($req->depo)) {
            return 'Tujuan depo tidak valid';
        }

        $table = 'smis_dfm_stok_obat';
        $query = DB::table($table)->join('smis_dfm_obat_masuk', 'smis_dfm_obat_masuk.id', $table . '.id_obat_masuk')
            ->select('id_obat', 'nama_obat', 'kode_obat', 'nama_jenis_obat', 'satuan', DB::raw('SUM(sisa) as sisa'))
            ->where('sisa', '>', 0)
            ->where('smis_dfm_obat_masuk.status', 'sudah')
            ->where('smis_dfm_obat_masuk.prop', '')
            ->where($table . '.prop', '');
        if (!is_null($req->kriteria)) {
            $query = $query->where('nama_obat', 'like', '%' . $req->kriteria . '%');
        }
        $query = $query->groupBy(['id_obat', 'nama_obat', 'kode_obat', 'nama_jenis_obat', 'satuan']);

        return DataTables::of($query)->toJson();
    }

    function harga_obat(Request $req)
    {
        //        if (is_null($req->kategori)) {
        //            return response()->json([
        //                'status' => false,
        //                'message' => 'Silahkan pilih kategori terlebih dahulu',
        //                'code' => 500
        //            ]);
        //        }

        $dobat = DB::table('smis_fr_stok_obat')
            ->select('smis_fr_stok_obat.hna', 'smis_fr_stok_obat.ppn', 'smis_fr_dobat_masuk.diskon', 'smis_fr_dobat_masuk.t_diskon')
            ->leftjoin('smis_fr_dobat_masuk', 'smis_fr_stok_obat.id_dobat_masuk', 'smis_fr_dobat_masuk.id')
            ->where('smis_fr_stok_obat.id_obat', $req->id_obat)
            ->where('smis_fr_stok_obat.sisa', '>', 0)->get();

        $hna_tertinggi = 0;
        if (count($dobat) > 0) {
            foreach ($dobat as $d_obat) {
                $temp_hna = 0;
                if ($d_obat->t_diskon == 'nominal') {
                    $temp_hna = ($d_obat->hna / (($d_obat->ppn / 100) + 1)) - $d_obat->diskon;
                } else if ($d_obat->t_diskon == 'persen') {
                    $temp_hna = ($d_obat->hna / (($d_obat->ppn / 100) + 1)) - (($d_obat->hna / (($d_obat->ppn / 100) + 1)) * ($d_obat->diskon / 100));
                }

                if ($temp_hna > $hna_tertinggi) {
                    $hna_tertinggi = $temp_hna;
                }
            }
        } else {
            $obat = DB::table('smis_fr_stok_obat')
                ->select('smis_fr_stok_obat.hna', 'smis_fr_stok_obat.ppn', 'smis_fr_dobat_masuk.diskon', 'smis_fr_dobat_masuk.t_diskon', 'smis_fr_obat_masuk.tanggal_datang')
                ->leftjoin('smis_fr_dobat_masuk', 'smis_fr_stok_obat.id_dobat_masuk', 'smis_fr_dobat_masuk.id')
                ->leftJoin('smis_fr_obat_masuk', 'smis_fr_dobat_masuk.id_obat_masuk', 'smis_fr_obat_masuk.id')
                ->where('smis_fr_stok_obat.id_obat', $req->id_obat)
                ->get();

            $tmp_tanggal = "";
            foreach ($obat as $obats) {
                $temp_hna = $obats->hna;

                if ($obats->t_diskon === 'nominal') {
                    $temp_hna = ($obats->hna / (($obats->ppn / 100) + 1)) - $obats->diskon;
                } else if ($obats->t_diskon === 'persen') {
                    $temp_hna = ($obats->hna / (($obats->ppn / 100) + 1)) - (($obats->hna / (($obats->ppn / 100) + 1)) * ($obats->diskon / 100));
                }

                if ($obats->tanggal_datang > $tmp_tanggal) {
                    $tmp_tanggal = $obats->tanggal_datang;
                    $hna_tertinggi = $temp_hna;
                }
            }
        }

        $jumlah = $hna_tertinggi + ($hna_tertinggi * 0.11);

        $margin = DB::table('smis_dfm_margin_jual_rentang_harga')->orderBy('id')->get();

        foreach ($margin as $val_margin) {
            if ($jumlah >= $val_margin->batas_bawah && $jumlah <= $val_margin->batas_atas) {
                $jumlah += ($jumlah * ($val_margin->margin_jual / 100));
                break;
            }
        }

        return response()->json(ceil($jumlah));
    }

    function select_obat(Request $req)
    {
        $table = 'smis_dfm_stok_obat';
        $query = DB::table($table)->select(DB::raw('SUM(sisa) as sisa'), 'kode_obat', 'nama_obat', 'id_obat', 'nama_jenis_obat', 'satuan')->where('sisa', '>', 0)->where('id_obat', $req->id)->groupBy('id_obat')->where('prop', '')->first();
        return response()->json($query);
    }

    function autocomplete_obat(Request $req)
    {
        if ($req['query'] != '') {
            $table = 'smis_dfm_stok_obat';
            $query = DB::table($table)->select(DB::raw('SUM(sisa) as sisa'), 'kode_obat', 'nama_obat', 'id_obat', 'nama_jenis_obat', 'satuan')->where('sisa', '>', 0)->where('nama_obat', 'like', '%' . $req['query'] . '%')->groupBy('id_obat')->where('prop', '')->get();
            if (sizeof($query) > 0) {
                foreach ($query as $q) {
                    $output['suggestions'][] = [
                        'value' => $q->kode_obat . ' - ' . $q->nama_obat,
                        'nama'  => $q->nama_obat,
                        'kode_obat'  => $q->kode_obat,
                        'id'  => $q->id_obat,
                        'jenis_obat'  => $q->nama_jenis_obat,
                        'sisa' => $q->sisa,
                        'satuan_obat'  => $q->satuan,
                    ];
                }
            }
            if (!empty($output)) {
                echo json_encode($output);
            }
        }
    }

    function datatable_dokter()
    {
        $data = SmisHrdEmployee::leftJoin('smis_hrd_job', 'smis_hrd_job.id', 'smis_hrd_employee.jabatan')
            ->where('jabatan', '1')
            ->select('smis_hrd_employee.nama as nama', 'smis_hrd_employee.id', 'smis_hrd_job.nama as jabatan', 'nip', 'no_ijin')->get();
        return Datatables::of($data)->addIndexColumn()->make(true);
    }

    function resep_store(Request $req, ResepService $rs)
    {
        try {
            $store = $rs->store($req);
            if ($store['status']) {
                return response()->json([
                    'code' => 200,
                    'status' => true,
                    'message' => 'Resep berhasil disimpan',
                    'data' => SMIS_Er_Resep::with('detail')->select('*')->where('noreg_pasien', $req->noreg)->where('prop', '')->first()
                ]);
            } else {
                return response()->json([
                    'code' => 500,
                    'status' => false,
                    'message' => $store['message'],
                    'data' => null
                ]);
            }
        } catch (\Exception $th) {
            return response()->json([
                'code' => 500,
                'status' => false,
                'message' => 'Kesalahan server'
            ]);
        }
    }

    function resep_store_by_id(Request $req, ResepService $rs)
    {
        try {
            $store = $rs->store_by_id($req);
            if ($store['status']) {
                return response()->json([
                    'code' => 200,
                    'status' => true,
                    'message' => 'Resep berhasil disimpan',
                    'data' => SMIS_Er_Resep::with('detail')->select('*')->where('id', $store['data']->id)->where('prop', '')->first()
                ]);
            } else {
                return response()->json([
                    'code' => 500,
                    'status' => false,
                    'message' => $store['message'],
                    'data' => null
                ]);
            }
        } catch (\Exception $th) {
            return response()->json([
                'code' => 500,
                'status' => false,
                'message' => 'Kesalahan server'
            ]);
        }
    }

    function resep_update(Request $req, ResepService $rs)
    {
        try {
            $cek = SMIS_Er_Resep::with('detail')->select('*')->where('id', $req->id_resep)->first();

            if ($cek->locked == 1) {
                return response()->json([
                    'code' => 500,
                    'status' => false,
                    'message' => 'Resep sudah dilock, tidak dapat diubah lagi',
                    'data' => null
                ]);
            }

            $update = $rs->update($req);
            if ($update['status']) {
                return response()->json([
                    'code' => 200,
                    'status' => true,
                    'message' => 'Resep berhasil disimpan',
                    'data' => SMIS_Er_Resep::with('detail')->select('*')->where('id', $req->id_resep)->where('prop', '')->first()
                ]);
            } else {
                return response()->json([
                    'code' => 500,
                    'status' => false,
                    'message' => $update['message'],
                    'data' => null
                ]);
            }
        } catch (\Exception $th) {
            return response()->json([
                'code' => 500,
                'status' => false,
                'message' => 'Kesalahan server'
            ]);
        }
    }

    function preview_resep(Request $req, ResepService $rs)
    {
    }

    function lock_resep(Request $req, ResepService $rs)
    {
        try {
            $rs->lock($req);
            return response()->json([
                'code' => 200,
                'status' => true,
                'data' => $rs->select_resep($req),
                'message' => 'Resep berhasil dilock'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'code' => 500,
                'status' => false,
                'message' => $th->getMessage()
            ]);
        }
    }

    function pesanan_lab_by_noreg(Request $req)
    {
        $data['pesanan_lab'] = SMIS_LabPesanan::where('noreg_pasien', $req->noreg)->where('prop', '')->first();
        $data['diagnosa'] = SMIS_Diagnosa::where('noreg_pasien', $req->noreg)->where('prop', '')->first();
        return response()->json($data);
    }

    function pesanan_lab_by_id(Request $req)
    {
        $data = SMIS_LabPesanan::where('id', $req->id)->where('prop', '')->first();
        return response()->json($data);
    }

    function pesanan_lab_store(Request $req, ERekamMedisService $erms)
    {
        try {
            $store = $erms->lab_pesanan_store($req);
            $data = $erms->pesanan_lab($req->noreg);
            return response()->json([
                'status' => true,
                'message' => 'Ok',
                'data' => $data
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ]);
        }
    }

    function pesanan_lab_store_by_id(Request $req, ERekamMedisService $erms)
    {
        try {
            // if (isset($req->nama_dokumen)) {
            //     $select = DB::table('smis_doc_'.$req->nama_dokumen)->where('id_dokumen', $req->dokumen)->first();

            //     if (is_null($select)) {
            //         return response()->json([
            //             'status' => false,
            //             'message' => 'Dokumen belum disimpan, simpan dokumen dahulu'
            //         ]);
            //     }

            $store = $erms->lab_pesanan_store_by_id($req);

            //     DB::table('smis_doc_'.$req->nama_dokumen)->updateOrInsert([
            //         'id_dokumen' => $req->dokumen
            //     ],[
            //         'id_lab' => $store->id
            //     ]);
            // }

            $data = $erms->pesanan_lab_by_id($store->id);
            return response()->json([
                'status' => true,
                'message' => 'Ok',
                'data' => $data
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ]);
        }
    }

    function pesanan_radiologi_by_noreg(Request $req)
    {
        $data = Smis_Rad_Pesanan::where('noreg_pasien', $req->noreg)->where('prop', '')->first();
        return response()->json($data);
    }

    function pesanan_radiologi_by_id(Request $req)
    {
        $data = Smis_Rad_Pesanan::where('id', $req->id)->where('prop', '')->first();
        return response()->json($data);
    }

    function pesanan_radiologi_store(Request $req, ERekamMedisService $erms)
    {
        try {
            $store = $erms->pesanan_radiologi_store($req);
            $data = $erms->pesanan_radiologi($req->noreg);
            return response()->json([
                'status' => true,
                'message' => 'Ok',
                'data' => $data
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ]);
        }
    }

    function pesanan_radiologi_store_by_id(Request $req, ERekamMedisService $erms)
    {
        try {
            $store = $erms->pesanan_radiologi_store_by_id($req);
            $data = $erms->pesanan_radiologi_by_id($store->id);
            return response()->json([
                'status' => true,
                'message' => 'Ok',
                'data' => $data
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ]);
        }
    }

    function hapus_dokumen_kunjungan(Request $req)
    {
        try {
            $dokumen = DokumenKunjungan::findOrFail($req->id);
            DokumenKunjungan::where('id', $req->id)->update([
                'prop' => 'del'
            ]);

            $path = '/var/www/html/casemix/files/shares/' . $dokumen->noreg;
            $fileName = '7_' . $req->id . '_surat_kontrol.pdf';
            $filePath = $path . '/' . $fileName;

            unlink($filePath);

            return response()->json([
                'status' => true,
                'message' => 'Ok',
                'noreg' => $dokumen->noreg
            ]);
        } catch (\Exception $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ]);
        }
    }

    function suggestion_suku()
    {
        $query = DB::table('smis_rg_suku')->select('nama')->where('prop', '')->get()->toArray();
        $result = array_column($query, 'nama');
        return response()->json($result);
    }

    function update_pesanan(Request $req)
    {
        try {
            DB::table('smis_doc_' . $req->dokumen)->updateOrInsert([
                'id_dokumen' => $req->id_dokumen
            ], [
                'id_pesanan_lab' => $req->id_pesanan_lab,
                'id_pesanan_rad' => $req->id_pesanan_rad,
            ]);
            return response()->json(['status' => true, 'message' => 'Ok']);
        } catch (\Exception $th) {
            return response()->json(['status' => false, 'message' => $th->getMessage()]);
        }
    }

    function e_rekam_medis(Request $req)
    {
        $query = ERekamMedis::where('nrm', $req->nrm);
        if ($req->profile != '') {
            $query->where('profile_number', $req->profile);
        }
        $data = $query->get();
        return response()->json($data);
    }

    function hapus_pesanan_lab(Request $req, JurnalService $js)
    {
        try {
            $pesanan = SMIS_LabPesanan::where('id', $req->id)->first();
            if ($pesanan->status == 'Pesanan ERM') {
                if (is_null($pesanan)) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Pesanan tidak ditemukan'
                    ]);
                }
                DB::table('smis_lab_pesanan')->where('id', $req->id)->update([
                    'prop' => 'del'
                ]);
                $js->delete_tagihan_kasir_lab($req->id);
                $js->delete_jurnal_lab($req->id);

                return response()->json([
                    'status' => true,
                    'message' => 'Ok'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Tidak diperkenankan ubah pesanan laboratorium'
                ]);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ]);
        }
    }

    function hapus_pesanan_rad(Request $req, JurnalService $js)
    {
        try {
            $pesanan = Smis_Rad_Pesanan::where('id', $req->id)->first();
            if ($pesanan->status == 'Pesanan ERM') {
                if (is_null($pesanan)) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Pesanan tidak ditemukan'
                    ]);
                }
                DB::table('smis_rad_pesanan')->where('id', $req->id)->update([
                    'prop' => 'del'
                ]);
                $js->delete_tagihan_kasir_rad($req->id);
                $js->delete_jurnal_rad($req->id);

                return response()->json([
                    'status' => true,
                    'message' => 'Ok'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Tidak diperkenankan ubah pesanan radiologi'
                ]);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ]);
        }
    }

    function list_riwayat_eresep(Request $req)
    {
        $data = SMIS_Er_Resep::orderByDesc('tanggal')
            ->where('prop', 'like', '')
            ->where('nrm_pasien', '=', $req->nrm_pasien)
            // ->where('id_dokter', '=', $req->id_dokter)
            ->select(
                'id',
                DB::raw('DATE_FORMAT(tanggal, "%d-%m-%Y, %H:%i") as tanggal'),
                'nama_dokter',
                DB::raw('REPLACE(UCASE(ruangan), "_", " ") as ruangan')
            )
            ->orderBy('id')
            ->offset(0)
            ->limit(10)
            ->get();
        return response()->json(
            array('data' => $data),
            200
        );
    }

    function preview_riwayat_eresep(Request $req)
    {
        $data = SMIS_Er_Dresep::orderBy('id')
            ->where('id_resep', '=', $req->id)
            ->where('prop', 'like', '')
            ->select('nama_obat', 'signa', 'jumlah', 'satuan')
            ->get();
        return response()->json(
            array('data' => $data),
            200
        );
    }

    function select_riwayat_eresep(Request $req)
    {
        $data = SMIS_Er_Dresep::orderBy('id')
            ->where('id_resep', '=', $req->id)
            ->where('prop', 'like', '')
            ->get();

        if ($data != null) {
            foreach ($data as $d) {
                $dobat = DB::table('smis_fr_obat_masuk')->join('smis_fr_stok_obat', 'smis_fr_stok_obat.id_dobat_masuk', 'smis_fr_obat_masuk.id')
                    ->select('smis_fr_stok_obat.ppn', 'smis_fr_stok_obat.hna')
                    ->where('id_obat', $d->id_obat)->get();
                $hna_tertinggi = 0;
                foreach ($dobat as $d_obat) {
                    $temp_hna = $d_obat->hna / (($d_obat->ppn / 100) + 1);
                    if ($temp_hna > $hna_tertinggi) {
                        $hna_tertinggi = $temp_hna;
                    }
                }
                $hpp = $hna_tertinggi + ($hna_tertinggi * 0.11);
                $hja = $hpp + ($hpp * 0.25);
                $d->harga = $hja;
            }
        }
        return response()->json(
            array('data' => $data),
            200
        );
    }

    function datatable_bidan(Request $req)
    {
        return DataTables::of(SmisHrdEmployee::where('jabatan', 6)->where('prop', ''))->make(true);
    }

    function datatable_dokter_dan_perawat(Request $req)
    {
        $data = SmisHrdEmployee::leftJoin('smis_hrd_job', 'smis_hrd_job.id', 'smis_hrd_employee.jabatan')
            ->where('jabatan', '1')->orWhere('jabatan', '2')
            ->select('smis_hrd_employee.nama as nama', 'smis_hrd_employee.id', 'smis_hrd_job.nama as jabatan', 'nip', 'no_ijin')->get();
        return DataTables::of($data)->make(true);
    }

    function icd_by_nama(Request $req)
    {
        return response()->json(Smis_Mr_Icd::where('nama', $req->nama)->where('prop', '')->first());
    }

    function riwayat_lab(Request $req)
    {
        $page = ($req->start / $req->length) + 1;
        $query = DB::table('smis_lab_pesanan')->where('nrm_pasien', $req->nrm)->where('prop', '')->orderBy('id', 'desc');
        $data = $query->paginate($req->length, ['*'], 'page', $page);

        $dataTable = DataTables::of($data->items())
            ->setTotalRecords($data->total())
            ->setOffset($req->start)
            ->setFilteredRecords($data->total());

        return $dataTable->make(true);
        // return response()->json(DB::table('smis_lab_pesanan')->where('nrm_pasien', $req->nrm)->where('prop', '')->orderBy('id', 'desc')->limit(5)->get());
    }

    function riwayat_rad(Request $req)
    {
        $page = ($req->start / $req->length) + 1;
        $query = DB::table('smis_rad_pesanan')->where('nrm_pasien', $req->nrm)->where('prop', '')->orderBy('id', 'desc');
        $data = $query->paginate($req->length, ['*'], 'page', $page);

        $dataTable = DataTables::of($data->items())
            ->setTotalRecords($data->total())
            ->setOffset($req->start)
            ->setFilteredRecords($data->total());

        return $dataTable->make(true);
        // return response()->json(DB::table('smis_rad_pesanan')->where('nrm_pasien', $req->nrm)->where('prop', '')->orderBy('id', 'desc')->limit(5)->get());
    }

    public function riwayat_rm(Request $req)
    {
        $page = ($req->start / $req->length) + 1;
        $query = DB::table('dokumen_kunjungan_pasien')
            ->select('noreg', 'tanggal', 'nama_verifikator', 'path_dokumen')
            ->where([
                ['prop', ''],
                ['nrm', $req->nrm],
                ['nama_dokumen', 'Scan Dokumen RM'],
                ['path_dokumen', '!=', '']
            ])
            ->orderBy('id', 'desc');

        $data = $query->paginate($req->length, ['*'], 'page', $page);

        $dataTable = DataTables::of($data->items())
            ->setTotalRecords($data->total())
            ->setOffset($req->start)
            ->setFilteredRecords($data->total());

        return $dataTable->make(true);
        // return response()->json(DB::table('smis_rad_pesanan')->where('nrm_pasien', $req->nrm)->where('prop', '')->orderBy('id', 'desc')->limit(5)->get());
    }

    function cek_casemix_folder(Request $req)
    {
        $path = '/var/www/html/casemix/files/shares/' . $req->noreg;

        if (file_exists($path)) {
            $files = File::files($path);
            if (count($files) > 0) {
                $data = [];
                foreach ($files as $file) {
                    array_push($data, $file->getFilename());
                }
                return response()->json([
                    'status' => true,
                    'message' => 'Files ditemukan',
                    'data' => $data
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Files tidak ditemukan'
                ]);
            }
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Directory tidak ditemukan'
            ]);
        }
    }
}
