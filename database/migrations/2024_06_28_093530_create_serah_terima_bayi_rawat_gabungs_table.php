<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSerahTerimaBayiRawatGabungsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('serah_terima_bayi_rawat_gabungs', function (Blueprint $table) {
            $table->id();
            $table->integer("id_dokumen");
            $table->string("nama_mengetahui");
            $table->string("ttd_mengetahui");
            $table->string("nama_menerima");
            $table->string("ttd_menerima");
            $table->string("petugas");
            $table->string("penerima_bayi");
            $table->string("nama_bayi");
            $table->string("diagnosa");
            $table->string("umur", 32);
            $table->tinyInteger("jenis_kelamin");
            $table->date("tgl_lahir");
            $table->dateTime("tgl_penyerahan");
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
        Schema::dropIfExists('serah_terima_bayi_rawat_gabungs');
    }
}
