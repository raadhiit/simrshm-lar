<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SatuSehatLocationReference extends Model
{
    use HasFactory;

    protected $table = 'smis_ss_referensi_lokasi';

    protected $guarded = ['id'];
}
