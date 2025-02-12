<?php

namespace App\Services;

use App\Models\DokumenKunjungan;

class PersetujuanPenolakanTindakanKedokteranService
{
    public function save_signature($data)
    {
        try {
            $folderPath = public_path('signature_pemberi/');

            $image_parts = explode(";base64,", $data->nama_yang_menyatakan);

            $image_type_aux = explode("image/", $image_parts[0]);

            $image_type = $image_type_aux[1];

            $image_base64 = base64_decode($image_parts[1]);

            $fileName = uniqid() . '.' . $image_type;
            $file = $folderPath . $fileName;
            file_put_contents($file, $image_base64);

            $val = [
                'signature_pemberi' => $fileName,
                'nama_yang_menyatakan' => $data->nama_yang_menyatakan
            ];

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
}
