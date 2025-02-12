<?php

namespace App\Services;

use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\InvoiceSetting;
use Illuminate\Support\Facades\Storage;
use Throwable;

/**
 * Class Services
 * @author yourname
 */
class InvoiceService
{

    private function penyebut($nilai)
    {
        $nilai = abs($nilai);
        $huruf = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
        $temp = "";
        if ($nilai < 12) {
            $temp = " " . $huruf[$nilai];
        } else if ($nilai < 20) {
            $temp = $this->penyebut($nilai - 10) . " Belas";
        } else if ($nilai < 100) {
            $temp = $this->penyebut($nilai / 10) . " Puluh" . $this->penyebut($nilai % 10);
        } else if ($nilai < 200) {
            $temp = " Seratus" . $this->penyebut($nilai - 100);
        } else if ($nilai < 1000) {
            $temp = $this->penyebut($nilai / 100) . " Ratus" . $this->penyebut($nilai % 100);
        } else if ($nilai < 2000) {
            $temp = " seribu" . penyebut($nilai - 1000);
        } else if ($nilai < 1000000) {
            $temp = $this->penyebut($nilai / 1000) . " Ribu" . $this->penyebut($nilai % 1000);
        } else if ($nilai < 1000000000) {
            $temp = $this->penyebut($nilai / 1000000) . " Juta" . $this->penyebut($nilai % 1000000);
        } else if ($nilai < 1000000000000) {
            $temp = $this->penyebut($nilai / 1000000000) . " Milyar" . $this->penyebut(fmod($nilai, 1000000000));
        }
        return $temp;
    }

    public function terbilang($nilai)
    {
        if ($nilai < 0) {
            $hasil = "minus " . trim($this->penyebut($nilai));
        } else {
            $hasil = trim($this->penyebut($nilai));
        }
        return $hasil;
    }


    private function countDay($tanggal, $jatuh_tempo)
    {
        $diff = strtotime($jatuh_tempo) - strtotime($tanggal);
        $term =  (int)round($diff / (60 * 60 * 24));
        return $term;
    }

    public function getInvoice()
    {
        $data = Invoice::where('prop', ' ')->orderBy('tanggal', 'DESC');
        return $data;
    }

    public function getDetailInvoice($id)
    {
        $dataHeader = Invoice::where('prop', ' ')
            ->where('id', $id)
            ->first();

        $dataDetail = InvoiceDetail::where('id_header', $id)
            ->where('prop', ' ')
            ->get();

        return [
            'header' => $dataHeader,
            'detail' => $dataDetail
        ];
    }

    public function editInvoice($id)
    {
        $dataHeader = Invoice::where('prop', ' ')
            ->where('id', $id)
            ->first();

        $dataDetail = InvoiceDetail::where('id_header', $id)
            ->where('prop', ' ')
            ->get();

        return [
            "header" => $dataHeader,
            "detail" => $dataDetail,
        ];
    }

    public function storeInvoice($getRequest)
    {
        $term = $this->countDay($getRequest[0]['tanggal'], $getRequest[0]['jatuh_tempo']);
        try {
            $idHeader =  Invoice::create([
                'id_vendor' => $getRequest[0]['id_vendor'],
                'prop' => " ",
                'no_invoice' => $getRequest[0]['no_invoice'],
                'tanggal' => $getRequest[0]['tanggal'],
                'jatuh_tempo' => $getRequest[0]['jatuh_tempo'],
                'term' => $term,
                'kode_vendor' => $getRequest[0]['kode_vendor'],
                'nama_vendor' => $getRequest[0]['vendor'],
                'alamat' => $getRequest[0]['alamat'],
                'catatan' => $getRequest[0]['catatan'],
                'kode_rekanan' => null,
                'inc_ppn' => "",
                'ppn' => $getRequest[0]['ppn'],
                'pph' => $getRequest[0]['pph'],
                'total' => $getRequest[0]['total'],
                'jml_ppn' => $getRequest[0]['jml_ppn'],
                'jml_pph' => $getRequest[0]['jml_pph'],
                'jml_bayar' => $getRequest[0]['jml_bayar'],
            ])->id;

            for ($i = 1; $i < sizeof($getRequest); $i++) {
                InvoiceDetail::create([
                    'id_header' => $idHeader,
                    'prop' => ' ',
                    'kode_barang' => $getRequest[$i]['kode_barang'],
                    'nama_barang' => $getRequest[$i]['nama_barang'],
                    'jenis_barang' => $getRequest[$i]['jenis_barang'],
                    'jumlah_dipesan' => $getRequest[$i]['jumlah_dipesan'],
                    'satuan' => $getRequest[$i]['satuan'],
                    'hna' => $getRequest[$i]['hna'],
                    'diskon' => $getRequest[$i]['diskon'],
                    'subtotal' => $getRequest[$i]['subtotal'],

                ]);
            }
            return "sukses";
        } catch (\Throwable $th) {

            return $th->getMessage();
        }
    }

