<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Smis_Mr_Tanda_Vital extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'smis_mr_tanda_vital';
    protected $fillable = ['prop', 'profile_number', 'waktu', 'spo2', 'ruangan', 'noreg_pasien', 'nrm_pasien', 'nama_pasien', 'keadaan_umum', 'berat_badan', 'tensi', 'nadi', 'rr', 'suhu', 'tinggi_badan', 'kesadaran', 'status_gizi'];
}
