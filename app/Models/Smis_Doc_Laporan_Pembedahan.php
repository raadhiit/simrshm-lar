<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Smis_Doc_Laporan_Pembedahan extends Model
{
    use HasFactory;

    protected $table = 'smis_doc_laporan_pembedahan';

    protected $guarded = ['id'];
}
