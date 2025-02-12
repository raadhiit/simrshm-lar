<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmisDocFormulirPenandaanLokasiOperasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('smis_doc_formulir_penandaan_lokasi_operasi', function (Blueprint $table) {
            $table->id();
            $table->integer('id_dokumen')->unsigned();
            $table->string('prosedur');
            $table->date('tanggal');
            $table->text('lokasi_operasi');
            $table->string('nama', 64);
            $table->text('tanda_tangan');
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
        Schema::dropIfExists('smis_doc_formulir_penandaan_lokasi_operasi');
    }
}
