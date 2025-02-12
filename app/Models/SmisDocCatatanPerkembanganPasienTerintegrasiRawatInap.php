<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmisDocCatatanPerkembanganPasienTerintegrasiRawatInap extends Model
{
    use HasFactory;

    protected $table = 'smis_doc_catatan_perkembangan_pasien_terintegrasi_rawat_inap';

    protected $guarded = ['id'];

    function ttv(){
        return $this->hasOne('App\Models\Smis_Mr_Tanda_Vital', 'id', 'id_ttv')->where('prop','');
    }

    function diagnosa(){
        return $this->hasOne('App\Models\SMIS_Diagnosa', 'id', 'id_diagnosa')->where('prop','');
    }

    function lab(){
        return $this->hasOne('App\Models\SMIS_LabPesanan', 'id', 'id_lab')->where('prop','');
    }

    function rad(){
        return $this->hasOne('App\Models\Smis_Rad_Pesanan', 'id', 'id_rad')->where('prop','');
    }

    function resep(){
        return $this->hasOne('App\Models\SMIS_Er_Resep', 'id', 'id_resep')->where('prop','');
    }
}
