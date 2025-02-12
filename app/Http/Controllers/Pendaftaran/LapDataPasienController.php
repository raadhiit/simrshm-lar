<?php

namespace App\Http\Controllers\Pendaftaran;

use App\Exports\Pendaftaran\LapDataPasienExport;
use App\Http\Controllers\Controller;
use App\Models\SMIS_Pasien;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx as WriterXlsx;
use Spatie\SimpleExcel\SimpleExcelWriter;

class LapDataPasienController extends Controller
{
    function __construct()
    {
        $this->middleware(function ($request, $next) {
            $menu = json_decode(Auth::user()->menu);
            if (property_exists($menu, 'registration')) {
                $arr = (array) $menu->registration;
                if ($arr['lap_data_pasien'] == 0) {
                    return redirect('home');
                }
            } else {
                return redirect('home');
            }
            return $next($request);
        });
    }

    function index()
    {
        return view('pendaftaran.lap_data_pasien.index');
    }

    function data_pasien(Request $req)
    {
        $data = SMIS_Pasien::select(
            'id as norm',
            'tanggal',
            'nama',
            'alamat',
            'nama_kelurahan',
            'nama_kecamatan',
            'nama_kabupaten',
            'nama_provinsi',
            'tempat_lahir',
            'tgl_lahir',
            'kelamin',
            'ktp',
            'nobpjs',
            'telpon',
            'pekerjaan',
            'pendidikan',
            'status'
        )->where('prop', '')->where('tanggal', $req->tanggal)->paginate(1000);
        return response()->json($data);
    }

    function prepare_file_excel(Request $req)
    {
        $namafile = time() . '_Lap_Data_Pasien_' . str_replace('-', '_', date('d-m-Y', strtotime($req->tanggal)));

        $spreadsheet = new Spreadsheet();
        $activeWorksheet = $spreadsheet->getActiveSheet();
        $activeWorksheet->setCellValue('A1', 'NO');
        $activeWorksheet->setCellValue('B1', 'NRM');
        $activeWorksheet->setCellValue('C1', 'TANGGAL');
        $activeWorksheet->setCellValue('D1', 'NAMA');
        $activeWorksheet->setCellValue('E1', 'ALAMAT');
        $activeWorksheet->setCellValue('F1', 'KELURAHAN');
        $activeWorksheet->setCellValue('G1', 'KECAMATAN');
        $activeWorksheet->setCellValue('H1', 'KABUPATEN');
        $activeWorksheet->setCellValue('I1', 'PROVINSI');
        $activeWorksheet->setCellValue('J1', 'TEMPAT LAHIR');
        $activeWorksheet->setCellValue('K1', 'TGL LAHIR');
        $activeWorksheet->setCellValue('L1', 'KELAMIN');
        $activeWorksheet->setCellValue('M1', 'KTP');
        $activeWorksheet->setCellValue('N1', 'NO BPJS');
        $activeWorksheet->setCellValue('O1', 'TELPON');
        $activeWorksheet->setCellValue('P1', 'PEKERJAAN');
        $activeWorksheet->setCellValue('Q1', 'PENDIDIKAN');
        $activeWorksheet->setCellValue('R1', 'STATUS');

        $activeWorksheet
            ->getStyle('A1:R1')
            ->getBorders()
            ->getOutline()
            ->setBorderStyle(Border::BORDER_THIN)
            ->setColor(new Color('#111'));

        foreach (range('A', 'R') as $columnID) {
            $activeWorksheet
                ->getColumnDimension($columnID)
                ->setAutoSize(true);

            $activeWorksheet
                ->getStyle($columnID)
                ->getAlignment()->setHorizontal('center');
        }

        $writer = new WriterXlsx($spreadsheet);
        $writer->save(public_path('lap_data_pasien\\' . $namafile . '.xlsx'));

        return response()->json([
            'status' => true,
            'code' => 200,
            'namafile' => $namafile,
        ]);
    }

