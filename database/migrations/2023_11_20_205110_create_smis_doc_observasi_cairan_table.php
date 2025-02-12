<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmisDocObservasiCairanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('smis_doc_observasi_cairan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_dokumen');
            $table->date('tanggal_pelaksanaan')->nullable();
            $table->json('pagi')->nullable();
            $table->json('sore')->nullable();
            $table->json('malam')->nullable();
            $table->double('cairan_masuk')->nullable();
            $table->double('cairan_keluar')->nullable();
            $table->double('diuresis_24_jam')->nullable();
            $table->double('iwl_24_jam')->nullable();
            $table->double('balance_cairan')->nullable();
            $table->boolean('status')->nullable();
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
        Schema::dropIfExists('smis_doc_observasi_cairan');
    }
}
