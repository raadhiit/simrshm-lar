<?php 

namespace App\Exports;
use App\Services\PeriksaDokterService;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;


class PeriksaDokterExport implements FromView, WithEvents
{

    private $request;

    public function __construct($data)
    {
        $this->request = $data;
    }

    public function view(): View
    {
        $PeriksaDokterService  = new PeriksaDokterService();
        return view('tindakan_dokter.periksa_dokter.excel', [
            'request' => $this->request,
            'data' => $PeriksaDokterService->getData()
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
