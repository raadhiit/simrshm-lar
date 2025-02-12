<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmisDocAssesmentPerioperatifMedis extends Model
{
    use HasFactory;

    protected $table = 'smis_doc_assesment_perioperatif_medis';
    protected $fillable = [
        'id_dokumen',
        'tanggal_jam_assesmen',
        'assesment_oleh',
        'assesment_dari',
        'asal_pasien',
        'asal_pasien_lain',
        'anamnesis',
        'pemeriksaan_fisik',
        'status_generalis',
        'pemeriksaan_penunjang_diagnostik',
        'diagnosis_pra_operasi',
        'rencana_tindakan_pengobatan',
        'tanggal_jam_selesai',
        'status',
        'id_verifikator',
        'nama_verifikator',
    ];
    protected $casts = [
        "tanggal_jam_assesmen" => "datetime",
        "anamnesis" => "array",
        "pemeriksaan_fisik" => "array",
        "tanggal_jam_selesai" => "datetime",
        "status" => "boolean",
    ];
}
