<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmisDocRenpra extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'tanggal' => 'datetime',
        'diagnosa_keperawatan' => 'array',
        'do' => 'array',
        'ds' => 'array',
        'noc' => 'array',
        'kriteria_hasil' => 'array',
        'intervensi' => 'array',
        'jam' => 'datetime',
        'status' => 'boolean',
    ];

    public $with = ['user_verifikator.hrd_employee'];

    public function user_verifikator()
    {
        return $this->belongsTo(User::class, 'verifikator', 'username');
    }

    public static function renpra()
    {
        return [
            [
                'name' => 'Perfusi Jaringan Renal Tidak Efektif',
                'view' => 'erm.rawat_inap.renpra.perfusi_jaringan_renal_tidak_efektif',
            ],
            [
                'name' => 'Perfusi Jaringan Kardiopulmonal Tidak Efektif',
                'view' => 'erm.rawat_inap.renpra.perfusi_jaringan_kardiopulmonal_tidak_efektif',
            ],
            [
                'name' => 'Perfusi Jaringan Gastrointestinal Tidak Efektif',
                'view' => 'erm.rawat_inap.renpra.perfusi_jaringan_gastrointestinal_tidak_efektif',
            ],
            [
                'name' => 'Perfusi Jaringan Cerebral Tidak Efektif',
                'view' => 'erm.rawat_inap.renpra.perfusi_jaringan_cerebral_tidak_efektif',
            ],
            [
                'name' => 'Penurunan Curah Jantung',
                'view' => 'erm.rawat_inap.renpra.penurunan_curah_jantung',
            ],
            [
                'name' => 'Nyeri Kronis',
                'view' => 'erm.rawat_inap.renpra.nyeri_kronis',
            ],
            [
                'name' => 'Nyeri Akut',
                'view' => 'erm.rawat_inap.renpra.nyeri_akut',
            ],
            [
                'name' => 'Mual',
                'view' => 'erm.rawat_inap.renpra.mual',
            ],
            [
                'name' => 'Resiko Aspirasi',
                'view' => 'erm.rawat_inap.renpra.resiko_aspirasi',
            ],
            [
                'name' => 'Risiko Gangguan Integritas Kulit',
                'view' => 'erm.rawat_inap.renpra.resiko_gangguan_integritas_kulit',
            ],
            [
                'name' => 'Risiko Infeksi',
                'view' => 'erm.rawat_inap.renpra.resiko_infeksi',
            ],
            [
                'name' => 'Risiko Injury',
                'view' => 'erm.rawat_inap.renpra.resiko_injury',
            ],
            [
                'name' => 'Risiko Trauma',
                'view' => 'erm.rawat_inap.renpra.resiko_trauma',
            ],
            [
                'name' => 'Risiko Urine',
                'view' => 'erm.rawat_inap.renpra.resiko_urine',
            ],
            [
                'name' => 'Takut',
                'view' => 'erm.rawat_inap.renpra.resiko_takut',
            ],
            [
                'name' => 'Hipotermia',
                'view' => 'erm.rawat_inap.renpra.hipotermia',
            ],
            [
                'name' => 'Hipertermia',
                'view' => 'erm.rawat_inap.renpra.hipertermia',
            ],
            [
                'name' => 'Bersihan Jalan Nafas',
                'view' => 'erm.rawat_inap.renpra.bersihan_jalan_nafas',
            ],
            [
                'name' => 'Defisit Perawatan Diri',
                'view' => 'erm.rawat_inap.renpra.defisit_perawatan_diri',
            ],
            [
                'name' => 'Defisit Volume Cairan',
                'view' => 'erm.rawat_inap.renpra.defisit_volume_cairan',
            ],
            [
                'name' => 'Diare',
                'view' => 'erm.rawat_inap.renpra.diare',
            ],
            [
                'name' => 'Gangguan Body Image',
                'view' => 'erm.rawat_inap.renpra.gangguan_body_image',
            ],
            [
                'name' => 'Gangguan Mobilitas Fisik',
                'view' => 'erm.rawat_inap.renpra.gangguan_mobilitas_fisik',
            ],
            [
                'name' => 'Gangguan Pertukaran Gas',
                'view' => 'erm.rawat_inap.renpra.gangguan_pertukaran_gas',
            ],
            [
                'name' => 'Gangguan Pola Tidur',
                'view' => 'erm.rawat_inap.renpra.gangguan_pola_tidur',
            ],
            [
                'name' => 'Intoleransi Aktivitas',
                'view' => 'erm.rawat_inap.renpra.intoleransi_aktifitas',
            ],
            [
                'name' => 'Kecemasan',
                'view' => 'erm.rawat_inap.renpra.kecemasan',
            ],
            [
                'name' => 'Kelebihan Volume Cairan',
                'view' => 'erm.rawat_inap.renpra.kelebihan_volume_cairan',
            ],
            [
                'name' => 'Kelelahan',
                'view' => 'erm.rawat_inap.renpra.kelelahan',
            ],
            [
                'name' => 'Kerusakan Integrasi Jaringan',
                'view' => 'erm.rawat_inap.renpra.kerusakan_integrasi_jaringan',
            ],
            [
                'name' => 'Ketidak Seimbangan Nutrisi Kurang Dari Kebutuhan Tubuh',
                'view' => 'erm.rawat_inap.renpra.kurang_nutrisi',
            ],
            [
                'name' => 'Ketidak Seimbangan Nutrisi Lebih Dari Kebutuhan Tubuh',
                'view' => 'erm.rawat_inap.renpra.kelebihan_nutrisi',
            ],
            [
                'name' => 'Kontipasi',
                'view' => 'erm.rawat_inap.renpra.kontipasi',
                'name' => 'Risiko Gangguan Integritas Kulit',
                'view' => 'erm.rawat_inap.renpra.resiko_gangguan_integritas_kulit',
            ],
            [
                'name' => 'Pra - Operasi',
                'view' => 'erm.rawat_inap.renpra.pra_operasi',
            ],
            [
                'name' => 'Post - Operasi',
                'view' => 'erm.rawat_inap.renpra.post_operasi',
            ],
            [
                'name' => 'Intra - Operasi',
                'view' => 'erm.rawat_inap.renpra.intra_operasi',
            ],
        ];
    }
}
