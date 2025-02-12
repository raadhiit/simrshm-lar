<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmisDocSuratPernyataanNaikKelasTable extends Migration
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
            $table->integer('id_dokumen')->unsigned();          
            $table->string('nama_pengampu','128')->nullable();
            $table->string('alamat_pengampu','128')->nullable();
            $table->string('telp_pengampu','25')->nullable();
            $table->string('hubungan','45')->nullable();
            $table->string('nama_pasien')->nullable();
            $table->string('nobpjs_pasien')->nullable();
            $table->string('hak_kelas','25')->nullable();
            $table->string('kelas_ditempati','25')->nullable();
            $table->date('tgl_ttd')->nullable();
            $table->string('nama_pernyataan')->nullable();
            $table->string('ttd_pernyataan')->nullable();
            $table->string('nama_saksi')->nullable();
            $table->string('ttd_saksi')->nullable();
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
        Schema::dropIfExists('surat_pernyataan_naik_kelas');
    }
}
