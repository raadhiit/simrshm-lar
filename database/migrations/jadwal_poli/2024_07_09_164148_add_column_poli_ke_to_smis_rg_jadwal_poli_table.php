<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnPoliKeToSmisRgJadwalPoliTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('smis_rg_jadwal_poli', function (Blueprint $table) {
            $table->string('poli_ke', 1)->default('');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('smis_rg_jawal_poli', function (Blueprint $table) {
            //
        });
    }
}
