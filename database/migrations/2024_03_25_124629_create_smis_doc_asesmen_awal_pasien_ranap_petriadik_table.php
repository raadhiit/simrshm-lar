<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmisDocAsesmenAwalPasienRanapPetriadikTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('smis_doc_asesmen_awal_pasien_ranap_petriadik', function (Blueprint $table) {
            $table->id();
            $table->integer('id_dokumen');
            $table->integer('id_diagnosa');
            $table->integer('id_pesanan_lab');
            $table->integer('id_pesanan_rad');
            $table->integer('id_e_resep');
            $table->dateTime('tanggal_tiba')->nullable();
            $table->dateTime('tanggal_pengkajian')->nullable();
            $table->string('diperoleh_dari', 64)->default('');
            $table->string('hubungan_dengan_pasien', 64)->default('');
            $table->string('nama_perawat', 64)->default('');
            $table->text('anamnesis')->nullable();
            $table->text('pemeriksaan_fisik')->nullable();
            $table->text('tindakan_perawat')->nullable();
            $table->text('anamnesis_perawat')->nullable();
            $table->text('pemeriksaan_fisik_perawat')->nullable();
            $table->text('spiritual')->nullable();
            $table->text('status_psikologis')->nullable();
            $table->text('kebutuhan_komunikasi')->nullable();
            $table->text('kebutuhan_privasi')->nullable();
            $table->text('skrining_gizi')->nullable();
            $table->text('daftar_masalah_keperawatan')->nullable();
            $table->text('rencana_keperawatan')->nullable();
            $table->text('perencanaan_perawatan')->nullable();
            $table->text('perencanaan_pulang')->nullable();
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
        // Schema::dropIfExists('smis_doc_asesmen_awal_pasien_ranap_petriadik');
    }
}
