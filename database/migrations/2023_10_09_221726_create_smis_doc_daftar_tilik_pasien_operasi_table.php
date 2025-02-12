<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmisDocDaftarTilikPasienOperasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('smis_doc_daftar_tilik_pasien_operasi', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary()->autoIncrement(false);
            $table->date('tanggal')->nullable();
            $table->string('asal_unit')->nullable();
            $table->string('transfer_ke')->nullable();
            $table->time('jam_transfer')->nullable();
            $table->string('tindakan_operasi')->nullable();
            $table->time('jam_rencana_operasi')->nullable();
            $table->unsignedBigInteger('id_dokter_spesialis')->nullable();
            $table->unsignedBigInteger('id_dokter_anestesi')->nullable();
            $table->json('daftar_periksa')->nullable();
            $table->text('pesan')->nullable();
            $table->boolean('status')->nullable();
            $table->unsignedBigInteger('id_pelaksana')->nullable();
            $table->string('nama_pelaksana', 250)->nullable();
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
        Schema::dropIfExists('smis_doc_daftar_tilik_pasien_operasi');
    }
}
