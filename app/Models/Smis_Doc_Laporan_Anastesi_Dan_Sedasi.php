<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Smis_Doc_Laporan_Anastesi_Dan_Sedasi extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $table = 'smis_doc_laporan_anastesi_dan_sedasi';
}
