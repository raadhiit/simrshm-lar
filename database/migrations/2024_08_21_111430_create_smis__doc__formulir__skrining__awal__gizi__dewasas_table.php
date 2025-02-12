<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmisDocFormulirSkriningAwalGiziDewasasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('smis__doc__formulir__skrining__awal__gizi__dewasas', function (Blueprint $table) {
            $table->id();
            $table->integer('id_dokumen')->unsigned();
            $table->integer('penurunan_satu')->nullable();
            $table->integer('penurunan_dua')->nullable();
            $table->integer('penurunan_tiga')->nullable();
            $table->integer('penurunan_empat')->nullable();
            $table->integer('penurunan_lima')->nullable();
            $table->integer('penurunan_enam')->nullable();
            $table->integer('penurunan_tujuh')->nullable();
            $table->integer('penurunan_delapan')->nullable();
            $table->integer('penurunan_sembilan')->nullable();
            $table->integer('total')->nullable();
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
        Schema::dropIfExists('smis__doc__formulir__skrining__awal__gizi__dewasas');
    }
}
