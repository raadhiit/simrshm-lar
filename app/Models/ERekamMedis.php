<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ERekamMedis extends Model
{
    use HasFactory;

    protected $table = 'e_rekam_medis_pasien';

    protected $guarded = ['id'];
}
