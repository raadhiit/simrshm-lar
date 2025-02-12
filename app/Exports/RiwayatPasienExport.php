<?php

namespace App\Exports;

use App\Services\RiwayatPasienService;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Sheet;

class RiwayatPasienExport implements FromView, WithEvents
{
    private $param;
    /**
     * @param $param
     */
    public function __construct($param)
    {
        $this->param = $param;
    }

    public function view(): View
    {
        $riwayatPasienService = new RiwayatPasienService();
        return view('data_riwayat.excel', [
            'data_riwayats' => $riwayatPasienService->getData($this->param)->get(),
            'request' => $this->param->all()
        ]);
    }

    public function registerEvents(): array
    {

        Sheet::macro('styleCells', function (Sheet $sheet, string $cellRange, array $style) {
            $sheet->getDelegate()->getStyle($cellRange)->applyFromArray($style);
        });
        return [
            AfterSheet::class => function (AfterSheet $event) {

                $event->sheet->getColumnDimension('A')->setWidth(5);
                $event->sheet->getColumnDimension('B')->setWidth(18);
                $event->sheet->getColumnDimension('C')->setWidth(18);
                $event->sheet->getColumnDimension('D')->setWidth(14);
                $event->sheet->getColumnDimension('E')->setWidth(14);
                $event->sheet->getColumnDimension('F')->setWidth(14);
                $event->sheet->getColumnDimension('G')->setWidth(12);
                $event->sheet->getColumnDimension('H')->setWidth(12);
                $event->sheet->getColumnDimension('I')->setWidth(7);
                $event->sheet->getColumnDimension('J')->setWidth(28);
                $event->sheet->getColumnDimension('K')->setWidth(20);
                $event->sheet->getColumnDimension('L')->setWidth(10);
                $event->sheet->getColumnDimension('M')->setWidth(23);
            },

        ];
    }
}
