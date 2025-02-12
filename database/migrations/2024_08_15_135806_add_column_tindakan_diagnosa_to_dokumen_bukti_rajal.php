<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnTindakanDiagnosaToDokumenBuktiRajal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('smis_doc_bukti_pendaftaran_rawat_jalan', function (Blueprint $table) {
            $table->string('diagnosa', 128)->nullable();
            $table->string('tindakan', 128)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('smis_doc_bukti_pendaftaran_rawat_jalan', function (Blueprint $table) {
            //
        });
    }
}
