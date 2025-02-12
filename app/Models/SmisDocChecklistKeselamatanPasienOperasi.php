<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmisDocChecklistKeselamatanPasienOperasi extends Model
{
    use HasFactory;

    protected $table = 'smis_doc_checklist_keselamatan_pasien_operasi';
    protected $fillable = [
        'id_dokumen',
        'tanggal',
        'sign_in_jam',
        'sign_in_checklist',
        'sign_in_status_perawat_sirkuler',
        'sign_in_id_perawat_sirkuler',
        'sign_in_nama_perawat_sirkuler',
        'sign_in_status_dokter_anastesi',
        'sign_in_id_dokter_anastesi',
        'sign_in_nama_dokter_anastesi',
        'time_out_jam',
        'time_out_checklist',
        'time_out_status_perawat_sirkuler',
        'time_out_id_perawat_sirkuler',
        'time_out_nama_perawat_sirkuler',
        'time_out_status_perawat_instrumen',
        'time_out_id_perawat_instrumen',
        'time_out_nama_perawat_instrumen',
        'sign_out_jam',
        'sign_out_checklist',
        'sign_out_status_dokter_bedah',
        'sign_out_id_dokter_bedah',
        'sign_out_nama_dokter_bedah',
        'sign_out_status_dokter_anastesi',
        'sign_out_id_dokter_anastesi',
        'sign_out_nama_dokter_anastesi',
    ];
    protected $casts = [
        "tanggal" => "date",
        "sign_in_jam" => "datetime",
        "sign_in_checklist" => "array",
        "sign_in_status_perawat_sirkuler" => "boolean",
        "sign_in_status_dokter_anastesi" => "boolean",
        "time_out_jam" => "datetime",
        "time_out_checklist" => "array",
        "time_out_status_perawat_sirkuler" => "boolean",
        "time_out_status_perawat_instrumen" => "boolean",
        "sign_out_jam" => "datetime",
        "sign_out_checklist" => "array",
        "sign_out_status_dokter_bedah" => "boolean",
        "sign_out_status_dokter_anastesi" => "boolean",
    ];

    protected $with = [
        'sign_in_perawat_sirkuler.hrd_employee',
        'sign_in_dokter_anastesi.hrd_employee',
        'time_out_perawat_sirkuler.hrd_employee',
        'time_out_perawat_instrumen.hrd_employee',
        'sign_out_dokter_bedah.hrd_employee',
        'sign_out_dokter_anastesi.hrd_employee',
    ];

    public function sign_in_perawat_sirkuler()
    {
        return $this->belongsTo(User::class, 'sign_in_id_perawat_sirkuler', 'id');
    }

    public function sign_in_dokter_anastesi()
    {
        return $this->belongsTo(User::class, 'sign_in_id_dokter_anastesi', 'id');
    }

    public function time_out_perawat_sirkuler()
    {
        return $this->belongsTo(User::class, 'time_out_id_perawat_sirkuler', 'id');
    }

    public function time_out_perawat_instrumen()
    {
        return $this->belongsTo(User::class, 'time_out_id_perawat_instrumen', 'id');
    }

    public function sign_out_dokter_bedah()
    {
        return $this->belongsTo(User::class, 'sign_out_id_dokter_bedah', 'id');
    }

    public function sign_out_dokter_anastesi()
    {
        return $this->belongsTo(User::class, 'sign_out_id_dokter_anastesi', 'id');
    }

    public function getChecklistValue($column, $label)
    {
        $result = null;
        $checklist = $this->getAttribute($column);
        if (is_array($checklist) && count($checklist) > 0) {
            foreach ($checklist as $key => $value) {
                if (is_array($value)) {
                    foreach ($value as $subkey => $subvalue) {
                        if ($subkey == $label) $result = $subvalue;
                    }
                } else {
                    if ($key == $label) $result = $value;
                }
            }
        }
        return $result;
    }
}
