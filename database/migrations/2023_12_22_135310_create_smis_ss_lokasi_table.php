<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmisSsLokasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('smis_ss_lokasi', function (Blueprint $table) {
            $table->id();
            $table->string('id_lokasi')->default('');
            $table->string('kode_tipe', 32);
            $table->string('tipe', 128);
            $table->string('nama', 128);
            $table->string('deskripsi');
            $table->string('status', 32);
            $table->string('telepon', 32);
            $table->string('email', 32);
            $table->string('dikelola_oleh');
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
        Schema::dropIfExists('smis_ss_lokasi');
    }
}
