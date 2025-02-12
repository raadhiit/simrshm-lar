<?php

namespace App\Services\DokumenKunjungan;

use App\Models\DokumenKunjungan;
use App\Models\SmisHrdEmployee;
use Illuminate\Support\Facades\DB;

class TataTertibDanPeraturanPelayananRawatInapService
{
    function data($req)
    {
        $dokumen = DokumenKunjungan::findOrFail($req->dokumen);
        return [
            'dokumen' => $dokumen,
            'data' => DB::table('smis_doc_tata_tertib_dan_peraturan_pelayanan_rawat_inap')->select('*')->where('id_dokumen', $req->dokumen)->first(),
            'employee' =>SmisHrdEmployee::where('nama', $dokumen->nama_verifikator)->where('prop', '')->first()
        ];
    }

    function tanda_tangan($req)
    {
        $select = DB::table('smis_doc_tata_tertib_dan_peraturan_pelayanan_rawat_inap')->select('*')->where('id_dokumen', $req->dokumen)->first();
        $fileName = $select ? $select->signature : '';

        $folderPath = public_path('signature_patient/');

        $image_parts = explode(";base64,", $req->signed);

        $image_type_aux = explode("image/", $image_parts[0]);

        $image_type = $image_type_aux[1];

        $image_base64 = base64_decode($image_parts[1]);

        $fileName = uniqid() . '.' . $image_type;
        $file = $folderPath . $fileName;
        file_put_contents($file, $image_base64);

        DB::table('dokumen_kunjungan_pasien')->where('id', $req->dokumen)->update([
            'nama_pasien' => $req->nama_pasien,
            'signature_pasien' => $fileName
        ]);

        DB::table('smis_doc_tata_tertib_dan_peraturan_pelayanan_rawat_inap')->updateOrInsert([
            'id_dokumen' => $req->dokumen,
        ], [
            'nama_pasien' => $req->nama_pasien,
            'signature' => $fileName,
            'tanggal_verifikasi' => $select ? $select->tanggal_verifikasi : '0000-00-00 00:00:00'
        ]);

        return DB::table('smis_doc_tata_tertib_dan_peraturan_pelayanan_rawat_inap')->select('*')->where('id_dokumen', $req->dokumen)->first();
    }

    function verifikasi($req)
    {
        $select = DB::table('smis_doc_tata_tertib_dan_peraturan_pelayanan_rawat_inap')->where('id_dokumen', $req->dokumen)->first();
        $query = DB::table('smis_doc_tata_tertib_dan_peraturan_pelayanan_rawat_inap')->updateOrInsert([
            'id_dokumen' => $req->dokumen,
        ], [
            'nama_pasien' => $select ? $select->nama_pasien : '',
            'signature' => $select ? $select->signature : '',
            'tanggal_verifikasi' => $req->tanggal_verifikasi ? date('Y-m-d H:i:s', strtotime($req->tanggal_verifikasi)) : '0000-00-00 00:00:00'
        ]);
        return $query;
    }
}
