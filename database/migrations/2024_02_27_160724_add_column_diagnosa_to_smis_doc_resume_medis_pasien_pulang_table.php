<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnDiagnosaToSmisDocResumeMedisPasienPulangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('smis_doc_resume_medis_pasien_pulang', function (Blueprint $table) {
            $table->string('diagnosa_primer', 128)->default('');
            $table->string('icd_primer', 10)->default('');
            $table->string('diagnosa_sekunder', 128)->default('');
            $table->string('icd_sekunder', 10)->default('');
            $table->text('tindakan_prosedur')->default('');
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
