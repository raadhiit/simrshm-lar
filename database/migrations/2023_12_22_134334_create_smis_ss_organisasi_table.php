<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmisSsOrganisasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('smis_ss_organisasi', function (Blueprint $table) {
            $table->id();
            $table->string('id_organisasi')->default('');
            $table->string('tipe');
            $table->string('nama');
            $table->tinyInteger('aktif')->unsigned();
            $table->string('telepon', 32);
            $table->string('email', 32);
            $table->string('alamat');
            $table->string('part_of');
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
        Schema::dropIfExists('smis_ss_organisasi');
    }
}
