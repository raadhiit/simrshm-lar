<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTtvToAssesmenMedisGawatDarurat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('smis_doc_dokumen_asesment_awal_medis_gawat_darurat', function (Blueprint $table) {
            $table->string('td_keluar', 7)->nullable();
            $table->string('td_rr', 5)->nullable();
            $table->string('td_nadi', 5)->nullable();
            $table->string('td_suhu', 5)->nullable();
            $table->string('td_spo2', 5)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('smis_doc_dokumen_asesment_awal_medis_gawat_darurat', function (Blueprint $table) {
            //
        });
    }
}
