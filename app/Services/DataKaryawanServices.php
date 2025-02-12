<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

/**
 * Class Services
 * @author rivald 
 */
class DataKaryawanServices
{

    public function getDataKaryawan()
    {
        $getData =  DB::table('smis_hrd_employee')->select(
            'id',
            'kode',
            'tanggal_masuk',
            'nama',
            'jk',
            'alamat',
            'pendidikan',
            'keterangan',
            'unit_kerja'
        )
            ->where('prop', ' ')
            ->orderBy('id', 'DESC');

        return $getData;
    }

    public function getDataKaryawanById($param)
    {
        $getDataById =  DB::table('smis_hrd_employee')->select(
            "id",
            "struktural",
            "ruangan",
            "ruangan_pegawai",
            "keterangan",
            "pendidikan",
            "kode",
            "nama",
            "tanggal_masuk",
            "jk",
            "alamat",
            "tgl_lahir",
            "tmp_lahir",
            "noktp",
            "nokk",
            "menikah",
            "tenaga",
            "bpjs_ketenagakerjaan",
            "bpjs_kesehatan",
            "akhir_kontrak",
            "telp",
            "hp",
            "agama",
            "golongan",
            "npwp",
            "unit_kerja",
            "tahun_lulus",
            "foto",
        )
            ->where([
                ['prop', ' '],
                ['id', $param]
            ])->first();

        return $getDataById;
    }



