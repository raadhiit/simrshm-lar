<?php

namespace App\Models\DokumenKunjungan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Smis_Doc_Bukti_Pendaftaran_Rawat_Jalan extends Model
{
    use HasFactory;

    protected $table = 'smis_doc_bukti_pendaftaran_rawat_jalan';

    protected $guarded = ['id'];
}
