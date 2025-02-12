<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmisDocDokumenOrientasiPasienBaruTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('smis_doc_dokumen_orientasi_pasien_baru', function (Blueprint $table) {
            $table->id();
            $table->integer('id_dokumen')->unsigned();
            $table->string('tanggal', 64)->nullable();
            $table->string('satu', 64);
            $table->string('dua', 64);
            $table->string('tiga', 64);
            $table->string('empat', 64);
            $table->string('lima', 64);
            $table->string('enam', 64);
            $table->string('tujuh_satu', 64);
            $table->string('tujuh_dua', 64);
            $table->string('tujuh_tiga', 64);
            $table->string('pemahaman', 64);
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
        Schema::dropIfExists('smis_doc_dokumen_orientasi_pasien_baru');
    }
}
