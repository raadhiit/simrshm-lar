<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;

class LaporanLabaRugiExport implements FromView, WithEvents
{

    private $request;

    public function __construct($data)
    {
        $this->request = $data;
    }

    public function view(): View
    {
        return view('laporan_laba_rugi.excel', [
            'request' => $this->request->except('_token'),
        ]);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {

                $event->sheet->getColumnDimension('B')->setWidth(40);
                $event->sheet->getColumnDimension('C')->setWidth(20);

                $event->sheet->getStyle('C')->getNumberFormat()
                    ->setFormatCode('_(* #,##0_);_(* \(#,##0\);_(* "-"??_);_(@_)');
            },
        ];
    }
}
