<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmisDocSuratKontrolRawatInapTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('smis_doc_surat_kontrol_rawat_inap', function (Blueprint $table) {
            $table->id();
            $table->integer('id_dokumen');
            $table->string('resume')->nullable();
            $table->string('radio_resume', 10)->nullable();
            $table->string('tgl_kontrol', 15)->nullable();
            $table->string('jam_kontrol', 15)->nullable();
            $table->string('nama_dokter')->nullable();
            $table->string('radio_kontrol', 10)->nullable();
            $table->string('alasan_istirahat')->nullable();
            $table->string('radio_dokter', 10)->nullable();
            $table->string('no_rad')->nullable();
            $table->string('rad')->nullable();
            $table->string('radio_rad', 10)->nullable();
            $table->string('lab')->nullable();
            $table->string('radio_lab', 10)->nullable();
            $table->string('terapi')->nullable();
            $table->string('radio_terapi', 10)->nullable();
            $table->string('diagnosa')->nullable();
            $table->string('tinggi_badan')->nullable();
            $table->string('berat_badan')->nullable();
            $table->string('surat_konsul')->nullable();
            $table->string('radio_konsul', 10)->nullable();
            $table->string('surat_jawaban_konsul')->nullable();
            $table->string('radio_jawaban_konsul', 10)->nullable();
            $table->string('surat_kematian')->nullable();
            $table->string('radio_kematian', 10)->nullable();
            $table->string('asuransi')->nullable();
            $table->string('radio_asuransi', 10)->nullable();
            $table->string('tgl_dokumen', 15)->nullable();
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
        Schema::dropIfExists('smis_doc_surat_kontrol_rawat_inap');
    }
}
