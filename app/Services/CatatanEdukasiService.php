<?php

namespace App\Services;

use App\Models\Smis_Doc_Catatan_Edukasi;
use App\Models\DokumenKunjungan;
use App\Models\SMIS_LayananPasien;
use App\Models\SmisHrdEmployee;
use Illuminate\Support\Facades\Auth;

class CatatanEdukasiService
{
    function cek_jenis_verifikasi($req)
    {
        switch ($req->jenis_verifikasi) {
            case 'petugas':

                break;

            default:
                # code...
                break;
        }
    }

    function create($data)
    {
        $select = Smis_Doc_Catatan_Edukasi::where('id_dokumen', $data->dokumen)->first();

        $topik_a = json_decode($data->topik_edukasi_a);
        $topik_b = json_decode($data->topik_edukasi_b);
        $topik_c = json_decode($data->topik_edukasi_c);
        $topik_d = json_decode($data->topik_edukasi_d);
        $topik_e = json_decode($data->topik_edukasi_e);
        $additional_topik = json_decode($data->additional_topik);

        $employee = SmisHrdEmployee::where('username', Auth::user()->username)->where('prop', '')->first();
        $nama_file_ttd = '';

        if ($data->jenis_verifikasi == 'pasien') {
            $upload = (new DokumenKunjunganService)->save_signature($data);

            if ($upload['status']) {
                $dokumen = DokumenKunjungan::findOrFail($data->dokumen);
                $nama_file_ttd = $dokumen->signature_pasien;
            }else{
                return [
                    'status' => false,
                    'message' => 'Gagal upload tanda tangan'
                ];
            }
        }

        switch ($data->index_simpan) {
            case '0':
                $topik_a[5] = $data->jenis_verifikasi == 'petugas' ? json_encode(['ttd' => ($employee ? $employee->ttd : ''), 'nama' => Auth::user()->realname]) : ($select ? isset(json_decode($select->topik_edukasi_a)[5]) ? json_decode($select->topik_edukasi_a)[5] : '' : '');
                $topik_a[6] = $data->jenis_verifikasi == 'pasien' ? json_encode(['ttd' => $nama_file_ttd, 'nama' => $data->nama_penerima_edukasi]) : ($select ? isset(json_decode($select->topik_edukasi_a)[6]) ? json_decode($select->topik_edukasi_a)[6] : '' : '');
                break;
            case '1':
                $topik_b[5] = $data->jenis_verifikasi == 'petugas' ? json_encode(['ttd' => ($employee ? $employee->ttd : ''), 'nama' => Auth::user()->realname]) : ($select ? isset(json_decode($select->topik_edukasi_b)[5]) ? json_decode($select->topik_edukasi_b)[5] : '' : '');
                $topik_b[6] = $data->jenis_verifikasi == 'pasien' ? json_encode(['ttd' => $nama_file_ttd, 'nama' => $data->nama_penerima_edukasi]) : ($select ? isset(json_decode($select->topik_edukasi_b)[6]) ? json_decode($select->topik_edukasi_b)[6] : '' : '');
                break;
            case '2':
                $topik_c[5] = $data->jenis_verifikasi == 'petugas' ? json_encode(['ttd' => ($employee ? $employee->ttd : ''), 'nama' => Auth::user()->realname]) : ($select ? isset(json_decode($select->topik_edukasi_c)[5]) ? json_decode($select->topik_edukasi_c)[5] : '' : '');
                $topik_c[6] = $data->jenis_verifikasi == 'pasien' ? json_encode(['ttd' => $nama_file_ttd, 'nama' => $data->nama_penerima_edukasi]) : ($select ? isset(json_decode($select->topik_edukasi_c)[6]) ? json_decode($select->topik_edukasi_c)[6] : '' : '');
                break;
            case '3':
                $topik_d[5] = $data->jenis_verifikasi == 'petugas' ? json_encode(['ttd' => ($employee ? $employee->ttd : ''), 'nama' => Auth::user()->realname]) : ($select ? json_decode($select->topik_edukasi_d)[5] : '');
                $topik_d[6] = $data->jenis_verifikasi == 'pasien' ? json_encode(['ttd' => $nama_file_ttd, 'nama' => $data->nama_penerima_edukasi]) : ($select ? isset(json_decode($select->topik_edukasi_d)[6]) ? json_decode($select->topik_edukasi_d)[6] : '' : '');
                break;
            case '4':
                $topik_e[5] = $data->jenis_verifikasi == 'petugas' ? json_encode(['ttd' => ($employee ? $employee->ttd : ''), 'nama' => Auth::user()->realname]) : ($select ? isset(json_decode($select->topik_edukasi_e)[5]) ? json_decode($select->topik_edukasi_e)[5] : '' : '');
                $topik_e[6] = $data->jenis_verifikasi == 'pasien' ? json_encode(['ttd' => $nama_file_ttd, 'nama' => $data->nama_penerima_edukasi]) : ($select ? isset(json_decode($select->topik_edukasi_e)[6]) ? json_decode($select->topik_edukasi_e)[6] : '' : '');
                break;

            default:
                # code...
                break;
        }

        if ($data->index_simpan > 3 && $data->index_simpan < 24) {
            $additional_topik[$data->index_simpan-4]->petugas = $data->jenis_verifikasi == 'petugas' ? json_encode(['ttd' => ($employee ? $employee->ttd : ''), 'nama' => Auth::user()->realname]) : (isset($additional_topik[$data->index_simpan-4]->petugas) ? $additional_topik[$data->index_simpan-4]->petugas : '');
            $additional_topik[$data->index_simpan-4]->pasien = $data->jenis_verifikasi == 'pasien' ? json_encode(['ttd' => $nama_file_ttd, 'nama' => $data->nama_penerima_edukasi]) : (isset($additional_topik[$data->index_simpan-4]->pasien) ? $additional_topik[$data->index_simpan-4]->pasien : '');
        }

        try {
            $tes = Smis_Doc_Catatan_Edukasi::updateOrCreate([
                'id_dokumen' => $data->dokumen,
            ], [
                'bahasa' => $data->bahasa ? $data->bahasa : "",
                'bahasa_lainnya' => $data->bahasa_lainnya ? $data->bahasa_lainnya : "",
                'penerjemah' => $data->penerjemah ? $data->penerjemah : "",
                'penerjemah_lainnya' => $data->penerjemah_lainnya ? $data->penerjemah_lainnya : "",
                'pendidikan' => $data->pendidikan ? $data->pendidikan : "",
                'pendidikan_lainnya' => $data->pendidikan_lainnya ? $data->pendidikan_lainnya : "",
                'baca_tulis' => $data->baca_tulis ? $data->baca_tulis : "",
                'pembelajaran' => $data->pembelajaran ? $data->pembelajaran : "",
                'pembelajaran_lainnya' => $data->pembelajaran_lainnya ? $data->pembelajaran_lainnya : "",
                'hambatan_edukasi' => $data->hambatan_edukasi ? $data->hambatan_edukasi : "",
                'hambatan_edukasi_lainnya' => $data->hambatan_edukasi_lainnya ? $data->hambatan_edukasi_lainnya : "",
                'menerima_edukasi' => $data->menerima_edukasi ? $data->menerima_edukasi : "",
                'metode_edukasi' => $data->metode_edukasi ? $data->metode_edukasi : "",
                'metode_edukasi_lainnya' => $data->metode_edukasi_lainnya ? $data->metode_edukasi_lainnya : "",
                'evaluasi_edukasi' => $data->evaluasi_edukasi ? $data->evaluasi_edukasi : "",
                'topik_edukasi_a' => json_encode($topik_a),
                'topik_edukasi_b' => json_encode($topik_b),
                'topik_edukasi_c' => json_encode($topik_c),
                'topik_edukasi_d' => json_encode($topik_d),
                'topik_edukasi_e' => json_encode($topik_e),
                'additional_topik' => json_encode($additional_topik),
                'sarana_edukasi' => $data->sarana_edukasi ? $data->sarana_edukasi : "",
                'sarana_edukasi_lain' => $data->sarana_edukasi_lain ? $data->sarana_edukasi_lain : "",
                'penerima_edukasi' => $data->penerima_edukasi ? $data->penerima_edukasi : "",
                'penerima_edukasi_lain' => $data->penerima_edukasi_lain ? $data->penerima_edukasi_lain : "",
            ]);

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

    function data($req)
    {
        $data['dokumen'] = DokumenKunjungan::with('catatan_edukasi_pasien')
            ->leftJoin('smis_adm_user', 'smis_adm_user.id', 'dokumen_kunjungan_pasien.id_verifikator')
            ->select('dokumen_kunjungan_pasien.*', 'smis_adm_user.username')
            ->where('dokumen_kunjungan_pasien.id', $req->dokumen)->first();
        $data['layanan'] = SMIS_LayananPasien::join('smis_rg_patient', 'smis_rg_patient.id', 'smis_rg_layananpasien.nrm')
            ->select(
                'smis_rg_patient.telpon',
                'smis_rg_patient.nama',
                'smis_rg_patient.tgl_lahir',
                'smis_rg_patient.kelamin',
                'smis_rg_patient.alamat',
                'smis_rg_patient.rt',
                'smis_rg_patient.rw',
                'smis_rg_patient.nama_kelurahan',
                'smis_rg_patient.nama_kecamatan',
                'smis_rg_patient.nama_kabupaten',
                'smis_rg_layananpasien.id',
                'smis_rg_layananpasien.nrm',
                'smis_rg_patient.ktp',
                'smis_rg_layananpasien.nama_pasien',
                'smis_rg_layananpasien.last_ruangan'
            )
            ->where('smis_rg_layananpasien.id', $data['dokumen']->noreg)
            ->first();
        $data['employee'] = SmisHrdEmployee::where('nama', $data['dokumen']->nama_verifikator)->first();
        return $data;
    }
}
