<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmisDocChecklistKeselamatanPasienOperasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('smis_doc_checklist_keselamatan_pasien_operasi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_dokumen');
            $table->date('tanggal')->nullable();
            $table->time('sign_in_jam')->nullable();
            $table->json('sign_in_checklist')->nullable();
            $table->boolean('sign_in_status_perawat_sirkuler')->nullable();
            $table->unsignedBigInteger('sign_in_id_perawat_sirkuler')->nullable();
            $table->string('sign_in_nama_perawat_sirkuler')->nullable();
            $table->boolean('sign_in_status_dokter_anastesi')->nullable();
            $table->unsignedBigInteger('sign_in_id_dokter_anastesi')->nullable();
            $table->string('sign_in_nama_dokter_anastesi')->nullable();
            $table->time('time_out_jam')->nullable();
            $table->json('time_out_checklist')->nullable();
            $table->boolean('time_out_status_perawat_sirkuler')->nullable();
            $table->unsignedBigInteger('time_out_id_perawat_sirkuler')->nullable();
            $table->string('time_out_nama_perawat_sirkuler')->nullable();
            $table->boolean('time_out_status_perawat_instrumen')->nullable();
            $table->unsignedBigInteger('time_out_id_perawat_instrumen')->nullable();
            $table->string('time_out_nama_perawat_instrumen')->nullable();
            $table->time('sign_out_jam')->nullable();
            $table->json('sign_out_checklist')->nullable();
            $table->boolean('sign_out_status_dokter_bedah')->nullable();
            $table->unsignedBigInteger('sign_out_id_dokter_bedah')->nullable();
            $table->string('sign_out_nama_dokter_bedah')->nullable();
            $table->boolean('sign_out_status_dokter_anastesi')->nullable();
            $table->unsignedBigInteger('sign_out_id_dokter_anastesi')->nullable();
            $table->string('sign_out_nama_dokter_anastesi')->nullable();
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
        Schema::dropIfExists('smis_doc_checklist_keselamatan_pasien_operasis');
    }
}
