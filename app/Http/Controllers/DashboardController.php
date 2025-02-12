<?php

namespace App\Http\Controllers;

use App\Models\AvailableBed;
use App\Models\User;
use App\Models\SMIS_LayananPasien;
use App\Models\SMIS_Diagnosa;
use App\Models\SMIS_RuanganIgd;
use Illuminate\Http\Request;
use Auth;

class DashboardController extends Controller
{
    function __construct()
    {
        $this->middleware(function ($request, $next) {
            $menu = json_decode(Auth::user()->menu);
            if (property_exists($menu, 'dashboard')) {
                $arr = (array) $menu->dashboard;
                if (request()->segment(2) == 'dashboard_pendaftaran') {
                    if ($arr['dashboard_pendaftaran'] == 0) {
                        return redirect('home');
                    }
                }else if (request()->segment(2) == 'pelayanan') {
                    if ($arr['pelayanan'] == 0) {
                        return redirect('home');
                    }
                }else if (request()->segment(2) == 'antrian') {
                    if ($arr['antrian'] == 0) {
                        return redirect('home');
                    }
                }
            } else {
                return redirect('home');
            }
            return $next($request);
        });
    }

    function index()
    {
        return view('dashboard.dashboard_layanan', [
            'user' => User::where('id', session('userid'))->first(),
        ]);
    }

    function ajax_jumlah_kunjungan(Request $req)
    {
        return response()->json([
            'total_kunjungan' => $this->total_kunjungan($req->from, $req->to),
            'total_rj' => $this->kunjungan_rawat_jalan($req->from, $req->to),
            'total_igd' => $this->kunjungan_igd($req->from, $req->to),
            'total_ri' => $this->kunjungan_rawat_inap($req->from, $req->to),
        ]);
    }

    function total_kunjungan($start, $end)
    {
        $totalVisit = SMIS_LayananPasien::select('id')
            ->where('prop', '')
            ->where('carapulang', '!=', 'TIDAK DATANG')
            ->where('selesai', 1)
            ->whereDate('tanggal', '>=', $start)
            ->whereDate('tanggal', '<=', $end)
            ->count();
        return $totalVisit;
    }

    function kunjungan_rawat_jalan($start, $end)
    {
        $ruangan = SMIS_RuanganIgd::first();
        if ($ruangan) {
            $totalVisit = SMIS_LayananPasien::select('id')
                ->where('prop', '')
                ->where('carapulang', '!=', 'TIDAK DATANG')
                ->where('uri', 0)
                ->where('selesai', 1)
                ->where('last_ruangan', '!=', $ruangan->alias)
                ->whereDate('tanggal', '>=', $start)
                ->whereDate('tanggal', '<=', $end)
                ->count();
        } else {
            $totalVisit = SMIS_LayananPasien::select('id')
                ->where('prop', '')
                ->where('carapulang', '!=', 'TIDAK DATANG')
                ->where('uri', 0)
                ->where('selesai', 1)
                ->whereDate('tanggal', '>=', $start)
                ->whereDate('tanggal', '<=', $end)
                ->count();
        }
        return $totalVisit;
    }

    function kunjungan_igd($start, $end)
    {
        $ruangan = SMIS_RuanganIgd::first();
        if ($ruangan) {
            $totalVisit = SMIS_LayananPasien::select('id')
                ->where('prop', '')
                ->where('carapulang', '!=', 'TIDAK DATANG')
                ->where('uri', 0)
                ->where('selesai', 1)
                ->where('last_ruangan', $ruangan->alias)
                ->whereDate('tanggal', '>=', $start)
                ->whereDate('tanggal', '<=', $end)
                ->count();
        } else {
            $totalVisit = SMIS_LayananPasien::select('id')
                ->where('prop', '')
                ->where('carapulang', '!=', 'TIDAK DATANG')
                ->where('uri', 0)
                ->where('selesai', 1)
                ->whereDate('tanggal', '>=', $start)
                ->whereDate('tanggal', '<=', $end)
                ->count();
        }
        return $totalVisit;
    }

    function ajax_jumlah_ketersediaan_kamar()
    {
        $totalVisit = AvailableBed::select('namaruang', 'tersedia')
            ->where('deleted_at', null)
            ->orderBy('tersedia', 'desc')
            ->get();
        return $totalVisit;
    }

    function kunjungan_rawat_inap($start, $end)
    {
        $totalVisit = SMIS_LayananPasien::select('id')
            ->where('prop', '')
            ->where('carapulang', '!=', 'TIDAK DATANG')
            ->where('uri', 1)
            ->where('selesai', 1)
            ->whereDate('tanggal', '>=', $start)
            ->whereDate('tanggal', '<=', $end)
            ->count();
        return $totalVisit;
    }

