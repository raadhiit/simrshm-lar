<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmisDocDaftarTilikPasienOperasi extends Model
{
    use HasFactory;

    protected $table = 'smis_doc_daftar_tilik_pasien_operasi';
    protected $fillable = [
        "id_dokumen",
        "tanggal",
        "asal_unit",
        "transfer_ke",
        "jam_transfer",
        "tindakan_operasi",
        "jam_rencana_operasi",
        "id_dokter_spesialis",
        "id_dokter_anestesi",
        "daftar_periksa",
        "pesan",
        "status",
        "id_pelaksana",
        "nama_pelaksana",
        "status_penerima",
        "id_penerima",
        "nama_penerima",
    ];
    protected $casts = [
        'status' => 'boolean',
        'tanggal' => 'date',
        'daftar_periksa' => 'array',
    ];
    protected $with = ['user_pelaksana.hrd_employee', 'user_penerima.hrd_employee', 'dokter_spesialis', 'dokter_anestesi'];

    public function user_pelaksana()
    {
        return $this->belongsTo(User::class, 'id_pelaksana', 'id');
    }

    public function user_penerima()
    {
        return $this->belongsTo(User::class, 'id_penerima', 'id');
    }

    public function dokumen_kunjungan()
    {
        return $this->hasOne(DokumenKunjungan::class, 'id', 'id');
    }

    public function dokter_spesialis()
    {
        return $this->belongsTo(SmisHrdEmployee::class, 'id_dokter_spesialis', 'id')->select('id', 'nama', 'ttd');
    }

    public function dokter_anestesi()
    {
        return $this->belongsTo(SmisHrdEmployee::class, 'id_dokter_anestesi', 'id')->select('id', 'nama', 'ttd');
    }
}
