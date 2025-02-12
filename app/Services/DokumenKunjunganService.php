<?php

namespace App\Services;

use App\Models\DokumenKunjungan;
use App\Models\SMIS_LayananPasien;
use App\Models\Smis_Hrd_Employee;
use Illuminate\Support\Facades\Auth;

class DokumenKunjunganService
{

    function save_signature($data)
    {
        try {
            $folderPath = public_path('signature_patient/');

            $image_parts = explode(";base64,", $data->signed);

            $image_type_aux = explode("image/", $image_parts[0]);

            $image_type = $image_type_aux[1];

            $image_base64 = base64_decode($image_parts[1]);

            $fileName = uniqid() . '.' . $image_type;
            $file = $folderPath . $fileName;
            file_put_contents($file, $image_base64);

            if (isset($data->nama_pasien)) {
                $val = [
                    'signature_pasien' => $fileName,
                    'nama_pasien' => $data->nama_pasien
                ];
            } else {
                $val = [
                    'signature_pasien' => $fileName,
                ];
            }

            DokumenKunjungan::where('id', $data->dokumen)->update($val);
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


    function verifikasi_dokumen($data)
    {
        // dd($data);
        $verif = DokumenKunjungan::where('id', $data->dokumen ?? $data->id_dokumen)->update([
            'status' => 1,
            'id_verifikator' => Auth::user()->id,
            'nama_verifikator' => Auth::user()->realname,
            'tanggal_update' => date('Y-m-d H:i:s'),
        ]);

        return $verif;
    }

    function upload_dokumen_kunjungan($data)
    {
        $file = $data->file('dokumen');
        $tujuan_upload = 'dokumen_kunjungan';
        $fileName = (isset($data->nama_dokumen) ? $data->id_dokumen."_".$data->nama_dokumen : time()) .".". $file->getClientOriginalExtension();
        $file->move($tujuan_upload, $fileName);

        $dokumen = DokumenKunjungan::findOrFail($data->id_dokumen);
        $temp = [];
        if ($dokumen->nama_dokumen == 'Scan Dokumen RM') {
            $temp = [
                'status' => 1,
                'id_verifikator' => Auth::user()->id,
                'nama_verifikator' => Auth::user()->realname,
                'path_dokumen' => $fileName,
                'tanggal_update' => date('Y-m-d H:i:s', strtotime('+7 hours'))
            ];
        } else {
            $temp = [
                'status' => 1,
                // 'id_verifikator' => Auth::user()->id,
                // 'nama_verifikator' => Auth::user()->realname,
                'path_dokumen' => $fileName,
                'tanggal_update' => date('Y-m-d H:i:s', strtotime('+7 hours'))
            ];
        }

        $verif = DokumenKunjungan::where('id', $data->id_dokumen)->update($temp);

        return $verif;
    }
}
