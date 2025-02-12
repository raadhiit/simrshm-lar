<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmisDocBuktiPendaftaranRawatJalanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('smis_doc_bukti_pendaftaran_rawat_jalan', function (Blueprint $table) {
            $table->id();
            $table->integer('id_dokumen');
            $table->string('pengirim', 64);
            $table->string('ditujukan', 64);
            $table->string('catatan', 128);
            $table->string('nama_pasien', 128);
            $table->string('signature', 128);
            $table->date('tanggal_verifikasi');
            $table->string('nama_user', 128)->default('');
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
        // Schema::dropIfExists('smis_doc_bukti_pendaftaran_rawat_jalan');
    }
}
