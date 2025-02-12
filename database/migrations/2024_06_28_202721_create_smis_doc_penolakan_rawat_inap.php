<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmisDocPenolakanRawatInap extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('smis_doc_penolakan_rawat_inap', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_dokumen');

            $table->string('nama_pasien')->nullable();
            $table->date('tgl_lahir_pasien')->nullable();
            $table->string('alamat_pasien')->nullable();
            $table->string('ktp_pasien', 25)->nullable();

            $table->string('nama_kerabat', 128);
            $table->string('alamat_kerabat', 25);
            $table->string('hubungan', 128);
            $table->date('tgl_lahir_kerabat');
            $table->string('telp_kerabat', 25);
            $table->string('ktp_kerabat', 25);
            $table->string('alasan', 128);
            $table->text('signature_kerabat');

            $table->string('nama_saksi')->nullable();
            $table->text('signature_saksi')->nullable();

            $table->timestamp('tanggal');
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
        Schema::dropIfExists('smis_doc_penolakan_rawat_inap');
    }
}
