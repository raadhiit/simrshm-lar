<?php

namespace App\Http\Controllers;

// use DB;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;
use App\Models\Antrian;
use App\Models\Propinsi;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\JadwalPoli;
use App\Models\JenisPasien;
use App\Models\SMIS_Pasien;
use App\Events\AntrianEvent;
use App\Models\AvailableBed;
use App\Models\Mjkn_Patient;
use App\Models\RsCredential;
use Illuminate\Http\Request;
use App\Models\SMIS_Rg_Asuransi;
use App\Models\AntrianPendaftaran;
use App\Models\SMIS_LayananPasien;
use App\Models\SMIS_Rg_Perusahaan;
use App\Helpers\GeneralHelper as GH;
use App\Services\AntrianPoliService;
use App\Services\AntrianManualService;
use App\Http\Requests\PasienBpjsRequest;
use App\Http\Requests\PasienUmumRequest;
use Illuminate\Support\Facades\Validator;
use App\Services\AntrianPendaftaranService;
use App\Http\Controllers\Api\Wsrs\AmbilAntrian;

class GuestRegistrationController extends Controller
{
    function send_broadcast(Request $req, AntrianManualService $ams)
    {
        $poli = $req->poli ? $req->poli : '';
        $baru = $req->baru == 1 ? 1 : 0;

        if ($req->manual == '1') {
            $jenis = $req->jenis;

            $last = $ams->getLastAntrian($jenis);
            if ($req->tipe == 'next') {
                if ($last->last_queue <= $last->last_call) {
                    AntrianPendaftaran::where('id', $last->id)->update(['last_call' => $last->last_queue]);
                    return response()->json([
                        'status' => false,
                        'message' => 'Sudah antrian terakhir.'
                    ]);
                }
                event(new AntrianEvent(null, $jenis, $req->loket, ($last->last_call + 1), $req->bagian, $req->pasien, $poli, $req->lantai, $baru, $req->manual));
                $ams->next($req->all());
                return response()->json([
                    'status' => true,
                    'message' => 'Ok.',
                    'data' => $ams->getLastAntrian($jenis)
                ]);
            } else {
                event(new AntrianEvent(null, $jenis, $req->loket, $last->last_call, $req->bagian, $req->pasien, $poli, $req->lantai, $baru, $req->manual));
                return response()->json([
                    'status' => true,
                    'message' => 'Ok.'
                ]);
            }
        } else {
            $jadwal =  $req->id_jadwal ? JadwalPoli::where('id', $req->id_jadwal)->where('prop', '')->first() : null;
            event(new AntrianEvent($jadwal, '', $req->loket, $req->nomor, $req->bagian, $req->pasien, $poli, $req->lantai, $baru, $req->manual));

            return response()->json([
                'status' => true,
                'message' => 'Ok.'
            ]);
        }
    }

    function cetak_antrian(Request $req)
    {
        $data['data'] = Antrian::leftJoin('smis_rg_patient', 'smis_rg_patient.id', 'antrians.norm')
            ->select('antrians.*', 'smis_rg_patient.nama as pasien')
            ->where('smis_rg_patient.prop', '')->where('kodebooking', $req->nomor)->first();
        return view('guest.cetak_antrian', $data);
    }

    function index()
    {
        return view('guest.home');
    }

    function umum()
    {
        $data['propinsi'] = Propinsi::all();
        return view('guest.umum', $data);
    }

    function bpjs()
    {
        $data['propinsi'] = Propinsi::all();
        return view('guest.bpjs', $data);
    }

    function ajax_request_kabupaten(Request $req)
    {
        return response()->json(Kabupaten::where('no_prop', $req->propinsi)->get());
    }

    function ajax_request_kecamatan(Request $req)
    {
        return response()->json(Kecamatan::where('no_kab', $req->kabupaten)->get());
    }

    function ajax_request_kelurahan(Request $req)
    {
        return response()->json(Kelurahan::where('no_kec', $req->kecamatan)->get());
    }

    function ajax_request_pasien(Request $req)
    {
        return response()->json(SMIS_Pasien::where('prop', '')->where(function ($q) use ($req) {
            $q->where('id', $req->nomor)->orWhere('ktp', $req->nomor);
        })->first());
    }

