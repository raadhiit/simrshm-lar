<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumToLaporanCaesarian extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('smis_doc_dokumen_laporan_caesarian', function (Blueprint $table) {
            $table->string('ket_antisepsis', 32)->nullable();
            $table->string('ket_insisi', 32)->nullable();
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
