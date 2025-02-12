<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SMIS_LayananPasien extends Model
{
    use HasFactory;

    protected $table = 'smis_rg_layananpasien';

    public $incrementing = false;

    protected $keyType = 'string';

    function diagnosa(){
        return $this->hasOne('App\Models\SMIS_Diagnosa', 'noreg_pasien', 'id')->where('prop','')->orderBy('id', 'desc');
    }

    function laborat(){
        return $this->hasOne('App\Models\SMIS_LabPesanan', 'noreg_pasien', 'origin_id');
    }

    function hpp(){
        return $this->hasMany('App\Models\KSR_Kolektif', 'noreg_pasien', 'id')->where('prop', '');
    }

   function tanda_vital(){
       return $this->hasOne('App\Models\Smis_Mr_Tanda_Vital', 'noreg_pasien', 'id');
   }

    function pesanan_lab(){
        return $this->hasMany('App\Models\SMIS_LabPesanan', 'noreg_pasien', 'id')->where('prop','')->orderBy('id', 'asc');
    }

    function pesanan_radiologi(){
        return $this->hasMany('App\Models\Smis_Rad_Pesanan', 'noreg_pasien', 'id')->where('prop','')->orderBy('id', 'asc');
    }

    function resep(){
        return $this->hasOne('App\Models\SMIS_Er_Resep', 'noreg_pasien', 'id')->where('prop','');
    }

    function rg_asuransi(){
        return $this->hasOne('App\Models\SMIS_Rg_Asuransi', 'id', 'asuransi');
    }

    function perusahaan(){
        return $this->hasOne('App\Models\SMIS_Rg_Perusahaan', 'id', 'nama_perusahaan');
    }
}
