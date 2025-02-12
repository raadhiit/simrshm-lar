<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Smis_Doc_Surat_Permintaan_Rawat_Inap extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $table = 'smis_doc_surat_permintaan_rawat_inap';
}
