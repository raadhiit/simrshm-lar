<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferensiDokter extends Model
{
    use HasFactory;

    protected $table = 'referensi_dokter';

    protected $fillable = ['kode_dokter','nama_dokter'];
}
