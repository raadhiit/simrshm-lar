<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmisDocSuratKeteranganKematianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('smis_doc_surat_keterangan_kematian', function (Blueprint $table) {
            $table->id();
            $table->integer('id_dokumen')->unsigned();
            $table->string('dokter')->nullable();
            $table->string('tgl_lahir', 24)->nullable();
            $table->string('umur', 12)->nullable();
            $table->string('alamat')->nullable();
            $table->string('tgl_tiba', 24)->nullable();
            $table->string('jam_tiba', 12)->nullable();
            $table->string('diagnosa')->nullable();
            $table->string('tgl_meninggal', 24)->nullable();
            $table->string('jam_meninggal', 12)->nullable();
            $table->string('sebab_kematian')->nullable();
            $table->string('tgl_dokumen', 24)->nullable();
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
        Schema::dropIfExists('smis_doc_surat_keterangan_kematian');
    }
}
