<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnFiksasiToSmisDocPermintaanPemeriksaanPatologiAnatomi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('smis_doc_permintaan_pemeriksaan_patologi_anatomi', function (Blueprint $table) {
            $table->string('fiksasi', 32)->default('')->after('lokasi_jaringan_tubuh');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('smis_doc_permintaan_pemeriksaan_patologi_anatomi', function (Blueprint $table) {
            //
        });
    }
}
