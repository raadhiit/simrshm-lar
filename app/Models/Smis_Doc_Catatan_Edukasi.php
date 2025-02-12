<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Smis_Doc_Catatan_Edukasi extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $table = 'smis_doc_catatan_edukasi_pasien';
}
