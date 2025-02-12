<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmisDocFormulirTriageTerintegrasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('smis_doc_formulir_triage_terintegrasi', function (Blueprint $table) {
            $table->id();
            $table->integer('id_dokumen')->unsigned();
            $table->string('cara_datang', 64)->nullable();
            $table->string('no_ambulan')->nullable();
            $table->string('rujukan', 64)->nullable();
            $table->string('asal_rujukan', 64)->nullable();
            $table->string('jam_datang', 64)->nullable();
            $table->text('alamat')->nullable();
            $table->string('nama_pengantar', 64)->nullable();
            $table->string('doa', 64)->nullable();
            $table->string('jam_doa', 64)->nullable();
            $table->string('keluhan_utama')->nullable();
            $table->string('trauma', 64)->nullable();
            $table->string('riwayat_penyakit')->nullable();
            $table->string('obstetri', 64)->nullable();
            $table->string('imunisasi', 64)->nullable();
            $table->string('riwayat_alergi')->nullable();
            $table->text('jalan_nafas')->nullable();
            $table->text('pernafasan')->nullable();
            $table->text('sirkulasi')->nullable();
            $table->text('kesadaran')->nullable();
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
        Schema::dropIfExists('smis_doc_formulir_triage_terintegrasi');
    }
}
