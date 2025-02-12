<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmisDocSuratPernyataanPenitipanKelas extends Model
{
    use HasFactory;

    CONST CHOICES_HUBUNGAN = [
        'pasien', 'keluarga', 'bapak', 'ibu', 'suami', 'istri', 'anak'
    ];

    protected $guarded = ['id'];
    protected $table = 'smis_doc_surat_pernyataan_penitipan_kelas';
}
