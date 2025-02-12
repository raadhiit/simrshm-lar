<?php

namespace App\Services;

use App\Models\SMIS_DFM2_Bahan_Pakai_Obat_Racikan;
use App\Models\SMIS_DFM2_Penjualan_Obat_Jadi;
use App\Models\SMIS_DFM2_Penjualan_Obat_Racikan;
use App\Models\SMIS_DFM2_Penjualan_Resep;
use App\Models\SMIS_DFM3_Penjualan_Resep;
use App\Models\Smis_Dfm_Bahan_Pakai_Obat_Racikan;
use App\Models\Smis_Dfm_Penjualan_Obat_Jadi;
use App\Models\Smis_Dfm_Penjualan_Obat_Racikan;
use App\Models\Smis_Dfm_Penjualan_Resep;
use App\Models\SMIS_LayananPasien;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ResepService
{

    function get_dfm($noreg, $ruangan)
    {
        $query = Smis_Dfm_Penjualan_Resep::with(['obat_jadi', 'obat_racik'])
            ->where('noreg_pasien', $noreg)
            ->where('dibatalkan', '0')
            ->where('prop', '');
        if (isset($ruangan) || $ruangan != "") {
            $query->where('ruangan', $ruangan);
        }
        $resep = $query->get();
        return $resep;
    }

    function get_dfm2($noreg, $ruangan)
    {
        $query = SMIS_DFM2_Penjualan_Resep::with(['obat_jadi', 'obat_racik'])
            ->where('noreg_pasien', $noreg)
            ->where('dibatalkan', '0')
            ->where('prop', '');
        if (isset($ruangan) || $ruangan != "") {
            $query->where('ruangan', $ruangan);
        }
        $resep = $query->get();
        return $resep;
    }

    function get_dfm_rpp($noreg, $ruangan)
    {
        $resep = Smis_Dfm_Penjualan_Resep::with(['obat_jadi', 'obat_racik'])
            ->where('noreg_pasien', $noreg)
            ->where('dibatalkan', '0')
            ->where('prop', '')
            ->get();
        return $resep;
    }

    function get_dfm3_rpp($noreg, $ruangan)
    {
        $resep = SMIS_DFM3_Penjualan_Resep::with(['obat_jadi', 'obat_racik'])
            ->where('noreg_pasien', $noreg)
            ->where('dibatalkan', '0')
            ->where('prop', '')
            ->get();
        return $resep;
    }

    function get_dfm2_rpp_kiri($noreg, $ruangan)
    {
        $resep = SMIS_DFM2_Penjualan_Resep::with(['obat_jadi', 'obat_racik'])
            ->where('noreg_pasien', $noreg)
            ->where('dibatalkan', '0')
            ->where('prop', '')
            ->where('krs', 0)
            ->get();
        return $resep;
    }

    function get_dfm2_rpp($noreg, $ruangan)
    {
        $resep = SMIS_DFM2_Penjualan_Resep::with(['obat_jadi', 'obat_racik'])
            ->where('noreg_pasien', $noreg)
            ->where('dibatalkan', '0')
            ->where('prop', '')
            ->where('krs', 1)
            ->get();
        return $resep;
    }

    function get_dfm3($noreg, $ruangan)
    {
        $resep = SMIS_DFM3_Penjualan_Resep::with(['obat_jadi', 'obat_racik'])
            ->where('noreg_pasien', $noreg)
            ->where('dibatalkan', '0')
            ->where('ruangan', $ruangan)
            ->where('prop', '')
            ->get();
        return $resep;
    }

    function store($req)
    {
        $asuransi = SMIS_LayananPasien::leftJoin('smis_rg_asuransi', 'smis_rg_asuransi.id', 'smis_rg_layananpasien.asuransi')
        ->select('smis_rg_asuransi.nama','smis_rg_layananpasien.nama_perusahaan')->where('smis_rg_layananpasien.id', $req->noreg)->first();
        try {
            DB::beginTransaction();
            $header = [
                "depo" => $req->depo_tujuan,
                "username_operator" => Auth::user()->username,
                "nama_operator" => Auth::user()->realname,
                "id_dokter" => $req->id_dokter,
                "nama_dokter" => $req->dokter,
                'tanggal' => date('Y-m-d H:i:s'),
                "sip_dokter" => $req->sip ? $req->sip : '',
                "noreg_pasien" => $req->noreg,
                "nrm_pasien" => $req->nrm,
                "nama_pasien" => $req->nama,
                "alamat_pasien" => $req->alamat,
                "no_telpon" => $req->telp ? $req->telp : '',
                "usia" => $req->usia,
                "berat_badan" => $req->berat_badan ? $req->berat_badan : '',
                "jenis" => $req->jenis_pasien,
                "asuransi" => $asuransi ? $asuransi->nama : '',
                "perusahaan" => $asuransi ? $asuransi->nama_perusahaan : '',
                "ruangan" => $req->ruangan,
                "catatan_obat_racikan" => $req->catatan_obat_racikan,
                'autonomous' => '[rshm]',
                'time_updated' => date('Y-m-d H:i:s'),
                'origin' => 'rshm',
                'origin_updated' => 'rshm',
                'catatan' => $req->catatan,
            ];

            DB::table('smis_er_resep')->insert($header);

            $last_insert = DB::table('smis_er_resep')->where('noreg_pasien', $req->noreg)->first();
            $detail = json_decode($req->detail);
            $mapping_detail = [];

            foreach ($detail as $det) {
                array_push($mapping_detail, [
                    'harga' => $det->harga,
                    'markup' => 25,
                    'origin_updated' => 'rshm',
                    'time_updated' => date('Y-m-d H:i:s'),
                    'origin' => '',
                    'origin_id' => 0,
                    'autonomous' => '[rshm]',
                    'id_resep' => $last_insert->id,
                    'id_obat' => $det->id_obat,
                    'kode_obat' => $det->kode_obat,
                    'nama_obat' => $det->nama_obat,
                    'nama_jenis_obat' => $det->nama_jenis_obat,
                    'jumlah' => $det->jumlah,
                    'satuan' => $det->satuan,
                    'signa' => $det->signa
                ]);
            }

            DB::table('smis_er_dresep')->insert($mapping_detail);

            DB::commit();
            return [
                'status' => true,
                'message' => 'Ok'
            ];
        } catch (\Throwable $th) {
            DB::rollback();
            return [
                'status' => false,
                'message' => $th->getMessage()
            ];
        }
    }

    function update($req){
        try {
            DB::beginTransaction();
            $header = [
                "depo" => $req->depo_tujuan,
                "username_operator" => Auth::user()->username,
                "nama_operator" => Auth::user()->realname,
                "id_dokter" => $req->id_dokter,
                "nama_dokter" => $req->dokter,
                "sip_dokter" => $req->sip ? $req->sip : '',
                "noreg_pasien" => $req->noreg,
                'tanggal' => date('Y-m-d H:i:s'),
                "nrm_pasien" => $req->nrm,
                "nama_pasien" => $req->nama,
                "alamat_pasien" => $req->alamat,
                "no_telpon" => $req->telp ? $req->telp : '',
                "usia" => $req->usia,
                "berat_badan" => $req->berat_badan ? $req->berat_badan : '',
                "jenis" => $req->jenis_pasien,
                "asuransi" => $req->asuransi ? $req->asuransi : '',
                "perusahaan" => $req->perusahaan ? $req->perusahaan : '',
                "ruangan" => $req->ruangan,
                "catatan_obat_racikan" => $req->catatan_obat_racikan,
                'autonomous' => '[rshm]',
                'time_updated' => date('Y-m-d H:i:s'),
                'origin' => 'rshm',
                'origin_updated' => 'rshm',
                'catatan' => $req->catatan,
            ];

            DB::table('smis_er_resep')->where('id', $req->id_resep)->update($header);

            $detail = json_decode($req->detail);

            foreach ($detail as $det) {
                $arr = [
                    'harga' => $det->harga,
                    'markup' => 25,
                    'origin_updated' => 'rshm',
                    'time_updated' => date('Y-m-d H:i:s'),
                    'origin' => '',
                    'origin_id' => 0,
                    'autonomous' => '[rshm]',
                    'id_resep' => $req->id_resep,
                    'id_obat' => $det->id_obat,
                    'kode_obat' => $det->kode_obat,
                    'nama_obat' => $det->nama_obat,
                    'nama_jenis_obat' => $det->nama_jenis_obat,
                    'jumlah' => $det->jumlah,
                    'satuan' => $det->satuan,
                    'signa' => $det->signa
                ];
                if ($det->deleted) {
                    DB::table('smis_er_dresep')->where('id', $det->id)->update(['prop' => 'del']);
                }else{
                    DB::table('smis_er_dresep')->updateOrInsert(['id' => $det->id],$arr);
                }
            }
            DB::commit();
            return [
                'status' => true,
                'message' => 'Ok'
            ];
        } catch (\Throwable $th) {
            DB::rollback();
            return [
                'status' => false,
                'message' => $th->getMessage()
            ];
        }
    }

    function lock($req){
        $query = DB::table('smis_er_resep')->where('id', $req->id)->update(['locked' => 1]);
        return $query;
    }

    function select_resep($req){
        $query = DB::table('smis_er_resep')->where('id', $req->id)->where('prop','')->first();
        return $query;
    }

    function store_by_id($req)
    {
        // dd($req->all());
        try {
            DB::beginTransaction();
            $header = [
                "depo" => $req->depo_tujuan,
                "username_operator" => Auth::user()->username,
                "nama_operator" => Auth::user()->realname,
                "id_dokter" => $req->id_dokter,
                "nama_dokter" => $req->dokter,
                'tanggal' => date('Y-m-d H:i:s'),
                "sip_dokter" => $req->sip ? $req->sip : '',
                "noreg_pasien" => $req->noreg,
                "nrm_pasien" => $req->nrm,
                "nama_pasien" => $req->nama,
                "alamat_pasien" => $req->alamat,
                "no_telpon" => $req->telp ? $req->telp : '',
                "usia" => $req->usia,
                "berat_badan" => $req->berat_badan ? $req->berat_badan : '',
                "jenis" => $req->jenis_pasien,
                "asuransi" => $req->asuransi ? $req->asuransi : '',
                "perusahaan" => $req->perusahaan ? $req->perusahaan : '',
                "ruangan" => $req->ruangan,
                "catatan_obat_racikan" => $req->catatan_obat_racikan,
                'autonomous' => '[rshm]',
                'time_updated' => date('Y-m-d H:i:s'),
                'origin' => 'rshm',
                'origin_updated' => 'rshm',
                'catatan' => $req->catatan,
            ];

            if($req->id_resep == 0){
                DB::table('smis_er_resep')->insert($header);
                $last_insert = DB::table('smis_er_resep')->orderBy('id', 'desc')->first();
            }else{
                DB::table('smis_er_resep')->where('id', $req->id_resep)->update($header);
                $last_insert = DB::table('smis_er_resep')->where('id', $req->id_resep)->first();
            }
            $detail = json_decode($req->detail);

            foreach ($detail as $det) {
                $arr = [
                    'harga' => $det->harga,
                    'markup' => 25,
                    'origin_updated' => 'rshm',
                    'time_updated' => date('Y-m-d H:i:s'),
                    'origin' => '',
                    'origin_id' => 0,
                    'autonomous' => '[rshm]',
                    'id_resep' => $req->id_resep == 0 ? $last_insert->id : $req->id_resep,
                    'id_obat' => $det->id_obat,
                    'kode_obat' => $det->kode_obat,
                    'nama_obat' => $det->nama_obat,
                    'nama_jenis_obat' => $det->nama_jenis_obat,
                    'jumlah' => $det->jumlah,
                    'satuan' => $det->satuan,
                    'signa' => $det->signa
                ];
                if ($det->deleted) {
                    DB::table('smis_er_dresep')->where('id', $det->id)->update(['prop' => 'del']);
                }else{
                    DB::table('smis_er_dresep')->updateOrInsert(['id' => $det->id],$arr);
                }
            }

            DB::commit();
            return [
                'status' => true,
                'message' => 'Ok',
                'data' => $last_insert
            ];
        } catch (\Throwable $th) {
            DB::rollback();
            return [
                'status' => false,
                'message' => $th->getMessage()
            ];
        }
    }
}
