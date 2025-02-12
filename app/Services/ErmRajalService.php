<?php

namespace App\Services;

use App\Models\DokumenKunjungan;
use App\Models\Smis_Doc_Catatan_Perkembangan_Pasien_Terintegrasi;
use App\Models\SMIS_LabPesanan;
use App\Models\Smis_Mr_Tanda_Vital;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ErmRajalService
{
    function save_cppt($req)
    {
        $dokumen = DokumenKunjungan::findOrFail($req->id);
        $body = json_decode($req->body);
        switch ($req->jenis) {
            case 'ns':
                $query = Smis_Doc_Catatan_Perkembangan_Pasien_Terintegrasi::updateOrCreate([
                    'id_dokumen' => $req->id
                ], [
                    'tanggal_ns' => date('Y-m-d H:i:s'),
                    'active_form' => $req->active_form ? json_encode(json_decode($req->active_form)) : '[]',
                    'id_ppa' => $body->id_ppa ? $body->id_ppa : '0',
                    'ppa' => $body->ppa ? $body->ppa : '',
                    'subjective_ns' => $body->subjective ? $body->subjective : '',
                    'asesmen_ns' => $body->asesmen ? $body->asesmen : '',
                    'planning_ns' => $body->planning ? $body->planning : '',
                    'instruksi_ns' => $body->instruksi ? $body->instruksi : '',
                    'status_ns' => 1,
                    'id_verifikator_ns' => Auth::user()->id,
                    'nama_verifikator_ns' => Auth::user()->realname,
                ]);

                DB::table('smis_mr_tanda_vital')->updateOrInsert([
                    'nrm_pasien' => $dokumen->nrm,
                    'noreg_pasien' => $dokumen->noreg
                ], [
                    'keadaan_umum' => $body->keadaan_umum,
                    'kesadaran' => $body->kesadaran,
                    'tensi' => $body->tensi,
                    'nadi' => $body->nadi,
                    'suhu' => $body->suhu,
                    'rr' => $body->rr,
                    'spo2' => $body->spo2,
                    'status_gizi' => $body->status_gizi,
                    'tinggi_badan' => $body->tinggi_badan,
                    'berat_badan' => $body->berat_badan,
                ]);

                break;
            case 'dr':
                $file_name = '';
                if ($req->file('dokumen_penunjang')) {
                    $file_name = $this->upload_file_dokumen_penunjang($req);
                }
                if ($file_name != '') {
                    $query = Smis_Doc_Catatan_Perkembangan_Pasien_Terintegrasi::updateOrCreate([
                        'id_dokumen' => $req->id
                    ], [
                        'tanggal_dr' => date('Y-m-d H:i:s'),
                        'active_form' => $req->active_form ? json_encode(json_decode($req->active_form)) : '[]',
                        'id_ppa_dr' => $body->id_ppa ? $body->id_ppa : '0',
                        'ppa_dr' => $body->ppa ? $body->ppa : '',
                        'subjective_dr' => $body->subjective ? $body->subjective : '',
                        'tindak_lanjut_dr' => $body->tindak_lanjut ? $body->tindak_lanjut : '',
                        'instruksi_dr' => $body->instruksi ? $body->instruksi : '',
                        'dokumen_penunjang' => $file_name,
                        'status_dr' => 1,
                        'id_verifikator_dr' => Auth::user()->id,
                        'nama_verifikator_dr' => Auth::user()->realname,
                    ]);
                }else{
                    $query = Smis_Doc_Catatan_Perkembangan_Pasien_Terintegrasi::updateOrCreate([
                        'id_dokumen' => $req->id
                    ], [
                        'tanggal_dr' => date('Y-m-d H:i:s'),
                        'active_form' => $req->active_form ? json_encode(json_decode($req->active_form)) : '[]',
                        'id_ppa_dr' => $body->id_ppa ? $body->id_ppa : '0',
                        'ppa_dr' => $body->ppa ? $body->ppa : '',
                        'subjective_dr' => $body->subjective ? $body->subjective : '',
                        'lain_lain_dr' => $body->lain_lain ? $body->lain_lain : '',
                        'tindak_lanjut_dr' => $body->tindak_lanjut ? $body->tindak_lanjut : '',
                        'instruksi_dr' => $body->instruksi ? $body->instruksi : '',
                        'status_dr' => 1,
                        'id_verifikator_dr' => Auth::user()->id,
                        'nama_verifikator_dr' => Auth::user()->realname,
                    ]);
                }
                
                $selected = Smis_Doc_Catatan_Perkembangan_Pasien_Terintegrasi::where('id_dokumen', $req->id)->first();
                if ($selected->id_pesanan_lab != 0) {
                    DB::table('smis_lab_pesanan')->where('id', $selected->id_pesanan_lab)->update([
                        'keluhan_klinis' => $body->subjective
                    ]);
                }
                break;
            case 'fp':
                $query = Smis_Doc_Catatan_Perkembangan_Pasien_Terintegrasi::updateOrCreate([
                    'id_dokumen' => $req->id
                ], [
                    'tanggal_fp' => date('Y-m-d H:i:s'),
                    'active_form' => $req->active_form ? json_encode(json_decode($req->active_form)) : '[]',
                    'id_ppa_fp' => $body->id_ppa ? $body->id_ppa : '0',
                    'ppa_fp' => $body->ppa ? $body->ppa : '',
                    'subjective_fp' => $body->subjective ? $body->subjective : '',
                    'objective_fp' => $body->objective ? $body->objective : '',
                    'asesmen_fp' => $body->asesmen ? $body->asesmen : '',
                    'planning_fp' => $body->planning ? $body->planning : '',
                    'instruksi_fp' => $body->instruksi ? $body->instruksi : '',
                    'status_fp' => 1,
                    'id_verifikator_fp' => Auth::user()->id,
                    'nama_verifikator_fp' => Auth::user()->realname,
                ]);
                break;
            case 'apt':
                $query = Smis_Doc_Catatan_Perkembangan_Pasien_Terintegrasi::updateOrCreate([
                    'id_dokumen' => $req->id
                ], [
                    'tanggal_apt' => date('Y-m-d H:i:s'),
                    'active_form' => $req->active_form ? json_encode(json_decode($req->active_form))  : '[]',
                    'id_ppa_apt' => $body->id_ppa ? $body->id_ppa : '0',
                    'ppa_apt' => $body->ppa ? $body->ppa : '',
                    'subjective_apt' => $body->subjective ? $body->subjective : '',
                    'objective_apt' => $body->objective ? $body->objective : '',
                    'asesmen_apt' => $body->asesmen ? $body->asesmen : '',
                    'planning_apt' => $body->planning ? $body->planning : '',
                    'instruksi_apt' => $body->instruksi ? $body->instruksi : '',
                    'status_apt' => 1,
                    'id_verifikator_apt' => Auth::user()->id,
                    'nama_verifikator_apt' => Auth::user()->realname,
                ]);
                break;
            default:
                $query = false;
                break;
        }
        DokumenKunjungan::where('id',$req->id)->update([
            'status' => 1,
            'id_verifikator' => Auth::user()->id,
            'nama_verifikator' => Auth::user()->realname
        ]);
        return $query;
    }

    function upload_file_dokumen_penunjang($req)
    {
        $file = $req->file('dokumen_penunjang');
        $nama_file = time() . $file->getClientOriginalName();
        $tujuan_upload = 'file_dokumen_penunjang_eksternal';
        $file->move($tujuan_upload, $nama_file);
        return $nama_file;
    }
}
