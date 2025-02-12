<?php

namespace App\Models\DokumenKunjungan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Smis_Doc_Persetujuan_Atau_Penolakan_Tindakan_Bedah extends Model
{
    use HasFactory;

    protected $table = 'smis_doc_persetujuan_atau_penolakan_tindakan_bedah';

    protected $guarded = ['id'];
}
