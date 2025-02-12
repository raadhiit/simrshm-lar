<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmisDocAssesmentPerioperatifMedisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('smis_doc_assesment_perioperatif_medis', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary();
            $table->dateTime('tanggal_jam_assesmen')->nullable();
            $table->string('assesment_oleh')->nullable();
            $table->string('assesment_dari')->nullable();
            $table->string('asal_pasien')->nullable();
            $table->string('asal_pasien_lain')->nullable();
            $table->json('anamnesis')->nullable();
            $table->json('pemeriksaan_fisik')->nullable();
            $table->longText('status_generalis')->nullable();
            $table->longText('pemeriksaan_penunjang_diagnostik')->nullable();
            $table->longText('diagnosis_pra_operasi')->nullable();
            $table->longText('rencana_tindakan_pengobatan')->nullable();
            $table->dateTime('tanggal_jam_selesai')->nullable();
            $table->boolean('status')->default(false);
            $table->unsignedBigInteger('id_verifikator')->nullable();
            $table->string('nama_verifikator')->nullable();
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
        Schema::dropIfExists('smis_doc_assesment_perioperatif_medis');
    }
}
