<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CutiDokter extends Model
{
    use HasFactory;

    protected $table = "jadwal_cuti_dokters";
    protected $guarded = ['id'];

}
