<?php

namespace App\Models\DokumenKunjungan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Smis_Doc_Lembar_Hasil_Tindakan_Uji_Fungsi extends Model
{
    use HasFactory;

    protected $table = 'smis_doc_lembar_hasil_tindakan_uji_fungsi';

    protected $guarded = ['id'];
}
