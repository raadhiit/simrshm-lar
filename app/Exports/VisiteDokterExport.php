<?php 

namespace App\Exports;

use App\Services\VisiteDokterService;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;


class VisiteDokterExport implements FromView, WithEvents
{

    private $request;

    public function __construct($data)
    {
        $this->request = $data;
    }

    public function view(): View
    {
        $VisiteDokterService  = new VisiteDokterService();
        return view('tindakan_dokter.visite_dokter.excel', [
            'request' => $this->request,
            'data' => $VisiteDokterService->getData()
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
