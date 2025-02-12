<?php

namespace App\Models\DokumenKunjungan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Smis_Doc_Skrining_Gizi_Rawat_Inap extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'smis_doc_skrining_gizi_rawat_inap';
}
