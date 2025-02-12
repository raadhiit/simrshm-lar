<?php

namespace App\Models\DokumenKunjungan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Smis_Doc_Daftar_Pemberian_Obat extends Model
{
    use HasFactory;

    protected $table = 'smis_doc_daftar_pemberian_obat';

    protected $guarded = ['id'];
}
