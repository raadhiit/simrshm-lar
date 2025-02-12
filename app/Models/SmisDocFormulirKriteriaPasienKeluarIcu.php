<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmisDocFormulirKriteriaPasienKeluarIcu extends Model
{
    use HasFactory;

    protected $table = 'smis_doc_formulir_kriteria_pasien_keluar_icus';
    public $increment = false;

    protected $fillable = [
        'id',
        'id_dokumen',
        'id_ttv',
        'ruangan',
        'diagnosa',
        'tanggal',
        'no1',
        'no2',
        'no3',
        'no4',
        'etcNo1',
        'etcNo4',
        'status',
        'id_dokter_yang_merawat',
        'id_dokter_konsulant_icu',
        'id_verifikator',
        'nama_verifikator',
    ];
    protected $casts = [
        'status' => 'boolean',
        'diagnosa' => 'string',
        'tanggal' => 'date',
        'no1' => 'boolean',
        'no2' => 'boolean',
        'no3' => 'boolean',
        'no4' => 'boolean',
        'etcNo1' => 'array',
        'etcNo4' => 'string',
    ];
    public $with = ['user_verifikator.hrd_employee','dokter_yang_merawat','dokter_konsulant_icu'];

    public function user_verifikator()
    {
        return $this->belongsTo(User::class, 'id_verifikator', 'id');
    }
    public function dokumen_kunjungan()
    {
        return $this->hasOne(DokumenKunjungan::class, 'id', 'id');
    }

    public function dokter_yang_merawat()
    {
        return $this->belongsTo(SmisHrdEmployee::class, 'id_dokter_yang_merawat', 'id')->select('id', 'nama', 'ttd');
    }

    public function dokter_konsulant_icu()
    {
        return $this->belongsTo(SmisHrdEmployee::class, 'id_dokter_konsulant_icu', 'id')->select('id', 'nama', 'ttd');
    }
}
