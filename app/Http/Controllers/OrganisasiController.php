<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrganisasiRequest;
use App\Models\SatuSehatOrganisasi;
use App\Models\SatuSehatReferensiOrganisasi;
use App\Services\SatuSehatOrganisasiService;
use App\Services\SatuSehatService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class OrganisasiController extends Controller
{
    function index(Request $req)
    {
        $query = DB::table('smis_ss_organisasi as org1')->leftJoin('smis_ss_organisasi as org2', 'org1.part_of', 'org2.id_organisasi');
        $query->select('org1.*', 'org2.nama as bagian_dari');
        if ($req->keyword) {
            $query->where('org1.nama', 'like', '%'.$req->keyword.'%');
        }
        $data['referensi'] = SatuSehatReferensiOrganisasi::all();
        $data['organisasi'] = $query->paginate(10)->setPath('?keyword='.$req->keyword);
        $data['keyword'] = $req->keyword ? $req->keyword : '';
        $data['all_organisasi'] = DB::table('smis_ss_organisasi')->select('*')->get();
        
        return view('satu_sehat.organisasi.index', $data);
    }

    function ajax_select_organisasi(Request $req){
        $data = SatuSehatOrganisasi::findOrFail($req->id);
        return response()->json($data);
    }

    function referensi_organisasi(Request $req)
    {
        $data['organisasi'] = SatuSehatReferensiOrganisasi::paginate(10);
        $data['keyword'] = $req->keyword ? $req->keyword : '';
        return view('satu_sehat.organisasi.referensi', $data);
    }

    function update_referensi_organisasi(SatuSehatService $sss, SatuSehatOrganisasiService $ssos)
    {
        try {
            $xml = simplexml_load_string($sss->get('http://terminology.hl7.org/CodeSystem/organization-type')->getBody()->getContents());
            $data = $xml->text->div->table;
            if ($data) {
                $ssos->store_referensi($data);
            } else {
                return redirect()->back()->with('gagal', 'Gagal tersambung ke satu sehat');
            }
            return redirect('satu_sehat/organisasi/referensi')->with('sukses', 'Update data referensi organisasi berhasil');
        } catch (\Throwable $th) {
            return redirect()->back()->with('gagal', $th->getMessage());
        }
    }

    function store(OrganisasiRequest $req, SatuSehatService $sss, SatuSehatOrganisasiService $ssos)
    {
        $data = $ssos->data_add_organisasi($req);
        try {
            $result = $sss->post(env('SATU_SEHAT_URL') . '/fhir-r4/v1/Organization', json_encode($data));

            if ($result->getStatusCode() == 401) {
                $autentikasi = json_decode($sss->auth());
                Session::put('token_satu_sehat', $autentikasi ? $autentikasi->access_token : null);
                return redirect()->back()->with('gagal', 'Token expired, silahkan coba kembali');
            }

            if ($result->getStatusCode() == 201) {
                $data = json_decode($result->getBody()->getContents());
                $ssos->store($req, $data);
                return redirect('satu_sehat/organisasi/rs')->with('sukses', 'Tambah organisasi berhasil');
            } else {
                return redirect()->back()->with('gagal', 'Gagal tambah organisasi');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('gagal', $th->getMessage());
        }
    }

    function update(OrganisasiRequest $req, SatuSehatService $sss, SatuSehatOrganisasiService $ssos)
    {
        $data = $ssos->data_edit_organisasi($req);
        try {
            $result = $sss->put(env('SATU_SEHAT_URL') . '/fhir-r4/v1/Organization/'.$req->id_organisasi, json_encode($data));

            if ($result->getStatusCode() == 401) {
                $autentikasi = json_decode($sss->auth());
                Session::put('token_satu_sehat', $autentikasi ? $autentikasi->access_token : null);
                return redirect()->back()->with('gagal', 'Token expired, silahkan coba kembali');
            }

            if ($result->getStatusCode() == 200) {
                $ssos->update($req);
                return redirect('satu_sehat/organisasi/rs')->with('sukses', 'Ubah organisasi berhasil');
            } else {
                return redirect()->back()->with('gagal', 'Gagal ubah organisasi');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('gagal', $th->getMessage());
        }
    }
}
