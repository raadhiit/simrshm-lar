<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmisDocCatatanEdukasiPasienTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('smis_doc_catatan_edukasi_pasien', function (Blueprint $table) {
            $table->id();
            $table->integer('id_dokumen')->unsigned();
            $table->string('bahasa', '100');
            $table->string('bahasa_lainnya', '100');
            $table->string('penerjemah', '100');
            $table->string('penerjemah_lainnya', '100');
            $table->string('pendidikan', '100');
            $table->string('pendidikan_lainnya', '100');
            $table->string('baca_tulis', '100');
            $table->string('pembelajaran', '100');
            $table->string('pembelajaran_lainnya', '100');
            $table->string('hambatan_edukasi', '100');
            $table->string('hambatan_edukasi_lainnya', '100');
            $table->string('menerima_edukasi', '100');
            $table->string('metode_edukasi', '100');
            $table->string('metode_edukasi_lainnya', '100');
            $table->string('evaluasi_edukasi', '100');
            $table->string('topik_edukasi_a', '100');
            $table->string('topik_edukasi_b', '100');
            $table->string('topik_edukasi_c', '100');
            $table->string('topik_edukasi_d', '100');
            $table->string('topik_edukasi_e', '100');
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
        Schema::dropIfExists('smis_doc_catatan_edukasi_pasien');
    }
}
