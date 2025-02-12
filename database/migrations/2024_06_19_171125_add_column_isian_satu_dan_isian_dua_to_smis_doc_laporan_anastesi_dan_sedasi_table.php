<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnIsianSatuDanIsianDuaToSmisDocLaporanAnastesiDanSedasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('smis_doc_laporan_anastesi_dan_sedasi', function (Blueprint $table) {
            $table->text('isian_satu');
            $table->text('isian_dua');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('smis_doc_laporan_anastesi_dan_sedasi', function (Blueprint $table) {
            //
        });
    }
}
