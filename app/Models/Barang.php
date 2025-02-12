<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'smis_gu_barang_masuk';

    function bayar(){
        return $this->hasMany(Bayar::class,'id_opl');
    }
}
