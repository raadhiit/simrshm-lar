<?php

namespace App\Services\DokumenKunjungan;

use App\Models\DokumenKunjungan;
use App\Models\DokumenKunjungan\Smis_Doc_Formulir_Klaim_Fisioterapi;
use App\Models\Smis_Lab_Hasil;
use App\Models\Smis_Lab_Layanan;
use App\Models\SMIS_LayananPasien;
use App\Models\Smis_Rad_Layanan;
use App\Models\SmisDocCatatanPerkembanganPasienTerintegrasiRawatInap;
use App\Models\SmisDocPenolakanRawatInap;
use App\Models\SmisHrdEmployee;
use App\Services\DokumenKunjunganService;

class FormulirKlaimFisioterapiService
{
    function data($req) {
        $dokumen = DokumenKunjungan::where('id', $req->dokumen)
            ->with(['rm_pasien:id,nama,kelamin,tempat_lahir,tgl_lahir,alamat,ktp,telpon,kelamin', 'verifikator:id,username', 'formulir_klaim_fisioterapi'])
            ->first();
        $cppt = DokumenKunjungan::where('noreg', '=', $dokumen->noreg)
            ->where('nrm', '=', $dokumen->nrm)
            ->where('nama_dokumen', 'like', '%Catatan Perkembangan Pasien Terintegrasi (CPPT)%')
            ->orderBy('id', 'desc')
            ->first();
        $data_cppt = null;
        if ($cppt) {
            $data_cppt = SmisDocCatatanPerkembanganPasienTerintegrasiRawatInap::with(['ttv', 'diagnosa', 'lab', 'rad', 'resep.detail'])
                ->select('smis_doc_catatan_perkembangan_pasien_terintegrasi_rawat_inap.*')
                ->where('smis_doc_catatan_perkembangan_pasien_terintegrasi_rawat_inap.id_dokumen', $cppt->id)
                ->where('smis_doc_catatan_perkembangan_pasien_terintegrasi_rawat_inap.prop', '')->first();
        }

        if (isset($dokumen->verifikator)) {
            $verifikator = SmisHrdEmployee::where('username', $dokumen->verifikator->username)
            ->get(['id', 'nama', 'username', 'ttd']);
            $data['employee'] = $verifikator->first();
        }
        $data['dokumen'] = $dokumen;
        $data['pasien'] = $dokumen->rm_pasien;
        $data['layanan'] = SMIS_LayananPasien::where('id', $dokumen->noreg)->first();
        $data['data'] = $dokumen->formulir_klaim_fisioterapi;
        $data['data_cppt'] = $data_cppt;
        $data['pemeriksaan'] = Smis_Lab_Layanan::where('prop', '')->get();
        $data['pemeriksaan_radiologi'] = Smis_Rad_Layanan::where('prop', '')->get();
        $data['master_hasil'] = Smis_Lab_Hasil::where('prop', '')->orderBy('grup')->get();

        return $data;
    }

    function store($req)
    {
        Smis_Doc_Formulir_Klaim_Fisioterapi::updateOrCreate([
            'id_dokumen' => $req->dokumen,
        ], [
            'radio_hubungan' => $req->radio_hubungan ? $req->radio_hubungan : '',
            'tanggal_pelayanan' => $req->tanggal_pelayanan ? $req->tanggal_pelayanan : '',
            'anamnesa' => $req->anamnesa ? $req->anamnesa : '',
            'pemeriksaan_fisik' => $req->pemeriksaan_fisik ? $req->pemeriksaan_fisik : '',
            'diagnosa_medis' => $req->diagnosa_medis ? $req->diagnosa_medis : '',
            'diagnosa_fungsi' => $req->diagnosa_fungsi ? $req->diagnosa_fungsi : '',
            'pemeriksaan_penunjang' => $req->pemeriksaan_penunjang ? $req->pemeriksaan_penunjang : '',
            'tata_laksana' => $req->tata_laksana ? $req->tata_laksana : '',
            'anjuran' => $req->anjuran ? $req->anjuran : '',
            'evaluasi' => $req->evaluasi ? $req->evaluasi : '',
            'tanggal_dokumen' => $req->tanggal_dokumen ? $req->tanggal_dokumen : '',
        ]);

        if (isset($req->password)) {
            $dokumen_kunjungan_service = new DokumenKunjunganService();

            $dokumen_kunjungan_service->verifikasi_dokumen($req);
        }

        return $this->data($req);
    }
}
