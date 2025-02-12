<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnIcdTindakanToSmisDocResumeMedisPasienPulangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('smis_doc_resume_medis_pasien_pulang', function (Blueprint $table) {
            $table->text('icd_tindakan')->default('');
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
