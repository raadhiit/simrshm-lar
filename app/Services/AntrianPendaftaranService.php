<?php

namespace App\Services;

use App\Http\Controllers\Controller;
use App\Models\Mjkn_Patient;
use App\Models\SMIS_Pasien;
use App\Models\Propinsi;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use Illuminate\Support\Facades\DB;
use App\Models\JadwalPoli;
use App\Models\Antrian;
use Illuminate\Support\Facades\Validator;
use App\Helpers\GeneralHelper as GH;
use App\Http\Controllers\GuestRegistrationController;
use App\Models\SMIS_LayananPasien;

class AntrianPendaftaranService extends Controller
{
    function pasien_mjkn_daftar($id)
    {
        $mjkn = Mjkn_Patient::findOrFail($id);
        $cek = null;

        if ($mjkn->nobpjs != '') {
            $cek = SMIS_Pasien::where('nobpjs', $mjkn->nobpjs)->first();
        }

        if (is_null($cek)) {
            $cek = SMIS_Pasien::where('ktp', $mjkn->nik)->first();
            if (is_null($cek)) {
                $cek = SMIS_Pasien::where('nama', $mjkn->nama)->where('tgl_lahir', $mjkn->tgl_lahir)->first();
            }
        }

        if ($cek) {
            $update = Mjkn_Patient::where('id', $id)->update([
                'nrm' => $cek->id,
                'origin_updated' => 'verified'
            ]);

            DB::table('smis_rg_patient')->where('id', $cek->id)->update([
                'ktp' => $mjkn->nik,
                'nobpjs' => $mjkn->nobpjs,
                'telpon' => $mjkn->telepon
            ]);
            return $update;
        }

        if ($mjkn->kelamin == 0) {
            $sebutan = 'Tn.';
        } else if ($mjkn->kelamin == 1) {
            $sebutan = 'Ny.';
        } else {
            $sebutan = '';
        }

        $propinsi = Propinsi::findOrFail($mjkn->id_propinsi);
        $kabupaten = Kabupaten::findOrFail($mjkn->id_kabupaten);
        $kecamatan = Kecamatan::findOrFail($mjkn->id_kecamatan);
        $kelurahan = Kelurahan::findOrFail($mjkn->id_kelurahan);

        $insert = SMIS_Pasien::insert([
            "id" => SMIS_Pasien::max('id') + 1,
            'prop' => '',
            "tanggal" => date('Y-m-d'),
            "sebutan" => $sebutan,
            "nama" => $mjkn->nama,
            "alamat" => $mjkn->alamat,
            "tempat_lahir" => "",
            "tgl_lahir" => $mjkn->tgl_lahir,
            "status" => "",
            "kelamin" => $mjkn->kelamin,
            "ktp" => $mjkn->nik,
            "rt" => $mjkn->rt,
            "rw" => $mjkn->rw,
            "provinsi" => $mjkn->id_propinsi,
            "nama_provinsi" => $propinsi->nama,
            "kabupaten" => $mjkn->id_kabupaten,
            "nama_kabupaten" => $kabupaten->nama,
            "kecamatan" => $mjkn->id_kecamatan,
            "nama_kecamatan" => $kecamatan->nama,
            "kelurahan" => $mjkn->id_kelurahan,
            "nama_kelurahan" => $kelurahan->nama,
            "nama_kedusunan" => "",
            "kedusunan" => "0",
            "nobpjs" => $mjkn->nobpjs ? $mjkn->nobpjs : '',
            "telpon" => $mjkn->telepon,
            "pekerjaan" => "",
            "pendidikan" => "",
            "agama" => "",
            "umur" => "",
            "suami" => "",
            "istri" => "",
            "ayah" => "",
            "ibu" => "",
            "jenis" => "",
            "suku" => "",
            "bahasa" => "",
            "email" => "",
            "bbm" => "",
            "gol_darah" => "",
            "document" => "",
            "keterangan" => "",
            "id_karyawan" => "",
            "nama_karyawan" => "",
            "hubungan" => "",
            "synch" => "",
            "fingerprint" => "",
            "fingerprint_proses" => "",
            "profile_number" => "",
            "alamat_keluarga" => "",
            "desa_keluarga" => "",
            "kecamatan_keluarga" => "",
            "pekerjaan_keluarga" => "",
            "kabupaten_keluarga" => "",
            "umur_keluarga" => "",
            "telepon_keluarga" => "",
            "autonomous" => "",
            "duplicate" => 0,
            "origin" => "",
            "origin_id" => 0,
            "origin_updated" => "",
            "time_updated" => "",
            "kartu" => 0,
            "time_updated" => "",
            "umur" => 0,
            "id_karyawan" => 0,
            "synch" => 0,
            "time_updated" => date('Y-m-d H:i:s'),
            "origin_updated" => 'rshm'
        ]);

        Mjkn_Patient::where('id', $id)->update([
            'nrm' => SMIS_Pasien::max('id'),
            'origin_updated' => 'verified'
        ]);

        return $insert;
    }

