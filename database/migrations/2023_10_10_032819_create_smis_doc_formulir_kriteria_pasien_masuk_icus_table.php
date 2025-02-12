<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmisDocFormulirKriteriaPasienMasukIcusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('smis_doc_formulir_kriteria_pasien_masuk_icus', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_dokumen')->nullable();
            $table->unsignedBigInteger('id_ttv')->nullable();
            $table->string('diagnosa')->nullable();
            $table->date('tanggal')->nullable();
            $table->unsignedBigInteger('id_dokter_yang_merawat')->nullable();
            $table->unsignedBigInteger('id_dokter_konsulant_icu')->nullable();
            $table->json('prioritas1')->nullable();
            $table->boolean('prioritas2')->nullable();
            $table->boolean('prioritas3')->nullable();
            $table->json('prioritas4')->nullable();
            $table->json('etc')->nullable();
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
        Schema::dropIfExists('smis_doc_formulir_kriteria_pasien_masuk_icus');
    }
}
