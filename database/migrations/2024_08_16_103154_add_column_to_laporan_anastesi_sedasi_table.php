<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToLaporanAnastesiSedasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('smis_doc_laporan_anastesi_dan_sedasi', function (Blueprint $table) {
            $table->string('jm_satu', 128)->nullable();
            $table->string('jm_dua', 128)->nullable();
            $table->string('jm_tiga', 128)->nullable();
            $table->string('jm_empat', 128)->nullable();
            $table->string('jm_lima', 128)->nullable();
            $table->string('jm_enam', 128)->nullable();
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
