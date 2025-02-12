<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SatuSehatLocation extends Model
{
    use HasFactory;

    protected $table = 'smis_ss_lokasi';

    protected $guarded = ['id'];
}
