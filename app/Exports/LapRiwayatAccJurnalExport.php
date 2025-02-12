<?php

namespace App\Exports;

use App\Services\LapRiwayatAccJurnalService;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;


class LapRiwayatAccJurnalExport implements FromView, WithEvents
{

    private $request;

    public function __construct($data)
    {
        $this->request = $data;
    }

    public function view(): View
    {
        $lapRiwayatAccJurnalService  = new LapRiwayatAccJurnalService();
        return view('lap_riwayat_jurnal.excel', [
            'request' => $this->request,
            'data' => $lapRiwayatAccJurnalService->getData($this->request->all())
        ]);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {

                $event->sheet->getColumnDimension('A')->setWidth(4);
                $event->sheet->getColumnDimension('B')->setWidth(25);
                $event->sheet->getColumnDimension('C')->setWidth(15);
                $event->sheet->getColumnDimension('D')->setWidth(17);
                $event->sheet->getColumnDimension('E')->setWidth(17);
                $event->sheet->getColumnDimension('F')->setWidth(25);
                $event->sheet->getColumnDimension('G')->setWidth(110);
                $event->sheet->getColumnDimension('H')->setWidth(17);
            },
        ];
    }
}
