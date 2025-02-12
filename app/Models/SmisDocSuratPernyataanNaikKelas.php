<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmisDocSuratPernyataanNaikKelas extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'smis_doc_surat_pernyataan_naik_kelas';
}
