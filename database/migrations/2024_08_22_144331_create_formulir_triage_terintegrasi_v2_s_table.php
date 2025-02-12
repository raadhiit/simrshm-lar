<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormulirTriageTerintegrasiV2STable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formulir_triage_terintegrasi_v2_s', function (Blueprint $table) {
            $table->id();
            $table->integer('id_dokumen')->unsigned();
            $table->string('kontak_awal_pasien', 64)->nullable();
            $table->date('tanggal')->nullable();
            $table->time('pukul')->nullable();
            $table->string('cara_masuk')->nullable();
            $table->string('ket_cara_masuk')->nullable();
            $table->string('sudah_terpasang')->nullable();
            $table->string('alasan_kedatangan')->nullable();
            $table->string('ket_rujukan')->nullable();
            $table->string('ket_dijemput')->nullable();
            $table->string('kendaraan')->nullable();
            $table->string('ket_kendaraan')->nullable();
            $table->string('nama_pengantar')->nullable();
            $table->string('no_telp_pengantar')->nullable();
            $table->string('kasus')->nullable();
            $table->text('keluhan_utama')->nullable();
            $table->string('tv_nyeri')->nullable();
            $table->string('esi_satu', 255)->nullable();
            $table->string('ket_esi_satu')->nullable();
            $table->string('esi_dua', 255)->nullable();
            $table->string('ket_esi_dua')->nullable();
            $table->string('sumber_daya', 255)->nullable();
            $table->string('danger_zone', 255)->nullable();
            $table->string('esi_tiga', 64)->nullable();
            $table->string('esi_empat', 32)->nullable();
            $table->string('esi_lima', 32)->nullable();
            $table->time('keputusan_pukul')->nullable();
            $table->string('reuunp', 32)->nullable();
            $table->string('catatan', 255)->nullable();
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
        Schema::dropIfExists('formulir_triage_terintegrasi_v2_s');
    }
}
