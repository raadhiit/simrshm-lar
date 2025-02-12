<?php

namespace App\Services;

use App\Models\Smis_Doc_General_Consent;
use App\Models\DokumenKunjungan;
use App\Models\SMIS_LayananPasien;
use App\Models\SmisHrdEmployee;

class GeneralConsentService
{
    function create($data)
    {
        try {
            $tes = Smis_Doc_General_Consent::updateOrCreate([
                'id_dokumen' => $data->dokumen,
            ],[
                'nama' => $data->nama,
                'alamat' => $data->alamat,
                'telpon' => $data->telpon,
                'no_identitas' => $data->no_identitas,
                'pi_satu' => $data->pi_satu ? $data->pi_satu : "",
                'pi_dua' => $data->pi_dua ? $data->pi_dua : "",
                'pi_tiga' => $data->pi_tiga ? $data->pi_tiga : "",
                'hubungan_satu' => $data->hubungan_satu ? $data->hubungan_satu : "",
                'hubungan_dua' => $data->hubungan_dua ? $data->hubungan_dua : "",
                'hubungan_tiga' => $data->hubungan_tiga ? $data->hubungan_tiga : "",
                'mengijinkan' => $data->mengijinkan,
                'keterangan_mengijinkan' => $data->keterangan_mengijinkan ? $data->keterangan_mengijinkan : "",
            ]);

            return [
                'status' => true,
                'message' => 'OK'
            ];
        } catch (\Throwable $th) {
            return [
                'status' => true,
                'message' => $th->getMessage()
            ];
        }
    }

    function update_persetujuan($data)
    {
        try {
            Smis_Doc_General_Consent::where('id_dokumen', $data->dokumen)->update([
                'nama' => $data->nama,
                'tgl_lahir' => $data->tgl_lahir,
                'alamat' => $data->alamat,
                'telpon' => $data->telepon,
                'no_identitas' => $data->no_identitas,
                'pi_satu' => $data->pi_satu,
                'pi_dua' => $data->pi_dua,
                'pi_tiga' => $data->pi_tiga,
                'hubungan_satu' => $data->hubungan_satu,
                'hubungan_dua' => $data->hubungan_dua,
                'hubungan_tiga' => $data->hubungan_tiga,
                'mengijinkan' => $data->perijinan,
                'keterangan_mengijinkan' => $data->keterangan_mengijinkan,
            ]);
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    function data($req){
        $data['dokumen'] = DokumenKunjungan::with('general_consent')
            ->leftJoin('smis_adm_user', 'smis_adm_user.id', 'dokumen_kunjungan_pasien.id_verifikator')
            ->select('dokumen_kunjungan_pasien.*', 'smis_adm_user.username')
            ->where('dokumen_kunjungan_pasien.id', $req->dokumen)->first();
        $data['layanan'] = SMIS_LayananPasien::join('smis_rg_patient', 'smis_rg_patient.id', 'smis_rg_layananpasien.nrm')
            ->select('smis_rg_patient.telpon', 'smis_rg_patient.nama', 'smis_rg_patient.tgl_lahir', 'smis_rg_patient.kelamin',
                'smis_rg_patient.alamat', 'smis_rg_patient.rt', 'smis_rg_patient.rw', 'smis_rg_patient.nama_kelurahan',
                'smis_rg_patient.nama_kecamatan', 'smis_rg_patient.nama_kabupaten', 'smis_rg_layananpasien.id',
                'smis_rg_layananpasien.nrm', 'smis_rg_patient.ktp',
                'smis_rg_layananpasien.nama_pasien', 'smis_rg_layananpasien.last_ruangan')
            ->where('smis_rg_layananpasien.id', $data['dokumen']->noreg)
            ->first();
        $data['employee'] = SmisHrdEmployee::where('nama', $data['dokumen']->nama_verifikator)->first();
        return $data;
    }
}
