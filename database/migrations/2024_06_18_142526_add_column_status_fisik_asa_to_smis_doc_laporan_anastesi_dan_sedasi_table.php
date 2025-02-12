<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnStatusFisikAsaToSmisDocLaporanAnastesiDanSedasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('smis_doc_laporan_anastesi_dan_sedasi', function (Blueprint $table) {
            $table->string('status_fisik_asa')->default('');
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
