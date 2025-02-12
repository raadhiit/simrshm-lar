<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferensiPoli extends Model
{
    use HasFactory;

    protected $table = 'referensi_poli';

    protected $fillable = ['kode_poli','nama_poli','kode_sub_spesialis','nama_sub_spesialis'];
}
