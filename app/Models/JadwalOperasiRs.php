<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalOperasiRs extends Model
{
    protected $table = "jadwal_operasi_rs";

    protected $guarded = ['id'];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