    function insert_pasien_anjungan_mandiri($param)
    {
        $last = SMIS_Pasien::orderBy('id', 'desc')->first();
        $propinsi = Propinsi::findOrFail($param->propinsi);
        $kabupaten = Kabupaten::findOrFail($param->kabupaten);
        $kecamatan = Kecamatan::findOrFail($param->kecamatan);
        $kelurahan = Kelurahan::findOrFail($param->kelurahan);

        $dataPasien = [
            'nrm' => $last ? ((int)$last->id + 1) : '',
            "nama" => $param->nama,
            "alamat" => $param->alamat,
            "tgl_lahir" => $param->tanggallahir,
            "kelamin" => $param->kelamin,
            "nik" => $param->nik,
            "rt" => $param->rt,
            "rw" => $param->rw,
            "id_propinsi" => $param->propinsi,
            "propinsi" => $propinsi->nama,
            "id_kabupaten" => $param->kabupaten,
            "kabupaten" => $kabupaten->nama,
            "id_kecamatan" => $param->kecamatan,
            "kecamatan" => $kecamatan->nama,
            "id_kelurahan" => $param->kelurahan,
            "kelurahan" => $kelurahan->nama,
            "nobpjs" => $param->nobpjs ? $param->nobpjs : '',
            "telepon" => $param->phone,
            "origin_updated" => 'mobile-jkn'
        ];
        Mjkn_Patient::insert($dataPasien);
        $addPasien = Mjkn_Patient::orderBy('id', 'desc')->first();
        return $addPasien;
    }

    function update_mjkn_patient($req)
    {
        $propinsi = Propinsi::findOrFail($req->propinsi);
        $kabupaten = Kabupaten::findOrFail($req->kabupaten);
        $kecamatan = Kecamatan::findOrFail($req->kecamatan);
        $kelurahan = Kelurahan::findOrFail($req->kelurahan);

        $query = Mjkn_Patient::where('id', $req->id)->update([
            'nobpjs' => $req->nobpjs,
            'nik' => $req->nik,
            // 'no_kk' => $req->no_kk,
            'nama' => $req->nama,
            'kelamin' => $req->kelamin,
            'tgl_lahir' => $req->tgl_lahir,
            'telepon' => $req->telepon,
            'alamat' => $req->alamat,
            'id_propinsi' => $req->propinsi,
            'id_kabupaten' => $req->kabupaten,
            'id_kecamatan' => $req->kecamatan,
            'id_kelurahan' => $req->kelurahan,
            "propinsi" => $propinsi->nama,
            "kabupaten" => $kabupaten->nama,
            "kecamatan" => $kecamatan->nama,
            "kelurahan" => $kelurahan->nama,
            'rt' => $req->rt,
            'rw' => $req->rw,
        ]);
        return $query;
    }

