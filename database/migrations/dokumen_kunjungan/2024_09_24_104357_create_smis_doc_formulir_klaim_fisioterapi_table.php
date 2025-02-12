<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmisDocFormulirKlaimFisioterapiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('smis_doc_formulir_klaim_fisioterapi', function (Blueprint $table) {
            $table->id();
            $table->integer('id_dokumen');
            $table->string('radio_hubungan', 64)->nullable();
            $table->string('tanggal_pelayanan', 32)->nullable();
            $table->string('anamnesa')->nullable();
            $table->string('pemeriksaan_fisik')->nullable();
            $table->string('diagnosa_medis')->nullable();
            $table->string('diagnosa_fungsi')->nullable();
            $table->string('pemeriksaan_penunjang')->nullable();
            $table->string('tata_laksana')->nullable();
            $table->string('anjuran')->nullable();
            $table->string('evaluasi')->nullable();
            $table->string('tanggal_dokumen', 32)->nullable();
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
        Schema::dropIfExists('smis_doc_formulir_klaim_fisioterapi');
    }
}
