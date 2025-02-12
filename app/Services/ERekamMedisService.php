<?php

namespace App\Services;

use App\Models\Smis_Lab_Hasil;
use App\Models\Smis_Lab_Layanan;
use App\Models\SMIS_LabPesanan;
use App\Models\SMIS_LayananPasien;
use App\Models\SMIS_Pasien;
use App\Models\Smis_Rad_Layanan;
use App\Models\Smis_Rad_Pesanan;
use App\Models\SmisAdmPrototype;
use App\Models\SmisAdmSettings;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use stdClass;

class ERekamMedisService
{
    function pesanan_lab($noreg)
    {
        $data = DB::table('smis_lab_pesanan')->where([
            'noreg_pasien' => $noreg
        ])->get();
        return $data;
    }

    function pesanan_lab_by_id($id)
    {
        $data = DB::table('smis_lab_pesanan')->where([
            'id' => $id
        ])->first();
        return $data;
    }

    public function lab_pesanan_store($req)
    {
        $insert = DB::table('smis_lab_pesanan')->updateOrInsert(['noreg_pasien' => $req->noreg], $this->generate_data_pesanan_lab($req));
        return $insert;
    }

    public function lab_pesanan_store_by_id($req)
    {
        $ss = new SmisService();
        $js = new JurnalService();
        $data = $this->generate_data_pesanan_lab($req);
        $data['noreg_pasien'] = $req->noreg;
        if ($req->id_pesanan != 0) {
            $js->delete_jurnal_lab($req->id_pesanan);
            DB::table('smis_lab_pesanan')->where('id', $req->id_pesanan)->update($data);
            $js->insert_tagihan_kasir_lab($req->id_pesanan);
            $js->insert_jurnal_lab($req->id_pesanan);
            $return_data = SMIS_LabPesanan::where('id', $req->id_pesanan)->first();
        } else {
            $data['status'] = 'Pesanan ERM';
            $id = DB::table('smis_lab_pesanan')->insertGetId($data);
            $return_data = SMIS_LabPesanan::where('id', $id)->first();
            $js->insert_tagihan_kasir_lab($return_data->id);
            $js->insert_jurnal_lab($return_data->id);
        }
        return $return_data;
    }

