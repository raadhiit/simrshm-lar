<?php

namespace App\Exports;

use App\Services\DataIndukService;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Sheet;

class DataIndukBagianExport implements FromView, WithEvents
{

    private $request;

    /**
     * @param $param
     */
    public function __construct($param)
    {
        $this->request = $param;
    }


    public function view(): View
    {
        $dataIndukService = new DataIndukService();
        return view('data_induk.bagian_excel', [
            'data' => $dataIndukService->getDownloadBagian($this->request),
        ]);
    }

    public function registerEvents(): array
    {
        Sheet::macro('styleCells', function (Sheet $sheet, string $cellRange, array $style) {
            $sheet->getDelegate()->getStyle($cellRange)->applyFromArray($style);
        });

        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getColumnDimension('A')->setWidth(7);
                $event->sheet->getColumnDimension('B')->setWidth(14);
                $event->sheet->getColumnDimension('C')->setWidth(14);
                $event->sheet->getColumnDimension('D')->setWidth(30);
            }
        ];
    }
}
