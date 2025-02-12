<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmisDocBuktiPendaftaranRawatInapTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('smis_doc_bukti_pendaftaran_rawat_inap', function (Blueprint $table) {
            $table->id();
            $table->integer('id_dokumen');
            $table->string('kontraktor', 64);
            $table->string('telepon', 25);
            $table->string('cara_masuk', 64);
            $table->string('datang_melalui', 64);
            $table->string('dikirim_oleh', 64);
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
        Schema::dropIfExists('smis_doc_bukti_pendaftaran_rawat_inap');
    }
}
