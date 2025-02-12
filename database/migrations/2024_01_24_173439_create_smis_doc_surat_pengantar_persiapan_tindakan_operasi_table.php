<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmisDocSuratPengantarPersiapanTindakanOperasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('smis_doc_surat_pengantar_persiapan_tindakan_operasi', function (Blueprint $table) {
            $table->id();
            $table->integer('id_dokumen')->unsigned();
            $table->text('atas_indikasi');
            $table->text('tindakan');
            $table->date('tanggal');
            $table->integer('ranap')->unsigned();
            $table->integer('tidak_dirawat')->unsigned();
            $table->string('pemeriksaan_penunjang');
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
        
    }
}
