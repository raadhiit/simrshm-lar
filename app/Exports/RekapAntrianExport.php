<?php

namespace App\Exports;

use App\Models\Antrian;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;


class RekapAntrianExport implements FromView, ShouldAutoSize, WithEvents
{
    protected $from;
    protected $to;

    function __construct($dari, $sampai)
    {
        $this->from = $dari;
        $this->to = $sampai;
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function (AfterSheet $event) {

                $num = $event->sheet->getDelegate()->getHighestRow();
                $alpha = ['A','B','C','D','E','F','G','H','I','J','K','L','M'];

                $cellRange = 'A4:M4'; // All headers
                $styleArray = [
                    'borders' => [
                        'outline' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['argb' => '#111'],
                        ],
                    ],
                ];
        
                for ($i=4; $i <= $num; $i++) { 
                    for ($j=0; $j < sizeof($alpha); $j++) { 
                        $event->sheet->getStyle($alpha[$j].$i)->applyFromArray($styleArray);
                    }
                }
            },
        ];
    }

    public function view(): View
    {
        $query['data'] = Antrian::leftJoin('smis_rg_patient', 'antrians.norm', 'smis_rg_patient.id')->select(
            'antrians.pasien_baru',
            'antrians.tanggalperiksa',
            'antrians.namapoli',
            'antrians.kodebooking',
            'antrians.nomorantrean',
            'smis_rg_patient.nama',
            'antrians.norm',
            'antrians.waktu_checkin',
            'antrians.waktu_taskid_dua',
            'antrians.waktu_taskid_tiga',
            'antrians.waktu_taskid_empat',
            'antrians.waktu_taskid_lima',
            'antrians.waktu_taskid_enam',
            'antrians.waktu_taskid_tujuh',
        )->whereBetween('tanggalperiksa', [$this->from, $this->to])->get();
        $query['dari'] = $this->from;
        $query['sampai'] = $this->to;
        return view('exports.rekap_antrian', $query);
    }
}