    function pasien_daftar($req)
    {
        $valid = $this->valid($req->all());

        if ($valid['metadata']['code'] != "200") {
            return [
                'status' => false,
                'message' => $valid['metadata']['message'],
                'code' => 201
            ];
        }

        $poli = explode('-', $req['kodepoli']);
        $jadwal = $valid['response']['jadwal'];
        $pasien = $valid['response']['pasien'];
        $sisakuotajkn = $valid['response']['sisakuotajkn'];
        $sisakuotanonjkn = $valid['response']['sisakuotanonjkn'];
        $generate = GH::generateAntrean($jadwal['kodedokter_bpjs'], $jadwal['id'], $poli[0], $req->tanggalperiksa);
        $mili = strtotime($req->tanggalperiksa . ' ' . $jadwal->jam_mulai);
        $estimasi = ($mili * 1000) + (($generate['angkaantrean'] - 1) * ($jadwal->estimasi_layanan * 60000));

        if (isset($pasien->nik)) {
            if ($pasien->origin_updated != 'verified') {
                return [
                    'status' => false,
                    'message' => 'No. rekam medis anda ' . $pasien['nrm'] . ' tersebut hanya bersifat sementara. Harap datang ke admisi untuk verifikasi & melengkapi data rekam medis dengan membawa kartu identitas, pastikan data anda benar-benar valid & belum pernah terdaftar di RS Harapan Mulia',
                    'code' => 201
                ];
            }
        } else {
            if ($pasien->origin_updated == 'mobile-jkn') {
                return [
                    'status' => false,
                    'message' => 'No. rekam medis anda ' . $pasien['id'] . ' tersebut hanya bersifat sementara. Harap datang ke admisi untuk verifikasi & melengkapi data rekam medis dengan membawa kartu identitas, pastikan data anda benar-benar valid & belum pernah terdaftar di RS Harapan Mulia',
                    'code' => 201
                ];
            }
        }

        $count_baru_lama = SMIS_LayananPasien::where('nrm', $pasien['id'])->count();
        $antrian = new Antrian();
        if ($count_baru_lama > 0) {
            $antrian->pasien_baru = 0;
        } else {
            $antrian->pasien_baru = 1;
        }

        $jp = $req->jenis_pasien ? explode('-', $req->jenis_pasien) : [''];

        $antrian->taskid = 0;
        $antrian->nomorreferensi = $req->nomorreferensi ? $req->nomorreferensi : '';
        $antrian->tanggalperiksa = $req->tanggalperiksa;
        $antrian->namapj = $req->nama_pj ? $req->nama_pj : '';
        $antrian->telppj = $req->telp_pj ? $req->telp_pj : '';
        $antrian->jadwal_id = $jadwal['id'];
        $antrian->carabayar = $jp[0] ? $jp[0] : '';
        $antrian->asuransi = isset($req->asuransi) ? $req->asuransi : 0;
        $antrian->perusahaan = isset($req->perusahaan) ? $req->perusahaan : 0;
        $antrian->nomorantrean = $generate['nomorantrean'];
        $antrian->angkaantrean = $generate['angkaantrean'];
        $antrian->kodebooking = $generate['kodebooking'];
        $antrian->norm = $pasien['id'];
        $antrian->namapoli = $jadwal['nama_poli'];
        $antrian->namadokter = $jadwal['nama_dokter'];
        $antrian->estimasidilayani = $estimasi; // masih salah harus di ganti
        $antrian->sisakuotajkn = $sisakuotajkn;
        $antrian->sisakuotanonjkn = $sisakuotanonjkn;
        $antrian->kuotajkn = $jadwal['kuota_jkn'];
        $antrian->kuotanonjkn = $jadwal['kuota_non_jkn'];
        $antrian->kedatangan = $req->kedatangan ? $req->kedatangan : '';
        $antrian->jenis_perujuk = $req->jenis_perujuk ? $req->jenis_perujuk : '';
        $antrian->id_perujuk = $req->id_perujuk ? $req->id_perujuk : 0;
        $antrian->keterangan = 'Peserta harap 60 menit lebih awal guna pencatatan administrasi.';
        $antrian->created_at = date('Y-m-d H:i:s', strtotime('now'));
        $antrian->updated_at = date('Y-m-d H:i:s', strtotime('now'));

        $ref = $req->nomorreferensi ? $req->nomorreferensi : '';
        if (isset($req->nobpjs)) {
            if ($req->nomorreferensi == '-' || $req->nomorreferensi == '') {
                return [
                    'status' => false,
                    'message' => 'Nomor referensi belum sesuai',
                    'code' => 201
                ];
            }
            if (strlen($req->nomorreferensi) < 19) {
                return [
                    'status' => false,
                    'message' => 'Nomor referensi belum sesuai',
                    'code' => 201
                ];
            }
        }

        $param_antrian_bpjs = json_encode([
            'kodebooking' => $generate['kodebooking'],
            'jenispasien' => $req->nobpjs ? 'JKN' : 'NON JKN',
            'nomorkartu' => $req->nobpjs ? $req->nobpjs : '-',
            'nik' => $pasien['ktp'],
            'nohp' => $pasien['telpon'],
            'kodepoli' => $jadwal['kodepoli_bpjs'],
            'namapoli' => $jadwal['nama_poli'],
            'pasienbaru' => $antrian->pasien_baru,
            'norm' => $pasien['id'],
            'tanggalperiksa' => $antrian->tanggalperiksa,
            'kodedokter' => (int)$jadwal['kodedokter_bpjs'],
            'namadokter' => $jadwal['nama_dokter'],
            'jampraktek' => $jadwal['jam_mulai'] . '-' . $jadwal['jam_selesai'],
            'jeniskunjungan' => (int)$req->jenis_kunjungan,
            'nomorreferensi' => $ref,
            'nomorantrean' => $generate['nomorantrean'],
            'angkaantrean' => $generate['angkaantrean'],
            'estimasidilayani' => $estimasi,
            "sisakuotajkn" => $sisakuotajkn,
            "kuotajkn" => $jadwal['kuota_jkn'],
            "sisakuotanonjkn" => $sisakuotanonjkn,
            "kuotanonjkn" => $jadwal['kuota_non_jkn'],
            "keterangan" => $antrian->keterangan
        ]);

        $grc = new GuestRegistrationController();
        $result = $grc->post_bpjs('antrean/add', $param_antrian_bpjs);

        if ($result['status']) {
            if ($result['code'] == 200) {
                $antrian->response_code = 200;
                $antrian->response_message = 'Ok';
                $antrian->save();
                $ktp = $pasien->nik ? $pasien->nik : $pasien->ktp;
                return [
                    'status' => true,
                    'message' => 'Ok',
                    'pasien' => $pasien,
                    'antrian' => $antrian,
                    'code' => 200
                ];
            } else {
                return [
                    'status' => false,
                    'message' => $result['message'],
                    'code' => 201,
                ];
            }
        } else {
            return [
                'status' => false,
                'message' => $result['message'],
                'code' => 201
            ];
        }
    }

