<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmisDocPenolakanRawatInap extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'smis_doc_penolakan_rawat_inap';
}
