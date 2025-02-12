<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SMIS_DFM2_Penjualan_Obat_Racikan extends Model
{
    use HasFactory;
    protected $table = 'smis_dfm2_penjualan_obat_racikan';

    function bahan(){
        return $this->hasMany('App\Models\SMIS_DFM2_Bahan_Pakai_Obat_Racikan', 'id_penjualan_obat_racikan', 'id');
    }
}
