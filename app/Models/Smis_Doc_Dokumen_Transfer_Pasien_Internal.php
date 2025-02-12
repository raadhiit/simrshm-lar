<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Smis_Doc_Dokumen_Transfer_Pasien_Internal extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $table = 'smis_doc_dokumen_transfer_pasien_internal';
}
