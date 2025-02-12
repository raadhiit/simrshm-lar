<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmisDocEarlyWarningScoringSystemDewasa extends Model
{
    use HasFactory;

    protected $table = 'smis_doc_early_warning_scoring_system_dewasa';

    protected $fillable = [
        'id_dokumen',
        'tanggal_jam',
        'respirasi',
        'saturasi_o2',
        'tekanan_darah_sistolik',
        'hr',
        'kesadaran',
        'temperatur',
        'parameter_tambahan',
        'status',
        'id_pemeriksa',
        'nama_pemeriksa',
    ];

    protected $casts = [
        'status' => 'boolean',
        'tanggal_jam' => 'datetime',
        'respirasi' => 'array',
        'saturasi_o2' => 'array',
        'tekanan_darah_sistolik' => 'array',
        'hr' => 'array',
        'kesadaran' => 'array',
        'temperatur' => 'array',
        'parameter_tambahan' => 'array',
    ];

    protected $with = ['pemeriksa.hrd_employee'];

    public function pemeriksa()
    {
        return $this->belongsTo(User::class, 'id_pemeriksa', 'id');
    }
}
