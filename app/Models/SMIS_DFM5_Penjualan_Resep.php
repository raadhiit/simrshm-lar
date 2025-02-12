<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SMIS_DFM5_Penjualan_Resep extends Model
{
    use HasFactory;
    protected $table = 'smis_dfm5_penjualan_resep';

    function obat_jadi(){
        return $this->hasMany('App\Models\SMIS_DFM5_Penjualan_Obat_Jadi', 'id_penjualan_resep', 'id');
    }

    function obat_racik(){
        return $this->hasMany('App\Models\SMIS_DFM5_Penjualan_Obat_Racikan', 'id_penjualan_resep', 'id');
    }
}
