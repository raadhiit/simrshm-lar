<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Smis_Doc_Observasi_Bayi extends Model
{
    use HasFactory;

    protected $table = 'smis_doc_observasi_bayi';

    protected $guarded = ['id'];
}
