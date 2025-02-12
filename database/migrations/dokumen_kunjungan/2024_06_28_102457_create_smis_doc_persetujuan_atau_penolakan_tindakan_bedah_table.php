<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmisDocPersetujuanAtauPenolakanTindakanBedahTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('smis_doc_persetujuan_atau_penolakan_tindakan_bedah', function (Blueprint $table) {
            $table->id();
            $table->integer('id_dokumen');
            $table->integer('id_dokter_pelaksana')->default(0);
            $table->string('nama_dokter_pelaksana', 128)->default('');
            $table->integer('id_pemberi_informasi')->default(0);
            $table->string('nama_pemberi_informasi', 128)->default('');
            $table->string('penerima_informasi', 128);
            $table->text('informasi');
            $table->integer('id_dokter')->default(0);
            $table->string('nama_dokter', 128)->default('');
            $table->string('tanda_tangan_keluarga', 128)->default('');
            $table->string('nama_keluarga', 128)->default('');
            $table->text('pernyataan');
            $table->string('tanda_tangan_menyatakan', 128)->default('');
            $table->string('nama_menyatakan', 128)->default('');
            $table->string('tanda_tangan_wali', 128)->default('');
            $table->string('nama_wali', 128)->default('');
            $table->integer('id_perawat')->default(0);
            $table->string('nama_perawat', 128)->default('');
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
        Schema::dropIfExists('smis_doc_persetujuan_atau_penolakan_tindakan_bedah');
    }
}
