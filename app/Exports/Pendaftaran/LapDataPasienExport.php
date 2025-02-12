<?php

namespace App\Exports\Pendaftaran;

use App\Models\SMIS_Pasien;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class LapDataPasienExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize, WithChunkReading
{
    /**
     * @return \Illuminate\Support\Collection
     */
    private $index = 0;
    private $tanggal_dari;
    private $tanggal_sampai;

    function __construct($arr){
        $this->tanggal_dari = $arr['tanggal_dari'];
        $this->tanggal_sampai = $arr['tanggal_sampai'];
    }

    public function query()
    {
        return SMIS_Pasien::select(
            'id as norm',
            'tanggal',
            'nama',
            'alamat',
            'nama_kelurahan',
            'nama_kecamatan',
            'nama_kabupaten',
            'nama_provinsi',
            'tempat_lahir',
            'tgl_lahir',
            'kelamin',
            'ktp',
            'nobpjs',
            'telpon',
            'pekerjaan',
            'pendidikan',
            'status'
        )->where('prop', '')->where('tanggal','>=', $this->tanggal_dari)->where('tanggal','<=', $this->tanggal_sampai);
    }

    public function headings(): array
    {
        return [
            'NO',
            'NRM',
            'TANGGAL',
            'NAMA',
            'ALAMAT',
            'KELURAHAN',
            'KECAMATAN',
            'KABUPATEN',
            'PROVINSI',
            'TEMPAT LAHIR',
            'TGL LAHIR',
            'KELAMIN',
            'KTP',
            'NO BPJS',
            'TELPON',
            'PEKERJAAN',
            'PENDIDIKAN',
            'STATUS',
        ];
    }

    public function map($result): array
    {
        return [
            ++$this->index,
            $result->norm,
            Carbon::parse($result->tanggal)->format('d/m/Y'),
            $result->nama,
            $result->alamat,
            $result->nama_kelurahan,
            $result->nama_kecamatan,
            $result->nama_kabupaten,
            $result->nama_provinsi,
            $result->tempat_lahir,
            Carbon::parse($result->tgl_lahir)->format('d/m/Y'),
            $result->kelamin == 1 ? 'Perempuan' : 'Laki-laki',
            $result->ktp,
            $result->nobpjs,
            $result->telpon,
            $result->pekerjaan,
            $result->pendidikan,
            $result->status,
        ];
    }

    function chunkSize(): int
    {
        return 3000;
    }
}
