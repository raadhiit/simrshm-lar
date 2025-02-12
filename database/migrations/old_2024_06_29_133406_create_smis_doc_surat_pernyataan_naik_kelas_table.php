<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class OldCreateSmisDocSuratPernyataanNaikKelasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('smis_doc_surat_pernyataan_naik_kelas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_dokumen');
            $table->string('nama_kerabat', 128);
            $table->string('alamat_kerabat', 128);
            $table->string('telp_kerabat', 25);
            $table->string('hubungan', 45);
            $table->string('hak_kelas_rawat', 25);
            $table->string('kelas_rawat_sekarang', 25);
            $table->text('signature_kerabat');

            $table->string('nama_pasien')->nullable();
            $table->string('nobpjs_pasien')->nullable();

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
        Schema::dropIfExists('smis_doc_surat_pernyataan_naik_kelas');
    }
}
