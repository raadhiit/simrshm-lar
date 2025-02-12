<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmisDocSurveiInfeksiRumahSakitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('smis_doc_survei_infeksi_rumah_sakit', function (Blueprint $table) {
            $table->id();
            $table->integer('id_dokumen');
            $table->string('smf_utama', 64);
            $table->date('tanggal_masuk');
            $table->date('tanggal_keluar');
            $table->string('tb', 32);
            $table->string('bb', 32);
            $table->string('cara_masuk', 32);
            $table->string('keadaan_keluar', 32);
            $table->text('diagnosa_akhir');
            $table->text('tempat_dirawat');
            $table->text('faktor_resiko');
            $table->text('iadp');
            $table->text('infeksi_saluran_kemih');
            $table->text('penumonia_ventilator');
            $table->text('infeksi_luka_operasi');
            $table->integer('id_dokter');
            $table->string('nama_dokter', 64);
            $table->integer('id_kepala_ruangan');
            $table->string('nama_kepala_ruangan', 64);
            $table->date('tanggal_verifikasi');
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
        Schema::dropIfExists('smis_doc_survei_infeksi_rumah_sakit');
    }
}
