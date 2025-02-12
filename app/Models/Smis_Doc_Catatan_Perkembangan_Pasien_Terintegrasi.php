<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Smis_Doc_Catatan_Perkembangan_Pasien_Terintegrasi extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $table = 'smis_doc_catatan_perkembangan_pasien_terintegrasi';
}
