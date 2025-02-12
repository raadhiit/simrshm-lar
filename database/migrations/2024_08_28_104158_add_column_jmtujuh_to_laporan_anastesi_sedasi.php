<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnJmtujuhToLaporanAnastesiSedasi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('smis_doc_laporan_anastesi_dan_sedasi', function (Blueprint $table) {
            $table->string('jm_tujuh', 32)->nullable();
            $table->string('jm_delapan', 32)->nullable();
            $table->string('jm_sembilan', 32)->nullable();
            $table->string('jm_sepuluh', 32)->nullable();
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
