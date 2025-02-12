<?php

namespace App\Exports;

use App\Models\SMIS_LayananPasien;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class FailedSatuSehatRawatJalanExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithEvents
{
    /**
     * @return \Illuminate\Support\Collection
     */
    private $data;
    private $index = 0;
    private $query;

    function __construct($param)
    {
        $this->data = $param->all();
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $styleHeader = [
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => 'thin',
                            'color' => ['rgb' => '#111'],
                        ],
                    ]
                ];
                $event->sheet->getStyle("A1:H" . (sizeof($this->collection()) + 1))->applyFromArray($styleHeader);
                $event->sheet->getDelegate()->getStyle('A1:H1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('A2:A' . (sizeof($this->collection()) + 1))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('B2:B' . (sizeof($this->collection()) + 1))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('C2:C' . (sizeof($this->collection()) + 1))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('F2:F' . (sizeof($this->collection()) + 1))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            },
        ];
    }

    public function collection()
    {
        /*        $query = SMIS_LayananPasien::leftJoin('smis_mr_diagnosa', 'smis_mr_diagnosa.noreg_pasien', 'smis_rg_layananpasien.id')
            ->where(function ($q) {
                $q->whereBetween('smis_rg_layananpasien.tanggal', [date('Y-m-d', strtotime($this->data['from'])) . ' 00:00:00', date('Y-m-d', strtotime($this->data['to'])) . ' 23:59:59']);
            })->where('smis_rg_layananpasien.prop', '')->where('smis_rg_layananpasien.uri', 0)
            ->where('selesai', 1)->where(function ($z) {
                $z->where('smis_rg_layananpasien.carapulang', '!=', 'Tidak Datang')->where('smis_rg_layananpasien.carapulang', '!=', 'Rawat Inap');
            })->where('status_ss', '0')->select(
                'smis_rg_layananpasien.id',
                'smis_rg_layananpasien.nama_pasien',
                'smis_rg_layananpasien.nrm',
                'smis_rg_layananpasien.jenislayanan',
                'smis_rg_layananpasien.tanggal',
                'smis_mr_diagnosa.nama_icd',
                'smis_rg_layananpasien.response_message_satu_sehat',
            )->get();
return $query; */

        $query = SMIS_LayananPasien::whereNotIn('carapulang', ['Tidak Datang', 'Rawat Inap'])
            ->join('smis_rg_patient', 'smis_rg_layananpasien.nrm', 'smis_rg_patient.id')
            ->where([
                ['smis_rg_layananpasien.status_ss', '0'],
                ['smis_rg_patient.prop', ''],
                ['smis_rg_layananpasien.prop', ''],
                ['uri', 0],
                ['selesai', 1],
                ['smis_rg_layananpasien.tanggal', '>=', date('Y-m-d', strtotime($this->data['from'])) . ' 00:00:00'],
                ['smis_rg_layananpasien.tanggal', '<=', date('Y-m-d', strtotime($this->data['to'])) . ' 23:59:59'],
            ])
            ->select(
                'smis_rg_layananpasien.id',
                'smis_rg_layananpasien.nama_pasien',
                'smis_rg_layananpasien.nrm',
                'smis_rg_layananpasien.jenislayanan',
                'smis_rg_layananpasien.tanggal',
                'smis_rg_layananpasien.response_message_satu_sehat',
            )
            ->get();

        $noregValues = $query->pluck('id');

        // Retrieve the diagnostic data
        $diagnosa = DB::table('smis_mr_diagnosa')
            ->where('prop', '')
            ->whereIn('noreg_pasien', $noregValues)
            ->select('noreg_pasien', 'nama_icd')
            ->get()
            ->keyBy('noreg_pasien');

        // Merge the diagnostic data back into the main results
        $results = $query->map(function ($item) use ($diagnosa) {
            $noreg = $item->id;
            if (isset($diagnosa[$noreg])) {
                $item->nama_icd = $diagnosa[$noreg]->nama_icd;
            } else {
                $item->nama_icd = null;
            }
            return $item;
        });

        return $results;
    }

    public function headings(): array
    {
        return ["NO", "NOREG", "NRM", "NAMA PASIEN", "NAMA POLI", "TANGGAL", "DIAGNOSA", "KETERANGAN"];
    }

    public function map($result): array
    {
        return [
            ++$this->index,
            $result->id,
            $result->nrm,
            $result->nama_pasien,
            ucwords(str_replace('_', ' ', $result->jenislayanan)),
            Carbon::parse($result->tanggal)->format('d/m/Y'),
            $result->nama_icd,
            $result->response_message_satu_sehat,
        ];
    }
}
