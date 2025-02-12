<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Smis_Doc_Surat_Keterangan_Kematian extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $table = 'smis_doc_surat_keterangan_kematian';
}
