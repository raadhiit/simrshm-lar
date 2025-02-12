<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmisDocTataTertibDanPeraturanPelayananRawatInapTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('smis_doc_tata_tertib_dan_peraturan_pelayanan_rawat_inap', function (Blueprint $table) {
            $table->id();
            $table->integer('id_dokumen');
            $table->string('nama_pasien', 128);
            $table->string('signature', 128);
            $table->dateTime('tanggal_verifikasi');
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
        Schema::dropIfExists('smis_doc_tata_tertib_dan_peraturan_pelayanan_rawat_inap');
    }
}
