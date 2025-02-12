<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmisDocDaftarKontrolIstimewaPasienDmTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('smis_doc_daftar_kontrol_istimewa_pasien_dm', function (Blueprint $table) {
            $table->id();
            $table->integer('id_dokumen');
            $table->string('no_kamar', 32);
            $table->integer('id_dpjp');
            $table->string('dpjp', 128);
            $table->text('list_data');
            $table->string('nilai_normal', 32);
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
        Schema::dropIfExists('smis_doc_daftar_kontrol_istimewa_pasien_dm');
    }
}
