<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmisDocFormulirKriteriaPasienKeluarIcusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('smis_doc_formulir_kriteria_pasien_keluar_icus', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_dokumen')->nullable();
            $table->unsignedBigInteger('id_ttv')->nullable();
            $table->string('diagnosa')->nullable();
            $table->date('tanggal')->nullable();
            $table->unsignedBigInteger('id_dokter_yang_merawat')->nullable();
            $table->unsignedBigInteger('id_dokter_konsulant_icu')->nullable();
            $table->boolean('no1')->nullable();
            $table->boolean('no2')->nullable();
            $table->boolean('no3')->nullable();
            $table->boolean('no4')->nullable();
            $table->json('etcNo1')->nullable();
            $table->string('etcNo4')->nullable();
            $table->unsignedBigInteger('id_verifikator')->nullable();
            $table->string('nama_verifikator', 128)->nullable();
            $table->integer('status')->nullable();
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
        Schema::dropIfExists('smis_doc_formulir_kriteria_pasien_keluar_icus');
    }
}