    function ajax_request_pasien_bpjs(Request $req)
    {
        return response()->json(SMIS_Pasien::where('prop', '')->where('nobpjs', $req->nomor)->first());
    }

    function daftar_pasien_umum(Request $req)
    {
        $data['pasien'] = SMIS_Pasien::findOrFail($req->pasien);
        if ($data['pasien']->telpon == '') {
            return redirect()->back()->with('gagal', 'Pasien tidak dapat didaftarkan karena belum mengisi no telepon');
        }
        $data['poli'] = JadwalPoli::select('kodepoli_bpjs', 'nama_poli')->groupBy(['kodepoli_bpjs', 'nama_poli'])->get();
        $data['jenispasien'] = JenisPasien::where('prop', '')->get();
        $data['asuransi'] = SMIS_Rg_Asuransi::where('prop', '')->get();
        $data['perusahaan'] = SMIS_Rg_Perusahaan::where('prop', '')->get();
        return view('guest/pasien_umum_daftar', $data);
    }

    function daftar_pasien_bpjs(Request $req)
    {
        $data['pasien'] = SMIS_Pasien::findOrFail($req->pasien);
        if ($data['pasien']->telpon == '') {
            return redirect()->back()->with('gagal', 'Pasien tidak dapat didaftarkan karena belum mengisi no telepon');
        }
        $data['poli'] = JadwalPoli::select('kodepoli_bpjs', 'nama_poli')->groupBy(['kodepoli_bpjs', 'nama_poli'])->get();
        $data['jenispasien'] = JenisPasien::where('prop', '')->get();
        $data['asuransi'] = SMIS_Rg_Asuransi::where('prop', '')->get();
        $data['perusahaan'] = SMIS_Rg_Perusahaan::where('prop', '')->get();
        return view('guest/pasien_bpjs_daftar', $data);
    }

    function ajax_request_dokter_by_poli(Request $req)
    {
        $temp = explode('-', $req->kode);
        $data = JadwalPoli::where('kodepoli_bpjs', $temp[0])->where('nama_poli', $temp[1])->select('kodedokter_bpjs', 'nama_dokter')->groupBy('kodedokter_bpjs', 'nama_dokter')->get();
        return response()->json($data);
    }

    function ajax_request_jam_praktek_by_dokter(Request $req)
    {
        $data = JadwalPoli::where('kodedokter_bpjs', 'like', $req->dokter)->where('hari', $req->hari)->get();
        return response()->json($data);
    }

    function tambah_pasien(PasienUmumRequest $req, AntrianPendaftaranService $aps)
    {
        try {
            $mjkn = $aps->insert_pasien_anjungan_mandiri($req);
            return redirect('guest_registration/pasien_umum')->with('sukses', 'No. rekam medis anda ' . $mjkn->nrm . ' tersebut hanya bersifat sementara. Harap datang ke admisi untuk verifikasi & melengkapi data rekam medis dengan membawa kartu identitas, pastikan data anda benar-benar valid & belum pernah terdaftar di RSU Kaliwates');
        } catch (\Throwable $th) {
            return redirect()->back()->with('gagal', $th->getMessage());
        }
    }

    function tambah_pasien_bpjs(PasienBpjsRequest $req, AntrianPendaftaranService $aps)
    {
        try {
            $mjkn = $aps->insert_pasien_anjungan_mandiri($req);
            return redirect('guest_registration/pasien_bpjs')->with('sukses', 'No. rekam medis anda ' . $mjkn->nrm . ' tersebut hanya bersifat sementara. Harap datang ke admisi untuk verifikasi & melengkapi data rekam medis dengan membawa kartu identitas, pastikan data anda benar-benar valid & belum pernah terdaftar di RSU Kaliwates');
        } catch (\Throwable $th) {
            return redirect()->back()->with('gagal', $th->getMessage());
        }
    }

