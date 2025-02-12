<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmisDocDokumenAsesmentAwalMedisGawatDaruratTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('smis_doc_dokumen_asesment_awal_medis_gawat_darurat', function (Blueprint $table) {
            $table->id();
            $table->integer('id_dokumen')->unsigned();
            $table->string('tgl_kedatangan', 64)->nullable();
            $table->string('jam_kedatangan', 64)->nullable();
            $table->string('cara_masuk')->nullable();
            $table->string('asal_rujukan')->nullable();
            $table->string('cara_bayar')->nullable();
            $table->string('ket_bayar_lain')->nullable();
            $table->string('kondisi_pasien')->nullable();
            $table->string('ket_kondisi_lain')->nullable();
            $table->string('jenis_pelayanan')->nullable();
            $table->string('keluhan_utama')->nullable();
            $table->string('riwayat_penyakit_sekarang')->nullable();
            $table->string('riwayat_penyakit_dahulu')->nullable();
            $table->string('riwayat_penyakit_keluarga')->nullable();
            $table->string('ket_riwayat_penyakit_keluarga')->nullable();
            $table->string('riwayat_penggunaan_obat')->nullable();
            $table->string('ket_riwayat_penggunaan_obat')->nullable();
            $table->string('riwayat_alergi')->nullable();
            $table->string('ket_riwayat_alergi')->nullable();
            $table->string('keadaan_umum')->nullable();
            $table->string('kesadaran')->nullable();
            $table->string('e_kesadaran')->nullable();
            $table->string('m_kesadaran')->nullable();
            $table->string('v_kesadaran')->nullable();
            $table->text('status_generalis')->nullable();
            $table->string('nyeri')->nullable();
            $table->string('sifat_nyeri')->nullable();
            $table->string('kualitas_nyeri')->nullable();
            $table->string('nyeri_menjalar')->nullable();
            $table->string('ket_nyeri_menjalar')->nullable();
            $table->string('skor_nyeri')->nullable();
            $table->string('frekuensi_nyeri')->nullable();
            $table->string('pengaruh_nyeri')->nullable();
            $table->string('nilai_wajah', 64)->nullable();
            $table->string('nilai_kaki', 64)->nullable();
            $table->string('nilai_aktifitas', 64)->nullable();
            $table->string('nilai_menangis', 64)->nullable();
            $table->string('nilai_bersuara', 64)->nullable();
            $table->string('faktor_pencetus')->nullable();
            $table->string('kualitas')->nullable();
            $table->string('lokasi')->nullable();
            $table->string('skala_nyeri')->nullable();
            $table->string('lama_nyeri')->nullable();
            $table->string('jam_tindakan1')->nullable();
            $table->string('tindakan1')->nullable();
            $table->string('diberikan_oleh1')->nullable();
            $table->string('keterangan1')->nullable();
            $table->string('jam_tindakan2')->nullable();
            $table->string('tindakan2')->nullable();
            $table->string('diberikan_oleh2')->nullable();
            $table->string('keterangan2')->nullable();
            $table->string('jam_tindakan3')->nullable();
            $table->string('tindakan3')->nullable();
            $table->string('diberikan_oleh3')->nullable();
            $table->string('keterangan3')->nullable();
            $table->string('jam_tindakan4')->nullable();
            $table->string('tindakan4')->nullable();
            $table->string('diberikan_oleh4')->nullable();
            $table->string('keterangan4')->nullable();
            $table->string('jam_tindakan5')->nullable();
            $table->string('tindakan5')->nullable();
            $table->string('diberikan_oleh5')->nullable();
            $table->string('keterangan5')->nullable();
            $table->string('jam_tindakan6')->nullable();
            $table->string('tindakan6')->nullable();
            $table->string('diberikan_oleh6')->nullable();
            $table->string('keterangan6')->nullable();
            $table->string('konsultasi')->nullable();
            $table->text('indikasi_rawat_inap')->nullable();
            $table->string('pulang')->nullable();
            $table->string('kontrol_poli')->nullable();
            $table->string('tgl_kontrol')->nullable();
            $table->text('rujuk_ke')->nullable();
            $table->text('alasan_rujuk')->nullable();
            $table->text('alasan_menolak')->nullable();
            $table->text('tgl_keluar')->nullable();
            $table->text('jam_keluar')->nullable();
            $table->text('kondisi_keluar')->nullable();
            $table->text('tgl_meninggal')->nullable();
            $table->text('jam_meninggal')->nullable();
            $table->text('keadaan_umum_keluar')->nullable();
            $table->text('kesadaran_keluar')->nullable();
            $table->text('catatan_penting')->nullable();
            $table->text('edukasi')->nullable();
            $table->text('penyampaian_edukasi')->nullable();
            $table->text('alasan_tidak_menyampaikan_edukasi')->nullable();
            $table->text('gambar_status_lokalis')->nullable();
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
        Schema::dropIfExists('smis_doc_dokumen_asesment_awal_medis_gawat_darurat');
    }
}
