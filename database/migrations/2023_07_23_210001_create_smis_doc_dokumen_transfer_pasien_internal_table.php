<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmisDocDokumenTransferPasienInternalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('smis_doc_dokumen_transfer_pasien_internal', function (Blueprint $table) {
            $table->id();
            $table->integer('id_dokumen')->unsigned();
            $table->string('tgl_transfer', 64);
            $table->string('jam_transfer', 64);
            $table->string('tgl_masuk', 64);
            $table->integer('id_dpjp');
            $table->string('dpjp', 64);
            $table->string('riwayat_penyakit', 64);
            $table->string('indikasi_rawat');
            $table->integer('id_unit');
            $table->string('unit', 64);
            $table->text('keadaan_umum', 64);
            $table->string('e_kesadaran', 64);
            $table->string('m_kesadaran', 64);
            $table->string('v_kesadaran', 64);
            $table->string('fasilitas_transfer', 64);
            $table->string('ket_fasilitas_transfer', 64)->default('');
            $table->integer('id_petugas_penyerahan')->nullable();
            $table->string('petugas_penyerahan', 64)->nullable();
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
        Schema::dropIfExists('smis_doc_dokumen_transfer_pasien_internal');
    }
}
