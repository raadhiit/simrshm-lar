<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormulirLayananKedokteranFisikRehabilitasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formulir_layanan_kedokteran_fisik_rehabilitasis', function (Blueprint $table) {
            $table->id();
            $table->integer('id_dokumen')->unsigned();
            $table->string('hubungan', 32)->nullable();
            $table->string('saksi_dua', 64)->nullable();
            $table->string('tanggal_pelayanan')->nullable();
            $table->string('anamnesa')->nullable();
            $table->string('pemeriksaan_fisik')->nullable();
            $table->string('diagnosa_medis')->nullable();
            $table->string('diagnosa_fungsi')->nullable();
            $table->string('pemeriksaan_penunjang')->nullable();
            $table->string('tata_laksana')->nullable();
            $table->string('anjuran')->nullable();
            $table->string('evaluasi')->nullable();
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
        Schema::dropIfExists('formulir_layanan_kedokteran_fisik_rehabilitasis');
    }
}
