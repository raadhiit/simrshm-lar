<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmisDocGeneralConsentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('smis_doc_general_consent', function (Blueprint $table) {
            $table->id();
            $table->integer('id_dokumen')->unsigned();
            $table->string('nama', 64);
            $table->string('alamat',255);
            $table->string('telpon', 20);
            $table->string('no_identitas', 20);
            $table->date('tgl_lahir');
            $table->string('pi_satu', 64)->default('');
            $table->string('pi_dua', 64)->default('');
            $table->string('pi_tiga', 64)->default('');
            $table->string('hubungan_satu', 64)->default('');
            $table->string('hubungan_dua', 64)->default('');
            $table->string('hubungan_tiga', 64)->default('');
            $table->integer('mengijinkan')->unsigned();
            $table->string('keterangan_mengijinkan', 64);
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
        Schema::dropIfExists('smis_doc_general_consent');
    }
}
