<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmisDocPersetujuanTransfusiDarahTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('smis_doc_persetujuan_transfusi_darah', function (Blueprint $table) {
            $table->id();
            $table->integer('id_dokumen')->unsigned();
            $table->integer('id_dokter_pelaksana')->nullable();
            $table->integer('id_pemberi_informasi')->nullable();
            $table->string('penerima_informasi')->nullable();
            $table->integer('id_diagnosis')->nullable();
            $table->string('alternatif')->nullable();
            $table->string('lain_lain')->nullable();
            $table->string('checklist')->nullable();
            $table->string('pengampu')->nullable();
            $table->string('alamat_pengampu')->nullable();
            $table->string('alamat_pasien')->nullable();
            $table->integer('status_tindakan')->nullable();
            $table->string('hubungan')->nullable();
            $table->string('ttd_pengampu')->nullable();
            $table->string('username_ttd_dokter')->nullable();
            $table->string('nama_keluarga')->nullable();
            $table->string('ttd_keluarga')->nullable();
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
        Schema::dropIfExists('smis_doc_persetujuan_transfusi_darah');
    }
}
