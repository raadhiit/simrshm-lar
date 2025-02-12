<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmisDocAsesmentMedisAwalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('smis_doc_asesment_medis_awal', function (Blueprint $table) {
            $table->id();
            $table->integer('id_dokumen')->unsigned();
            $table->string('keluhan_utama');
            $table->string('riwayat_penyakit_sekarang');
            $table->string('riwayat_penyakit_dahulu');
            $table->string('riwayat_alergi_obat');
            $table->string('kesadaran');
            $table->string('ket_sopor_koma');
            $table->string('kesadaran_umum');
            $table->string('berat_badan');
            $table->string('saudara');
            $table->string('ket_kandung');
            $table->string('ket_tiri');
            $table->string('tinggal_bersama');
            $table->string('ket_tinggal_lainnya');
            $table->string('bicara');
            $table->string('komunikasi');
            $table->string('emosional');
            $table->string('gangguan_jiwa');
            $table->string('tahun_gangguan_jiwa');
            $table->string('riwayat_trauma');
            $table->string('ket_kriminal');
            $table->string('perasaan');
            $table->string('wawancara');
            $table->string('spiritual');
            $table->string('kebutuhan_spiritual');
            $table->string('agama_spiritual');
            $table->string('bantuan_ibadah');
            $table->string('status_pernikahan');
            $table->string('pekerjaan');
            $table->string('pekerjaan_lain_lain');
            $table->string('nyeri');
            $table->string('sifat_nyeri');
            $table->string('kualitas_nyeri');
            $table->string('nyeri_menjalar');
            $table->string('ket_nyeri_menjalar');
            $table->string('skor_nyeri');
            $table->string('frekuensi_nyeri');
            $table->string('pengaruh_nyeri');
            $table->string('cara_berjalan');
            $table->string('memegang_kursi');
            $table->string('hasil_resiko_jatuh');
            $table->string('beritahu_dokter');
            $table->string('jam_diberitahukan');
            $table->text('hasil_skrining_resiko_jatuh');
            $table->text('saran_resiko_jatuh');
            $table->string('bb_gizi');
            $table->string('pb_gizi');
            $table->string('imt_gizi');
            $table->string('tampak_kurus');
            $table->string('penurunan_bb');
            $table->string('asupan_makanan');
            $table->text('hasil_skrining_gizi');
            $table->text('saran_skrining_gizi');
            $table->string('sensorik_penglihatan');
            $table->string('sensorik_penciuman');
            $table->string('sensorik_pendengaran');
            $table->string('kognitif_satu');
            $table->string('kognitif_dua');
            $table->string('motorik_satu');
            $table->string('motorik_dua');
            $table->string('saran_satu');
            $table->string('saran_dua');
            $table->string('saran_tiga');
            $table->text('hasil_discharge_planning');
            $table->text('saran_discharge_planning');
            $table->text('pemeriksaan_penunjang');
            $table->text('status_generalis');
            $table->string('kontrol_ulang');
            $table->string('tgl_kontrol_ulang');
            $table->string('rujuk');
            $table->string('tgl_rujuk');
            $table->string('penyampaian_edukasi');
            $table->integer('id_ppa');
            $table->string('ppa', 64);
            $table->text('subyektif');
            $table->text('instruksi_kesehatan');
            $table->text('nama_obat_1')->nullable();
            $table->text('jumlah_obat_1')->nullable();
            $table->text('aturan_pakai_obat_1')->nullable();
            $table->text('tanggal_mulai_minum_obat_1')->nullable();
            $table->text('keterangan_obat_1')->nullable();
            $table->text('nama_obat_2')->nullable();
            $table->text('jumlah_obat_2')->nullable();
            $table->text('aturan_pakai_obat_2')->nullable();
            $table->text('tanggal_mulai_minum_obat_2')->nullable();
            $table->text('keterangan_obat_2')->nullable();
            $table->text('nama_obat_3')->nullable();
            $table->text('jumlah_obat_3')->nullable();
            $table->text('aturan_pakai_obat_3')->nullable();
            $table->text('tanggal_mulai_minum_obat_3')->nullable();
            $table->text('keterangan_obat_3')->nullable();
            $table->text('nama_obat_4')->nullable();
            $table->text('jumlah_obat_4')->nullable();
            $table->text('aturan_pakai_obat_4')->nullable();
            $table->text('tanggal_mulai_minum_obat_4')->nullable();
            $table->text('keterangan_obat_4')->nullable();
            $table->text('nama_obat_5')->nullable();
            $table->text('jumlah_obat_5')->nullable();
            $table->text('aturan_pakai_obat_5')->nullable();
            $table->text('tanggal_mulai_minum_obat_5')->nullable();
            $table->text('keterangan_obat_5')->nullable();
            $table->text('nama_obat_6')->nullable();
            $table->text('jumlah_obat_6')->nullable();
            $table->text('aturan_pakai_obat_6')->nullable();
            $table->text('tanggal_mulai_minum_obat_6')->nullable();
            $table->text('keterangan_obat_6')->nullable();
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
        Schema::dropIfExists('smis_doc_asesment_medis_awal');
    }
}
