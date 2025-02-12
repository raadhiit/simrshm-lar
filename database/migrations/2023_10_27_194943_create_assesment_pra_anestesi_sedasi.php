<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssesmentPraAnestesiSedasi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assesment_pra_anestesi_sedasi', function (Blueprint $table) {
            $table->id();
            $table->integer('id_dokumen')->unsigned();
            $table->integer('idx')->unsigned();
            $table->dateTime('tanggal')->nullable();
            $table->json('sosial')->nullable();
            $table->json('kebiasaan')->nullable();
            $table->json('pengobatan')->nullable();
            $table->json('riwayat_keluarga')->nullable();
            $table->json('riwayat_penyakit')->nullable();
            $table->json('pasien_perempuan')->nullable();
            $table->json('pemeriksaan_penunjang')->nullable();
            $table->json('asesmen_dokter_anestesi')->nullable();
            $table->string('verifikator')->nullable();
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
        Schema::dropIfExists('assesment_pra_anestesi_sedasi');
    }
}
