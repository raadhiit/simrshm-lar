<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Smis_Doc_Asesmen_Awal_Kebidanan_Ranap extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $table = 'smis_doc_asesmen_awal_kebidanan_rawat_inap';
}
