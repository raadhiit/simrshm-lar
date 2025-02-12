<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Smis_Doc_Resume_Medis_Pasien_Pulang extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $table = 'smis_doc_resume_medis_pasien_pulang';
}
