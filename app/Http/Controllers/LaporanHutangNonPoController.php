<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use App\Models\Obat;
use App\Models\Barang;
use App\Bayar;
use App\Models\SmisFncHutangBiaya;
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

class LaporanHutangNonPoController extends Controller
{
    function __construct()
    {
        $this->middleware(function ($request, $next) {
            $menu = json_decode(Auth::user()->menu);
            if (property_exists($menu, 'laporan_keuangan')) {
                $arr = (array) $menu->laporan_keuangan;
                if ($arr['laporan_hutang_non_po'] == 0) {
                    return redirect('home');
                }
            } else {
                return redirect('home');
            }
            return $next($request);
        });
    }

    function ajax_prepare_excel(Request $req)
    {
        $namafile = time() . '_Laporan_Hutang_PO.xls';
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load(public_path("template//laporan_hutang_non_po.xls"));
        $writer = new WriterXls($spreadsheet);
        $writer->save(str_replace('\\', '/', public_path('filejadi/' . $namafile)));

        $hspreadsheet = IOFactory::load(public_path("filejadi//" . $namafile));
        $worksheet = $hspreadsheet->setActiveSheetIndexByName('Laporan');
        $worksheet->setCellValue('C3', $req->nama_vendor);
        $worksheet->setCellValue('C4', $req->status);
        $worksheet->setCellValue('F3', $req->outstanding);
        $hwriter = new WriterXls($hspreadsheet);
        $hwriter->save(public_path("filejadi//" . $namafile));

        return response()->json(['status' => true, 'namafile' => $namafile]);
    }

    function cekStatus($tagihan, $bayar)
    {
        if ($bayar == $tagihan) {
            return 'Sudah Lunas';
        } else if ($bayar > $tagihan) {
            return 'Lebih Bayar';
        } else if ($bayar < $tagihan) {
            return 'Belum Lunas';
        }
    }

    function ajaxWriteExcel(Request $req)
    {
        try {
            $spreadsheet = IOFactory::load(public_path("filejadi//" . $req->nama_file));
            $worksheet = $spreadsheet->setActiveSheetIndexByName('Laporan');
            $rowNum = 8;
            $no = 1;

            $query = SmisFncHutangBiaya::query();
            if ($req->nama_vendor != 'semua') {
                $query->where('nama_vendor', 'like', '%' . $req->nama_vendor . '%');
            }
            if ($req->status != 'semua') {
                $query->where('status', $req->status);
            }
            $data = $query->get();
            $tot_nilai = 0;
            $tot_bayar = 0;

            foreach ($data as $d) {
                if ($d->nama_vendor != '') {
                    $worksheet->setCellValue('A' . $rowNum, strval($no));
                }
                $worksheet->setCellValue('B' . $rowNum, $d->nama_vendor);
                $worksheet->setCellValue('C' . $rowNum, $d->nomor_invoice);
                $worksheet->setCellValue('D' . $rowNum, $d->tanggal_jurnal);
                $worksheet->setCellValue('E' . $rowNum, str_replace('.', '', $d->nilai));
                $worksheet->setCellValue('F' . $rowNum, str_replace('.', '', $d->total_terbayar));
                $worksheet->setCellValue('G' . $rowNum, $d->status);
                $worksheet->getStyle('A' . $rowNum . ':G' . $rowNum)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
                $rowNum++;
                $no++;
                $tot_nilai += $d->nilai;
                $tot_bayar += $d->total_terbayar;
            }

            $worksheet->setCellValue('D' . $rowNum, 'Total');
            $worksheet->setCellValue('E' . $rowNum, str_replace('.', '', $tot_nilai));
            $worksheet->setCellValue('F' . $rowNum, str_replace('.', '', $tot_bayar));

            $writer = new WriterXls($spreadsheet);
            $writer->save(str_replace('\\', '/', public_path('filejadi/' . $req->nama_file)));

            return response()->json($req->nama_file);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage());
        }
    }

    function getStatus($tagihan, $bayar)
    {
        if ($tagihan == $bayar) {
            return 'Lunas';
        } else {
            return 'Belum Lunas';
        }
    }

    function downloadExcel(Request $req)
    {
        $file = public_path("filejadi//" . $req->namafile);
        $headers = array('Content-Type: application/csv',);
        $tmp = date('d-m-Y H:i');
        $waktu = str_replace('-', '_', $tmp);
        $waktu = str_replace(' ', '_', $waktu);
        $waktu = str_replace(':', '_', $waktu);
        return Response::download($file, 'Laporan Hutang Non PO - ' . $waktu . '.csv', $headers);
    }

    function index()
    {
        return view('laporan_keuangan.laporan_hutang_non_po');
    }

    function ajaxSearchVendor(Request $req)
    {
        $data = Vendor::where('nama', 'like', '%' . $req->vendor . '%')->select('id', 'nama')->get();
        $d['items'] = $data;
        return response()->json($d);
    }

    function ajaxDoingFilter(Request $req)
    {
        $query = SmisFncHutangBiaya::query();
        if ($req->nama_vendor != 'semua') {
            $query->where('nama_vendor', 'like', '%' . $req->nama_vendor . '%');
        }
        if ($req->status != 'semua') {
            $query->where('status', $req->status);
        }
        $hasilakhir = $query->get();

        return response()->json($hasilakhir);
    }
}
