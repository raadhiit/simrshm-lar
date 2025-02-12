<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmisDocObservasiCairan extends Model
{
    use HasFactory;

    protected $table = 'smis_doc_observasi_cairan';

    protected $fillable = [
        'id_dokumen',
        'tanggal_pelaksanaan',
        'pagi',
        'sore',
        'malam',
        'cairan_masuk',
        'cairan_keluar',
        'diuresis_24_jam',
        'iwl_24_jam',
        'balance_cairan',
        'status',
        'id_verifikator',
        'nama_verifikator',
    ];

    protected $casts = [
        'pagi' => 'array',
        'sore' => 'array',
        'malam' => 'array',
        'status' => 'boolean',
        'tanggal_pelaksanaan' => 'date',
    ];

    protected $with = ['verifikator.hrd_employee'];

    public function verifikator()
    {
        return $this->belongsTo(User::class, 'id_verifikator', 'id');
    }
}