    function generate_data_pesanan_lab($req)
    {
        $hapusan_darah = '<p>' .
            '<br>' .
            '</p>' .
            '<table class="table table-bordered">' .
            '<tbody>' .
            '<tr>' .
            '<td>' .
            '<span style="font-weight: bold;">Jenis Sel</span>' .
            '</td>' .
            '<td>' .
            '<span style="font-weight: bold;">Hasil Pemeriksaan</span>' .
            '</td>' .
            '</tr>' .
            '<tr>' .
            '<td>Eritrosit</td>' .
            '<td>-</td>' .
            '</tr>' .
            '<tr>' .
            '<td>Leukosit</td>' .
            '<td>-</td>' .
            '</tr>' .
            '<tr>' .
            '<td>Trombosit</td>' .
            '<td>-</td>' .
            '</tr>' .
            '<tr>' .
            '<td>' .
            '<span style="font-weight: bold;">Kesimpulan</span>' .
            '</td>' .
            '<td>-</td>' .
            '</tr>' .
            '</tbody>' .
            '</table>' .
            '<p>' .
            '<br>' .
            '</p>';

        $jumlah_pesanan = SMIS_LabPesanan::where('noreg_pasien', $req->noreg)->whereMonth('tanggal', date('m', strtotime($req->tanggal)))->count();
        $layanan_pasien = SMIS_LayananPasien::where('id', $req->noreg)->first();
        $map_layanan = [];
        $map_harga = new stdClass();
        $map_hasil = [];
        $total = 0;
        $layanan = Smis_Lab_Layanan::where('prop', '')->get();
        $list_hasil = Smis_Lab_Hasil::where('prop', '')->get();
        // $setting_harga = SmisAdmSettings::where('name', 'smis_lab_harga')->where('prop', '')->first();
        // $ruangan = SmisAdmPrototype::where('slug', $req->ruangan)->first();
        // $list_harga = $setting_harga ? $setting_harga->value : "{}";
        // $temp = json_decode($list_harga, true);
        // $key = array_keys($temp);
        $tarif = 0;

        foreach ($layanan as $lay) {
            if (in_array($lay->slug, $req->pesan_pemeriksaan)) {
                $map_layanan[$lay->slug] = 1;
                $get_tarif = DB::table('smis_mjm_tarif_laboratory')->where('slug', $lay->slug)->where('kelas', $req->kelas)->first();

                $concat_kelas_slug = $req->kelas . '_' . $lay->slug;

                $map_harga->$concat_kelas_slug = (string)($get_tarif ? $get_tarif->tarif : 0);

                $tarif += $get_tarif ? $get_tarif->tarif : 0;
            } else {
                $map_layanan[$lay->slug] = 0;
            }
        }

        // for ($i = 0; $i < sizeof($key); $i++) {
        //     if (strpos($key[$i], $req->kelas . '_') !== false) {
        //         $map_harga[$key[$i]] = $temp[$key[$i]];
        //         $decrease = str_replace($req->kelas . '_', '', $key[$i]);
        //         if (array_key_exists($decrease, $map_layanan)) {
        //             if ($map_layanan[$decrease] == 1) {
        //                 $total += $temp[$key[$i]];
        //             }
        //         }
        //     }
        // }

        foreach ($list_hasil as $lh) {
            $map_hasil[$lh->slug] = "";
        }

        $umur = substr($req->umur, 0, 2);
        $umur = trim($umur);

        $no_lab = $this->format_no_lab($jumlah_pesanan);

        $pasien = SMIS_Pasien::where('id', $req->nrm)->where('prop', '')->first();
        $pesanan = Smis_LabPesanan::where('id', $req->id_pesanan)->where('prop', '')->first();
        $id_konsultan = SmisAdmSettings::where('name', 'like', '%laboratory-konsultan-id%')->first();
        $nama_konsultan = SmisAdmSettings::where('name', 'like', '%laboratory-konsultan-nama%')->first();
        $last = Smis_LabPesanan::orderBy('id', 'desc')->first();

        $data = [
            'keluhan_klinis' => $req->keluhan_klinis ? $req->keluhan_klinis : '',
            'kelurahan' => $layanan_pasien->nama_kelurahan,
            'kecamatan' => $layanan_pasien->nama_kecamatan,
            'kabupaten' => $layanan_pasien->nama_kabupaten,
            'provinsi' => $layanan_pasien->nama_provinsi,
            'total_biaya' => $tarif,
            'biaya_lain' => 0,
            'operator' => Auth::user()->realname,
            'cetak_hasil_ke' => 0,
            'setting_kelas' => '',
            'prop' => '',
            'id_paket' => null,
            'tanggal' => $req->tanggal . ' ' . date('H:i:s'),
            'nama_pasien' => $req->nama_pasien,
            'tgl_lahir' => $pasien->tgl_lahir,
            'nrm_pasien' => $req->nrm,
            'noreg_pasien' => $req->noreg,
            'jk' => $pasien ? $pasien->kelamin : 0,
            'kelas' => $req->kelas,
            'umur' => $req->umur,
            'alamat' => $req->alamat,
            'ibu' => $req->ibu ? $req->ibu : '',
            'limapuluh' => $umur >= 50 ? 1 : 0,
            'carabayar' => $req->jenis_pasien,
            'id_marketing' => 0,
            'marketing' => '',
            'ruangan' => $req->ruangan,
            'no_lab' => $req->id_pesanan == 0 ? 'LAB-' . $req->noreg . '/' . $this->romawi(date('m')) . '-' . $this->dua_digit_tahun(date('Y')) . '/' . ($last ? $last->id + 1 : 1) : $pesanan->no_lab,
            'id_dokter' => $req->id_dokter,
            'nama_dokter' => $req->dokter,
            'id_konsultan' => $id_konsultan ? $id_konsultan->value : 0,
            'nama_konsultan' => $nama_konsultan ? $nama_konsultan->value : '',
            'id_petugas' => $req->id_petugas ? $req->id_petugas : 0,
            'nama_petugas' => $req->petugas ? $req->petugas : '',
            'periksa' => json_encode($map_layanan),
            'hasil' => $req->id_pesanan == 0 ? json_encode($map_hasil) : $pesanan->hasil,
            'hapusan_darah' => $hapusan_darah,
            'harga' => json_encode($map_harga),
            'biaya' => $tarif,
            'pembagian' => '',
            'selesai' => 0,
            'waktu_daftar' => date('Y-m-d H:i:s'),
            'waktu_ditangani' => '0000-00-00 00:00:00',
            'waktu_selesai' => '0000-00-00 00:00:00',
            'waktu_ditangani_hapusan' => '0000-00-00 00:00:00',
            'waktu_selesai_hapusan' => '0000-00-00 00:00:00',
            'uri' => $layanan_pasien ? $layanan_pasien->uri : '',
            'cetak_1' => '',
            'cetak_2' => '',
            'cetak_3' => '',
            'cetak_gabung' => '',
            'response_time' => 0,
            'response_time_hapusan' => 0,
            'diagnosa' => $req->diagnosa ? $req->diagnosa : '',
            'file' => '',
            'akunting' => 0,
            'autonomous' => '',
            'duplicate' => 0,
            'origin' => '',
            'origin_id' => 0,
            'time_updated' => 0,
            'origin_updated' => '',
            'bed_ruangan' => $req->last_bed ? $req->last_bed : '',
            'cito' => $req->cito ? $req->cito : '',
        ];
        return $data;
    }

