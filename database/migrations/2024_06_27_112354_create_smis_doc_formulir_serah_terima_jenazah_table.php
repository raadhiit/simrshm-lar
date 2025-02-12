<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmisDocFormulirSerahTerimaJenazahTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('smis_doc_formulir_serah_terima_jenazah', function (Blueprint $table) {
            $table->id();
            $table->integer('id_dokumen')->unsigned();
            $table->string('hari_dokumen', 64)->nullable();
            $table->string('tgl_dokumen', 64)->nullable();
            $table->string('tempat_meninggal', 64)->nullable();
            $table->string('nama', 64)->nullable();
            $table->string('umur', 64)->nullable();
            $table->string('tgl_meninggal', 64)->nullable();
            $table->string('nama_wali', 64)->nullable();
            $table->string('umur_wali', 64)->nullable();
            $table->string('alamat_wali', 64)->nullable();
            $table->string('telp_wali', 64)->nullable();
            $table->string('ktp_wali', 64)->nullable();
            $table->string('hubungan', 64)->nullable();
            $table->string('ket_lain_lain', 64)->nullable();
            $table->string('tgl_ttd', 64)->nullable();
            $table->string('nama_penerima', 64)->nullable();
            $table->string('ttd_penerima', 64)->nullable();
            $table->string('nama_saksi', 64)->nullable();
            $table->string('ttd_saksi', 64)->nullable();
            $table->string('nama_saksi_dua', 64)->nullable();
            $table->string('ttd_saksi_dua', 64)->nullable();
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
        Schema::dropIfExists('smis_doc_formulir_serah_terima_jenazah');
    }
}
