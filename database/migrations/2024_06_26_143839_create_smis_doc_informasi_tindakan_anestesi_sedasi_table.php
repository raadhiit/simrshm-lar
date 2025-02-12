<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmisDocInformasiTindakanAnestesiSedasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('smis_doc_informasi_tindakan_anestesi_sedasi', function (Blueprint $table) {
            $table->id();
            $table->integer('id_dokumen')->unsigned();
            $table->integer('id_dokter_pelaksana')->nullable();
            $table->integer('id_pemberi_informasi')->nullable();
            $table->string('penerima_informasi')->nullable();
            $table->integer('id_diagnosa')->nullable();
            $table->string('dasar_diagnosis')->nullable();
            $table->string('indikasi_tindakan')->nullable();
            $table->string('alternatif')->nullable();
            $table->string('checklist')->nullable();
            $table->string('pengampu')->nullable();
            $table->string('tgl_lahir_pengampu')->nullable();
            $table->string('alamat_pengampu')->nullable();
            $table->integer('status_tindakan')->nullable();
            $table->string('hubungan')->nullable();
            $table->string('ttd_pengampu')->nullable();
            $table->dateTime('tanggal_diampu')->nullable();
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
        Schema::dropIfExists('smis_doc_informasi_tindakan_anestesi_sedasi');
    }
}
