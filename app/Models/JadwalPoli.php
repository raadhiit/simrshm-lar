<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalPoli extends Model
{
    protected $table = "smis_rg_jadwal_poli";

    function antrian(){
        return $this->hasMany('App\Models\Antrian', 'jadwal_id');
    }

    function antrian_panggil(){
        return $this->hasOne('App\Models\Antrian', 'jadwal_id');
    }
}
