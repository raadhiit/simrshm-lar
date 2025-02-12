<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSomeFieldToDokumenKunjunganPasien extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dokumen_kunjungan_pasien', function (Blueprint $table) {
            $table->string('signature_statement', 64);
            $table->string('signature_saksi_satu', 64);
            $table->string('signature_saksi_dua', 64);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dokumen_kunjungan_pasien', function (Blueprint $table) {
            //
        });
    }
}
