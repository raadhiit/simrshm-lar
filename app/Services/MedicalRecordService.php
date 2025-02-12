<?php

namespace App\Services;

use App\Models\DokumenKunjungan;
use App\Models\ERekamMedis;
use App\Models\Smis_Doc_Rpp;
use App\Models\Smis_Doc_Sbpk;
use App\Models\SMIS_HRD_Employee;
use App\Models\Smis_Lab_Layanan;
use App\Models\SMIS_LayananPasien;
use App\Models\SMIS_Pasien;
use App\Models\Smis_Rad_Layanan;
use App\Models\SmisAdmPrototype;
use App\Models\SmisHrdEmployee;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MedicalRecordService
{
    function upload_signature($req)
    {
        ERekamMedis::findOrFail($req->dokumen);
        $folderPath = public_path('signature_patient/');

        $image_parts = explode(";base64,", $req->signed);

        $image_type_aux = explode("image/", $image_parts[0]);

        $image_type = $image_type_aux[1];

        $image_base64 = base64_decode($image_parts[1]);

        $fileName = uniqid() . '.' . $image_type;
        $file = $folderPath . $fileName;
        file_put_contents($file, $image_base64);

        $query = ERekamMedis::where('id', $req->dokumen)->update([
            'signature_pasien' => $fileName,
            'id_verifikator' => Auth::user()->id,
            'nama_verifikator' => Auth::user()->realname,
            'tanggal_update' => date('Y-m-d H:i:s', strtotime('now')),
            'updated_at' => date('Y-m-d H:i:s', strtotime('now'))
        ]);
        return $query;
    }

    function verifikasi($req){
        ERekamMedis::findOrFail($req->dokumen);
        $query = ERekamMedis::where('id', $req->dokumen)->update([
            'status' => 1,
            'id_verifikator' => Auth::user()->id,
            'nama_verifikator' => Auth::user()->realname,
            'tanggal_update' => date('Y-m-d H:i:s', strtotime('now')),
            'updated_at' => date('Y-m-d H:i:s', strtotime('now'))
        ]);
        return $query;
    }

    function data_admission_note($doc)
    {
        $layanan = SMIS_LayananPasien::join('smis_rg_patient', 'smis_rg_layananpasien.nrm', 'smis_rg_patient.id')
            ->leftJoin('smis_rg_asuransi', 'smis_rg_layananpasien.asuransi', 'smis_rg_asuransi.id')
            ->select(
                'smis_rg_layananpasien.nama_pasien',
                'smis_rg_layananpasien.umur',
                'smis_rg_layananpasien.nrm',
                'smis_rg_layananpasien.asuransi',
                'smis_rg_layananpasien.tanggal_inap',
                'smis_rg_layananpasien.id_dokter',
                'smis_rg_layananpasien.nama_dokter',
                'smis_rg_layananpasien.carabayar',
                'smis_rg_layananpasien.kamar_inap',
                'smis_rg_layananpasien.indikasi_rawat_inap',
                'smis_rg_patient.tgl_lahir',
                'smis_rg_patient.alamat',
                'smis_rg_patient.nama_kelurahan',
                'smis_rg_patient.nama_kecamatan',
                'smis_rg_patient.nama_kabupaten',
        )
            ->where('smis_rg_layananpasien.id', $doc->noreg)->first();
        $data['dokumen'] = $doc;
        $data['layanan'] = $layanan;
        $data['prototype'] = SmisAdmPrototype::where('slug', $layanan->kamar_inap)->first();
        $data['employee'] = SmisHrdEmployee::where('id', $layanan->id_dokter)->first();
        return $data;
    }

    function save_admission_note($req, $doc)
    {
        $update = DB::table('smis_rg_layananpasien')->where('id', $doc->noreg)->update([
            'indikasi_rawat_inap' => $req->indikasi
        ]);

        return $update;
    }

    function data_identitas_pasien($id)
    {
        $rm = ERekamMedis::findOrFail($id);
        $data['pasien'] = SMIS_Pasien::get($rm->nrm, $rm->profile_number);
        $data['dokumen'] = $id;
        $data['rm'] = $rm;
        return $data;
    }

    function get_patient_and_history_kunjungan($req)
    {
        $query_pasien = SMIS_Pasien::select('*');
        $query_history = SMIS_LayananPasien::join('smis_rg_patient', 'smis_rg_patient.id', 'smis_rg_layananpasien.nrm')
            ->leftJoin('smis_mr_diagnosa', 'smis_rg_layananpasien.id', 'smis_mr_diagnosa.noreg_pasien')
            ->select('smis_rg_layananpasien.id', 'smis_rg_layananpasien.tanggal', 'smis_rg_layananpasien.jenislayanan',
                'smis_rg_layananpasien.last_ruangan', 'smis_rg_layananpasien.last_nama_ruangan', 'smis_rg_layananpasien.nrm',
                'smis_rg_layananpasien.nama_pasien', 'smis_mr_diagnosa.diagnosa', 'smis_mr_diagnosa.ruangan');
        if ($req->nrm != '' && $req->nrm != null) {
            $query_pasien->where('id', '=',$req->nrm);
            $query_history->where('smis_rg_layananpasien.nrm', $req->nrm);
        }
        $data['patient'] = $query_pasien->first();
        $data['history'] = $query_history->orderBy('tanggal', 'desc')->get();

        $data['layanan'] = count($data['history']) > 0 ? $data['history'][0] : null;
        $data['pemeriksaan'] = Smis_Lab_Layanan::where('prop', '')->get();
        $data['pemeriksaan_radiologi'] = Smis_Rad_Layanan::where('prop', '')->get();

        return $data;
    }

    function create_dokumen_kunjungan($req)
    {
        $layanan = SMIS_LayananPasien::findOrFail($req->noreg);
        $pasien = SMIS_Pasien::where('id', $layanan->nrm)->where('prop', '')->first();
        $query = DokumenKunjungan::create([
            'tanggal' => date('Y-m-d', strtotime($layanan->tanggal)),
            'noreg' => $req->noreg,
            'nama_dokumen' => $req->jenis_dokumen,
            'ruangan' => $layanan ? $layanan->last_ruangan : '',
            'nrm' => $pasien ? $pasien->id : 0,
            'nama_pasien' => $pasien ? $pasien->nama : "",
            'status' => 0,
            'id_verifikator' => 0,
            'nama_verifikator' => '',
            'tanggal_update' => date('Y-m-d H:i:s'),
        ]);

        if ($req->jenis_dokumen == 'Dokumen Asesment Awal Medis Gawat Darurat') {
            DB::table('smis_doc_dokumen_asesment_awal_medis_gawat_darurat')->insert([
                'id_dokumen' => $query->id
            ]);
        }

        return $query;
    }

    function create_sbpk($req)
    {
        $query = Smis_Doc_Sbpk::updateOrCreate([
            'id_dokumen' => $req->id_dokumen
        ], [
            'datang_untuk' => $req->datang_untuk ? $req->datang_untuk : '',
            'datang_untuk_lain' => $req->datang_untuk_lain ? $req->datang_untuk_lain : '',
            'anamnesa' => $req->anamnesa ? $req->anamnesa : '',
            'tindakan' => $req->tindakan ? $req->tindakan : '',
            'tindakan_lain' => $req->tindakan_lain ? $req->tindakan_lain : '',
            'kode_icd_sembilan' => $req->kode_icd_sembilan ? $req->kode_icd_sembilan : '',
        ]);
        return $query;
    }

    function surat_bukti_pelayanan_kesehatan($req, $rs, $ls, $rad)
    {
        $dokumen = DokumenKunjungan::with('sbpk')->where('id', $req->dokumen)->first();
        $data['pasien'] = SMIS_Pasien::findOrFail($dokumen->nrm);
        $data['employee'] = SMIS_HRD_Employee::where('nama', $dokumen->nama_verifikator)->first();
        $data['layanan'] = SMIS_LayananPasien::with(['diagnosa', 'ttv'])->where('id', $dokumen->noreg)->first();
        $data['laboratorium'] = $ls->get($dokumen->noreg);
        $data['radiologi'] = $rad->get($dokumen->noreg);
        $data['terapi'][0] = $rs->get_dfm($dokumen->noreg, $dokumen->ruangan);
        $data['terapi'][1] = $rs->get_dfm3($dokumen->noreg, $dokumen->ruangan);
        $data['dokumen'] = $dokumen;
        return $data;
    }
    function create_rpp($req)
    {
        $data = [
            'tanggal_operasi' => $req->tanggal_operasi ? $req->tanggal_operasi : '',
            'jenis_operasi' => $req->jenis_operasi ? $req->jenis_operasi : '',
            'alasan_mrs' => $req->alasan_mrs ? $req->alasan_mrs : '',
            'pemeriksaan_fisik' => $req->pemeriksaan_fisik ? $req->pemeriksaan_fisik : '',
            'dipulangkan' => $req->dipulangkan ? $req->dipulangkan : '',
            'hal_yg_diperhatikan' => $req->hal_yg_diperhatikan ? $req->hal_yg_diperhatikan : '',
            'instruksi_mendesak' => $req->instruksi_mendesak ? $req->instruksi_mendesak : '',
            'kontrol_ke1' => $req->kontrol_ke1 ? $req->kontrol_ke1 : '',
            'kontrol_ke2' => $req->kontrol_ke2 ? $req->kontrol_ke2 : '',
            'kontrol_ke3' => $req->kontrol_ke3 ? $req->kontrol_ke3 : '',
            'kontrol_ke4' => $req->kontrol_ke4 ? $req->kontrol_ke4 : '',
            'disertakan_waktu_pulang' => $req->disertakan_waktu_pulang ? $req->disertakan_waktu_pulang : '',
            'keterangan_foto_rontgent' => $req->keterangan_foto_rontgent ? $req->keterangan_foto_rontgent : '',
            'keterangan_hasil_usg' => $req->keterangan_hasil_usg ? $req->keterangan_hasil_usg : '',
            'keterangan_lain_lain' => $req->keterangan_lain_lain ? $req->keterangan_lain_lain : '',
        ];

        if ($req->verifikator === 'dokter') {
            $data['tgl_ttd_dokter'] = date('Y-m-d H:i:s');
            $data['nama_dokter'] = Auth::user()->realname;
        } else if ($req->verifikator === 'perawat') {
            $data['tgl_ttd_perawat'] = date('Y-m-d H:i:s');
            $data['nama_perawat'] = Auth::user()->realname;
        }
        $query = Smis_Doc_Rpp::updateOrCreate([
            'id_dokumen' => $req->id_dokumen
        ],$data);
        return $query;
    }

    function ringkasan_pulang_pasien($req, $rs, $ls, $rad)
    {
        $dokumen = DokumenKunjungan::with('rpp')->where('id', $req->dokumen)->first();
        $data['pasien'] = SMIS_Pasien::findOrFail($dokumen->nrm);
        $data['employee'] = SMIS_HRD_Employee::where('nama', $dokumen->nama_verifikator)->first();
        $data['dokter'] = SMIS_HRD_Employee::where('nama', $dokumen->rpp ? $dokumen->rpp->nama_dokter : '')->first();
        $data['perawat'] = SMIS_HRD_Employee::where('nama', $dokumen->rpp ? $dokumen->rpp->nama_perawat : '')->first();
        $data['layanan'] = SMIS_LayananPasien::with(['diagnosa', 'ttv'])->where('id', $dokumen->noreg)->first();
        $data['laboratorium'] = $ls->get($dokumen->noreg);
        $data['radiologi'] = $rad->get($dokumen->noreg);
        $data['terapi'][0] = $rs->get_dfm_rpp($dokumen->noreg, $dokumen->ruangan);
        $data['terapi'][1] = $rs->get_dfm2_rpp_kiri($dokumen->noreg, $dokumen->ruangan);
        $data['terapi'][2] = $rs->get_dfm3_rpp($dokumen->noreg, $dokumen->ruangan);
        $data['terapi'][3] = $rs->get_dfm2_rpp($dokumen->noreg, $dokumen->ruangan);
        $data['dokumen'] = $dokumen;
        return $data;
    }

}
