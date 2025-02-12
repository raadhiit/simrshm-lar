<?php

namespace App\Models\DokumenKunjungan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Smis_Doc_Survei_Infeksi_Rumah_Sakit extends Model
{
    use HasFactory;

    protected $table = 'smis_doc_survei_infeksi_rumah_sakit';

    protected $guarded = ['id'];
}
