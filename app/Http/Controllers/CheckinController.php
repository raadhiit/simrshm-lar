<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use App\Models\JadwalPoli;
use App\Models\SMIS_Pasien;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Models\RsCredential;
use App\Models\SMIS_Ksr_Kolektif;
use App\Models\SMIS_LayananPasien;
use App\Models\SMIS_Rg_Asuransi;
use App\Models\SMIS_Rwt_Antrian;
use App\Models\SmisAdmPrototype;
use App\Models\SmisHrdEmployee;
use App\Models\SMIS_Mjm_Tarif_Pendaftaran;
use App\Models\SmisAdmSettings;
use App\Services\SmisService;
use App\Services\SatuSehatService;
use App\Services\SatuSehatEncounterService;
use DateTime;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use stdClass;
use Auth;
use File;

class CheckinController extends Controller
{
    function index()
    {
        return view('checkin.index');
    }

    function antrian_by_kode_booking(Request $req)
    {
        $query = Antrian::join('smis_rg_patient', 'smis_rg_patient.id', 'antrians.norm')
            ->select('antrians.*', 'smis_rg_patient.nama as pasien', 'smis_rg_patient.tgl_lahir');
        if ($req->jenis_nomor) {
            switch ($req->jenis_nomor) {
                case 'nobpjs':
                    $antrian = $query->where('nomorkartu', $req->kode_booking)->where('tanggalperiksa', date('Y-m-d'));
                    break;
                case 'nrm':
                    $antrian = $query->where('norm', $req->kode_booking)->where('tanggalperiksa', date('Y-m-d'));
                    break;
                case 'kodebooking':
                    $antrian = $query->where('kodebooking', $req->kode_booking);
                    break;
                default:
                    $antrian = $query->where('kodebooking', $req->kode_booking);
                    break;
            }
        } else {
            $antrian = $query->where('kodebooking', $req->kode_booking);
        }
        $data = $antrian->first();
        return response()->json($data);
    }

