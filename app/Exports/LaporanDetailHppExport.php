<?php

namespace App\Exports;

use App\Services\LaporanDetailHppService;
use Maatwebsite\Excel\Concerns\FromCollection;
//use Maatwebsite\Excel\Events\AfterSheet;
//use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LaporanDetailHppExport implements FromCollection, WithHeadings
{

    private $request;
    private $data;

    public function __construct($request)
    {
        $this->request = $request;
        $laporanDetailHppService = new LaporanDetailHppService();
        $data = $laporanDetailHppService->getData($this->request->all(), false);
        $this->data = $data;
    }

    public function collection()
    {
        $formattedData = $this->data->map(function ($item, $index) {
            return [
                'No' => $index + 1,
                'Nama Pasien' => $item->nama_pasien,
                'NRM' => $item->nrm,
                'Noreg' => $item->noreg_pasien,
                'Nama Tagihan' => $item->nama_tagihan,
                'Jumlah Tagihan' => round($item->total),
                'Hpp' => round($item->hpp),
            ];
        });

        return $formattedData;
    }

    public function headings(): array
    {
        return [
            ['Laporan Detail HPP'],
            [$this->request['tanggal_dari'] .  ' s.d ' . $this->request['tanggal_sampai']],
            [],
            [],
            ['No', 'Nama Pasien', 'NRM', 'Noreg', 'Nama Tagihan', 'Jumlah Tagihan', 'Hpp'], // Heading pada baris ketiga
        ];
    }
}
