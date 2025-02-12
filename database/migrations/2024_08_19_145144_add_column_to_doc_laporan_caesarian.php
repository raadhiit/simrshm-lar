<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToDocLaporanCaesarian extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('smis_doc_dokumen_laporan_caesarian', function (Blueprint $table) {
            $table->string('pra_bedah');
            $table->string('pasca_bedah');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('smis_doc_dokumen_laporan_caesarian', function (Blueprint $table) {
            //
        });
    }
}
