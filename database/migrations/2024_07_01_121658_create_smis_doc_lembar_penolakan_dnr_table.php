<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmisDocLembarPenolakanDnrTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('smis_doc_lembar_penolakan_dnr', function (Blueprint $table) {
            $table->id();
            $table->integer('id_dokumen')->unsigned();
            $table->string('dokter', 64)->nullable();
            $table->string('perawat', 64)->nullable();
            $table->string('penerima_informasi', 64)->nullable();
            $table->text('informasi')->nullable();
            $table->string('diagnosa', 64)->nullable();
            $table->string('dasar_diagnosa', 64)->nullable();
            $table->string('tindakan_dokter', 64)->nullable();
            $table->string('indikasi_tindakan', 64)->nullable();
            $table->string('tata_cara', 64)->nullable();
            $table->string('tujuan', 64)->nullable();
            $table->string('risiko', 64)->nullable();
            $table->string('komplikasi', 64)->nullable();
            $table->string('prognosis', 64)->nullable();
            $table->string('alternatif', 64)->nullable();
            $table->string('lain_lain', 64)->nullable();
            $table->string('nama_pasien', 64)->nullable();
            $table->string('alamat_pasien', 64)->nullable();
            $table->string('menolak', 64)->nullable();
            $table->string('terhadap', 64)->nullable();
            $table->string('nama_wali', 64)->nullable();
            $table->string('tgl_lahir_wali', 64)->nullable();
            $table->string('kelamin', 64)->nullable();
            $table->string('alamat', 64)->nullable();
            $table->string('tgl_ttd', 64)->nullable();
            $table->string('nama_keluarga', 64)->nullable();
            $table->string('ttd_keluarga', 64)->nullable();
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
        Schema::dropIfExists('smis_doc_lembar_penolakan_dnr');
    }
}
