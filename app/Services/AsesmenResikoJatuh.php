<?php

namespace App\Services;

use App\Models\Smis_Doc_General_Consent;
use App\Models\DokumenKunjungan;
use App\Models\Smis_Doc_Asesment_Praanestesi_Sedasi;
use App\Models\Smis_Doc_Catatan_Perkembangan_Pasien_Terintegrasi;
use App\Models\Smis_Doc_Reasesmen_Resiko_Jatuh;
use App\Models\Smis_Doc_Reasesmen_Resiko_Jatuh_Detail;
use App\Models\SMIS_Er_Resep;
use App\Models\Smis_Lab_Hasil;
use App\Models\Smis_Lab_Layanan;
use App\Models\SMIS_LayananPasien;
use App\Models\Smis_Mjm_Kelas;
use App\Models\Smis_Mr_Icd;
use App\Models\Smis_Rad_Layanan;
use App\Models\SmisAdmPrototype;
use App\Models\SmisAdmSettings;
use App\Models\SmisDocAssesmentUlangNyeriIntervensi;
use App\Models\SmisHrdEmployee;
use Illuminate\Support\Facades\Auth;

class AsesmenResikoJatuh
{
    function create($data)
    {
        $tes = Smis_Doc_Catatan_Perkembangan_Pasien_Terintegrasi::updateOrCreate([
            'id_dokumen' => $data->dokumen,
        ], [
            'id_ppa' => $data->id_ppa,
            'ppa' => $data->ppa,
            'subyektif' => $data->subyektif,
            'instruksi_kesehatan' => $data->instruksi_kesehatan,
        ]);

//        try {
//
//
//            return [
//                'status' => true,
//                'message' => 'OK'
//            ];
//        } catch (\Throwable $th) {
//            return [
//                'status' => false,
//                'message' => $th->getMessage()
//            ];
//        }
    }

