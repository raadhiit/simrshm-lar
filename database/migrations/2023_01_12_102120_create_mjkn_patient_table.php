<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMjknPatientTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mjkn_patient', function (Blueprint $table) {
            $table->id();
            $table->string('nrm',32);
            $table->string('nik',32);
            $table->string('no_kk',32);
            $table->string('nobpjs',64);
            $table->string('nama',64);
            $table->tinyInteger('kelamin')->unsigned();
            $table->date('tgl_lahir');
            $table->string('telepon',20);
            $table->string('alamat');
            $table->integer('id_propinsi')->unsigned();
            $table->string('propinsi',64);
            $table->integer('id_kabupaten')->unsigned();
            $table->string('kabupaten',64);
            $table->integer('id_kecamatan')->unsigned();
            $table->string('kecamatan',64);
            $table->integer('id_kelurahan')->unsigned();
            $table->string('kelurahan',64);
            $table->string('rt',10);
            $table->string('rw',10);
            $table->string('origin_updated',64);
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
        Schema::dropIfExists('mjkn_patient');
    }
}
