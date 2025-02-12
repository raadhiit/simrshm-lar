<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmisDocPermintaanPemeriksaanPatologiAnatomi extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'smis_doc_permintaan_pemeriksaan_patologi_anatomi';
}