    function ajax_jumlah_kunjungan_berdasarkan_cara_bayar(Request $req)
    {
        $ruangan = SMIS_RuanganIgd::first();
        $query = SMIS_LayananPasien::query();
        $query->selectRaw('count(id) as total, carabayar')
            ->where('prop', '')
            ->where('carapulang', '!=', 'TIDAK DATANG')
            ->where('selesai', 1)
            ->whereDate('tanggal', '>=', $req->from)
            ->whereDate('tanggal', '<=', $req->to);
        if ($req->category == 'rawat jalan') {
            $query->where('uri', 0);
            if ($ruangan) {
                $query->where('last_ruangan', '<>', $ruangan->alias);
            }
        } else if ($req->category == 'igd') {
            $query->where('uri', 0);
            if ($ruangan) {
                $query->where('last_ruangan', $ruangan->alias);
            }
        } else if ($req->category == 'rawat inap') {
            $query->where('uri', 1);
        }
        $query->groupBy('carabayar');
        $totalVisit = $query->get();
        // $mapped = array();
        // foreach ($totalVisit as $i) {
        //     $mapped[$i->carabayar] = $i->total;
        // }
        return response()->json($totalVisit);
    }

    function ajax_jumlah_kunjungan_berdasarkan_jenis_kelamin(Request $req)
    {
        $ruangan = SMIS_RuanganIgd::first();
        $query = SMIS_LayananPasien::query();
        $query->selectRaw('count(id) as total, kelamin')
            ->where('prop', '')
            ->where('carapulang', '!=', 'TIDAK DATANG')
            ->where('selesai', 1)
            ->whereDate('tanggal', '>=', $req->from)
            ->whereDate('tanggal', '<=', $req->to);
        if ($req->category == 'rawat jalan') {
            $query->where('uri', 0);
            if ($ruangan) {
                $query->where('last_ruangan', '<>', $ruangan->alias);
            }
        } else if ($req->category == 'igd') {
            $query->where('uri', 0);
            if ($ruangan) {
                $query->where('last_ruangan', $ruangan->alias);
            }
        } else if ($req->category == 'rawat inap') {
            $query->where('uri', 1);
        }
        $query->groupBy('kelamin');
        $totalVisit = $query->get();
        return response()->json($totalVisit);
    }

    function ajax_jumlah_kunjungan_tertinggi_kecamatan(Request $req)
    {
        $setting = SMIS_RuanganIgd::first();
        $query = SMIS_LayananPasien::query();
        $query->selectRaw('count(id) as total, nama_kecamatan as kecamatan')
            ->where('prop', '')
            ->where('carapulang', '!=', 'TIDAK DATANG')
            ->where('selesai', 1)
            ->whereDate('tanggal', '>=', $req->from)
            ->whereDate('tanggal', '<=', $req->to);
        if ($setting && $setting->kabupaten != '') {
            $query->where('nama_kabupaten', 'like', '%' . $setting->kabupaten . '%');
        }
        if ($setting && $setting->provinsi != '') {
            $query->where('nama_provinsi', 'like', '%' . $setting->provinsi . '%');
        }
        $query->orderBy('total', 'DESC')
            ->groupBy('nama_kecamatan')
            ->take(10);
        $totalVisit = $query->get();
        return response()->json($totalVisit);
    }

    function ajax_jumlah_kunjungan_terendah_kecamatan(Request $req)
    {
        $setting = SMIS_RuanganIgd::first();
        $query = SMIS_LayananPasien::query();
        $query->selectRaw('count(id) as total, nama_kecamatan as kecamatan')
            ->where('prop', '')
            ->where('carapulang', '!=', 'TIDAK DATANG')
            ->where('selesai', 1)
            ->whereDate('tanggal', '>=', $req->from)
            ->whereDate('tanggal', '<=', $req->to);
        if ($setting && $setting->kabupaten != '') {
            $query->where('nama_kabupaten', 'like', '%' . $setting->kabupaten . '%');
        }
        if ($setting && $setting->provinsi != '') {
            $query->where('nama_provinsi', 'like', '%' . $setting->provinsi . '%');
        }
        $query->orderBy('total', 'ASC')
            ->groupBy('nama_kecamatan')
            ->take(10);
        $totalVisit = $query->get();
        return response()->json($totalVisit);
    }