    function post_bpjs($url, $data)
    {
        $credentials = RsCredential::where('layanan', 'antrian')->first();
        // return response()->json($credentials);
        if ($credentials == null) {
            return [
                'status' => false,
                'message' => 'Credential RS tidak ditemukan'
            ];
        }
        try {
            date_default_timezone_set('UTC');
            $timeStamp = strval(time() - strtotime('1970-01-01 00:00:00'));
            $signature = $this->get_signature($timeStamp, $credentials->cons_id, $credentials->cons_secret);
            $guzzleClient = new Client([
                'verify' => false
            ]);
            $response = $guzzleClient->request('post', $credentials->base_url . '/' . $url, [
                'headers' => [
                    'x-cons-id'     => $credentials->cons_id,
                    'x-timestamp'  => $timeStamp,
                    'x-signature'   => $signature,
                    'user_key' => $credentials->user_key,
                ],
                'body' => $data
            ]);
            if ($response->getStatusCode() == 200) {
                $list = json_decode($response->getBody()->getContents());
                if ($list->metadata->code == 201) {
                    return [
                        'status' => 'true',
                        'message' => $list->metadata->message,
                        'code' => $list->metadata->code
                    ];
                }
                return [
                    'status' => 'true',
                    'message' => $list->metadata->message,
                    'code' => $list->metadata->code
                ];
            } else {
                return [
                    'status' => 'false',
                    'message' => 'Gagal terhubung ke bpjs',
                    'code' => $response->getStatusCode()
                ];
            }
        } catch (\Throwable $th) {
            return [
                'status' => 'false',
                'message' => $th->getMessage(),
                'code' => 500
            ];
        }
    }

