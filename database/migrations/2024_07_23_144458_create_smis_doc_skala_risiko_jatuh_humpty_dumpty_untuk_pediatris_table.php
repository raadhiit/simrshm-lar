<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmisDocSkalaRisikoJatuhHumptyDumptyUntukPediatrisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('smis_doc_skala_risiko_jatuh_humpty_dumpty_untuk_pediatris', function (Blueprint $table) {
            $table->id();
            $table->integer('id_dokumen')->unsigned();
            $table->integer('usia')->nullable();
            $table->integer('jenis_kelamin')->nullable();
            $table->integer('diagnosis')->nullable();
            $table->integer('gangguan_kognitif')->nullable();
            $table->integer('faktor_lingkungan')->nullable();
            $table->integer('pembedahan')->nullable();
            $table->integer('medikamentosa')->nullable();
            $table->integer('jumlah_skor')->nullable();
            $table->integer('id_verifikator')->unsigned();
            $table->string('nama_verifikator', 64);
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
        Schema::dropIfExists('smis_doc_skala_risiko_jatuh_humpty_dumpty_untuk_pediatris');
    }
}
