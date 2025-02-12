<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmisDocResumeMedisPasienPulangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('smis_doc_resume_medis_pasien_pulang', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_dokumen');
            $table->text('indikasi_rawat_inap');
            $table->text('riwayat_kesehatan');
            $table->text('pemeriksaan_fisik');
            $table->string('pemeriksaan_penunjang', 64);
            $table->string('ket_pemeriksaan_penunjang', 64);
            $table->string('tgl_kontrol', 64);
            $table->string('perawatan_dirumah', 64);
            $table->string('rencana_pemeriksaan_penunjang', 64);
            $table->text('kebutuhan_edukasi');
            $table->string('ket_pertolongan_mendesak');
            $table->string('ket_kebutuhan_edukasi');
            $table->string('keadaan_akhir', 64);
            $table->string('mobilisasi_pulang', 64);
            $table->string('alat_bantu', 64);
            $table->string('alkes', 64);
            $table->string('dit');
            $table->string('disertakan_waktu_pulang', 64);
            $table->string('ket_disertakan_waktu_pulang', 64);
            $table->string('penyakit_berhubungan', 64);
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
        Schema::dropIfExists('smis_doc_resume_medis_pasien_pulang');
    }
}