    function write_file_excel(Request $req)
    {
        $last_row = $req->last_row;
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $spreadsheet = $reader->load(public_path('lap_data_pasien\\' . $req->namafile . '.xlsx'));
        $activeWorksheet = $spreadsheet->getActiveSheet();

        $data = SMIS_Pasien::select(
            'id as norm',
            'tanggal',
            'nama',
            'alamat',
            'nama_kelurahan',
            'nama_kecamatan',
            'nama_kabupaten',
            'nama_provinsi',
            'tempat_lahir',
            'tgl_lahir',
            'kelamin',
            'ktp',
            'nobpjs',
            'telpon',
            'pekerjaan',
            'pendidikan',
            'status'
        )->where('prop', '')->where('tanggal', $req->tanggal)->offset((($req->iteration * 1000) - 999) - 1)->take($req->iteration * 1000)->get();

        for ($i = 0; $i < sizeof($data); $i++) {
            $activeWorksheet->setCellValue('A' . $last_row, $last_row - 1);
            $activeWorksheet->setCellValue('B' . $last_row, $data[$i]->nrm);
            $activeWorksheet->setCellValue('C' . $last_row, $data[$i]->tanggal);
            $activeWorksheet->setCellValue('D' . $last_row, $data[$i]->nama);
            $activeWorksheet->setCellValue('E' . $last_row, $data[$i]->alamat);
            $activeWorksheet->setCellValue('F' . $last_row, $data[$i]->nama_kelurahan);
            $activeWorksheet->setCellValue('G' . $last_row, $data[$i]->nama_kecamatan);
            $activeWorksheet->setCellValue('H' . $last_row, $data[$i]->nama_kabupaten);
            $activeWorksheet->setCellValue('I' . $last_row, $data[$i]->nama_provinsi);
            $activeWorksheet->setCellValue('J' . $last_row, $data[$i]->tempat_lahir);
            $activeWorksheet->setCellValue('K' . $last_row, $data[$i]->tgl_lahir);
            $activeWorksheet->setCellValue('L' . $last_row, $data[$i]->kelamin);
            $activeWorksheet->setCellValue('M' . $last_row, $data[$i]->ktp);
            $activeWorksheet->setCellValue('N' . $last_row, $data[$i]->nobpjs);
            $activeWorksheet->setCellValue('O' . $last_row, $data[$i]->telpon);
            $activeWorksheet->setCellValue('P' . $last_row, $data[$i]->pekerjaan);
            $activeWorksheet->setCellValue('Q' . $last_row, $data[$i]->pendidikan);
            $activeWorksheet->setCellValue('R' . $last_row, $data[$i]->status);

            $last_row++;
        }

        $writer = new WriterXlsx($spreadsheet);
        $writer->save(public_path('lap_data_pasien\\' . $req->namafile . '.xlsx'));

        return response()->json([
            'status' => true,
            'message' => 'Ok',
            'last_row' => $last_row
        ]);
    }

    function export(Request $req)
    {
        $query = DB::table('smis_rg_patient')->select(
            'id as norm',
            'tanggal',
            'nama',
            'alamat',
            'nama_kelurahan',
            'nama_kecamatan',
            'nama_kabupaten',
            'nama_provinsi',
            'tempat_lahir',
            'tgl_lahir',
            'kelamin',
            'ktp',
            'nobpjs',
            'telpon',
            'pekerjaan',
            'pendidikan',
            'status'
        )->where('prop', '')->where('tanggal', '>=', $req->tanggal_dari)->where('tanggal', '<=', $req->tanggal_sampai);
        $query = DB::select(DB::raw("SELECT id as norm, tanggal, nama, alamat, nama_kelurahan, nama_kecamatan, nama_kabupaten, nama_provinsi, tempat_lahir, tgl_lahir, kelamin, ktp, nobpjs, telpon, pekerjaan, pendidikan, status from smis_rg_patient where prop = '' and tanggal >= '" . $req->tanggal_dari . "' and tanggal <= '" . $req->tanggal_sampai . "'"));
        $query = collect($query);

        $writer = SimpleExcelWriter::streamDownload('lap_data_pasien.xlsx');

        foreach (range(0, $query->count()) as $i) {
            $writer->addRow([
                'NRM'           => $query[$i]->norm,
                'TANGGAL'       => Carbon::parse($query[$i]->tanggal)->format('d/m/Y'),
                'NAMA'          => $query[$i]->nama,
                'ALAMAT'        => $query[$i]->alamat,
                'KELURAHAN'     => $query[$i]->nama_kelurahan,
                'KECAMATAN'     => $query[$i]->nama_kecamatan,
                'KABUPATEN'     => $query[$i]->nama_kabupaten,
                'PROVINSI'      => $query[$i]->nama_provinsi,
                'TEMPAT LAHIR'  => $query[$i]->tempat_lahir,
                'TGL LAHIR'     => $query[$i]->tgl_lahir != '0000-00-00' && $query[$i]->tgl_lahir != '' ? Carbon::parse($query[$i]->tgl_lahir)->format('d/m/Y') : '',
                'KELAMIN'       => $query[$i]->kelamin == 1 ? 'Perempuan' : 'Laki-laki',
                'KTP'           => $query[$i]->ktp,
                'NO BPJS'       => $query[$i]->nobpjs,
                'TELPON'        => $query[$i]->telpon,
                'PEKERJAAN'     => $query[$i]->pekerjaan,
                'PENDIDIKAN'    => $query[$i]->pendidikan,
                'STATUS'        => $query[$i]->status,
            ]);

            if ($i % $query->count() === 0) {
                flush(); // Flush the buffer
            }
        }

        $writer->toBrowser();

        // return Excel::download(new LapDataPasienExport($req->all()), 'lap_data_pasien.csv', \Maatwebsite\Excel\Excel::CSV, [
        //     'chunk_size' => 3000,
        // ]);
    }
}
