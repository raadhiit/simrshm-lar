<?php

namespace App\Services;

use App\Models\Smis_Doc_General_Consent;
use App\Models\DokumenKunjungan;
use App\Models\Smis_Doc_Persetujuan_Transfusi_Darah;
use App\Models\SMIS_Er_Resep;
use App\Models\Smis_Lab_Hasil;
use App\Models\Smis_Lab_Layanan;
use App\Models\SMIS_LayananPasien;
use App\Models\Smis_Mjm_Kelas;
use App\Models\Smis_Mr_Icd;
use App\Models\Smis_Rad_Layanan;
use App\Models\SmisAdmPrototype;
use App\Models\SmisAdmSettings;
use App\Models\SmisHrdEmployee;
use Illuminate\Support\Facades\Auth;

class PersetujuanTransfusiDarahService
{
    function data($req)
    {
        $data['dokumen'] = DokumenKunjungan::with('persetujuan_transfusi_darah')
            ->leftJoin('smis_adm_user', 'smis_adm_user.id', 'dokumen_kunjungan_pasien.id_verifikator')
            ->leftJoin('smis_rg_patient', 'smis_rg_patient.id', 'dokumen_kunjungan_pasien.nrm')
            ->select('dokumen_kunjungan_pasien.*', 'smis_adm_user.username','smis_rg_patient.alamat')
            ->where('dokumen_kunjungan_pasien.id', $req->dokumen)->first();
        $data['employee'] = SmisHrdEmployee::where('username', $data['dokumen']->username)->first();
        $data['dokter_pelaksana'] = SmisHrdEmployee::where([['jabatan', 1],['keluar',0],['prop','']])->get();
        $data['pemberi_informasi'] = SmisHrdEmployee::where([['jabatan', 1],['keluar',0],['prop','']])->orWhere([['jabatan',2],['keluar',0],['prop','']])->get();
        $layanan = SMIS_LayananPasien::with(['diagnosa', 'pesanan_lab', 'pesanan_radiologi'])
            ->join('smis_rg_patient', 'smis_rg_patient.id', 'smis_rg_layananpasien.nrm')
            ->select('smis_rg_patient.telpon', 'smis_rg_patient.nama', 'smis_rg_patient.tgl_lahir', 'smis_rg_patient.kelamin',
                'smis_rg_patient.alamat', 'smis_rg_patient.rt', 'smis_rg_patient.rw', 'smis_rg_patient.nama_kelurahan',
                'smis_rg_patient.nama_kecamatan', 'smis_rg_patient.nama_kabupaten', 'smis_rg_layananpasien.id',
                'smis_rg_layananpasien.nrm', 'smis_rg_patient.ktp', 'smis_rg_layananpasien.umur', 'smis_rg_layananpasien.carabayar',
                'smis_rg_layananpasien.nama_pasien', 'smis_rg_layananpasien.last_ruangan')
            ->where('smis_rg_layananpasien.id', $data['dokumen']->noreg)
            ->first();
        $data['diagnosa']=Smis_Mr_Icd::where('prop','')->get();
        $data['layanan'] = $layanan;
        return $data;
    }

    function create($req)
    {
        $itas = Smis_Doc_Persetujuan_Transfusi_Darah::updateOrCreate([
            'id_dokumen' => $req->dokumen
        ], [
            'id_dokter_pelaksana' => $req->id_dokter_pelaksana,
            'id_pemberi_informasi' => $req->id_pemberi_informasi,
            'penerima_informasi' => $req->penerima_informasi,
            'id_diagnosis' => $req->id_diagnosis,
            'checklist' => $req->checklist,
            'alternatif' => $req->alternatif,
            'lain_lain' => $req->lain_lain,
            'pengampu' => $req->pengampu,
            'hubungan' => $req->hubungan,
            'alamat_pengampu' => $req->alamat_pengampu,
            'tgl_lahir_pengampu' => $req->tgl_lahir_pengampu,
            'alamat_pasien'=>$req->alamat_pasien,
            'status_tindakan' => $req->status_tindakan,
            'hubungan' => $req->hubungan,
            'tanggal_diampu' => ($req->tanggal_diampu ? date('Y-m-d', strtotime($req->tanggal_diampu)) : date('Y-m-d')) . ' ' . ($req->jam_ttd ? $req->jam_ttd . ':00' : date('H:i:s')),
        ]);
    
        return $itas;
    }

    function save_signature($data)
    {
        try {
            $folderPath = public_path('signature_patient/');

            $image_parts = explode(";base64,", $data->signed!=null?$data->signed:$data->signed2);

            $image_type_aux = explode("image/", $image_parts[0]);

            $image_type = $image_type_aux[1];

            $image_base64 = base64_decode($image_parts[1]);

            $fileName = uniqid() . '.' . $image_type;
            $file = $folderPath . $fileName;
            file_put_contents($file, $image_base64);
            if ($data->signed!=null) {
                Smis_Doc_Persetujuan_Transfusi_Darah::where('id_dokumen', $data->dokumen)->update([
                'ttd_keluarga' => $fileName,
                'nama_keluarga'=> $data->nama_keluarga,
                ]);
            }else{
                Smis_Doc_Persetujuan_Transfusi_Darah::where('id_dokumen', $data->dokumen)->update([
                'ttd_pengampu' => $fileName,
                ]);
            }
            return [
                'status' => true,
                'message' => 'OK'
            ];
        } catch (\Throwable $th) {
            return [
                'status' => false,
                'message' => $th->getMessage()
            ];
        }
    }

    function save_ttd_dokter($req){
        $ttd = Smis_Doc_Persetujuan_Transfusi_Darah::where('id_dokumen', $req->dokumen)->update([
            'username_ttd_dokter' => Auth::user()->username,
        ]);
        
    }
}
