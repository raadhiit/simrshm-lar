<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmisDocFormulirSerahTerimaBayiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('smis_doc_formulir_serah_terima_bayi', function (Blueprint $table) {
            $table->id();
            $table->integer('id_dokumen')->unsigned();
            $table->string('nama_ibu', 64)->nullable();
            $table->string('nama_ayah', 64)->nullable();
            $table->string('bb_saat_pulang', 64)->nullable();
            $table->string('hari_control', 64)->nullable();
            $table->string('tgl_control', 64)->nullable();
            $table->string('jk', 64)->nullable();
            $table->string('checklist_satu', 64)->nullable();
            $table->string('checklist_dua', 64)->nullable();
            $table->string('checklist_tiga', 64)->nullable();
            $table->string('checklist_empat', 64)->nullable();
            $table->string('checklist_lima', 64)->nullable();
            $table->string('checklist_enam', 64)->nullable();
            $table->string('checklist_tujuh', 64)->nullable();
            $table->string('checklist_delapan', 64)->nullable();
            $table->string('checklist_sembilan', 64)->nullable();
            $table->string('checklist_sepuluh', 64)->nullable();
            $table->string('nama_dokter', 64)->nullable();
            $table->string('hari_dokumen', 64)->nullable();
            $table->string('tgl_dokumen', 64)->nullable();
            $table->string('jam_dokumen', 64)->nullable();
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
        Schema::dropIfExists('smis_doc_formulir_serah_terima_bayi');
    }
}
