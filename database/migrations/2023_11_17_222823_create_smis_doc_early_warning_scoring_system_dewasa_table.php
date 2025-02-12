<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmisDocEarlyWarningScoringSystemDewasaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('smis_doc_early_warning_scoring_system_dewasa', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_dokumen');
            $table->dateTime('tanggal_jam')->nullable();
            $table->json('respirasi')->nullable();
            $table->json('saturasi_o2')->nullable();
            $table->json('tekanan_darah_sistolik')->nullable();
            $table->json('hr')->nullable();
            $table->json('kesadaran')->nullable();
            $table->json('temperatur')->nullable();
            $table->json('parameter_tambahan')->nullable();
            $table->boolean('status')->nullable();
            $table->unsignedBigInteger('id_pemeriksa')->nullable();
            $table->string('nama_pemeriksa')->nullable();
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
        Schema::dropIfExists('smis_doc_early_warning_scoring_system_dewasa');
    }
}