    function checkin(Request $req, SmisService $ss, SatuSehatService $sss, SatuSehatEncounterService $sses)
    {
        try {
            $antrian = Antrian::where('kodebooking', $req->kodebooking)->first();

            $cek_layanan = SMIS_LayananPasien::where('nrm', $antrian->norm)->where('selesai', 0)->first();

            $taskid = 3;

            if ($antrian->pasien_baru == 1) {
                $taskid = 1;
            }

            $wak = strtotime(now());

            $hit_bpjs = $this->update_waktu_antrian($taskid, $req->kodebooking, $wak . '000');

            if ($hit_bpjs['code'] == 200 || $hit_bpjs['code'] == 208) {
                Antrian::where('kodebooking', $req->kodebooking)->update([
                    'taskid' => $taskid,
                    'waktu_checkin' => $wak . '000',
                ]);

                $cred = RsCredential::where('layanan', 'like', 'antrian')->first();
                $pasien = SMIS_Pasien::where('id', $antrian->norm)->first();
                $jadwal = JadwalPoli::findOrFail($antrian->jadwal_id);

                $employee = SmisHrdEmployee::where('id', $jadwal->id_dokter)->first();
                $data_layanan = $this->data_layanan_pasien($pasien, $antrian, $cred);

                $pasien = SMIS_Pasien::where('id', $antrian->norm)->first();

                DB::beginTransaction();
                $add_layanan = DB::table('smis_rg_layananpasien')->insert($data_layanan);
                $noreg = SMIS_LayananPasien::orderBy('id', 'desc')->first();

                $add_riwayat_antrian = DB::table('smis_rwt_antrian_' . $jadwal->slug_poli)->insert($this->data_riwayat_antrian($data_layanan, $pasien, $jadwal, $wak, $antrian));

                $add_ksr = DB::table('smis_ksr_kolektif')->insert($this->data_ksr_kolektif($data_layanan, $pasien, $antrian, $wak));

                DB::table('antrians')->where('kodebooking', $req->kodebooking)->update([
                    'noreg' => $noreg->id,
                ]);

                $push_jurnal = $ss->post(
                    env('SMIS_URL_JURNAL'),
                    [
                        [
                            'name'     => 'status',
                            'contents' => 'insert'
                        ],
                        [
                            'name'     => 'noreg',
                            'contents' => $noreg->id
                        ]
                    ]
                )->getBody()->getContents();

                if (!$push_jurnal) {
                    DB::rollBack();
                    return response()->json([
                        'status' => false,
                        'message' => 'Gagal push jurnal, checkin gagal',
                    ]);
                }

                DB::commit();

                if ($antrian->carabayar == 'bpjs') {
                    if (!is_dir('/var/www/html/casemix/files/shares/' . $noreg->id)) {
                        mkdir('/var/www/html/casemix/files/shares/' . $noreg->id, 0777, true);
                        chmod('/var/www/html/casemix/files/shares/' . $noreg->id, 0777);
                    }
                }

                return response()->json([
                    'status' => true,
                    'message' => 'Anda berhasil checkin',
                    'kodebooking' => $req->kodebooking,
                    'new_noreg' => $noreg->id,
                    'antrian' => $antrian
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => $hit_bpjs['message'],
                ]);
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ]);
        }
    }

    function update_waktu_antrian($taskid, $kode, $waktu)
    {
        try {
            $client = new Client([
                'verify' => false
            ]);

            $credentials = RsCredential::where('layanan', 'like', 'antrian')->first();

            if (is_null($credentials)) {
                return [
                    'status' => false,
                    'message' => 'Credentials tidak ditemukan'
                ];
            }

            date_default_timezone_set('UTC');
            $timeStamp = strval(time() - strtotime('1970-01-01 00:00:00'));
            $signature = $this->get_signature($timeStamp, $credentials->cons_id, $credentials->cons_secret);

            $response = $client->request('post', $credentials->base_url . '/antrean/updatewaktu', [
                'headers' => [
                    'x-cons-id'     => $credentials->cons_id,
                    'x-timestamp'  => $timeStamp,
                    'x-signature'   => $signature,
                    'user_key' => $credentials->user_key,
                ],
                'body' => json_encode([
                    "kodebooking" => $kode,
                    "taskid" => $taskid,
                    "waktu" => $waktu
                ])
            ])->getBody()->getContents();

            $result = json_decode($response);

            if ($result->metadata->code == 200) {
                return [
                    'status' => true,
                    'message' => $result->metadata->message,
                    'code' => $result->metadata->code,
                ];
            } else {
                return [
                    'status' => false,
                    'message' => $result->metadata->message,
                    'code' => $result->metadata->code,
                ];
            }
        } catch (\Throwable $th) {
            return [
                'status' => false,
                'message' => $th->getMessage(),
                'code' => 500,
            ];
        }
    }

    function get_signature($timeStamp, $cons_id, $cons_secret)
    {
        $signature = hash_hmac('sha256', $cons_id . "&" . $timeStamp, $cons_secret, true);
        $encodedSignature = base64_encode($signature);
        return $encodedSignature;
    }

    function data_ksr_kolektif($layanan, $pasien, $antrian, $waktu)
    {
        $tabel_ksr = new SMIS_Ksr_Kolektif();
        $tabel_ksr = $tabel_ksr->getTable();
        $columns = Schema::getColumnListing($tabel_ksr);
        $dataArray = [];

        $jadwal = JadwalPoli::where('id', $antrian->jadwal_id)->first();

        foreach ($columns as $column) {
            $type_column = Schema::getColumnType($tabel_ksr, $column);

            $default_input = "";
            if (in_array($type_column, ["integer", "boolean", 'tinyinteger'])) $default_input = 0;
            if (in_array($type_column, ["string", "text", 'varchar'])) $default_input = "";
            if (in_array($type_column, ["datetime"])) $default_input = '0000-00-00 00:00:00';

            $dataArray[$column] = @$layanan[$column] ?? $default_input;

            $last = SMIS_Ksr_Kolektif::orderBy('id', 'desc')->first();
            $urutan = SmisAdmSettings::where('name', 'cashier-replace-order-registration')->first();
            $nama_grup = SmisAdmSettings::where('name', 'cashier-replace-tipe-registration')->first();
            $map = SmisAdmSettings::where('name', 'cashier-map-area-registration')->first();

            $barulama = $antrian->pasien_baru == 1 ? 0 : 1;

            $hpp = SMIS_Mjm_Tarif_Pendaftaran::select('formulir', 'kartu_pasien')->where('slug', $jadwal->slug_poli)->where('barulama', $barulama)->first();
            $karcis = SMIS_Mjm_Tarif_Pendaftaran::where('slug', $jadwal->slug_poli)->where('barulama', $barulama)->first();

            $dataArray['id_dokter'] = $layanan['id_dokter'];
            $dataArray['urjigd'] = 'URJ';
            $dataArray['tanggal_tagihan'] = date('Y-m-d');
            $dataArray['carabayar'] = $layanan['carabayar'];
            $dataArray['tanggal_masuk'] = date('Y-m-d');
            $dataArray['tanggal_pulang'] = '0000-00-00';
            $dataArray['id'] = $last ? (int) $last->id + 1 : 1;
            $dataArray['urutan'] = $urutan ? $urutan->value : '';
            $dataArray['nama_grup'] = $nama_grup ? $nama_grup->value : '';
            $dataArray['jenis_tagihan'] = $nama_grup ? $nama_grup->value : '';
            $dataArray['nama_tagihan'] = 'Karcis Pendaftaran Pasien (' . strtoupper($jadwal->slug_poli) . ')';
            $dataArray['id_unit'] = $layanan['id'];
            $dataArray['noreg_pasien'] = $layanan['id'];
            $dataArray['nrm_pasien'] = $pasien->id;
            $dataArray['nama_pasien'] = $pasien->nama;
            $dataArray['jenis_tagihan'] = 'registration';
            $dataArray['nama_grup'] = 'registration';
            $dataArray['nama_dokter'] = $antrian->namadokter;
            $dataArray['ruangan'] = $nama_grup ? $nama_grup->value : '';
            $dataArray['ruangan_map'] = $map ? $map->value : '';
            $dataArray['tanggal'] = $this->convertTanggal($antrian->tanggalperiksa);
            $dataArray['quantity'] = 1;
            $dataArray['hidden'] = 0;
            $dataArray['status'] = 0;
            $dataArray['ruangan_kasir'] = $nama_grup ? $nama_grup->value : '';
            $dataArray['id_kwitansi'] = 0;
            $dataArray['akunting'] = 0;
            $dataArray['ruangan'] = 'registration';
            $dataArray['ruangan_kasir'] = $map ? strtolower($map->value) : '';
            $dataArray['nama_tagihan'] = 'Karcis Pendaftaran Pasien (' . strtoupper($jadwal->slug_poli) . ')';
            $dataArray['akunting_only'] = 0;
            $dataArray['akunting_nama'] = 'Karcis Pendaftaran Pasien (' . strtoupper($jadwal->slug_poli) . ')';
            $dataArray['keterangan'] = 'Karcis ' . $jadwal->slug_poli . ' Senilai Rp. ' . number_format($karcis ? $karcis->harga_total : 0, 0, ',', '.') . ',00 Belum dibayar';
            $dataArray['total'] = $karcis ? $karcis->harga_total * 1 : 0;
            $dataArray['nilai'] = $karcis ? $karcis->harga_total : 0;
            $dataArray['dari'] = date('Y-m-d H:i:s', 25200 + $waktu);
            $dataArray['sampai'] = date('Y-m-d H:i:s', 25200 + $waktu);
            $dataArray['hpp'] = $hpp ? $hpp->formulir + $hpp->kartu_pasien : 0;

            return $dataArray;
        }
    }

    function convertTanggal($param)
    {
        $temp = explode('-', $param);
        switch ($temp[1]) {
            case '01':
                return $temp[2] . ' Januari ' . $temp[0];
                break;
            case '02':
                return $temp[2] . ' Februari ' . $temp[0];
                break;
            case '03':
                return $temp[2] . ' Maret ' . $temp[0];
                break;
            case '04':
                return $temp[2] . ' April ' . $temp[0];
                break;
            case '05':
                return $temp[2] . ' Mei ' . $temp[0];
                break;
            case '06':
                return $temp[2] . ' Juni ' . $temp[0];
                break;
            case '07':
                return $temp[2] . ' Juli ' . $temp[0];
                break;
            case '08':
                return $temp[2] . ' Agustus ' . $temp[0];
                break;
            case '09':
                return $temp[2] . ' September ' . $temp[0];
                break;
            case '10':
                return $temp[2] . ' Oktober ' . $temp[0];
                break;
            case '11':
                return $temp[2] . ' November ' . $temp[0];
                break;
            case '12':
                return $temp[2] . ' Desember ' . $temp[0];
                break;
            default:
                return '';
                break;
        }
    }

    function data_riwayat_antrian($layanan, $pasien, $jadwal, $waktu, $antrian)
    {
        $tabel_riwayat = new SMIS_Rwt_Antrian();
        $tabel_riwayat = $tabel_riwayat->getTable();
        $columns = Schema::getColumnListing($tabel_riwayat);
        $dataArray = [];

        foreach ($columns as $column) {
            $type_column = Schema::getColumnType($tabel_riwayat, $column);

            $default_input = "";
            if (in_array($type_column, ["integer", "boolean", 'tinyinteger'])) $default_input = 0;
            if (in_array($type_column, ["string", "text", 'varchar'])) $default_input = "";
            if (in_array($type_column, ["datetime"])) $default_input = '0000-00-00 00:00:00';

            $dataArray[$column] = @$layanan[$column] ?? $default_input;

            $kunjungan = DB::table('smis_rwt_antrian_' . $jadwal->slug_poli)->where('nrm_pasien', $pasien->id)->count();
            $origin_id_max = DB::table('smis_rwt_antrian_' . $jadwal->slug_poli)->orderBy('origin_id', 'desc')->first();
            $rl52 = SmisAdmSettings::where('name', 'smis-rs-rl52-default-' . $jadwal->slug_poli)->first();
            $origin_updated = SmisAdmSettings::where('name', 'smis_autonomous_id')->first();

            $detail = new stdClass();
            $detail->alamat = $pasien->alamat;
            $detail->ibu = $pasien->ibu;
            $detail->caradatang = $antrian->kedatangan;
            $detail->tgl_lahir = $pasien->tgl_lahir;
            $detail->no_profile = '';
            $detail->faskes = '';
            $dataArray['waktu'] = date('Y-m-d H:i:s', 25200 + $waktu);
            $dataArray['waktu_register'] = date('Y-m-d H:i:s', 25200 + $waktu);
            $dataArray['no_register'] = $layanan['id'];
            $dataArray['kunjungan'] = $kunjungan == '0' ? 'Baru' : 'Lama';
            $dataArray['nama_pasien'] = $pasien->nama;
            $dataArray['jk'] = $pasien->kelamin;
            $dataArray['carabayar'] = $layanan['carabayar'];
            $dataArray['nrm_pasien'] = $pasien->id;
            $dataArray['nomor'] = $layanan['no_urut'];
            $dataArray['umur'] = $layanan['umur'];
            $dataArray['golongan_umur'] = $layanan['gol_umur'];
            $dataArray['asal'] = 'Pendaftaran';
            $dataArray['alamat'] = $pasien->alamat;
            $dataArray['autonomous'] = '[' . ($dataArray['origin_updated'] = $origin_updated ? $origin_updated->value : '') . ']';
            $dataArray['origin'] = $origin_updated ? $origin_updated->value : '';
            $dataArray['origin_id'] = $origin_id_max ? (int) $origin_id_max->origin_id + 1 : 1;
            $dataArray['origin_updated'] = $origin_updated ? $origin_updated->value : '';
            $dataArray['time_updated'] = date('Y-m-d H:i:s', 25200 + $waktu);
            $dataArray['rl52'] = $rl52 ? $rl52->value : '';
            $dataArray['dokter'] = $jadwal->nama_dokter;
            $dataArray['kelas'] = 'non_kelas';
            $dataArray['detail'] = json_encode($detail);

            return $dataArray;
        }
    }

    function data_layanan_pasien($req, $ant, $cred)
    {
        $jadwal = JadwalPoli::where('id', $ant->jadwal_id)->first();
        $table_pasien = new SMIS_LayananPasien();
        $table_pasien = $table_pasien->getTable();

        $columns = Schema::getColumnListing($table_pasien);
        $dataArray = [];

        foreach ($columns as $column) {
            $type_column = Schema::getColumnType($table_pasien, $column);

            $default_input = "";
            if (in_array($type_column, ["integer", "boolean", 'tinyinteger'])) $default_input = 0;
            if (in_array($type_column, ["string", "text", 'varchar'])) $default_input = "";
            if (in_array($type_column, ["datetime"])) $default_input = '0000-00-00 00:00:00';

            $dataArray[$column] = @$req[$column] ?? $default_input;
        }

        $last = SMIS_LayananPasien::orderBy('id', 'desc')->first();
        $jml_kunjungan = SMIS_LayananPasien::where('nrm', $req->id)->count();
        $origin_updated = SmisAdmSettings::where('name', 'smis_autonomous_id')->first();
        $rl52 = SmisAdmSettings::where('name', 'smis-rs-rl52-default-' . $jadwal->slug_poli)->first();

        $barulama = $ant->pasien_baru == 1 ? 0 : 1;

        $karcis = SMIS_Mjm_Tarif_Pendaftaran::where('slug', $jadwal->slug_poli)->where('barulama', $barulama)->first();

        $age = 'TGL LAHIR TDK VALID';
        $gol_umur = 'TGL LAHIR TDK VALID';

        if ($req->tgl_lahir != '0000-00-00') {
            if ($req->tgl_lahir == date('Y-m-d')) {
                $age = '0 Tahun';
                $gol_umur = '0 - 28 HR';
            } else {
                $bday = new DateTime($req->tgl_lahir); // Your date of birth
                $today = new Datetime(date('y-m-d'));
                $diff = $today->diff($bday);
                $age = $diff->y . ' Tahun ' . $diff->m . ' Bulan ' . $diff->d . ' Hari';
                $gol_umur = $this->convert_gol_umur($diff->y, $diff->m, $diff->d);
            }
        }

        $perujuk = DB::table('smis_rg_perujuk')->where('id', $ant->id_perujuk)->first();

        $dataArray['last_nama_ruangan'] = $ant->namapoli;
        $dataArray['jenis_kegiatan'] = $rl52 ? $rl52->value : '';
        $dataArray['last_kelas'] = 'non_kelas';
        $dataArray['oprj'] = Auth::check() ? Auth::user()->username : '';

        $dataArray['carabayar'] = $ant->carabayar;
        $dataArray['asuransi'] = $ant->asuransi;
        $dataArray['nama_perusahaan'] = $ant->perusahaan;
        $dataArray['id'] = $last ? (int) $last->id + 1 : 1;
        $dataArray['nobpjs'] = $req->nobpjs;
        $dataArray['rujukan'] = $ant->jenis_perujuk;
        $dataArray['id_rujukan'] = $ant->id_perujuk;
        $dataArray['nama_rujukan'] = $perujuk ? $perujuk->nama : '';
        // $dataArray['ktp'] = $req->ktp;
        $dataArray['umur'] = $age;
        $dataArray['caradatang'] = $ant->kedatangan;
        $dataArray['gol_umur'] = $gol_umur;

        $dataArray['namapenanggungjawab'] = $ant->namapj;
        $dataArray['telponpenanggungjawab'] = $ant->telppj;
        $dataArray['no_urut'] = $ant->angkaantrean;
        $dataArray['jenislayanan'] = $jadwal->slug_poli;
        $dataArray['kelamin'] = $req->kelamin;
        $dataArray['barulama'] = $jml_kunjungan == 0 ? 0 : 1;
        $dataArray['no_kunjungan'] = $jml_kunjungan + 1;
        $dataArray['tanggal'] = date('Y-m-d H:i:s', strtotime('-7h' . now()));;
        $dataArray['alamat_pasien'] = $req->alamat;
        $dataArray['nama_provinsi'] = $req->nama_provinsi;
        $dataArray['nama_kabupaten'] = $req->nama_kabupaten;
        $dataArray['nama_kecamatan'] = $req->nama_kecamatan;
        $dataArray['nama_kelurahan'] = $req->nama_kelurahan;
        $dataArray['nrm'] = $req->id;
        $dataArray['last_ruangan'] = $jadwal->slug_poli;
        $dataArray['nama_pasien'] = $req->nama;
        $dataArray['id_dokter'] = $jadwal->id_dokter;
        $dataArray['nama_dokter'] = $jadwal->nama_dokter;
        $dataArray['prop'] = "";
        $dataArray['ppk_bpjs'] = $cred->kode_ppk;
        $dataArray['lama_dirawat'] = 0;
        $dataArray['last_edit_timestamp'] = date('Y-m-d H:i:s', strtotime('-7h' . now()));;
        $dataArray['time_updated'] = date('Y-m-d H:i:s', strtotime('-7h' . now()));;
        $dataArray['origin_updated'] = 'rshm';
        $dataArray['origin'] = "";
        $dataArray['karcis'] = $karcis ? $karcis->harga_total : 0;
        $dataArray['autonomous'] = "";

        return $dataArray;
    }

    function convert_gol_umur($tahun, $bulan, $hari)
    {
        if ($tahun == 0 && $bulan == 0) {
            return '0 - 28 HR';
        }
        if (($tahun <= 1 && $bulan > 0) && ($tahun <= 1 && $hari >= 0)) {
            return '28 HR - 1 TH';
        }

        if ((($tahun >= 1 && $hari >= 0) || ($tahun >= 1 && $bulan > 0)) && $tahun < 5) {
            return '1 - 4 TH';
        } else if ($tahun >= 5 && $tahun <= 14) {
            return '5-14 TH';
        } else if ($tahun > 14 && $tahun <= 24) {
            return '15-24 TH';
        } else if ($tahun > 24 && $tahun <= 44) {
            return '25-44 TH';
        } else if ($tahun > 44 && $tahun <= 59) {
            return '45-59 TH';
        } else if ($tahun > 59 && $tahun <= 64) {
            return '60-64 TH';
        } else if ($tahun > 64) {
            return '>65 TH';
        }
    }
}
