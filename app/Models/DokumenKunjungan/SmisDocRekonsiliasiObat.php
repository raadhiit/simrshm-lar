<?php

namespace App\Models\DokumenKunjungan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmisDocRekonsiliasiObat extends Model
{
    use HasFactory;

    protected $table = 'smis_doc_rekonsiliasi_obat';

    protected $guarded = ['id'];
}
