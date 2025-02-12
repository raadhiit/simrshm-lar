<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmisDocLaporanPembedahanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('smis_doc_laporan_pembedahan', function (Blueprint $table) {
            $table->id();
            $table->integer('id_dokumen')->unsigned();
            $table->integer('id_dokter_operator')->unsigned();
            $table->string('dokter_operator', 128)->default('');
            $table->integer('id_asisten_operator')->unsigned();
            $table->string('asisten_operator', 128)->default('');
            $table->integer('id_instrumen')->unsigned();
            $table->string('instrumen', 128)->default('');
            $table->integer('id_spesialis_anestesi')->unsigned();
            $table->string('spesialis_anestesi', 128)->default('');
            $table->integer('id_asisten_anestesi')->unsigned();
            $table->string('asisten_anestesi', 128)->default('');
            $table->integer('id_jenis_anestesi')->unsigned();
            $table->string('jenis_anestesi', 128)->default('');
            $table->string('diagnosis_pasca_bedah')->default('');
            $table->string('tindakan')->default('');
            $table->string('indikasi_operasi')->default('');
            $table->string('posisi',10)->default('');
            $table->string('jenis_pembedahan', 32)->default('');
            $table->string('jenis_pembedahan_rencana', 32)->default('');
            $table->string('jenis_luka_operasi', 32)->default('');
            $table->date('tanggal');
            $table->date('mulai');
            $table->date('selesai');
            $table->string('lama_pembedahan', 32)->default('');
            $table->text('laporan_pembedahan');
            $table->string('lampiran_pembedahan');
            $table->string('dikirim_pa', 10);
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
        
    }
}
