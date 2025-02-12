<?php

namespace App\Services\DokumenKunjungan;

use App\Models\DokumenKunjungan;
use App\Models\DokumenKunjungan\Smis_Doc_Persetujuan_Atau_Penolakan_Tindakan_Bedah;
use App\Models\SMIS_LayananPasien;
use App\Models\SMIS_Pasien;
use App\Models\SmisHrdEmployee;
use App\Services\DokumenKunjunganService;
use Illuminate\Support\Facades\Auth;

class PersetujuanAtauPenolakanTindakanBedahService
{

    function data($req)
    {
        $dokumen = DokumenKunjungan::findOrFail($req->dokumen);
        $layanan = SMIS_LayananPasien::where('id', $dokumen->noreg)->where('prop', '')->first();
        $pasien = SMIS_Pasien::where('id', $layanan->nrm)->where('prop', '')->first();
        $data = Smis_Doc_Persetujuan_Atau_Penolakan_Tindakan_Bedah::where('id_dokumen', $dokumen->id)->first();
        $dokter = $data ? SmisHrdEmployee::where('nama', $data->nama_dokter)->where('prop', '')->first() : null;
        $perawat = $data ? SmisHrdEmployee::where('nama', $data->nama_perawat)->where('prop', '')->first() : null;
        return [
            'dokumen' => $dokumen,
            'layanan' => $layanan,
            'pasien'  => $pasien,
            'data'    => $data,
            'dokter'  => $dokter,
            'perawat'  => $perawat
        ];
    }