    function format_no_lab($jumlah)
    {
        $temp = $jumlah + 1;
        if ($temp < 10) {
            return '000' . $temp;
        } else if ($temp > 9 && $temp < 100) {
            return '00' . $temp;
        } else {
            return '0' . $temp;
        }
    }

    function dua_digit_tahun($thn)
    {
        $temp = str_split($thn);
        return $temp[sizeof($temp) - 2] . $temp[sizeof($temp) - 1];
    }

    function romawi($bln)
    {
        switch ($bln) {
            case 1:
                return "I";
                break;
            case 2:
                return "II";
                break;
            case 3:
                return "III";
                break;
            case 4:
                return "IV";
                break;
            case 5:
                return "V";
                break;
            case 6:
                return "VI";
                break;
            case 7:
                return "VII";
                break;
            case 8:
                return "VIII";
                break;
            case 9:
                return "IX";
                break;
            case 10:
                return "X";
                break;
            case 11:
                return "XI";
                break;
            case 12:
                return "XII";
                break;
        }
    }

    function pesanan_radiologi_store($req)
    {
        $pesanan = Smis_Rad_Pesanan::where('noreg_pasien', $req->noreg)->where('prop', '')->first();
        $data = $this->generate_data_pesanan_radiologi($req);

        if ($pesanan) {
            $insert = DB::table('smis_rad_pesanan')->where('no_lab', $pesanan->no_lab)->update($data);
        } else {
            $insert = DB::table('smis_rad_pesanan')->insert($data);
        }
        return $insert;
    }

    function pesanan_radiologi($noreg)
    {
        $data = DB::table('smis_rad_pesanan')->where([
            'noreg_pasien' => $noreg,
            'prop' => ''
        ])->get();
        return $data;
    }

    function pesanan_radiologi_store_by_id($req)
    {
        $js = new JurnalService();
        $data = $this->generate_data_pesanan_radiologi($req);
        if ($req->id_pesanan != 0) {
            $js->delete_jurnal_rad($req->id_pesanan);
            DB::table('smis_rad_pesanan')->where('id', $req->id_pesanan)->update($data);
            $js->insert_tagihan_kasir_rad($req->id_pesanan);
            $js->insert_jurnal_rad($req->id_pesanan);
            $return_data = Smis_Rad_Pesanan::where('id', $req->id_pesanan)->first();
        } else {
            $data['status'] = 'Pesanan ERM';
            $id = DB::table('smis_rad_pesanan')->insertGetId($data);
            $return_data = Smis_Rad_Pesanan::where('id', $id)->first();
            $js->insert_tagihan_kasir_rad($return_data->id);
            $js->insert_jurnal_rad($return_data->id);
        }
        return $return_data;
    }

    function pesanan_radiologi_by_id($id)
    {
        $data = DB::table('smis_rad_pesanan')->where([
            'id' => $id,
            'prop' => ''
        ])->first();
        return $data;
    }

