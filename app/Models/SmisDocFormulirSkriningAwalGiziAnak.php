<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmisDocFormulirSkriningAwalGiziAnak extends Model
{
    use HasFactory;

    protected $table = 'smis_doc_formulir_skrining_awal_gizi_anaks';

    protected $guarded = ['id'];
}
