<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmisDocFormulirSuratPernyataanRawatInapTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('smis_doc_formulir_surat_pernyataan_rawat_inap', function (Blueprint $table) {
            $table->id();
            $table->integer('id_dokumen')->unsigned();
            $table->string('nama', 64)->nullable();
            $table->string('umur', 64)->nullable();
            $table->string('alamat', 255)->nullable();
            $table->string('no_ktp', 64)->nullable();
            $table->string('hubungan', 64)->nullable();
            $table->string('ket_lain_lain', 64)->nullable();
            $table->string('nama_wali', 64)->nullable();
            $table->string('umur_wali', 64)->nullable();
            $table->string('alamat_wali', 255)->nullable();
            $table->string('no_ktp_wali', 64)->nullable();
            $table->string('tgl_dokumen', 64)->nullable();
            $table->string('nama_saksi', 64)->nullable();
            $table->string('ttd_saksi', 64)->nullable();
            $table->string('nama_petugas', 64)->nullable();
            $table->string('ttd_petugas', 64)->nullable();
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
        Schema::dropIfExists('smis_doc_formulir_surat_pernyataan_rawat_inap');
    }
}
