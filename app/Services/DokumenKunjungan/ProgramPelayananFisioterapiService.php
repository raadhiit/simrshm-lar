<?php

namespace App\Services\DokumenKunjungan;

use App\Models\DokumenKunjungan;
use App\Models\DokumenKunjungan\Smis_Doc_Program_Pelayanan_Fisioterapi;
use App\Models\SMIS_LayananPasien;
use App\Models\SmisDocCatatanPerkembanganPasienTerintegrasiRawatInap;
use App\Models\SmisHrdEmployee;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ProgramPelayananFisioterapiService
{
    function data($req) {
        $dokumen = DokumenKunjungan::where('id', $req->dokumen)
            ->with(['rm_pasien:id,nama,kelamin,tempat_lahir,tgl_lahir,alamat,ktp,telpon,kelamin', 'verifikator:id,username', 'program_pelayanan_fisioterapi'])
            ->first();
        $cppt = DokumenKunjungan::where('nrm', '=', $dokumen->nrm)
            ->whereDate('tanggal', Carbon::today())
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
        $data['layanan'] = SMIS_LayananPasien::where('id', $req->noreg)->select('id', 'carabayar', 'nobpjs', 'no_sep_rj')->first();
        $data['program_pelayanan_fisioterapi'] = $dokumen->program_pelayanan_fisioterapi;
        $data['data_cppt'] = $data_cppt;

        return $data;
    }

    function tambah_program($req) {

        $cek = Smis_Doc_Program_Pelayanan_Fisioterapi::where('id_dokumen', $req->dokumen)->first();
        $tmp_program = $cek ? json_decode($cek->program) : [];
        $tmp_program[] = array(
            'tgl_pelayanan' => $req->tgl_pelayanan,
            'jenis_pelayanan' => $req->jenis_pelayanan,
            'no_sep' => $req->no_sep
        );
        $tmp_program = json_encode($tmp_program);

        $ins = Smis_Doc_Program_Pelayanan_Fisioterapi::updateOrCreate([
            'id_dokumen' => $req->dokumen
        ], [
            'program' => $tmp_program
        ]);
    
        return $ins;
    }

    function verif_dokter($req) {
        $cek = Smis_Doc_Program_Pelayanan_Fisioterapi::where('id_dokumen', $req->dokumen)->first();
        $tmp_program = $cek ? json_decode($cek->program) : [];
        
        $tmp_program[$req->index_program]->id_dokter = Auth::user()->id;
        $tmp_program[$req->index_program]->nama_dokter = Auth::user()->realname;

        $tmp_program = json_encode($tmp_program);

        $ins = Smis_Doc_Program_Pelayanan_Fisioterapi::updateOrCreate([
            'id_dokumen' => $req->dokumen
        ], [
            'program' => $tmp_program
        ]);
    
        return $ins;
    }

    function ttd_pasien($req) {
        $folderPath = public_path('signature_patient/');

        $image_parts = explode(";base64,", $req->signed);

        $image_type_aux = explode("image/", $image_parts[0]);

        $image_type = $image_type_aux[1];

        $image_base64 = base64_decode($image_parts[1]);

        $fileName = uniqid() . '.' . $image_type;
        $file = $folderPath . $fileName;
        file_put_contents($file, $image_base64);

        $cek = Smis_Doc_Program_Pelayanan_Fisioterapi::where('id_dokumen', $req->dokumen)->first();
        $tmp_program = $cek ? json_decode($cek->program) : [];
        $tmp_program[$req->index_program]->nama_pasien = $req->nama_pasien;
        $tmp_program[$req->index_program]->signature_pasien = $fileName;
        $tmp_program = json_encode($tmp_program);

        $ins = Smis_Doc_Program_Pelayanan_Fisioterapi::updateOrCreate([
            'id_dokumen' => $req->dokumen
        ], [
            'program' => $tmp_program
        ]);
    
        return $ins;
    }

    function verifikasi_dokumen($data)
    {
        // dd($data);
        $verif = DokumenKunjungan::where('id', $data->dokumen ?? $data->id_dokumen)->update([
            'status' => 1,
            'id_verifikator' => Auth::user()->id,
            'nama_verifikator' => Auth::user()->realname,
            'noreg_selesai' => $data->noreg_selesai,
            'tanggal_update' => date('Y-m-d H:i:s'),
        ]);

        return $verif;
    }
}