    function pasien_umum_daftar_post(Request $req)
    {
        $valid = Validator::make($req->all(), [
            'tanggalperiksa' => "required|date_format:Y-m-d",
            'kodepoli' => 'required',
            'kodedokter' => 'required',
            'jampraktek' => 'required',
            'jenis_kunjungan' => "required"
        ], [
            'tanggalperiksa.required' => 'Pilih tanggal periksa dahulu',
            'tanggalperiksa.date_format' => 'Format tanggal periksa tidak sesuai',
            'kodepoli.required' => 'Pilih poli dahulu',
            'kodedokter.required' => 'Pilih dokter dahulu',
            'jampraktek.required' => 'Pilih jam terlebih dahulu',
            'jenis_kunjungan.required' => 'Jenis kunjungan harus diisi'
        ]);

        $valid = $this->valid($req->all());
        if ($valid['metadata']['code'] != "200") return redirect()->back()->with('gagal', $valid['metadata']['message']);

        // dd($valid);

        $poli = explode('-', $req['kodepoli']);
        // data antrian
        $jadwal = $valid['response']['jadwal'];
        $pasien = $valid['response']['pasien'];

        if ($pasien->origin_updated == 'mobile-jkn') {
            return redirect()->back()->with('gagal', 'No. rekam medis anda ' . $pasien['id'] . ' tersebut hanya bersifat sementara. Harap datang ke admisi untuk verifikasi & melengkapi data rekam medis dengan membawa kartu identitas, pastikan data anda benar-benar valid & belum pernah terdaftar di RSI Jombang');
        }

        $sisakuotajkn = $valid['response']['sisakuotajkn'];
        $sisakuotanonjkn = $valid['response']['sisakuotanonjkn'];
        $generate = GH::generateAntrean($jadwal['kodedokter_bpjs'], $jadwal['id'], $poli[0], $req->tanggalperiksa);
        $mili = strtotime($req->tanggalperiksa . ' ' . $jadwal->jam_mulai);
        $estimasi = ($mili * 1000) + (($generate['angkaantrean'] - 1) * ($jadwal->estimasi_layanan * 60000));

        $count_baru_lama = SMIS_LayananPasien::where('nrm', $pasien['id'])->count();

        $antrian = new Antrian();
        if ($count_baru_lama > 0) {
            $antrian->pasien_baru = 0;
        } else {
            $antrian->pasien_baru = 1;
        }
        // $antriran->pasien_baru = $count_baru_lama > 0 ? '0' : '1';

        $jp = $req->jenis_pasien ? explode('-', $req->jenis_pasien) : [''];

        $antrian->taskid = 0;
        $antrian->nomorreferensi = $req->nomorreferensi ? $req->nomorreferensi : '';
        $antrian->namapj = $req->nama_pj ? $req->nama_pj : '';
        $antrian->telppj = $req->telp_pj ? $req->telp_pj : '';
        $antrian->kedatangan = $req->kedatangan ? $req->kedatangan : '';
        $antrian->jenis_perujuk = $req->jenis_perujuk ? $req->jenis_perujuk : '';
        $antrian->id_perujuk = $req->id_perujuk ? $req->id_perujuk : 0;
        $antrian->tanggalperiksa = $req->tanggalperiksa;
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
        $antrian->created_at = date('Y-m-d H:i:s');
        $antrian->updated_at = date('Y-m-d H:i:s');
        $antrian->sisakuotajkn = $sisakuotajkn;
        $antrian->sisakuotanonjkn = $sisakuotanonjkn;
        $antrian->kuotajkn = $jadwal['kuota_jkn'];
        $antrian->kuotanonjkn = $jadwal['kuota_non_jkn'];
        $antrian->keterangan = 'Peserta harap 60 menit lebih awal guna pencatatan administrasi.';
        $antrian->nomorkartu = $req->nobpjs ? $req->nobpjs : '';

        $ref = $req->nomorreferensi ? $req->nomorreferensi : '';

        if (isset($req->nobpjs)) {
            if ($req->nomorreferensi == '-' || $req->nomorreferensi == '') {
                return redirect()->back()->with('gagal', 'Nomor referensi belum sesuai');
            }
            if (strlen($req->nomorreferensi) < 19) {
                return redirect()->back()->with('gagal', 'Nomor referensi belum sesuai');
            }
        }

        try {
            $param_antrian_bpjs = json_encode([
                'kodebooking' => $generate['kodebooking'],
                'jenispasien' => $req->nobpjs ? 'JKN' : 'NON JKN',
                'nomorkartu' => $req->nobpjs ? $req->nobpjs : '',
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
            $result = $this->post_bpjs('antrean/add', $param_antrian_bpjs);
            if ($result['status']) {
                if ($result['code'] == 200) {
                    $antrian->response_code = 200;
                    $antrian->response_message = 'Ok';
                    $antrian->save();
                    return redirect('guest_registration/hasil_antrian?pasien=' . $req->pasien . '&kodebooking=' . $antrian->kodebooking . '&nomorantrian=' . $antrian->nomorantrean . '&estimasi=' . $antrian->estimasidilayani);
                } else {
                    return redirect()->back()->with('gagal', $result['message']);
                }
            } else {
                return redirect()->back()->with('gagal', $result['message']);
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('gagal', $th->getMessage());
        }
    }

    function hasil(Request $req)
    {
        $data['pasien'] = SMIS_Pasien::findOrFail($req->pasien);
        $data['antrian'] = Antrian::where('kodebooking', $req->kodebooking)->first();
        $data['kodebooking'] = $req->kodebooking;
        $data['nomorantrian'] = $req->nomorantrian;
        $data['estimasi'] = $req->estimasi;
        return view('guest.hasil', $data);
    }

    function get_signature($timeStamp, $cons_id, $cons_secret)
    {
        $signature = hash_hmac('sha256', $cons_id . "&" . $timeStamp, $cons_secret, true);
        $encodedSignature = base64_encode($signature);
        return $encodedSignature;
    }

    private function valid($param)
    {
        $pasien = SMIS_Pasien::findOrFail($param['pasien']);
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
            $pasien = SMIS_Pasien::where("nobpjs", $param['nobpjs'])->where('prop', '')->first();
            if (is_null($pasien)) {
                $pasien = Mjkn_Patient::where('nobpjs', $param['nobpjs'])->first();
            }
        } else { // jika pasien non bpjs
            $pasien = SMIS_Pasien::where("ktp", $param['ktp'])->where('prop', '')->first();
            if (is_null($pasien)) {
                $pasien = Mjkn_Patient::where('nik', $param['ktp'])->first();
            }
        }
        // dd($param);
        if (is_null($pasien)) {
            return $this->responseFormat("Data Pasien tidak ditemukan, silahkan daftar baru.", 202);
        }

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
            return $this->responseFormat("Anda telah mengambil Antrian di poli ini untuk tanggal " . $param['tanggalperiksa'], 201);
        // jika validasi sudah benar
        return $this->responseFormat("ok", 200, ["jadwal" => $jadwal, "sisakuotajkn" => $sisakuotajkn, "sisakuotanonjkn" => $sisakuotanonjkn, "pasien" => $pasien]);
    }

    function display_farmasi(Request $req)
    {
        return view('antrian.display_farmasi_new', [
            'dalam_antrian' => Antrian::where('tanggalperiksa', date('Y-m-d'))->where('taskid', 5)->orderBy('angkaantrean')->get(),
            'sedang_diproses' => Antrian::where('tanggalperiksa', date('Y-m-d'))->where('taskid', 6)->orderBy('angkaantrean')->get(),
            'siap_diambil' => Antrian::where('tanggalperiksa', date('Y-m-d'))->where('taskid', 7)->orderBy('angkaantrean')->get()
        ]);
    }

    function display_poli(Request $req, AntrianPoliService $service)
    {
        $display = $req->display ? $req->display : 1;

        if ($display > 4 || $display < 1) {
            abort(404);
        }

        // dd($display , $service->data_antrian_display($display), $service->data_dokter_display($display));
        return view('antrian.display_poli_new_' . $display, [
            'display' => $display,
            'antrian' => $service->data_antrian_display($display),
            'dokter'  => $service->data_dokter_display($display)
        ]);
    }

    // function display_IGD(Request $r)
    // {
    //     $beds = AvailableBed::select(
    // "namakelas", 
    //          "namaruang", 
    //          "kapasitas as total",
    //          "tersedia",
    //          "updated_at"
    //          )
    //         ->where('namaruang', 'Instalasi Gawat Darurat')
    //         ->where('kodekelas', 'IGD')
    //         ->where('kapasitas', '>', 0)
    //         ->get();

    //     $isolasi = AvailableBed::select(
    //         "namakelas",
    //         "namaruang",
    //         "kapasitas as total",
    //         "tersedia",
    //         "updated_at"
    //     )
    //     ->where('namaruang', 'Instalasi Gawat Darurat')
    //     ->where('kodekelas', 'ISO')
    //     ->where('kapasitas' , '>', 0)
    //     ->get();

    //     // dd($beds,$isolasi);

    //     return view('aplicare.display_IGD', compact('beds', 'isolasi'));
    // }


    public function display_IGD(Request $r)
    {
        // Ambil data utama dengan grouping pada kodekelas
        $data = AvailableBed::select(
            "namakelas",
            "namaruang",
            "kapasitas as total",
            "tersedia",
            "updated_at",
            "kodekelas"
        )
            ->where('namaruang', 'Instalasi Gawat Darurat')
            ->whereIn('kodekelas', ['IGD', 'ISO'])
            ->where('kapasitas', '>', 0)
            ->get()
            ->groupBy('kodekelas');
    
        // Ambil data tambahan untuk 'beds'
        $beds = AvailableBed::select(
            "namakelas",
            "namaruang",
            "kapasitas as total",
            "tersedia as total_tersedia",
            "updated_at"
        )
        ->where("namakelas", "<>", " ")
        ->whereNull("deleted_at")
        ->whereNotIn('kodekelas', ['ISO', 'IGD'])
        ->where("kapasitas", ">", 0)
        ->where("namakelas", "<>", "KELAS II")
        ->union(
            AvailableBed::select(
                "namakelas",
                DB::raw("'As Salam' as namaruang"),
                DB::raw('SUM(kapasitas) as total'),
                DB::raw('SUM(tersedia) as total_tersedia'),
                DB::raw("(select updated_at from available_beds WHERE namakelas = 'KELAS II' and koderuang = 19) as updated_at")
            )
            ->where("namakelas", "<>", " ")
            ->whereNull("deleted_at")
            ->where("kapasitas", ">", 0)
            ->where("namakelas", "=", "KELAS II")
            ->groupBy("namakelas")
        )
        ->orderBy("namakelas")
        ->get();

    // dd($beds);
        return view('aplicare.display_IGD', compact('data', 'beds'));
    }

    public function pendaftaran_dislay()
    {
        return view('antrian.add_jadwal_cuti_dokter');
    }
    
}