    function valid($param)
    {
        $poli = explode('-', $param['kodepoli']);
        $jadwal = new JadwalPoli();
        // jika poli tidak ada
        $jadwal = $jadwal->where("kodepoli_bpjs", $poli[0]);
        if (is_null($jadwal->first())) {
            return $this->responseFormat("Poli tidak ditemukan.", 201);
        }
        // jika dokter tidak ada
        $jadwal = $jadwal->where("kodedokter_bpjs", $param['kodedokter']);
        if (is_null($jadwal->first())) {
            return $this->responseFormat("Dokter di Poli ini tidak ditemukan.", 201);
        }
        // jika format tanggal salah
        $checkTgl = Validator::make(["tanggalperiksa" => $param['tanggalperiksa']], [
            'tanggalperiksa' => 'date_format:Y-m-d',
        ]);
        if ($checkTgl->fails()) {
            return $this->responseFormat("Format tanggal salah gunakan format Y-m-d.", 201);
        }
        // jika tanggal telah berlalu
        if (date("Y-m-d") > $param['tanggalperiksa']) {
            return $this->responseFormat("Tanggal periksa yang anda masukkan telah berlalu.", 201);
        }
        // tidak bisa ambil antrian di hari H
        // if (date("Y-m-d") == $param['tanggalperiksa']) {
        //     return $this->responseFormat("Anda tidak dapat mengambil antrian di hari H.", 201);
        // }
        // jika format jam praktek salah
        $jampraktek = explode("-", $param['jampraktek']);
        if (count($jampraktek) < 2 || ($jampraktek[0] == "" && $jampraktek[1] == ""))
            return $this->responseFormat("Format jam praktek salah, contoh yang benar: 08:00-10:00", 201);
        // date_default_timezone_set('Asia/Jakarta');
        // dd(date_create('+7 hours')->format('Y-m-d H:i') . ' - ' . $param['tanggalperiksa'] . ' ' . $jampraktek[1]);
        // exit();
        $sekarang = strtotime('now');
        $str_jadwal = strtotime($param['tanggalperiksa'] . ' ' . $jampraktek[1]);
        if ($sekarang > $str_jadwal) {
            return $this->responseFormat("Pendaftaran ke poli " . $poli[1] . " sudah tutup jam " . $jampraktek[1], 201);
        }
        // jika jadwal tidak ada
        $hari = date("N", strtotime($param['tanggalperiksa']));
        $jadwal = $jadwal->where("hari", $hari);
        $jadwal = $jadwal->where("jam_mulai", $jampraktek[0]);
        $jadwal = $jadwal->where("jam_selesai", $jampraktek[1])->first();
        if (is_null($jadwal)) {
            return $this->responseFormat("Jadwal tidak ditemukan.", 201);
        }

        if ($param['nobpjs'] != '' && $param['nobpjs'] != null) { // jika pasien bpjs
            $pasien = SMIS_Pasien::where("nobpjs", $param['nobpjs'])->where('prop','')->first();
            if (is_null($pasien)) {
                $pasien = Mjkn_Patient::where('nobpjs', $param['nobpjs'])->first();
            }
        } else { // jika pasien non bpjs
            $pasien = SMIS_Pasien::where("ktp", $param['ktp'])->where('prop','')->first();
            if (is_null($pasien)) {
                $pasien = Mjkn_Patient::where('nik', $param['ktp'])->first();
            }
        }
        // dd($param);
        if (is_null($pasien)) {
            return $this->responseFormat("Data Pasien tidak ditemukan, silahkan daftar baru.", 202);
        }
        // dd($pasien);
        // last antrian
        $lastAntrian = Antrian::where(['jadwal_id' => $jadwal->id, 'tanggalperiksa' => $param['tanggalperiksa']])->orderBy("id", "desc")->first();
        // sisa antrian jkn
        if (!is_null($lastAntrian))
            $sisakuotajkn = $lastAntrian->sisakuotajkn;
        else
            $sisakuotajkn = $jadwal->kuota_jkn;
        if (isset($param['nobpjs'])) { // jika pasien bpjs
            if ($sisakuotajkn <= 0) { // jika kuota jkn habis
                return $this->responseFormat("Sisa kuota Pasien BPJS sudah habis.", 201);
            }
            $sisakuotajkn = $sisakuotajkn - 1;
        }
        // sisa antrian non jkn
        if (!is_null($lastAntrian))
            $sisakuotanonjkn = $lastAntrian->sisakuotanonjkn;
        else
            $sisakuotanonjkn = $jadwal->kuota_non_jkn;
        if (!isset($param['nobpjs'])) { // jika pasien non bpjs
            if ($sisakuotanonjkn <= 0) { // jika kuota non jkn habis
                return $this->responseFormat("Sisa kuota Pasien Non BPJS sudah habis.", 201);
            }
            $sisakuotanonjkn = $sisakuotanonjkn - 1;
        }

        // jika sudah ambil antrian
        if (!is_null(Antrian::where(['jadwal_id' => $jadwal->id, 'tanggalperiksa' => $param['tanggalperiksa']])->where("norm", $pasien->id)->where('taskid', '!=', 99)->first()))
            return $this->responseFormat("Anda telah mengambil Antrian di poli ini untuk tanggal " . date('d-m-Y', strtotime($param['tanggalperiksa'])), 201);
        // jika validasi sudah benar
        return $this->responseFormat("ok", 200, ["jadwal" => $jadwal, "sisakuotajkn" => $sisakuotajkn, "sisakuotanonjkn" => $sisakuotanonjkn, "pasien" => $pasien]);
    }
}
