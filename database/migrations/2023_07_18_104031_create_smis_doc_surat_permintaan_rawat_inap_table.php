<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmisDocSuratPermintaanRawatInapTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('smis_doc_surat_permintaan_rawat_inap', function (Blueprint $table) {
            $table->id();
            $table->integer('id_dokumen')->unsigned();
            $table->string('unit');
            $table->text('indikasi_rawat');
            $table->integer('id_dpjp');
            $table->string('dpjp');
            $table->integer('id_dokter_pengirim');
            $table->string('dokter_pengirim');
            $table->string('tgl_rawat_inap', 64);
            $table->integer('id_kamar');
            $table->string('kamar', 64);
            $table->integer('id_petugas_ranap');
            $table->string('petugas_ranap', 64);
            $table->string('tgl_rencana_operasi');
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
        Schema::dropIfExists('smis_doc_surat_permintaan_rawat_inap');
    }
}
