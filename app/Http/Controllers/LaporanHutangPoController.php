<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use App\Models\Obat;
use App\Models\Barang;
use App\Bayar;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use DB;
use Faker\Provider\ar_SA\Color;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xls as WriterXls;
use PhpOffice\PhpSpreadsheet\Writer\Csv as WriterCsv;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use Response;
use Auth;

class LaporanHutangPoController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $menu = json_decode(Auth::user()->menu);
            if (property_exists($menu, 'laporan_keuangan')) {
                $arr = (array) $menu->laporan_keuangan;
                if ($arr['laporan_hutang_po'] == 0) {
                    return redirect('home');
                }
            } else {
                return redirect('home');
            }
            return $next($request);
        });
    }

    public function ajax_prepare_excel(Request $req)
    {
        $namafile = time() . '_Laporan_Hutang_PO.xls';
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load(public_path("template//laporan_hutang_po.xls"));
        $writer = new WriterXls($spreadsheet);
        $writer->save(str_replace('\\', '/', public_path('filejadi/' . $namafile)));

        $hspreadsheet = IOFactory::load(public_path("filejadi//" . $namafile));
        $worksheet = $hspreadsheet->setActiveSheetIndexByName('Laporan');
        $worksheet->setCellValue('C3', $req->nama_vendor);
        $worksheet->setCellValue('C4', $req->jenis_faktur);
        $worksheet->setCellValue('C5', $req->outstanding);
        $worksheet->setCellValue('F3', $req->tanggal_jt);
        $worksheet->setCellValue('F4', $req->status);
        $hwriter = new WriterXls($hspreadsheet);
        $hwriter->save(public_path("filejadi//" . $namafile));

        return response()->json(['status' => true, 'namafile' => $namafile]);
    }

    public function cekStatus($tagihan, $bayar)
    {
        if ($bayar == $tagihan) {
            return 'Sudah Lunas';
        } else if ($bayar > $tagihan) {
            return 'Lebih Bayar';
        } else if ($bayar < $tagihan) {
            return 'Belum Lunas';
        }
    }

    public function ajaxWriteExcel(Request $req)
    {
        try {
            $spreadsheet = IOFactory::load(public_path("filejadi//" . $req->nama_file));
            $worksheet = $spreadsheet->setActiveSheetIndexByName('Laporan');
            $rowNum = 8;
            $no = 1;
            $tot_tagihan = 0;
            $tot_dibayar = 0;

            $data = $this->getData($req->jenis_faktur, $req->nama_vendor, $req->tanggal_jt, $req->status);

            foreach ($data as $d) {
                if ($d->nama_vendor != '') {
                    $worksheet->setCellValue('A' . $rowNum, strval($no));
                }
                $worksheet->setCellValue('B' . $rowNum, $d->nama_vendor);
                $worksheet->setCellValue('C' . $rowNum, $d->no_po);
                $worksheet->setCellValue('D' . $rowNum, $d->tipe);
                $worksheet->setCellValue('E' . $rowNum, $d->no_faktur);
                $worksheet->setCellValue('F' . $rowNum, $d->tanggal);
                $worksheet->setCellValue('G' . $rowNum, $d->tanggal_tempo);
                $worksheet->setCellValue('H' . $rowNum, str_replace('.', '', $d->total_tagihan));
                $worksheet->setCellValue('I' . $rowNum, str_replace('.', '', $d->total_dibayar));
                $worksheet->setCellValue('J' . $rowNum, $this->cekStatus(str_replace('.', '', $d->total_tagihan), str_replace('.', '', $d->total_dibayar)));
                $worksheet->getStyle('A' . $rowNum . ':J' . $rowNum)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
                $rowNum++;
                $no++;
                $tot_tagihan += $d->total_tagihan;
                $tot_dibayar += $d->total_dibayar;
            }

            $worksheet->setCellValue('G' . $rowNum, 'Total');
            $worksheet->setCellValue('H' . $rowNum, str_replace('.', '', $tot_tagihan));
            $worksheet->setCellValue('I' . $rowNum, str_replace('.', '', $tot_dibayar));

            $writer = new WriterXls($spreadsheet);
            $writer->save(str_replace('\\', '/', public_path('filejadi/' . $req->nama_file)));

            return response()->json($req->nama_file);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage());
        }
    }

    public function getStatus($tagihan, $bayar)
    {
        if ($tagihan == $bayar) {
            return 'Lunas';
        } else {
            return 'Belum Lunas';
        }
    }

    public function downloadExcel(Request $req)
    {
        $file = public_path("filejadi//" . $req->namafile);
        $headers = array('Content-Type: application/csv',);
        $tmp = date('d-m-Y H:i');
        $waktu = str_replace('-', '_', $tmp);
        $waktu = str_replace(' ', '_', $waktu);
        $waktu = str_replace(':', '_', $waktu);
        return Response::download($file, 'Laporan Hutang PO - ' . $waktu . '.csv', $headers);
    }

    public function index()
    {
        return view('laporan_keuangan.laporan_hutang_po');
    }

    public function ajaxSearchVendor(Request $req)
    {
        $data = Vendor::where('nama', 'like', '%' . $req->vendor . '%')->select('id', 'nama')->get();
        $d['items'] = $data;
        return response()->json($d);
    }

    public function getData($jenis_faktur, $nama_vendor, $tanggal_jt, $status)
    {
        if ($jenis_faktur == 'semua') {
            $barang = Barang::query()->where('prop', '');
            $barang->select('id', 'nama_vendor', 'no_faktur', 'tanggal', 'tanggal_tempo', 'tipe', 'total_tagihan', 'total_dibayar', 'no_opl as no_po');
            if ($nama_vendor != 'semua') {
                $barang->where('id_vendor', $nama_vendor);
            }
            $barang->where('no_faktur', '<>', null);
            $barang->groupBy('id');
            $resbarang = $barang->get();

            $obat = Obat::query()->where('prop', '');
            $obat->select('id', 'nama_vendor', 'no_faktur', 'tanggal', 'tanggal_tempo', 'tipe', 'total_tagihan', 'total_dibayar', 'no_opl as no_po');
            if ($nama_vendor != 'semua') {
                $obat->where('id_vendor', $nama_vendor);
            }
            $obat->where('no_faktur', '<>', null);
            $obat->groupBy('id');
            $resobat = $obat->get();

            $result = [];
            foreach ($resbarang as $bar) {
                array_push($result, $bar);
            }
            foreach ($resobat as $obt) {
                array_push($result, $obt);
            }
        } else {
            if ($jenis_faktur == 'umum') {
                $data = Barang::query()->where('prop', '');
                $data->select('id', 'nama_vendor', 'id_po', 'no_faktur', 'tanggal', 'tanggal_tempo', 'tipe', 'total_tagihan', 'total_dibayar', 'no_opl as no_po');
                if ($nama_vendor != 'semua') {
                    $data->where('id_vendor', $nama_vendor);
                }
                $data->where('no_faktur', '<>', null);
            } else if ($jenis_faktur == 'farmasi') {
                $data = Obat::query()->where('prop', '');
                $data->select('id', 'nama_vendor', 'id_po', 'no_faktur', 'tanggal', 'tanggal_tempo', 'tipe', 'total_tagihan', 'total_dibayar', 'no_opl as no_po');
                if ($nama_vendor != 'semua') {
                    $data->where('id_vendor', $nama_vendor);
                }
                $data->where('no_faktur', '<>', null);
            }
            $result = $data->get();
        }

        $filtertempo = [];

        if ($tanggal_jt == 'jatuh tempo') {
            foreach ($result as $res) {
                if ($res->tanggal_tempo < date('Y-m-d')) {
                    array_push($filtertempo, $res);
                }
            }
        } else if ($tanggal_jt == 'semua') {
            $filtertempo = $result;
        } else {
            $now = time();
            if (strpos($tanggal_jt, '>') !== false) {
                foreach ($result as $res) {
                    $your_date = strtotime($res->tanggal_tempo);
                    $datediff = $your_date - $now;
                    if (($datediff / (60 * 60 * 24)) > 90) {
                        array_push($filtertempo, $res);
                    }
                }
            } else {
                $jt = explode('-', $tanggal_jt);
                foreach ($result as $res) {
                    $your_date = strtotime($res->tanggal_tempo);
                    $datediff = $your_date - $now;
                    if (($datediff / (60 * 60 * 24)) >= $jt[0] && ($datediff / (60 * 60 * 24)) <= $jt[1]) {
                        array_push($filtertempo, $res);
                    }
                }
            }
        }

        $hasilakhir = [];

        if ($status != 'semua') {
            if ($status == 'belum lunas') {
                foreach ($filtertempo as $temp) {
                    if ($temp->total_tagihan > $temp->total_dibayar) {
                        array_push($hasilakhir, $temp);
                    }
                }
            } else if ($status == 'sudah lunas') {
                foreach ($filtertempo as $temp) {
                    if ($temp->total_tagihan = $temp->total_dibayar) {
                        array_push($hasilakhir, $temp);
                    }
                }
            } else if ($status == 'lebih bayar') {
                foreach ($filtertempo as $temp) {
                    if ($temp->total_tagihan < $temp->total_dibayar) {
                        array_push($hasilakhir, $temp);
                    }
                }
            }
        } else {
            $hasilakhir = $filtertempo;
        }

        return $hasilakhir;
    }

    public function ajaxDoingFilter(Request $req)
    {
        $hasilakhir = $this->getData($req->jenis_faktur, $req->nama_vendor, $req->tanggal_jt, $req->status);

        return response()->json($hasilakhir);
    }
}
