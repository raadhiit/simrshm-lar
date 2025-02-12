<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmisDocLaporanAnastesiDanSedasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('smis_doc_laporan_anastesi_dan_sedasi', function (Blueprint $table) {
            $table->id();
            $table->integer('id_dokumen')->unsigned();
            $table->integer('id_d_anastesi')->nullable();
            $table->string('d_anastesi', 64)->nullable();
            $table->integer('id_perawat')->nullable();
            $table->string('perawat', 64)->nullable();
            $table->integer('id_instrumen')->nullable();
            $table->string('instrumen', 64)->nullable();
            $table->string('diagnosa_pre_op', 128)->nullable();
            $table->string('diagnosa_post_op', 128)->nullable();
            $table->string('tindakan', 128)->nullable();
            $table->string('jenis_anastesi', 64)->nullable();
            $table->string('resiko_anastesi', 64)->nullable();
            $table->string('tb_pre', 32)->nullable();
            $table->string('bb_pre', 32)->nullable();
            $table->string('td', 32)->nullable();
            $table->string('hb', 32)->nullable();
            $table->string('nadi', 32)->nullable();
            $table->string('ht', 32)->nullable();
            $table->string('suhu', 32)->nullable();
            $table->string('gol_darah', 32)->nullable();
            $table->string('gcs_e', 32)->nullable();
            $table->string('gcs_m', 32)->nullable();
            $table->string('gcs_v', 32)->nullable();
            $table->string('pramedikasi', 128)->nullable();
            $table->string('profol', 128)->nullable();
            $table->string('midazolam', 128)->nullable();
            $table->string('rl', 128)->nullable();
            $table->string('fentanyl', 128)->nullable();
            $table->string('medikasi1', 128)->nullable();
            $table->string('det_medikasi1', 128)->nullable();
            $table->string('pethidin', 128)->nullable();
            $table->string('medikasi2', 128)->nullable();
            $table->string('det_medikasi2', 128)->nullable();
            $table->string('atrakurium', 128)->nullable();
            $table->string('sa', 128)->nullable();
            $table->string('urine', 128)->nullable();
            $table->string('buvupacaine', 128)->nullable();
            $table->string('pendarahan', 128)->nullable();
            $table->string('ngt', 128)->nullable();
            $table->string('catatan')->nullable();
            $table->text('ket_tunda')->nullable();
            $table->string('regional', 64)->nullable();
            $table->string('induksi', 64)->nullable();
            $table->string('tiva', 64)->nullable();
            $table->string('inhalasi', 64)->nullable();
            $table->string('ett_lma', 64)->nullable();
            $table->string('ket_ett_lma', 128)->nullable();
            $table->string('masker', 64)->nullable();
            $table->string('maintance', 64)->nullable();
            $table->time('jam_anastesi')->nullable();
            $table->string('spo1', 128)->nullable();
            $table->string('spo2', 128)->nullable();
            $table->string('spo3', 128)->nullable();
            $table->string('spo4', 128)->nullable();
            $table->time('waktu_anastesi')->nullable();
            $table->time('selesai_anastesi')->nullable();
            $table->time('pasien_masuk_rr')->nullable();
            $table->integer('id_perawat_masuk_rr')->nullable();
            $table->string('perawat_masuk_rr')->nullable();
            $table->integer('id_penata_anastesi')->nullable();
            $table->string('penata_anastesi')->nullable();
            $table->time('jam_anastesi2')->nullable();
            $table->time('pasien_keluar_rr')->nullable();
            $table->string('keluar_rr', 64)->nullable();
            $table->integer('id_perawat_keluar_rr')->nullable();
            $table->string('perawat_keluar_rr')->nullable();
            $table->integer('id_perawat_penerima')->nullable();
            $table->string('perawat_penerima')->nullable();
            $table->smallInteger('aktivitas_motorik_masuk')->nullable();
            $table->smallInteger('aktivitas_motorik_keluar')->nullable();
            $table->smallInteger('respirasi_masuk')->nullable();
            $table->smallInteger('respirasi_keluar')->nullable();
            $table->smallInteger('sirkulasi_masuk')->nullable();
            $table->smallInteger('sirkulasi_keluar')->nullable();
            $table->smallInteger('kesadaran_masuk')->nullable();
            $table->smallInteger('kesadaran_keluar')->nullable();
            $table->smallInteger('warna_kulit_masuk')->nullable();
            $table->smallInteger('warna_kulit_keluar')->nullable();
            $table->smallInteger('bromage_masuk')->nullable();
            $table->smallInteger('bromage_keluar')->nullable();
            $table->smallInteger('kesadaran_steward_masuk')->nullable();
            $table->smallInteger('kesadaran_steward_keluar')->nullable();
            $table->smallInteger('respirasi_steward_masuk')->nullable();
            $table->smallInteger('respirasi_steward_keluar')->nullable();
            $table->smallInteger('aktifitas_motorik_steward_masuk')->nullable();
            $table->smallInteger('aktifitas_motorik_steward_keluar')->nullable();
            $table->string('gambar1', 128)->nullable();
            $table->string('gambar2', 128)->nullable();
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
        Schema::dropIfExists('smis_doc_laporan_anastesi_dan_sedasi');
    }
}
