<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmisDocSuratKontrolTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('smis_doc_surat_kontrol', function (Blueprint $table) {
            $table->id();
            $table->integer('id_dokumen')->unsigned();
            $table->string('terapi')->nullable();
            $table->string('tgl_surat_rujukan', 64)->nullable();
            $table->string('alasan1')->nullable();
            $table->string('alasan2')->nullable();
            $table->string('tindak_lanjut1')->nullable();
            $table->string('tindak_lanjut2')->nullable();
            $table->string('tgl_keterangan', 64)->nullable();
            $table->string('no_antrian', 16)->nullable();
            $table->string('tgl_dokumen', 64)->nullable();
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
        Schema::dropIfExists('smis_doc_surat_kontrol');
    }
}
