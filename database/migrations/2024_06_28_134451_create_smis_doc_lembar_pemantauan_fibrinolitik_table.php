<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmisDocLembarPemantauanFibrinolitikTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('smis_doc_lembar_pemantauan_fibrinolitik', function (Blueprint $table) {
            $table->id();
            $table->integer('id_dokumen')->unsigned();
            $table->string('tgl_tindakan', 64)->nullable();
            $table->string('skala_nyeri', 64)->nullable();
            $table->string('tensi', 64)->nullable();
            $table->string('nadi', 64)->nullable();
            $table->string('rr', 64)->nullable();
            $table->string('spo2', 64)->nullable();
            $table->string('pendarahan', 64)->nullable();
            $table->integer('id_verifikator');
            $table->string('nama_verifikator', 64);
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
        Schema::dropIfExists('smis_doc_lembar_pemantauan_fibrinolitik');
    }
}
