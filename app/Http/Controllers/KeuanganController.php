<?php

namespace App\Http\Controllers;

use App\Models\Keuangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

use function PHPUnit\Framework\isEmpty;

class KeuanganController extends Controller
{
    public function index()
    {
        return view('setting.keuangan', [
            'deskripsi' => Keuangan::select('deskripsi', 'id')->first()
        ]);
    }

    public function createUpdate(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'deskripsi' => 'required|string',
        ]);

        if ($validation->validate()) {
            try {
                Keuangan::updateOrCreate(
                    ['id' => $request->id],
                    ['deskripsi' => $request->deskripsi]
                );
                Alert::success('Behasil', 'Deskripsi berhasil ditambahkan');
            } catch (Exception $th) {
                Alert::error('Gagal', 'Deskripsi gagal ditambahkan' . $th->getMessage());
            }
        } else {
            Alert::error('Error', 'Silahkan hubungi admin');
        }

        return redirect()->route('keuangan.index');
    }
}
