<?php

namespace App\Services\DokumenKunjungan;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\DokumenKunjungan;
use App\Models\SMIS_LayananPasien;
use App\Models\SMIS_Pasien;
use App\Models\SMIS_Diagnosa;
use App\Models\SmisHrdEmployee;
use App\Models\DokumenKunjungan\SmisDocRekonsiliasiObat;

/**
 * Class RekonsiliasiObatService.
 */
class RekonsiliasiObatService
{
	public function data(Request $req)
	{
		$dokumen = DokumenKunjungan::with('rekonsiliasi_obat')->findOrFail($req->dokumen);
        $single_data = SmisDocRekonsiliasiObat::where('id_dokumen', $dokumen->id)->first();
        $data = SmisDocRekonsiliasiObat::where('id_dokumen', $dokumen->id)->get();
        $verifikator_apoteker = null;
        $verifikator_dokter = SmisHrdEmployee::where('nama', $dokumen->nama_verifikator)->first();
        if ($single_data != null) {
            $verifikator_apoteker = SmisHrdEmployee::where('nama', $single_data->nama_apoteker)->first();
        }
        $diagnosa = SMIS_Diagnosa::where('noreg_pasien', $dokumen->noreg)->where('prop', '')->orderBy('id', 'DESC')->first();
        $layanan = SMIS_LayananPasien::where('id', $dokumen->noreg)->first();
        return array(
        	'dokumen' => $dokumen,
        	'data' => $data,
            'single_data' => $single_data,
            'layanan' => $layanan,
            'pasien' => SMIS_Pasien::get($dokumen->nrm),
            'diagnosa' => $diagnosa ? $diagnosa->diagnosa : '',
            'verifikator_apoteker' => $verifikator_apoteker,
            'verifikator_dokter' => $verifikator_dokter,
        );
	}

	public function store(Request $req)
	{
        $result = true;
        $n_data = $req->id ? count($req->id) : 0;
        for ($i = 0; $i < $n_data; $i++) {
            if ($req->id[$i] == null || $req->id[$i] == 0) {
        		$result = SmisDocRekonsiliasiObat::create([
                    'id_dokumen' => $req->dokumen,
                    'id_obat' => isset($req->id_obat[$i]) ? $req->id_obat[$i] : 0,
                    'nama_obat' => isset($req->nama_obat[$i]) ? $req->nama_obat[$i] : '',
                    'dosis' => isset($req->dosis[$i]) ? $req->dosis[$i] : '',
                    'aturan_pakai' => isset($req->aturan_pakai[$i]) ? $req->aturan_pakai[$i] : '',
                    'cara_pemberian' => isset($req->cara_pemberian[$i]) ? $req->cara_pemberian[$i] : '',
                    'tanggal_mulai' => isset($req->tanggal_mulai[$i]) ? $req->tanggal_mulai[$i] : '',
                    'tanggal_selesai' => isset($req->tanggal_selesai[$i]) ? $req->tanggal_selesai[$i] : '',
                    'pengobatan_admisi' => isset($req->pengobatan_admisi[$i]) ? $req->pengobatan_admisi[$i] : '',
                    'tl_pengobatan_transfer' => isset($req->tl_pengobatan_transfer[$i]) ? $req->tl_pengobatan_transfer[$i] : '',
                    'tl_pengobatan_discharge' => isset($req->tl_pengobatan_discharge[$i]) ? $req->tl_pengobatan_discharge[$i] : '',
                    'perubahan_aturan_pakai' => isset($req->perubahan_aturan_pakai[$i]) ? $req->perubahan_aturan_pakai[$i] : '',
                ]);
                if (!$result) {
                    return false;
                }
            } else {
                if ($req->deleted[$i] == true) {
                    $result = SmisDocRekonsiliasiObat::where('id', $req->id[$i])->delete();
                    if (!$result) {
                        return false;
                    }
                } else {
                    $result = SmisDocRekonsiliasiObat::where('id', $req->id[$i])->update([
                        'id_dokumen' => $req->dokumen,
                        'id_obat' => isset($req->id_obat[$i]) ? $req->id_obat[$i] : 0,
                        'nama_obat' => isset($req->nama_obat[$i]) ? $req->nama_obat[$i] : '',
                        'dosis' => isset($req->dosis[$i]) ? $req->dosis[$i] : '',
                        'aturan_pakai' => isset($req->aturan_pakai[$i]) ? $req->aturan_pakai[$i] : '',
                        'cara_pemberian' => isset($req->cara_pemberian[$i]) ? $req->cara_pemberian[$i] : '',
                        'tanggal_mulai' => isset($req->tanggal_mulai[$i]) ? $req->tanggal_mulai[$i] : '',
                        'tanggal_selesai' => isset($req->tanggal_selesai[$i]) ? $req->tanggal_selesai[$i] : '',
                        'pengobatan_admisi' => isset($req->pengobatan_admisi[$i]) ? $req->pengobatan_admisi[$i] : '',
                        'tl_pengobatan_transfer' => isset($req->tl_pengobatan_transfer[$i]) ? $req->tl_pengobatan_transfer[$i] : '',
                        'tl_pengobatan_discharge' => isset($req->tl_pengobatan_discharge[$i]) ? $req->tl_pengobatan_discharge[$i] : '',
                        'perubahan_aturan_pakai' => isset($req->perubahan_aturan_pakai[$i]) ? $req->perubahan_aturan_pakai[$i] : '',
                    ]);
                    if (!$result) {
                        return false;
                    }
                }
            }
        }
        return $result;
	}

    public function update_info_apoteker(Request $req) {
        return SmisDocRekonsiliasiObat::where('id_dokumen', $req->dokumen)->update([
            'id_apoteker' => $req->id_apoteker ? $req->id_apoteker : '',
            'nama_apoteker' => $req->nama_apoteker ? $req->nama_apoteker : '',
        ]);
    }
}
