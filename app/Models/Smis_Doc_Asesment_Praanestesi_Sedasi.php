<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Smis_Doc_Asesment_Praanestesi_Sedasi extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $casts = [
        'sosial' => 'array',
        'kebiasaan' => 'array',
        'pengobatan' => 'array',
        'riwayat_keluarga' => 'array',
        'riwayat_penyakit' => 'array',
        'pasien_perempuan' => 'array',
        'pemeriksaan_penunjang' => 'array',
        'asesmen_dokter_anestesi' => 'array',
    ];

    protected $table = 'assesment_pra_anestesi_sedasi';

    public $with = ['user_verifikator.hrd_employee'];

    public function user_verifikator()
    {
        return $this->belongsTo(User::class, 'verifikator', 'username');
    }

    public function user_operator()
    {
        return $this->belongsTo(User::class, 'operator', 'id');
    }
}