    function data($req)
    {
        $data['dokumen'] = DokumenKunjungan::with('catatan_perkembangan_pasien_terintegrasi')
            ->leftJoin('smis_adm_user', 'smis_adm_user.id', 'dokumen_kunjungan_pasien.id_verifikator')
            ->leftJoin('assesment_pra_anestesi_sedasi', 'assesment_pra_anestesi_sedasi.id_dokumen', 'dokumen_kunjungan_pasien.id')
            ->select('dokumen_kunjungan_pasien.*', 'smis_adm_user.username')
            ->where('dokumen_kunjungan_pasien.id', $req->dokumen)->first();

        $data['detail'] = Smis_Doc_Reasesmen_Resiko_Jatuh::where(['id_dokumen' => $req->dokumen])->first();
        $data['detailAsesment'] = Smis_Doc_Reasesmen_Resiko_Jatuh_Detail::where(['id_dokumen' => $req->dokumen]);

        // dd($data['detail']);

        $data['employee'] = SmisHrdEmployee::where('nama', $data['dokumen']->username)->first();
        $data['data_ppa'] = SmisHrdEmployee::where('nama', $data['dokumen']->ppa)->first();

        $layanan = SMIS_LayananPasien::with(['diagnosa', 'pesanan_lab', 'pesanan_radiologi'])
            ->join('smis_rg_patient', 'smis_rg_patient.id', 'smis_rg_layananpasien.nrm')
            ->select('smis_rg_patient.telpon', 'smis_rg_patient.nama', 'smis_rg_patient.tgl_lahir', 'smis_rg_patient.kelamin',
                'smis_rg_patient.pekerjaan',
                'smis_rg_patient.alamat', 'smis_rg_patient.rt', 'smis_rg_patient.rw', 'smis_rg_patient.nama_kelurahan',
                'smis_rg_patient.nama_kecamatan', 'smis_rg_patient.nama_kabupaten', 'smis_rg_layananpasien.id',
                'smis_rg_layananpasien.nrm', 'smis_rg_patient.ktp', 'smis_rg_layananpasien.umur', 'smis_rg_layananpasien.carabayar',
                'smis_rg_layananpasien.nama_pasien', 'smis_rg_layananpasien.last_ruangan')
            ->where('smis_rg_layananpasien.id', $data['dokumen']->noreg)
            ->first();

        $data['layanan'] = $layanan;


        $data['assesment'] = Smis_Doc_Reasesmen_Resiko_Jatuh::where(['id_dokumen' => $req->dokumen]);
        $data['assesmentDetail'] = Smis_Doc_Reasesmen_Resiko_Jatuh_Detail::where(['id_dokumen' => $req->dokumen]);

        $data['detailAssesment'] = [];

        if($data['detail']){
            if(
                ($data['detail']->TotalScore1 <= 24 && $data['detail']->TanggalJam1 != null) ||
                ($data['detail']->TotalScore2 <= 24 && $data['detail']->TanggalJam2 != null) ||
                ($data['detail']->TotalScore3 <= 24 && $data['detail']->TanggalJam3 != null) ||
                ($data['detail']->TotalScore4 <= 24 && $data['detail']->TanggalJam4 != null) ||
                ($data['detail']->TotalScore5 <= 24 && $data['detail']->TanggalJam5 != null)
            ){
                $data['detailAssesment']["RESIKO RENDAH"] = [
                    "Lakukan orientasi kamar pada pasien atau keluarga",
                    "Posisikan tempat tidur serendah mungkin, roda tempat tidur terkunci, kedua sisi pengaman tempat tidur terpasang dengan baik",
                    "Jelaskan pada pasien dan keluarga mengenai fungi pengaman tersebut dan penggunaan bel",
                    "Lantai kamar dan kamar mandi tidak licin",
                    "Pencahayaan yang kuat (sesuai dengan kebutuhan pasien)",
                    "Benda bendapribadi berada dalam jangkauan(telpongenggam,bel, airminum,kacamata)",
                    "Alat bantu berada dalam jangkauan (tongkat, alatpenopang)",
                    "Optimalisasi penggunaan kacamata dan alat bantu dengar(pastikan bersih dan berfungsi)",
                    "Beri edukasi mengenai pencegahan jatuh pada pasien dan keluarga",
                    "Tawarkan kekamar mandi secara teratur",
                    "Usahakan lokasi tempat tidur berdekatan dengan pos perawat (nurse station)/ruangan yang bias dipantau oleh perawat.",
                ];
            }

            if(
                ($data['detail']->TotalScore1 >= 25 && $data['detail']->TotalScore1 <= 50 && $data['detail']->TanggalJam1 != null) ||
                ($data['detail']->TotalScore2 >= 25 && $data['detail']->TotalScore2 <= 50 && $data['detail']->TanggalJam2 != null) ||
                ($data['detail']->TotalScore3 >= 25 && $data['detail']->TotalScore3 <= 50 && $data['detail']->TanggalJam3 != null) ||
                ($data['detail']->TotalScore4 >= 25 && $data['detail']->TotalScore4 <= 50 && $data['detail']->TanggalJam4 != null) ||
                ($data['detail']->TotalScore5 >= 25 && $data['detail']->TotalScore5 <= 50 && $data['detail']->TanggalJam5 != null)
            ){
                $data['detailAssesment']["RESIKO SEDANG"] = [
                    "Tingkatkan observasi bantuan sesuai dengan ambulasi",
                    "Gunakan tempatduduk di kamar mandi padasaatpasien mandi",
                    "Pantau efek obat obatan",
                    "Penggunaan alas kaki yang tidak licin untuk pasien yang dapat berjalan",
                    "Nilai Kemampuan pasien dan Keluarga untuk ke kamar dan bantu bila dibutuhkan",
                    "Monitor Kebutuhan pasien",
                    "Gunakan alat bantu jalan (tongkat, alat penopang)",
                    "Beriedukasi mengenai pencegahan jatuh pada pasien dan keluarga",
                    "Dampingi ke kamar mandi secara teratur",
                    "Benda benda pribadi berada dalam jangkauan (telpon genggam, bel, air minum,kacamata)",
                    "Usahakan lokasi tempat tidur berdekatan dengan pos perawat (nurse station)/ruangan yang bisa dipantau oleh perawat",
                    "Pendampingan dari keluarga",
                ];
            }

            if(
                ($data['detail']->TotalScore1 > 50 && $data['detail']->TanggalJam1 != null) ||
                ($data['detail']->TotalScore2 > 50 && $data['detail']->TanggalJam2 != null) ||
                ($data['detail']->TotalScore3 > 50 && $data['detail']->TanggalJam3 != null) ||
                ($data['detail']->TotalScore4 > 50 && $data['detail']->TanggalJam4 != null) ||
                ($data['detail']->TotalScore5 > 50 && $data['detail']->TanggalJam5 != null)
            ){
                $data['detailAssesment']["RESIKO BERAT"] = [
                    "Pasang tanda peringatan resiko jatuh pada tempat tidur pasten (segitiga kuning)",
                    "Beri penanda berupa label bewarna kuning yang ditempelkan pada gelangi dentitas pasien",
                    "Bantu kebutuhan BAB/BAK denganpenggunaan pispot setiap 2(dua) jam (saat pasien bangun) dan secara periodik (saat malam hari)",
                    "Kunjungi dan amati pasien setiap 1 (satu) jam",
                    "Beri edukasi mengenal pencegahan Jatuh pada pasien dan keluarga",
                    "Bantu kebutuhan mandi secara teratur",
                    "Benda benda pribadi berada dalam jangkauan (telpon genggam,bel,air minum,kacamata)",
                    "Usahakan lokasi tempat tidur berdekatan dengan pos perawat (nurse station)/ruangan yang bisa dipantau oleh perawat.",
                    "Pendampingan dari keluarga",
                ];
            }
        }

        // dd($data['detailAssesment']);

        return $data;
    }

    function verifikasi_dokumen($data){

        $verif = Smis_Doc_Asesment_Praanestesi_Sedasi::where([
            'id_dokumen' => $data->dokumen,
        ])->update([
            'verifikator' => Auth::user()->username,
            'status' => 1,
        ]);

        return null;
    }
}
