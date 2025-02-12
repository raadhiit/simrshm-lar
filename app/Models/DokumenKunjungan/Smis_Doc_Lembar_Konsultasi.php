<?php

namespace App\Models\DokumenKunjungan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Smis_Doc_Lembar_Konsultasi extends Model
{
    use HasFactory;

    protected $table = 'smis_doc_lembar_konsultasi';

    protected $guarded = ['id'];
}
