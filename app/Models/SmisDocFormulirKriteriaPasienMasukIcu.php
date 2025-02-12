<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmisDocFormulirKriteriaPasienMasukIcu extends Model
{
    use HasFactory;

    protected $table = 'smis_doc_formulir_kriteria_pasien_masuk_icus';
    public $increment = false;

    protected $fillable = [
        'id',
        'id_dokumen',
        'id_ttv',
        'ruangan',
        'diagnosa',
        'tanggal',
        'prioritas1',
        'prioritas2',
        'prioritas3',
        'prioritas4',
        'etc',
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
        'prioritas1' => 'array',
        'prioritas2' => 'boolean',
        'prioritas3' => 'boolean',
        'prioritas4' => 'array',
        'etc' => 'array',
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
