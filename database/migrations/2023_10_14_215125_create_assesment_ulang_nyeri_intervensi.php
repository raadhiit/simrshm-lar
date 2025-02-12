<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssesmentUlangNyeriIntervensi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('smis_doc_assesment_ulang_nyeri_intervensi', function (Blueprint $table) {
            $table->id();
            $table->integer('id_dokumen')->unsigned();
            $table->integer('idx')->unsigned();
            $table->dateTime('tanggal1')->nullable();
            $table->integer('skor_nyeri')->nullable();
            $table->integer('skor_sedasi')->nullable();
            $table->string('tekanan_darah')->nullable();
            $table->string('nadi')->nullable();
            $table->string('suhu')->nullable();
            $table->string('respirasi')->nullable();
            $table->string('verifikator1', 128)->nullable();
            $table->dateTime('tanggal2')->nullable();
            $table->string('nama_obat', 128)->nullable();
            $table->string('dosis', 128)->nullable();
            $table->string('rute', 128)->nullable();
            $table->string('efek_samping', 128)->nullable();
            $table->integer('intervensi_non_farmakologi')->nullable();
            $table->string('verifikator2', 128)->nullable();
            $table->dateTime('tanggal_kaji_ulang')->nullable();
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
        Schema::dropIfExists('smis_doc_assesment_ulang_nyeri_intervensi');
    }
}