    function store($req)
    {
        $select = Smis_Doc_Persetujuan_Atau_Penolakan_Tindakan_Bedah::where('id_dokumen', $req->dokumen)->first();
        if ($req->form == 1) {
            switch ($req->jenis) {
                case 'dokter':
                    Smis_Doc_Persetujuan_Atau_Penolakan_Tindakan_Bedah::updateOrCreate([
                        'id_dokumen' => $req->dokumen
                    ], [
                        'id_dokter_pelaksana' => $req->id_dokter_pelaksana ? $req->id_dokter_pelaksana : 0,
                        'nama_dokter_pelaksana' => $req->dokter_pelaksana ? $req->dokter_pelaksana : '',
                        'id_pemberi_informasi' => $req->id_pemberi_informasi ? $req->id_pemberi_informasi : 0,
                        'nama_pemberi_informasi' => $req->pemberi_informasi ? $req->pemberi_informasi : '',
                        'penerima_informasi' => $req->penerima_informasi ? $req->penerima_informasi : '',
                        'informasi' => $req->informasi ? $req->informasi : '',
                        'id_dokter' => Auth::user()->id,
                        'nama_dokter' => Auth::user()->realname,
                        'tanda_tangan_keluarga' => $select ? $select->tanda_tangan_keluarga : '',
                        'nama_keluarga' => $select ? $select->nama_keluarga : '',
                        'pernyataan' => $select ? $select->pernyataan : '',
                        'id_menyatakan' => $select ? $select->id_menyatakan : '',
                        'nama_menyatakan' => $select ? $select->nama_menyatakan : '',
                        'id_wali' => $select ? $select->id_wali : '',
                        'nama_wali' => $select ? $select->nama_wali : '',
                        'id_perawat' => $select ? $select->id_perawat : 0,
                        'nama_perawat' => $select ? $select->nama_perawat : '',
                        'tanggal_verifikasi' => $select ? $select->tanggal_verifikasi : '0000-00-00 00:00:00',
                    ]);
                    break;
                case 'keluarga':
                    $fileName = $select ? $select->nama_keluarga : '';

                    $fileName = $this->upload_signature($req);

                    Smis_Doc_Persetujuan_Atau_Penolakan_Tindakan_Bedah::updateOrCreate([
                        'id_dokumen' => $req->dokumen
                    ], [
                        'id_dokter_pelaksana' => $req->id_dokter_pelaksana ? $req->id_dokter_pelaksana : 0,
                        'nama_dokter_pelaksana' => $req->dokter_pelaksana ? $req->dokter_pelaksana : '',
                        'id_pemberi_informasi' => $req->id_pemberi_informasi ? $req->id_pemberi_informasi : 0,
                        'nama_pemberi_informasi' => $req->pemberi_informasi ? $req->pemberi_informasi : '',
                        'penerima_informasi' => $req->penerima_informasi ? $req->penerima_informasi : '',
                        'informasi' => $req->informasi ? $req->informasi : '',
                        'id_dokter' => $select ? $select->id_dokter : 0,
                        'nama_dokter' => $select ? $select->nama_dokter : '',
                        'tanda_tangan_keluarga' => $fileName,
                        'nama_keluarga' => $req->nama_keluarga ? $req->nama_keluarga : '',
                        'pernyataan' => $select ? $select->pernyataan : '',
                        'id_menyatakan' => $select ? $select->id_menyatakan : '',
                        'nama_menyatakan' => $select ? $select->nama_menyatakan : '',
                        'id_wali' => $select ? $select->id_wali : '',
                        'nama_wali' => $select ? $select->nama_wali : '',
                        'id_perawat' => $select ? $select->id_perawat : 0,
                        'nama_perawat' => $select ? $select->nama_perawat : '',
                        'tanggal_verifikasi' => $select ? $select->tanggal_verifikasi : '0000-00-00 00:00:00',
                    ]);
                    break;
                default:
                    # code...
                    break;
            }
        } else if ($req->form == 2) {
            switch ($req->jenis) {
                case 'pasien':
                    $fileName = $select ? $select->nama_pasien : '';

                    $fileName = $this->upload_signature($req);

                    Smis_Doc_Persetujuan_Atau_Penolakan_Tindakan_Bedah::updateOrCreate([
                        'id_dokumen' => $req->dokumen
                    ], [
                        'id_dokter_pelaksana' => $select->id_dokter_pelaksana,
                        'nama_dokter_pelaksana' => $select->nama_dokter_pelaksana,
                        'id_pemberi_informasi' => $select->id_pemberi_informasi,
                        'nama_pemberi_informasi' => $select->nama_pemberi_informasi,
                        'penerima_informasi' => $select->penerima_informasi,
                        'informasi' => $select->informasi,
                        'id_dokter' => $select->id_dokter,
                        'nama_dokter' => $select->nama_dokter,
                        'tanda_tangan_keluarga' => $select->tanda_tangan_keluarga,
                        'nama_keluarga' => $select->nama_keluarga,
                        'pernyataan' => $req->pernyataan ? $req->pernyataan : '',
                        'tanda_tangan_menyatakan' => $fileName,
                        'nama_menyatakan' => $req->nama_keluarga ? $req->nama_keluarga : '',
                        'tanda_tangan_wali' => $select ? $select->tanda_tangan_wali : '',
                        'nama_wali' => $select ? $select->nama_wali : '',
                        'id_perawat' => $select ? $select->id_perawat : 0,
                        'nama_perawat' => $select ? $select->nama_perawat : '',
                        'tanggal_verifikasi' => $select ? $select->tanggal_verifikasi : '0000-00-00 00:00:00',
                    ]);
                    break;

                case 'wali':
                    $fileName = $select ? $select->nama_pasien : '';

                    $fileName = $this->upload_signature($req);

                    Smis_Doc_Persetujuan_Atau_Penolakan_Tindakan_Bedah::updateOrCreate([
                        'id_dokumen' => $req->dokumen
                    ], [
                        'id_dokter_pelaksana' => $select->id_dokter_pelaksana,
                        'nama_dokter_pelaksana' => $select->nama_dokter_pelaksana,
                        'id_pemberi_informasi' => $select->id_pemberi_informasi,
                        'nama_pemberi_informasi' => $select->nama_pemberi_informasi,
                        'penerima_informasi' => $select->penerima_informasi,
                        'informasi' => $select->informasi,
                        'id_dokter' => $select->id_dokter,
                        'nama_dokter' => $select->nama_dokter,
                        'tanda_tangan_keluarga' => $select->tanda_tangan_keluarga,
                        'nama_keluarga' => $select->nama_keluarga,
                        'pernyataan' => $req->pernyataan ? $req->pernyataan : '',
                        'tanda_tangan_menyatakan' => $select ? $select->tanda_tangan_menyatakan : '',
                        'nama_menyatakan' => $select ? $select->nama_menyatakan : '',
                        'tanda_tangan_wali' => $fileName,
                        'nama_wali' => $req->nama_keluarga ? $req->nama_keluarga : '',
                        'id_perawat' => $select ? $select->id_perawat : 0,
                        'nama_perawat' => $select ? $select->nama_perawat : '',
                        'tanggal_verifikasi' => $select ? $select->tanggal_verifikasi : '0000-00-00 00:00:00',
                    ]);
                    break;

                case 'perawat':
                    Smis_Doc_Persetujuan_Atau_Penolakan_Tindakan_Bedah::updateOrCreate([
                        'id_dokumen' => $req->dokumen
                    ], [
                        'id_dokter_pelaksana' => $select->id_dokter_pelaksana,
                        'nama_dokter_pelaksana' => $select->nama_dokter_pelaksana,
                        'id_pemberi_informasi' => $select->id_pemberi_informasi,
                        'nama_pemberi_informasi' => $select->nama_pemberi_informasi,
                        'penerima_informasi' => $select->penerima_informasi,
                        'informasi' => $select->informasi,
                        'id_dokter' => $select->id_dokter,
                        'nama_dokter' => $select->nama_dokter,
                        'tanda_tangan_keluarga' => $select->tanda_tangan_keluarga,
                        'nama_keluarga' => $select->nama_keluarga,
                        'pernyataan' => $req->pernyataan ? $req->pernyataan : '',
                        'tanda_tangan_menyatakan' => $select ? $select->tanda_tangan_menyatakan : '',
                        'nama_menyatakan' => $select ? $select->nama_menyatakan : '',
                        'tanda_tangan_wali' => $select ? $select->tanda_tangan_wali : '',
                        'nama_wali' => $select ? $select->nama_wali : '',
                        'id_perawat' => Auth::user()->id,
                        'nama_perawat' => Auth::user()->realname,
                        'tanggal_verifikasi' => $req->tanggal_verifikasi ? date('Y-m-d H:i:s', strtotime($req->tanggal_verifikasi)) : '0000-00-00 00:00:00',
                    ]);

                    $dks = new DokumenKunjunganService();
                    $dks->verifikasi_dokumen($req);
                    
                    break;
                default:
                    # code...
                    break;
            }
        }

        return Smis_Doc_Persetujuan_Atau_Penolakan_Tindakan_Bedah::where('id_dokumen', $req->dokumen)->first();
    }

    function upload_signature($req)
    {
        $folderPath = public_path('signature_patient/');

        $image_parts = explode(";base64,", $req->tanda_tangan);

        $image_type_aux = explode("image/", $image_parts[0]);

        $image_type = $image_type_aux[1];

        $image_base64 = base64_decode($image_parts[1]);

        $fileName = uniqid() . '.' . $image_type;
        $file = $folderPath . $fileName;
        file_put_contents($file, $image_base64);

        return $fileName;
    }
}
