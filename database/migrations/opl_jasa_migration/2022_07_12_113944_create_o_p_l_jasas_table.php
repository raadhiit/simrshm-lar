<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOPLJasasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('o_p_l_jasas', function (Blueprint $table) {
            $table->id();
            $table->integer('id_vendor');
            $table->string('no_opl');
            $table->string('prop', 10);
            $table->string('tanggal');
            $table->string('kode_vendor');
            $table->string('nama_vendor');
            $table->string('alamat')->nullable();
            $table->string('kode_rekanan')->nullable();
            $table->string('inc_ppn', 12)->nullable();
            $table->tinyInteger('ppn')->nullable();
            $table->integer('total');
            $table->integer('jml_ppn');
            $table->integer('jml_bayar');
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
        Schema::dropIfExists('o_p_l_jasas');
    }
}
