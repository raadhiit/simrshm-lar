<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDokumenKunjunganPasienTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dokumen_kunjungan_pasien', function (Blueprint $table) {
            $table->id();
            $table->string('noreg', 32);
            $table->string('nrm', 32);
            $table->string('nama_pasien', 64);
            $table->string('signature_pasien', 64);
            $table->date('tanggal');
            $table->string('nama_dokumen', 64);
            $table->tinyInteger('status')->unsigned();
            $table->integer('id_verifikator')->unsigned();
            $table->string('nama_verifikator', 64);
            $table->timestamp('tanggal_update');
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
        Schema::dropIfExists('dokumen_kunjungan_pasien');
    }
}
