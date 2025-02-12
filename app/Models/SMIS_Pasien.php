<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SMIS_Pasien extends Model
{
    use HasFactory;

    protected $table = 'smis_rg_patient';

    static function get($nrm)
    {
        return SMIS_Pasien::leftJoin('smis_rg_layananpasien', 'smis_rg_patient.id', 'smis_rg_layananpasien.nrm')
            ->leftJoin('smis_rg_asuransi', 'smis_rg_layananpasien.asuransi', 'smis_rg_asuransi.id')
            ->select(
                'smis_rg_layananpasien.nrm as nrm',
                'smis_rg_patient.nama as nama',
                'smis_rg_patient.ktp as ktp',
                'smis_rg_patient.telpon as telpon',
                'smis_rg_patient.tempat_lahir as tempat_lahir',
                'smis_rg_patient.tgl_lahir as tgl_lahir',
                'smis_rg_patient.kelamin as kelamin',
                'smis_rg_patient.agama as agama',
                'smis_rg_patient.pendidikan as pendidikan',
                'smis_rg_patient.pekerjaan as pekerjaan',
                'smis_rg_patient.status as status',
                'smis_rg_patient.alamat as alamat',
                'smis_rg_patient.rt as rt',
                'smis_rg_patient.rw as rw',
                'smis_rg_patient.nama_kelurahan as kelurahan',
                'smis_rg_patient.nama_kecamatan as kecamatan',
                'smis_rg_patient.nama_kabupaten as kabupaten',
                'smis_rg_patient.nama_provinsi as provinsi',
                'smis_rg_patient.nama_kedusunan as dusun',
                'smis_rg_patient.telpon as telpon',
                'smis_rg_patient.suami as suami',
                'smis_rg_patient.istri as istri',
                'smis_rg_patient.ayah as ayah',
                'smis_rg_patient.ibu as ibu',
                'smis_rg_patient.telepon_keluarga as telepon_keluarga',
                'smis_rg_layananpasien.carabayar as carabayar',
                'smis_rg_asuransi.nama as asuransi',
            )
            ->where('smis_rg_patient.id', $nrm)
            ->orderBy('smis_rg_layananpasien.id', 'asc')->first();
    }
}
