<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bayar extends Model
{
    protected $table = 'smis_fnc_bayar';

    function barang(){
        return $this->belongsTo(Barang::class);
    }

    function obat(){
        return $this->belongsTo(Obat::class);
    }
}
