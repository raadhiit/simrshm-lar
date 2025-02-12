<?php

namespace App\Services;

use App\Models\ERekamMedis;
use App\Models\Smis_Doc_Persetujuan_Umum;
use App\Models\SMIS_Pasien;
use App\Models\SmisHrdEmployee;
use Auth;
use PDF;
use iio\libmergepdf\Merger;

class ErmPendaftaranService
{
    function create($data)
    {
        try {
            $tes = Smis_Doc_Persetujuan_Umum::updateOrCreate([
                'id_dokumen' => $data->dokumen,
            ],[
                'identitas' => $data->identitas_pasien,
                'nomer_identitas' => $data->nomer_identitas,
                'kebangsaan' => $data->kebangsaan,
                'suku' => $data->suku ? $data->suku : '',
                'nama_wali' => $data->nama_wali,
                'hubungan_pasien' => $data->hubungan_wali ? $data->hubungan_wali : "",
                'alamat_wali' => $data->alamat_wali,
                'telpon' => $data->telpon,
            ]);
            return true;
        } catch (\Throwable $th) {
            return $th;
        }
    }

    function verifikasi($req){
        $sts = $this->create($req);
        if ($sts) {
            $query = ERekamMedis::where('id', $req->dokumen)->update([
                'id_verifikator' => Auth::user()->id,
                'nama_verifikator' => Auth::user()->realname,
                'status' => 1,
                'tanggal_update' => date('Y-m-d H:i', strtotime('+7 hours')),
            ]);
            return $query;
        } else {
            return false;
        }
    }

    function upload_signature($req)
    {
        ERekamMedis::findOrFail($req->dokumen);
        $folderPath = public_path('signature_patient/');

        $image_parts = explode(";base64,", $req->signed);

        $image_type_aux = explode("image/", $image_parts[0]);

        $image_type = $image_type_aux[1];

        $image_base64 = base64_decode($image_parts[1]);

        $fileName = uniqid() . '.' . $image_type;
        $file = $folderPath . $fileName;
        file_put_contents($file, $image_base64);

        $query = ERekamMedis::where('id', $req->dokumen)->update([
            'signature_pasien' => $fileName,
            'nama_pasien' => $req->nama_pasien,
            'tanggal_update' => date('Y-m-d H:i:s', strtotime('+7 hours')),
            'updated_at' => date('Y-m-d H:i:s', strtotime('+7 hours'))
        ]);
        return $query;
    }

    function data($req){
        $dokumen = ERekamMedis::findOrFail($req->dokumen);
        $data['pasien'] = SMIS_Pasien::where('id', $dokumen->nrm)->first();
        $data['dokumen'] = $dokumen;
        $data['employee'] = SmisHrdEmployee::where('nama', $dokumen->nama_verifikator)->where('prop','')->first();
        return $data;
    }

    function data_identitas_pasien($req)
    {
        $rm = ERekamMedis::findOrFail($req->dokumen);
        $data['pasien'] = SMIS_Pasien::get($rm->nrm);
        $data['dokumen'] = $req->dokumen;
        $data['employee'] = SmisHrdEmployee::where('nama', $rm->nama_verifikator)->first();
        $data['persetujuan'] = Smis_Doc_Persetujuan_Umum::where('id_dokumen', $req->dokumen)->first();
        $data['rm'] = $rm;
        return $data;
    }

    function pdf($data, $view)
    {
        PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
        $pdf_one = PDF::loadView($view, $data)->setPaper('A4');
        $m = new Merger();
        $m->addRaw($pdf_one->output());
        $contents = $m->merge();
        return $contents;
    }
}
