<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmisDocObservasiBayiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('smis_doc_observasi_bayi', function (Blueprint $table) {
            $table->id();
            $table->integer('id_dokumen')->unsigned();
            $table->string('bb', 64);
            $table->string('pb', 64);
            $table->date('tanggal');
            $table->string('jam', 10);
            $table->string('suhu', 10);
            $table->string('rr', 10);
            $table->string('nadi', 10);
            $table->string('minum');
            $table->string('muntah');
            $table->string('meco');
            $table->string('miksi');
            $table->string('keterangan');
            $table->integer('id_perawat')->unsigned();
            $table->string('perawat', 64);
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