    public function storeDataKaryawan($param)
    {
        $imageVar = "";
        if ($param->hasFile('foto')) { //check file is getting or not..
            $param->file('foto')->move(public_path('/file_data_karyawan'), $param->image);
            $destinationPath = public_path('/file_data_karyawan/' . $param->image);

            if (file_exists($destinationPath)) {  // check file exists in directory or not
                $imageVar = $param->image;
            } else {
                return "error upload gambar";
            }
        }
        try {
            DB::table('smis_hrd_employee')->insert([
                "prop" => ' ',
                "kode" => $param->no_pegawai,
                "nama" => $param->nama,
                "keluar" => 0,
                "tanggal_masuk" => $param->tgl_awal_kontrak ?? "1111-11-11",
                "jk" => $param->gender,
                "suami_istri" => ' ',
                "anak_lk" => 0,
                "anak_pr" => 0,
                "anak_satu" => " ",
                "anak_dua" => " ",
                "alamat" => $param->alamat ?? " ",
                "ayah" => " ",
                "ibu" => " ",
                "pendidikan" => $param->pendidikan ?? " ",
                "jabatan" => 0,
                "dokter_spesialis" => 0,
                "struktural" => $param->jabatan_struktural ?? " ",
                "no_ijin" => " ",
                "pelatihan" => " ",
                "nip" => 00,
                "nip_asli" => 00,
                "nidn" => " ",
                "keterangan" => $param->keterangan ?? " ",
                "tgl_lahir" => $param->tanggal_lahir ?? "1111-11-11",
                "tmp_lahir" => $param->tempat_lahir ?? " ",
                "noktp" => $param->no_ktp ?? 0,
                "nokk" => $param->no_kk ?? 0,
                "menikah" => $param->status_menikah ?? " ",
                "organik" => 0,
                "tenaga" => $param->status_tenaga_kerja ?? " ",
                "ruangan" => $param->ruangan_otorisasi ?? " ",
                "ruangan_pegawai" => $param->ruangan_pegawai ?? " ",
                "finger_print" => " ",
                "finger_time" => "1997-12-01",
                "finger_duration" => 0,
                "gaji_pokok" => 0,
                "jaspel" => 0,
                "tunj_struktural" => 0,
                "tunj_fungsional" => 0,
                "tunj_jabatan" => 0,
                "tunj_pendidikan" => 0,
                "tunj_pasutri" => 0,
                "tunj_anak" => 0,
                "tunj_kehadiran" => 0,
                "uang_transport" => 0,
                "uang_makan" => 0,
                "tunjangan_golongan" => 0,
                "tunjangan_pengabdian" => 0,
                "dana_pensiun" => 0,
                "bpjs_ketenagakerjaan" => $param->no_bpjs_ketenagakerjaan ?? 0,
                "bpjs_kesehatan" => $param->no_bpjs_kesehatan ?? 0,
                "insentif" => 0,
                "lain_lain"  => 0,
                "uang_operasi" => 0,
                "uang_perujuk" => 0,
                "uang_duduk" => 0,
                "uang_pasien" => 0,
                "rumus_lembur" => " ",
                "uang_hadir_pagi" => 0,
                "uang_hadir_siang" => 0,
                "uang_hadir_malam" => 0,
                "prodi" => " ",
                "tahun_lulus" => $param->tahun_lulus ?? 0,
                "tgl_validasi" => "1999-12-12",
                "nama_kampus" => " ",
                "strata" => " ",
                "akhir_kontrak" => $param->tgl_akhir_kontrak ?? "1111-11-11",
                "id_marketing" => 0,
                "marketing" => " ",
                "telp" => $param->telp ?? 0,
                "hp" => $param->no_hp ?? 0,
                "no_bpjs" => " ",
                "no_bpjsk" => " ",
                "agama" => $param->agama ?? " ",
                "ijasah" => 0,
                "golongan" => $param->golongan ?? " ",
                "pengalaman" => " ",
                "nama_bank" => " ",
                "cabang_bank" => " ",
                "no_rek" => " ",
                "npwp" => $param->no_npwp ?? 0,
                "unit_kerja" => $param->bagian ?? " ",
                "foto" => $imageVar,
                "t_kerja" => " ",
                "debet" => " ",
                "kredit" => " ",
                "ttd" => " ",
                "autonomous" => "rshm",
                "duplicate" => 0,
                "origin" => "rshm",
                "origin_id" => 0,
                "time_updated" => date('Y-m-d h:i:s'),
                "origin_updated" => "rshm"
            ]);
            return "sukses";
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function updateDataKaryawan($param)
    {
        $imageVar = "";

        if ($param->image != '' || isset($param->image)) {
            $path = public_path('/file_data_karyawan/');

            //code for remove old file
            if ($param->old_image != ''  && $param->old_image != null) {
                $file_old = $path . $param->old_image;
                unlink($file_old);
            }
            $param->file('foto')->move(public_path('/file_data_karyawan'), $param->image);

            $imageVar = $param->image;
        }

        try {
            DB::table('smis_hrd_employee')->where('id', $param->id)->update([
                "prop" => ' ',
                "kode" => $param->no_pegawai,
                "nama" => $param->nama,
                "keluar" => 0,
                "tanggal_masuk" => $param->tgl_awal_kontrak ?? "1111-11-11",
                "jk" => $param->gender,
                "suami_istri" => ' ',
                "anak_lk" => 0,
                "anak_pr" => 0,
                "anak_satu" => " ",
                "anak_dua" => " ",
                "alamat" => $param->alamat ?? " ",
                "ayah" => " ",
                "ibu" => " ",
                "pendidikan" => $param->pendidikan ?? " ",
                "jabatan" => 0,
                "dokter_spesialis" => 0,
                "struktural" => $param->jabatan_struktural ?? " ",
                "no_ijin" => " ",
                "pelatihan" => " ",
                "nip" => 00,
                "nip_asli" => 00,
                "nidn" => " ",
                "keterangan" => $param->keterangan ?? " ",
                "tgl_lahir" => $param->tanggal_lahir ?? "1111-11-11",
                "tmp_lahir" => $param->tempat_lahir ?? " ",
                "noktp" => $param->no_ktp ?? 0,
                "nokk" => $param->no_kk ?? 0,
                "menikah" => $param->status_menikah ?? " ",
                "organik" => 0,
                "tenaga" => $param->status_tenaga_kerja ?? " ",
                "ruangan" => $param->ruangan_otorisasi ?? " ",
                "ruangan_pegawai" => $param->ruangan_pegawai ?? " ",
                "finger_print" => " ",
                "finger_time" => "1997-12-01",
                "finger_duration" => 0,
                "gaji_pokok" => 0,
                "jaspel" => 0,
                "tunj_struktural" => 0,
                "tunj_fungsional" => 0,
                "tunj_jabatan" => 0,
                "tunj_pendidikan" => 0,
                "tunj_pasutri" => 0,
                "tunj_anak" => 0,
                "tunj_kehadiran" => 0,
                "uang_transport" => 0,
                "uang_makan" => 0,
                "tunjangan_golongan" => 0,
                "tunjangan_pengabdian" => 0,
                "dana_pensiun" => 0,
                "bpjs_ketenagakerjaan" => $param->no_bpjs_ketenagakerjaan ?? 0,
                "bpjs_kesehatan" => $param->no_bpjs_kesehatan ?? 0,
                "insentif" => 0,
                "lain_lain"  => 0,
                "uang_operasi" => 0,
                "uang_perujuk" => 0,
                "uang_duduk" => 0,
                "uang_pasien" => 0,
                "rumus_lembur" => " ",
                "uang_hadir_pagi" => 0,
                "uang_hadir_siang" => 0,
                "uang_hadir_malam" => 0,
                "prodi" => " ",
                "tahun_lulus" => $param->tahun_lulus ?? 0,
                "tgl_validasi" => "1999-12-12",
                "nama_kampus" => " ",
                "strata" => " ",
                "akhir_kontrak" => $param->tgl_akhir_kontrak ?? "1111-11-11",
                "id_marketing" => 0,
                "marketing" => " ",
                "telp" => $param->telp ?? 0,
                "hp" => $param->no_hp ?? 0,
                "no_bpjs" => " ",
                "no_bpjsk" => " ",
                "agama" => $param->agama ?? " ",
                "ijasah" => 0,
                "golongan" => $param->golongan ?? " ",
                "pengalaman" => " ",
                "nama_bank" => " ",
                "cabang_bank" => " ",
                "no_rek" => " ",
                "npwp" => $param->no_npwp ?? 0,
                "unit_kerja" => $param->bagian ?? " ",
                "foto" => $imageVar,
                "t_kerja" => " ",
                "debet" => " ",
                "kredit" => " ",
                "ttd" => " ",
                "autonomous" => "rshm",
                "duplicate" => 0,
                "origin" => "rshm",
                "origin_id" => 0,
                "time_updated" => date('Y-m-d h:i:s'),
                "origin_updated" => "rshm"
            ]);
            return "sukses";
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function deleteDataKaryawan($id)
    {
        try {
            DB::table('smis_hrd_employee')
                ->where('id', $id)
                ->update(['prop' => 'del']);
            return 'sukses';
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
