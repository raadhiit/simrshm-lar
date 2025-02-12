<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmisDocFormulirAsesmenAwalPasienRanapDewasa2Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('smis_doc_formulir_asesmen_awal_pasien_ranap_dewasa2', function (Blueprint $table) {
            $table->id();
            $table->integer('id_dokumen')->unsigned();
            $table->string('tgl_pengkajian_keperawatan', 64)->nullable();
            $table->string('jam_pengkajian_keperawatan', 64)->nullable();
            $table->string('diperoleh_dari', 120)->nullable();
            $table->string('keluhan_utama')->nullable();
            $table->string('riwayat_penyakit_sekarang')->nullable();
            $table->string('riwayat_penyakit_dahulu')->nullable();
            $table->string('ket_riwayat_penyakit_keluarga', 100)->nullable();
            $table->string('riwayat_penggunaan_obat')->nullable();
            $table->string('ket_riwayat_penggunaan_obat', 100)->nullable();
            $table->string('riwayat_alergi')->nullable();
            $table->string('ket_riwayat_alergi', 100)->nullable();
            $table->string('riwayat_transfusi')->nullable();
            $table->string('riwayat_timbul_reaksi')->nullable();
            $table->string('ket_riwayat_transfusi', 100)->nullable();
            $table->string('ket_riwayat_timbul_reaksi', 100)->nullable();
            $table->string('riwayat_kemoterapi')->nullable();
            $table->string('ket_riwayat_kemoterapi', 100)->nullable();
            $table->string('berapa_kali_riwayat_kemoterapi', 64)->nullable();
            $table->string('riwayat_radioterapi')->nullable();
            $table->string('ket_riwayat_radioterapi', 100)->nullable();
            $table->string('berapa_kali_riwayat_radioterapi', 64)->nullable();
            $table->string('golongan_darah', 10)->nullable();
            $table->string('rh', 20)->nullable();
            $table->string('keadaan_umum', 64)->nullable();
            $table->string('kesadaran', 64)->nullable();
            $table->string('e_kesadaran', 100)->nullable();
            $table->string('m_kesadaran', 100)->nullable();
            $table->string('v_kesadaran', 100)->nullable();
            $table->text('persistem')->nullable();
            $table->string('ket_kepala', 120)->nullable();
            $table->string('ket_ubun_ubun', 120)->nullable();
            $table->string('ket_wajah', 120)->nullable();
            $table->string('ket_leher', 120)->nullable();
            $table->string('ket_kejang', 120)->nullable();
            $table->string('ket_kelopak_mata', 120)->nullable();
            $table->string('ket_konjungtiva', 120)->nullable();
            $table->string('ket_seklera', 120)->nullable();
            $table->string('ket_sistem_pendengaran', 120)->nullable();
            $table->string('ket_sistem_penciuman', 120)->nullable();
            $table->string('ket_jenis_pernapasan', 120)->nullable();
            $table->string('detail_kesulitan_bernapas', 120)->nullable();
            $table->string('ket_detail_kesulitan_bernapas', 120)->nullable();
            $table->string('detail_batuk', 120)->nullable();
            $table->string('ket_warna_kulit', 120)->nullable();
            $table->string('ket_nyeri_dada', 120)->nullable();
            $table->string('ket_sirkulasi', 120)->nullable();
            $table->string('ket_pulsasi', 120)->nullable();
            $table->string('ket_mulut', 120)->nullable();
            $table->string('ket_gigi', 120)->nullable();
            $table->string('ket_lidah', 120)->nullable();
            $table->string('ket_apus', 120)->nullable();
            $table->string('ket_kebersihan', 120)->nullable();
            $table->string('ket_kelainan', 120)->nullable();
            $table->string('ket_bak', 120)->nullable();
            $table->string('umur_menarche', 100)->nullable();
            $table->string('siklus_haid_menarche', 100)->nullable();
            $table->string('lama_haid_menarche', 100)->nullable();
            $table->string('hpht_menarche', 100)->nullable();
            $table->string('ket_gangguan_haid', 100)->nullable();
            $table->string('ket_alat_kontrasepsi', 100)->nullable();
            $table->string('tfu', 100)->nullable();
            $table->string('ket_dekubituas', 100)->nullable();
            $table->string('ket_nyeri_sendi', 100)->nullable();
            $table->string('ket_oedema', 100)->nullable();
            $table->string('ket_fraktur', 100)->nullable();
            $table->string('ket_parese', 100)->nullable();

            $table->text('kualifikasi_nyeri')->nullable();
            $table->string('ket_nyeri_menjalar', 120)->nullable();
            $table->string('skor_nyeri', 10)->nullable();
            $table->text('pola_kehidupan')->nullable();

            $table->string('pola_nutrisi_sebelum_sakit')->nullable();
            $table->string('frekuensi_makan_sebelum_sakit')->nullable();
            $table->string('jenis_makan_sebelum_sakit')->nullable();
            $table->string('porsi_makan_sebelum_sakit')->nullable();
            $table->string('lama_tidur_sebelum_sakit')->nullable();
            $table->string('bak_sebelum_sakit')->nullable();
            $table->string('kelinan_bak_sebelum_sakit')->nullable();
            $table->string('warna_bak_sebelum_sakit')->nullable();
            $table->string('bab_sebelum_sakit')->nullable();
            $table->string('kelinan_bab_sebelum_sakit')->nullable();
            $table->string('warna_bab_sebelum_sakit')->nullable();
            $table->string('konsistensi_bab_sebelum_sakit')->nullable();
            $table->string('konstipasi_bab_sebelum_sakit')->nullable();
            $table->string('ket_bab_sebelum_sakit')->nullable();
            $table->string('pola_nutrisi_saat_sakit')->nullable();
            $table->string('frekuensi_makan_saat_sakit')->nullable();
            $table->string('jenis_makan_saat_sakit')->nullable();
            $table->string('porsi_makan_saat_sakit')->nullable();
            $table->string('bak_saat_sakit')->nullable();
            $table->string('kelinan_bak_saat_sakit')->nullable();
            $table->string('warna_bak_saat_sakit')->nullable();
            $table->string('bab_saat_sakit')->nullable();
            $table->string('kelinan_bab_saat_sakit')->nullable();
            $table->string('warna_bab_saat_sakit')->nullable();
            $table->string('konsistensi_bab_saat_sakit')->nullable();
            $table->string('konstipasi_bab_saat_sakit')->nullable();
            $table->string('ket_bab_saat_sakit')->nullable();
            
            $table->string('jumlah_riwayat_merokok_sebelum_sakit', 100)->nullable();
            $table->string('lamanya_riwayat_merokok_sebelum_sakit', 100)->nullable();
            $table->string('jenis_riwayat_miras_sebelum_sakit', 100)->nullable();
            $table->string('jumlah_riwayat_miras_sebelum_sakit', 100)->nullable();
            $table->string('jenis_riwayat_obat_penenang_sebelum_sakit', 100)->nullable();
            $table->string('jumlah_riwayat_obat_penenang_sebelum_sakit', 100)->nullable();

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
        Schema::dropIfExists('smis_doc_formulir_asesmen_awal_pasien_ranap_dewasa2');
    }
}