    public function updateInvoice($getRequest, $id)
    {
        $term = $this->countDay($getRequest[0]['tanggal'], $getRequest[0]['jatuh_tempo']);

        try {
            Invoice::where('id', $id)->update([
                'id_vendor' => $getRequest[0]['id_vendor'],
                'prop' => " ",
                'tanggal' => $getRequest[0]['tanggal'],
                'jatuh_tempo' => $getRequest[0]['jatuh_tempo'],
                'term' => $term,
                'kode_vendor' => $getRequest[0]['kode_vendor'],
                'nama_vendor' => $getRequest[0]['vendor'],
                'alamat' => $getRequest[0]['alamat'],
                'catatan' => $getRequest[0]['catatan'],
                'kode_rekanan' => null,
                'inc_ppn' => "",
                'ppn' => $getRequest[0]['ppn'],
                'pph' => $getRequest[0]['pph'],
                'total' => $getRequest[0]['total'],
                'jml_ppn' => $getRequest[0]['jml_ppn'],
                'jml_pph' => $getRequest[0]['jml_pph'],
                'jml_bayar' => $getRequest[0]['jml_bayar'],
            ]);

            for ($i = 1; $i < sizeof($getRequest); $i++) {
                if (isset($getRequest[$i]['id_detail'])) {
                    InvoiceDetail::where('id_header', $getRequest[0]['id_header'])
                        ->where('id', $getRequest[$i]['id_detail'])->update([
                            'prop' => ' ',
                            'kode_barang' => $getRequest[$i]['kode_barang'],
                            'nama_barang' => $getRequest[$i]['nama_barang'],
                            'jenis_barang' => $getRequest[$i]['jenis_barang'],
                            'jumlah_dipesan' => $getRequest[$i]['jumlah_dipesan'],
                            'satuan' => $getRequest[$i]['satuan'],
                            'hna' => $getRequest[$i]['hna'],
                            'diskon' => $getRequest[$i]['diskon'],
                            'subtotal' => $getRequest[$i]['subtotal'],
                        ]);
                } else {
                    InvoiceDetail::create([
                        'id_header' => $getRequest[0]['id_header'],
                        'prop' => ' ',
                        'kode_barang' => $getRequest[$i]['kode_barang'],
                        'nama_barang' => $getRequest[$i]['nama_barang'],
                        'jenis_barang' => $getRequest[$i]['jenis_barang'],
                        'jumlah_dipesan' => $getRequest[$i]['jumlah_dipesan'],
                        'satuan' => $getRequest[$i]['satuan'],
                        'hna' => $getRequest[$i]['hna'],
                        'diskon' => $getRequest[$i]['diskon'],
                        'subtotal' => $getRequest[$i]['subtotal'],
                    ]);
                }
            }
            return "sukses";
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function deleteDetail($id)
    {
        try {
            InvoiceDetail::where('id', $id)->update([
                'prop' => "del"
            ]);
            return 'sukses';
        } catch (\Throwable $th) {
            return $th->getMessage;
        }
    }

    public function deleteInvoice($id)
    {

        try {
            Invoice::where('id', $id)->update([
                'prop' => "del"
            ]);

            InvoiceDetail::where('id_header', $id)->update([
                'prop' => "del"
            ]);
            return 'sukses';
        } catch (\Throwable $th) {
            return $th->getMessage;
        }
    }

    public function getSearch($request)
    {
        $data = Invoice::where([['prop', " "], ["no_invoice", 'like', '%' . $request->keyword . '%']])
            ->orWhere([['prop', " "], ["tanggal", 'like', '%' . $request->keyword . '%']])
            ->orWhere([['prop', " "], ["kode_vendor", 'like', '%' . $request->keyword]])
            ->orWhere([['prop', " "], ["nama_vendor", 'like', '%' . $request->keyword . '%']]);

        return $data;
    }

    /**
     * undocumented function
     *
     * @return void
     */
    public function storeSetting($request)
    {
        $response = [];
        $image = $request->file('logo');

        $response['upload'] = '-';
        if (isset($image)) {
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            if ($image->storeAs('image', $imageName)) {
                $response['upload'] = 'sukses';
            }

            $request['nama_logo'] = $imageName;
        }
        try {
            InvoiceSetting::updateOrCreate(
                ['nama_perusahaan' => $request->nama_perusahaan],
                $request->except('_token', 'logo')
            );

            $response['create'] = 'sukses';
        } catch (Throwable $th) {
            $response['create'] = $th->getMessage();
        }

        return $response;
    }

    /**
     * undocumented function
     *
     * @return void
     */
    public function getSetting()
    {
        return InvoiceSetting::all()->first();
    }

    public function getImgLogo()
    {
        $getSetting = $this->getSetting();
        if (isset($getSetting) && $getSetting->nama_logo != '-') {
            $imagePath = 'image/' . $getSetting->nama_logo; // Sesuaikan dengan struktur direktori Anda
            $img = Storage::get($imagePath);
            $base64Image = base64_encode($img);
            return $base64Image;
        }
        return '';
    }
}
