<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmisDocFormulirAsesmenAwalPasienRanapDewasaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('smis_doc_formulir_asesmen_awal_pasien_ranap_dewasa', function (Blueprint $table) {
            $table->id();
            $table->integer('id_dokumen')->unsigned();
            $table->string('tgl_kedatangan', 64)->nullable();
            $table->string('jam_kedatangan', 64)->nullable();
            $table->string('tgl_pengkajian', 64)->nullable();
            $table->string('jam_pengkajian', 64)->nullable();
            $table->string('diperoleh_dari')->nullable();
            $table->string('hubungan_dengan_pasien')->nullable();
            $table->string('cara_masuk')->nullable();
            $table->string('asal_pasien')->nullable();
            $table->string('nama_primary_nurse')->nullable();
            $table->string('keluhan_utama')->nullable();
            $table->string('riwayat_penyakit_sekarang')->nullable();
            $table->string('riwayat_penyakit_dahulu')->nullable();
            $table->string('riwayat_penyakit_keluarga')->nullable();
            $table->string('ket_riwayat_penyakit_keluarga')->nullable();
            $table->string('riwayat_penggunaan_obat')->nullable();
            $table->text('list_riwayat_penggunaan_obat')->nullable();
            $table->string('ket_riwayat_penggunaan_obat')->nullable();
            $table->string('riwayat_alergi')->nullable();
            $table->string('ket_riwayat_alergi')->nullable();
            $table->string('keadaan_umum')->nullable();
            $table->string('kesadaran')->nullable();
            $table->string('e_kesadaran')->nullable();
            $table->string('m_kesadaran')->nullable();
            $table->string('v_kesadaran')->nullable();
            $table->text('status_generalis')->nullable();
            $table->text('gambar_status_lokalis')->nullable();
            $table->string('jam_tindakan1', 64)->nullable();
            $table->string('tindakan1')->nullable();
            $table->string('diberikan_oleh1')->nullable();
            $table->string('keterangan1')->nullable();
            $table->string('jam_tindakan2', 64)->nullable();
            $table->string('tindakan2')->nullable();
            $table->string('diberikan_oleh2')->nullable();
            $table->string('keterangan2')->nullable();
            $table->string('jam_tindakan3', 64)->nullable();
            $table->string('tindakan3')->nullable();
            $table->string('diberikan_oleh3')->nullable();
            $table->string('keterangan3')->nullable();
            $table->string('jam_tindakan4', 64)->nullable();
            $table->string('tindakan4')->nullable();
            $table->string('diberikan_oleh4')->nullable();
            $table->string('keterangan4')->nullable();
            $table->string('jam_tindakan5', 64)->nullable();
            $table->string('tindakan5')->nullable();
            $table->string('diberikan_oleh5')->nullable();
            $table->string('keterangan5')->nullable();
            $table->string('jam_tindakan6', 64)->nullable();
            $table->string('tindakan6')->nullable();
            $table->string('diberikan_oleh6')->nullable();
            $table->string('keterangan6')->nullable();
            $table->string('td', 64)->nullable();
            $table->string('rr', 64)->nullable();
            $table->string('nadi', 64)->nullable();
            $table->string('suhu', 64)->nullable();
            $table->integer('id_pesanan_lab')->default(0)->after('id_dokumen');
            $table->integer('id_pesanan_rad')->default(0)->after('id_pesanan_lab');
            $table->integer('id_resep')->default(0)->after('id_pesanan_rad');
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
        Schema::dropIfExists('smis_doc_formulir_asesmen_awal_pasien_ranap_dewasa');
    }
}
