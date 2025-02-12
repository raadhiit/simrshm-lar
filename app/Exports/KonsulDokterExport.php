<?php 

namespace App\Exports;

use App\Services\KonsulDokterService;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;


class KonsulDokterExport implements FromView, WithEvents
{

    private $request;

    public function __construct($data)
    {
        $this->request = $data;
    }

    public function view(): View
    {
        $KonsulDokterService  = new KonsulDokterService();
        return view('tindakan_dokter.konsul_dokter.excel', [
            'request' => $this->request,
            'data' => $KonsulDokterService->getData()
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
            },
        ];
    }
}
