<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddKodeBpjsToSmisRgJadwalPoliTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('smis_rg_jadwal_poli', function (Blueprint $table) {
            $table->string("kodedokter_bpjs")->after("id")->nullable();
            $table->string("kodepoli_bpjs")->after("id")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('smis_rg_jadwal_poli', function (Blueprint $table) {
            //
        });
    }
}