    function generate_data_pesanan_radiologi($req)
    {
        // $pesanan = Smis_Rad_Pesanan::where('noreg_pasien', $req->noreg)->where('prop', '')->first();
        $layanan = SMIS_LayananPasien::where('id', $req->noreg)->first();
        $id_konsultan = SmisAdmSettings::where('name', 'like', '%radiology-konsultan-id%')->first();
        $nama_konsultan = SmisAdmSettings::where('name', 'like', '%radiology-konsultan-nama%')->first();
        $last = Smis_Rad_Pesanan::orderBy('id', 'desc')->first();
        $master_layanan = Smis_Rad_Layanan::where('prop', '')->get();
        $kelas = SmisAdmSettings::where('name', 'radiology-ui-pemeriksaan-default-jenis')->first();
        $harga = SmisAdmSettings::where('name', 'smis_rad_harga')->first();
        $temp = $harga ? json_decode($harga->value, true) : [];
        $key = array_keys($temp);

        $map_layanan = [];
        $map_harga = new stdClass();
        $total = 0;
        $tarif = 0;
        $slug_kelas = $kelas ? $kelas->value : '';

        foreach ($master_layanan as $lay) {
            if (in_array($lay->id, $req->pesan_pemeriksaan)) {
                $map_layanan['rad_' . $lay->id] = 1;
                $get_tarif = DB::table('smis_mjm_tarif_radiology')->where('slug', 'rad_' . $lay->id)->where('kelas', $kelas->value)->where('carabayar', $layanan->carabayar)->first();

                $concat_slug = $slug_kelas . '_rad_' . $lay->id;

                $map_harga->$concat_slug = (string)($get_tarif ? $get_tarif->tarif : 0);

                $tarif += $get_tarif ? $get_tarif->tarif : 0;
            } else {
                $map_layanan['rad_' . $lay->id] = 0;
            }
        }

        $new_kelas = $kelas ? $kelas->value : '';
        // $map_kelas = [];

        // for ($i = 0; $i < sizeof($key); $i++) {
        //     if (strpos($key[$i], $new_kelas) !== false) {
        //         $map_kelas[$key[$i]] = $temp[$key[$i]];
        //     }
        // }

        // $key_kelas = array_keys($map_kelas);

        // for ($i = 0; $i < sizeof($key_kelas); $i++) {
        //     $temp_slug = str_replace($new_kelas . '_', '', $key_kelas[$i]);
        //     if (array_key_exists($temp_slug, $map_layanan)) {
        //         if ($map_layanan[$temp_slug] == 1) {
        //             $total += $temp[$key_kelas[$i]];
        //         }
        //     }
        // }
        $pasien = SMIS_Pasien::where('id', $req->nrm)->where('prop', '')->first();
        $pesanan = Smis_Rad_Pesanan::where('id', $req->id_pesanan)->where('prop', '')->first();
        $data = [
            'tgl_lahir' => $pasien->tgl_lahir,
            'tanggal' => $req->tanggal . ' ' . date('H:i:s'),
            'nama_pasien' => $req->pasien,
            'nrm_pasien' => $req->nrm,
            'noreg_pasien' => $req->noreg,
            'kelas' => $kelas ? $kelas->value : '',
            'ruangan' => $req->ruangan,
            'no_lab' => $req->id_pesanan != 0 ? $pesanan->no_lab : 'RAD-' . $req->noreg . '/' . $this->romawi(date('m')) . '/' . $this->dua_digit_tahun(date('Y')) . '/' . ($last ? $last->id + 1 : 1),
            'carabayar' => $layanan ? $layanan->carabayar : '',
            'id_marketing' => '',
            'marketing' => '',
            'id_dokter' => $req->id_dokter,
            'nama_dokter' => $req->dokter,
            'id_konsultan' => $id_konsultan ? $id_konsultan->value : '',
            'nama_konsultan' => $nama_konsultan ? $nama_konsultan->value : '',
            'id_petugas' => '',
            'nama_petugas' => '',
            'periksa' => json_encode($map_layanan),
            'hasil' => $req->id_pesanan != 0 ? $pesanan->hasil : '',
            'umur' => $req->umur,
            'waktu_datang' => '',
            'waktu_ditangani' => '',
            'waktu_selesai' => '',
            'froll' => '',
            'f1824' => '',
            'f2430' => '',
            'f3040' => '',
            'f3535' => '',
            'f3543' => '',
            'file' => '',
            'sdq4335' => '',
            'dhf3543' => '',
            'dhf2636' => '',
            'dhf2025' => '',
            'dvb3543' => '',
            'dvb3528' => '',
            'dvb2025' => '',
            'fdental' => '',
            'operator' => $req->dokter,
            'jenis_kegiatan' => '',
            'biaya_konsul' => '',
            'harga' => json_encode($map_harga),
            'biaya' => $tarif,
            'total_biaya' => $tarif,
            'barulama' => $layanan ? $layanan->barulama : '',
            'waktu_daftar' => date('Y-m-d H:i:s'),
            'prop' => '',
        ];

        return $data;
    }
}
