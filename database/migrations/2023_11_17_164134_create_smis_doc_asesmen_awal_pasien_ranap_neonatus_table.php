<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmisDocAsesmenAwalPasienRanapNeonatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('smis_doc_asesmen_awal_pasien_ranap_neonatus', function (Blueprint $table) {
            $table->id();
            $table->integer('id_dokumen');
            $table->integer('id_diagnosa');
            $table->integer('id_pesanan_lab');
            $table->integer('id_pesanan_rad');
            $table->integer('id_e_resep');
            $table->dateTime('tanggal_tiba')->nullable();
            $table->dateTime('tanggal_pengkajian')->nullable();
            $table->string('diperoleh_dari', 64)->default('');
            $table->string('hubungan_dengan_pasien', 64)->default('');
            $table->string('nama_perawat', 64)->default('');
            $table->text('keluhan_utama')->nullable();
            $table->text('riwayat_penyakit_sekarang')->nullable();
            $table->text('riwayat_penyakit_dahulu')->nullable();
            $table->string('riwayat_penyakit_keluarga', 32)->default('');
            $table->string('desc_riwayat_penyakit_keluarga', 128)->default('');
            $table->string('riwayat_penggunaan_obat', 32)->default('');
            $table->string('desc_riwayat_penggunaan_obat', 128)->default('');
            $table->text('list_penggunaan_obat')->nullable();
            $table->string('riwayat_alergi', 32)->default('');
            $table->string('desc_riwayat_alergi', 128)->default('');
            $table->string('keadaan_umum', 64)->default('');
            $table->string('kesadaran', 64)->default('');
            $table->string('gcs_e', 64)->default('');
            $table->string('gcs_m', 64)->default('');
            $table->string('gcs_v', 64)->default('');
            $table->string('td', 64)->default('');
            $table->string('suhu', 64)->default('');
            $table->string('nadi', 64)->default('');
            $table->string('rr', 64)->default('');
            $table->string('periksa_di', 64)->default('');
            $table->string('periksa_di_lain', 64)->default('');
            $table->string('penyakit_kehamilan', 32)->default('');
            $table->string('desc_penyakit_kehamilan', 64)->default('');
            $table->string('obat_obatan_dikonsumsi', 32)->default('');
            $table->string('desc_obat_obatan_dikonsumsi', 64)->default('');
            $table->string('lahir_di', 32)->default('');
            $table->string('ditolong', 32)->default('');
            $table->text('status_generalis')->nullable();
            $table->dateTime('tanggal_tiba_p')->nullable();
            $table->dateTime('tanggal_pengkajian_p')->nullable();
            $table->string('diperoleh_dari_p', 64)->default('');
            $table->string('hubungan_dengan_pasien_p', 64)->default('');
            $table->string('cara_masuk', 32)->default('');
            $table->string('asal_pasien', 64)->default('');
            $table->string('nama_pj', 64)->default('');
            $table->string('usia_pj', 64)->default('');
            $table->string('pekerjaan_pj', 64)->default('');
            $table->string('ayah', 64)->default('');
            $table->string('ibu', 64)->default('');
            $table->string('pekerjaan_ayah', 64)->default('');
            $table->string('pekerjaan_ibu', 64)->default('');
            $table->string('suku_ayah', 64)->default('');
            $table->string('suku_ibu', 64)->default('');
            $table->date('tgl_lahir_ayah')->nullable();
            $table->date('tgl_lahir_ibu')->nullable();
            $table->string('agama_ayah', 64)->default('');
            $table->string('agama_ibu', 64)->default('');
            $table->string('alamat_ayah', 64)->default('');
            $table->string('alamat_ibu', 64)->default('');
            $table->text('keluhan_utama_p')->nullable();
            $table->string('riwayat_obstetric_g', 32)->default('');
            $table->string('riwayat_obstetric_p', 32)->default('');
            $table->string('riwayat_obstetric_a', 32)->default('');
            $table->string('usia_gestasi', 32)->default('');
            $table->string('pernah_dirawat', 20)->default('');
            $table->string('indikasi_rawat', 32)->default('');
            $table->string('status_gizi_ibu', 10)->default('');
            $table->string('obat_obatan_yang_dikonsumsi_selama_hamil', 32)->default('');
            $table->string('desc_obat_dikonsumsi_selama_hamil', 32)->default('');
            $table->string('kebiasaan_ibu', 32)->default('');
            $table->string('kebiasaan_ibu_lain', 32)->default('');
            $table->string('riwayat_persalinan', 32)->default('');
            $table->string('ketuban', 32)->default('');
            $table->string('ketuban_lain', 32)->default('');
            $table->string('volume', 32)->default('');
            $table->string('apgar_score', 32)->default('');
            $table->string('bb_p', 32)->default('');
            $table->string('pb_p', 32)->default('');
            $table->string('lk', 32)->default('');
            $table->string('ld', 32)->default('');
            $table->string('lp', 32)->default('');
            $table->string('riwayat_penyakit_keluarga_p', 32)->default('');
            $table->string('desc_riwayat_penyakit_keluarga_p', 128)->default('');
            $table->string('riwayat_alergi_obat', 32)->default('');
            $table->string('desc_riwayat_alergi_obat', 128)->default('');
            $table->string('riwayat_transfusi_darah', 32)->default('');
            $table->string('desc_riwayat_transfusi_darah', 128)->default('');
            $table->string('timbul_reaksi', 32)->default(''); 
            $table->string('desc_timbul_reaksi', 128)->default('');
            $table->string('riwayat_imunisasi', 32)->default('');
            $table->string('desc_riwayat_imunisasi', 128)->default('');
            $table->string('keadaan_umum_p', 32)->default('');
            $table->string('kesadaran_p', 32)->default('');
            $table->string('gcs_e_p', 32)->default('');
            $table->string('gcs_m_p', 32)->default('');
            $table->string('gcs_v_p', 32)->default('');
            $table->string('td_p', 64)->default('');
            $table->string('s_p', 64)->default('');
            $table->string('n_p', 64)->default('');
            $table->string('rr_p', 64)->default('');
            $table->string('bb', 64)->default('');
            $table->string('tb', 64)->default('');
            $table->string('lingkar_kepala', 64)->default('');
            $table->string('lingkar_dada', 64)->default('');
            $table->string('lingkar_perut', 64)->default('');
            $table->string('goldar_bayi', 10)->default('');
            $table->string('rh_bayi', 10)->default('');
            $table->string('goldar_ibu', 10)->default('');
            $table->string('rh_ibu', 10)->default('');
            $table->string('goldar_ayah', 10)->default('');
            $table->string('rh_ayah', 10)->default('');
            $table->string('gerak_bayi', 32)->default('');
            $table->string('ubun_ubun', 32)->default('');
            $table->string('ubun_ubun_lain', 32)->default('');
            $table->string('kejang', 32)->default('');
            $table->string('desc_kejang', 32)->default('');
            $table->string('refleks', 32)->default('');
            $table->string('refleks_lain', 128)->default('');
            $table->string('tangis_bayi', 32)->default('');
            $table->string('tangis_bayi_lain', 32)->default('');
            $table->string('posisi_mata', 32)->default('');
            $table->string('pupil', 32)->default('');
            $table->string('kelopak_mata', 32)->default('');
            $table->string('kelopak_mata_lain', 32)->default('');
            $table->string('konjungtiva', 32)->default('');
            $table->string('konjungtiva_lain', 32)->default('');
            $table->string('sklera', 32)->default('');
            $table->string('sklera_lain', 32)->default('');
            $table->string('sistem_pendengaran', 64)->default('');
            $table->string('sistem_pendengaran_lain', 128)->default('');
            $table->string('sistem_penciuman', 64)->default('');
            $table->string('sistem_penciuman_lain', 128)->default('');
            $table->string('pola_napas', 32)->default('');
            $table->string('jenis_pernapasan', 32)->default('');
            $table->string('desc_jenis_pernapasan', 32)->default('');
            $table->string('irama_napas', 32)->default('');
            $table->string('retraksi', 32)->default('');
            $table->string('air_entri', 64)->default('');
            $table->string('merintih', 64)->default('');
            $table->string('suara_napas', 32)->default('');
            $table->string('warna_kulit', 32)->default('');
            $table->string('warna_kulit_lain', 32)->default('');
            $table->string('denyut_nadi', 32)->default('');
            $table->string('sirkulasi', 32)->default('');
            $table->string('crt', 32)->default('');
            $table->string('edema', 32)->default('');
            $table->string('pulsasi', 32)->default('');
            $table->string('pulsasi_lain', 32)->default('');
            $table->string('mulut', 64)->default('');
            $table->string('mulut_lain', 64)->default('');
            $table->string('gigi', 64)->default('');
            $table->string('gigi_lain', 32)->default('');
            $table->string('lidah', 64)->default('');
            $table->string('lidah_lain', 32)->default('');
            $table->string('oesofagus', 64)->default('');
            $table->string('oesofagus_lain', 64)->default('');
            $table->string('abdomen', 32)->default('');
            $table->string('abdomen_lain', 64)->default('');
            $table->string('bab', 32)->default('');
            $table->string('frekuensi_diare', 32)->default('');
            $table->dateTIme('meco_pertama')->nullable();
            $table->string('warna_bab', 32)->default('');
            $table->string('warna_bab_lain', 32)->default('');
            $table->string('bak', 32)->default('');
            $table->dateTime('bak_pertama')->nullable();
            $table->string('warna_bak', 32)->default('');
            $table->string('warna_bak_lain', 32)->default('');
            $table->string('sistem_reproduksi_l', 32)->default('');
            $table->string('sistem_reproduksi_l_lain', 128)->default('');
            $table->string('sistem_reproduksi_p', 32)->default('');
            $table->string('sistem_reproduksi_p_lain', 32)->default('');
            $table->string('vernic_kaseosa', 32)->default('');
            $table->string('vernic_kaseosa_lain', 32)->default('');
            $table->string('lanugo', 128)->default('');
            $table->string('warna_integumen', 32)->default('');
            $table->string('warna_integumen_lain', 32)->default('');
            $table->string('tugor', 32)->default('');
            $table->string('kulit', 32)->default('');
            $table->string('kriteria_resiko_dekubitus', 64)->default('');
            $table->string('lengan', 64)->default('');
            $table->string('lengan_lain', 64)->default('');
            $table->string('tungkai', 64)->default('');
            $table->string('tungkai_lain', 64)->default('');
            $table->string('rekoil_telinga', 32)->default('');
            $table->string('rekoil_telinga_lain', 32)->default('');
            $table->string('garis_telapak_kaki', 64)->default('');
            $table->string('nyeri', 32)->default('');
            $table->string('skor_nyeri', 64)->default('');
            $table->string('skala_nyeri', 64)->default('');
            $table->string('tipe', 64)->default('');
            $table->string('desc_tipe', 64)->default('');
            $table->string('frekuensi', 64)->default('');
            $table->string('lama_nyeri', 128)->default('');
            $table->string('lama_kehamilan', 32)->default('');
            $table->string('komplikasi', 32)->default('');
            $table->string('desc_komplikasi', 128)->default('');
            $table->string('masalah_neonatus', 32)->default('');
            $table->string('desc_masalah_neonatus', 128)->default('');
            $table->string('masalah_maternal', 32)->default('');
            $table->string('desc_masalah_maternal', 128)->default('');
            $table->string('bb_anak_saat_lahir', 128)->default('');
            $table->string('pb_anak_saat_lahir', 128)->default('');
            $table->string('asi_sampai_umur', 128)->default('');
            $table->string('susu_formula_dimulai', 128)->default('');
            $table->string('makanan_padat_dimulai', 128)->default('');
            $table->string('makanan_tambahan_mulai_umur', 128)->default('');
            $table->string('tengkurap', 128)->default('');
            $table->string('duduk', 128)->default('');
            $table->string('berdiri', 128)->default('');
            $table->string('berjalan', 128)->default('');
            $table->text('list_riwayat_imunisasi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
    }
}
