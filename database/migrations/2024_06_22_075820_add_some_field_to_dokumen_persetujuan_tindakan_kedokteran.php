<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSomeFieldToDokumenPersetujuanTindakanKedokteran extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('smis__doc__persetujuan_atau__penolakan__tindakan__kedokterans', function (Blueprint $table) {
            $table->integer('id_dokter_pelaksana_tindakan')->unsigned();
            $table->string('dokter_pelaksana_tindakan', 128)->default('');
            $table->integer('id_pemberi_informasi')->unsigned();
            $table->string('pemberi_informasi', 128)->default('');
            $table->date('tanggal_formulir');
            $table->time('waktu_formulir');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('smis__doc__persetujuan_atau__penolakan__tindakan__kedokterans', function (Blueprint $table) {
            //
        });
    }
}
