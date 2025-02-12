<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnTglKeluarToSmisDocResumeMedisPasienPulangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('smis_doc_resume_medis_pasien_pulang', function (Blueprint $table) {
            $table->string('tgl_keluar')->default('');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('smis_doc_resume_medis_pasien_pulang', function (Blueprint $table) {
            //
        });
    }
}
