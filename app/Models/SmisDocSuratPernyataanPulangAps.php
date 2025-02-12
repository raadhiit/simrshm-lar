<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class SmisDocSuratPernyataanPulangAps extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'smis_doc_surat_pernyataan_pulang_aps';

    public function getTanggalAttribute($value) {
        return Carbon::parse($value)->toISOString();
    }
}
