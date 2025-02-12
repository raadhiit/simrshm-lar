<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Smis_Doc_Persetujuan_Umum extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $table = 'smis_doc_persetujuan_umum';

    protected $fillable = ['id_dokumen','identitas','nomer_identitas','kebangsaan','suku',
        'nama_wali','hubungan_pasien', 'alamat_wali', 'telpon'];
}
