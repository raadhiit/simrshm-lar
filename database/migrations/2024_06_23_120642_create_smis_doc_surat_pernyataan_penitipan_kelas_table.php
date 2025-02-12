<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmisDocSuratPernyataanPenitipanKelasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('smis_doc_surat_pernyataan_penitipan_kelas', function (Blueprint $table) {
            $table->id()->unsigned();
            $table->bigInteger('id_dokumen')->unsigned();
            $table->string('nama_pasien');
            $table->string('alamat_pasien');
            $table->string('telp_pasien');
            $table->string('nama_kerabat', 128);
            $table->string('telp_kerabat', 25);
            $table->text('alamat_kerabat');
            $table->string('hubungan');
            $table->string('kelas_lama', 25);
            $table->string('kelas_baru', 25);
            $table->string('signature_kerabat')->nullable();
            $table->string('nama_saksi')->nullable();
            $table->string('signature_saksi')->nullable();
            $table->date('tanggal');
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
        Schema::dropIfExists('smis_doc_surat_pernyataan_penitipan_kelas');
    }
}
