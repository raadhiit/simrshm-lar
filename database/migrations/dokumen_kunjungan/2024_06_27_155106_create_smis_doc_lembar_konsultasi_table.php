<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmisDocLembarKonsultasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('smis_doc_lembar_konsultasi', function (Blueprint $table) {
            $table->id();
            $table->integer('id_dokumen');
            $table->integer('id_kepada');
            $table->string('kepada', 128);
            $table->string('spesialis', 128);
            $table->string('jenis_konsul', 32);
            $table->dateTime('tanggal');
            $table->text('keterangan_klinis');
            $table->string('diagnosa', 64);
            $table->integer('id_konsul');
            $table->string('nama_konsul', 128);
            $table->text('temuan');
            $table->text('keluhan');
            $table->string('saran_tindakan', 128);
            $table->date('konsultasi_ulang');
            $table->string('tindakan_khusus', 128);
            $table->dateTime('tanggal_verifikasi');
            $table->integer('id_jawab');
            $table->string('nama_jawab', 128);
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
        Schema::dropIfExists('smis_doc_lembar_konsultasi');
    }
}
