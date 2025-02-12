<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    protected $table = 'smis_fr_obat_masuk';

    function bayar(){
        return $this->hasMany(Bayar::class,'id_opl');
    }
}
