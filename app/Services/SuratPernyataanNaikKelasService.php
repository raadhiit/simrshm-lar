<?php

namespace App\Services;

use App\Models\Smis_Doc_Asesment_Medis_Awal;
use App\Models\Smis_Doc_General_Consent;
use App\Models\DokumenKunjungan;
use App\Models\Smis_Doc_Surat_Pernyataan_Naik_Kelas;
use App\Models\SMIS_Er_Resep;
use App\Models\Smis_Lab_Hasil;
use App\Models\Smis_Lab_Layanan;
use App\Models\SMIS_LayananPasien;
use App\Models\Smis_Mjm_Kelas;
use App\Models\Smis_Mr_Icd;
use App\Models\SMIS_Pasien;
use App\Models\Smis_Rad_Layanan;
use App\Models\SmisAdmPrototype;
use App\Models\SmisAdmSettings;
use App\Models\SmisHrdEmployee;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Auth;

class SuratPernyataanNaikKelasService
{
    function create($data)
    {
        $spnk = Smis_Doc_Surat_Pernyataan_Naik_Kelas::updateOrCreate([
            'id_dokumen' => $data->id_dokumen,
        ], [
            'nama_pengampu' => $data->nama_kerabat,
            'alamat_pengampu' => $data->alamat_kerabat,
            'telp_pengampu' => $data->telp_kerabat,
            'hubungan' => $data->hubungan,
            'nama_pasien' => $data->nama_pasien,
            'nobpjs_pasien' => $data->nobpjs_pasien,
            'hak_kelas' => $data->hak_kelas_rawat,
            'kelas_ditempati' => $data->kelas_rawat_sekarang,
            'tgl_ttd' => date('Y-m-d',strtotime($data->tanggal)),
        ]);
        return $spnk;
    }

    function data($req)
    {
        $data['dokumen'] = DokumenKunjungan::with('surat_pernyataan_naik_kelas')
            ->leftJoin('smis_adm_user', 'smis_adm_user.id', 'dokumen_kunjungan_pasien.id_verifikator')
            ->select('dokumen_kunjungan_pasien.*', 'smis_adm_user.username')
            ->where('dokumen_kunjungan_pasien.id', $req->dokumen)->first();
        $data['pasien'] = SMIS_Pasien::where('id', $data['dokumen']->nrm)->where('prop', '')->first();
        $data['employee'] = SmisHrdEmployee::where('username', $data['dokumen']->username)->first();
        $data['data_ppa'] = SmisHrdEmployee::where('nama', $data['dokumen']->ppa)->first();
        $data['dokter_pelaksana'] = SmisHrdEmployee::where([['jabatan', 1],['keluar',0],['prop','']])->get();
        $data['pemberi_informasi'] = SmisHrdEmployee::where([['jabatan', 1],['keluar',0],['prop','']])->orWhere([['jabatan',2],['keluar',0],['prop','']])->get();
        $layanan = SMIS_LayananPasien::with(['diagnosa', 'pesanan_lab', 'pesanan_radiologi'])
            ->join('smis_rg_patient', 'smis_rg_patient.id', 'smis_rg_layananpasien.nrm')
            ->select('smis_rg_patient.telpon', 'smis_rg_patient.nama', 'smis_rg_patient.tgl_lahir', 'smis_rg_patient.kelamin',
                'smis_rg_patient.alamat', 'smis_rg_patient.rt', 'smis_rg_patient.rw', 'smis_rg_patient.nama_kelurahan',
                'smis_rg_patient.nama_kecamatan', 'smis_rg_patient.nama_kabupaten', 'smis_rg_layananpasien.id',
                'smis_rg_layananpasien.nrm','smis_rg_patient.nobpjs', 'smis_rg_patient.ktp', 'smis_rg_layananpasien.umur', 'smis_rg_layananpasien.carabayar',
                'smis_rg_layananpasien.nama_pasien', 'smis_rg_layananpasien.last_ruangan')
            ->where('smis_rg_layananpasien.id', $data['dokumen']->noreg)
            ->first();
        $data['layanan'] = $layanan;
        return $data;

    }

    function save_signature($data)
    {
        try {
            $folderPath = public_path('signature_patient/');

            $image_parts = explode(";base64,", isset($data->signature) ? $data->signature: $data->signature_kerabat);

            $image_type_aux = explode("image/", $image_parts[0]);

            $image_type = $image_type_aux[1];

            $image_base64 = base64_decode($image_parts[1]);

            $fileName = uniqid() . '.' . $image_type;
            $file = $folderPath . $fileName;
            file_put_contents($file, $image_base64);

            if(isset($data->signature)){
                Smis_Doc_Surat_Pernyataan_Naik_Kelas::where('id_dokumen', $data->id_dokumen)->update([
                    'nama_saksi' => $data->nama_saksi,
                    'ttd_saksi' => $fileName
                ]);
            }else{
                Smis_Doc_Surat_Pernyataan_Naik_Kelas::where('id_dokumen', $data->id_dokumen)->update([
                    'nama_pernyataan' => $data->nama_kerabat,
                    'ttd_pernyataan' => $fileName
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

    function verifikasi_dokumen_kunjungan(Request $req, DokumenKunjunganService $dks)
    {
        try {
            if (Auth::user()->password == md5($req->pass)) {
                $dks->verifikasi_dokumen($req);
//                return redirect('e_rekam_medis/detail/general_consent?dokumen=' . $req->dokumen)
//                    ->with('sukses', 'Dokumen berhasil diverifikasi');
                return back()
                    ->with('sukses', 'Dokumen berhasil diverifikasi');
            }
            return redirect()->back()->with('gagal', 'Password yang anda masukkan salah');
        } catch (\Throwable $th) {
            return redirect()->back()->with('gagal', $th->getMessage());
        }
    }

}