    function ajax_jumlah_kunjungan_berdasarkan_baru_lama(Request $req)
    {
        $ruangan = SMIS_RuanganIgd::first();
        $query = SMIS_LayananPasien::query();
        $query->selectRaw('count(id) as total, barulama')
            ->where('prop', '')
            ->where('carapulang', '!=', 'TIDAK DATANG')
            ->where('selesai', 1)
            ->whereDate('tanggal', '>=', $req->from)
            ->whereDate('tanggal', '<=', $req->to);
        if ($req->category == 'rawat jalan') {
            $query->where('uri', 0);
            if ($ruangan) {
                $query->where('last_ruangan', '<>', $ruangan->alias);
            }
        } else if ($req->category == 'igd') {
            $query->where('uri', 0);
            if ($ruangan) {
                $query->where('last_ruangan', $ruangan->alias);
            }
        } else if ($req->category == 'rawat inap') {
            $query->where('uri', 1);
        };
        $query->groupBy('barulama');
        $totalVisit = $query->get();
        return $totalVisit;
    }

    function ajax_jumlah_kunjungan_rawat_jalan(Request $req)
    {
        $totalVisit = SMIS_LayananPasien::selectRaw('count(id) as total, last_ruangan')
            ->where('prop', '')
            ->where('carapulang', '!=', 'TIDAK DATANG')
            ->where('uri', 0)
            ->where('selesai', 1)
            ->whereDate('tanggal', '>=', $req->from)
            ->whereDate('tanggal', '<=', $req->to)
            ->orderBy('total', 'DESC')
            ->groupBy('last_ruangan')
            ->get();
        $mapped = array();
        foreach ($totalVisit as $i => $data) {
            array_push($mapped, ['jenislayanan' => ucwords(str_replace('_', ' ', $data->last_ruangan)), 'total' => $data->total]);
        }
        return response()->json($mapped);
    }

    function ajax_jumlah_kunjungan_rawat_inap(Request $req)
    {
        $totalVisit = SMIS_LayananPasien::selectRaw('count(id) as total, last_ruangan')
            ->where('prop', '')
            ->where('carapulang', '!=', 'TIDAK DATANG')
            ->where('uri', 1)
            ->where('selesai', 1)
            ->whereDate('tanggal', '>=', $req->from)
            ->whereDate('tanggal', '<=', $req->to)
            ->orderBy('total', 'DESC')
            ->groupBy('last_ruangan')
            ->get();
        $mapped = array();
        foreach ($totalVisit as $i => $data) {
            array_push($mapped, ['kamar_inap' => ucwords(str_replace('_', ' ', $data->last_ruangan)), 'total' => $data->total]);
        }
        return response()->json($mapped);
    }

    function ajax_jumlah_kunjungan_tertinggi_diagnosa(Request $req)
    {
        $distinct = SMIS_Diagnosa::selectRaw('max(id) as id')->groupBy('noreg_pasien');
        $layanan = SMIS_LayananPasien::select('id')
            ->where('prop', '')
            ->where('carapulang', '!=', 'TIDAK DATANG')
            ->where('selesai', 1);
        $totalVisit = SMIS_Diagnosa::selectRaw('count(smis_mr_diagnosa.id) as total, nama_icd')
            ->joinSub($layanan, 'layanan', function ($join) {
                $join->on('smis_mr_diagnosa.noreg_pasien', '=', 'layanan.id');
            })
            ->joinSub($distinct, 'max_icd', function ($join) {
                $join->on('smis_mr_diagnosa.id', '=', 'max_icd.id');
            })
            ->where('prop', '')
            ->whereDate('tanggal', '>=', $req->from)
            ->whereDate('tanggal', '<=', $req->to)
            ->where('nama_icd', '!=', '')
            ->when($req->category == 'rawat jalan', function ($query) {
                $ruangan = SMIS_RuanganIgd::first();
                if ($ruangan) {
                    return $query->where('uri', 0)
                        ->where('last_ruangan', '!=', $ruangan->alias);
                } else {
                    return $query->where('uri', 0);
                }
            })
            ->when($req->category == 'rawat inap', function ($query) {
                return $query->where('uri', 1);
            })
            ->when($req->category == 'igd', function ($query) {
                $ruangan = SMIS_RuanganIgd::first();
                if ($ruangan) {
                    return $query->where('uri', 0)
                        ->where('last_ruangan', '=', $ruangan->alias);
                } else {
                    return $query->where('uri', 0);
                }
            })
            ->groupBy('nama_icd')
            ->orderBy('total', 'DESC')
            ->take(10)
            ->get();
        // $mapped = array();
        // foreach ($totalVisit as $i => $data) {
        //     $mapped[$data->nama_icd] = $data->total;
        // }
        return response()->json($totalVisit);
    }
}
