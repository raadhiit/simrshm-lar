<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmisDocCatatanPerkembanganPasienTerintegrasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('smis_doc_catatan_perkembangan_pasien_terintegrasi', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_dokumen');
            $table->integer('id_ppa');
            $table->string('ppa', 64);
            $table->text('subyektif');
            $table->text('instruksi_kesehatan');
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
        Schema::dropIfExists('smis_doc_catatan_perkembangan_pasien_terintegrasi');
    }
}
