<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColsErmResumeMedis extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('smis_doc_resume_medis_pasien_pulang', function (Blueprint $table) {
            $table->string('pemeriksaan_lainnya')->default("");
            $table->string('diagnosa_sekunder2')->default("");
            $table->string('icd_sekunder2')->default("");
            $table->string('diagnosa_sekunder3')->default("");
            $table->string('icd_sekunder3')->default("");
            $table->string('diagnosa_sekunder4')->default("");
            $table->string('icd_sekunder4')->default("");
            $table->string('diagnosa_sekunder5')->default("");
            $table->string('icd_sekunder5')->default("");

            $table->string('diagnosa_penyerta1')->default("");
            $table->string('icd_penyerta1')->default("");
            $table->string('diagnosa_penyerta2')->default("");
            $table->string('icd_penyerta2')->default("");
            $table->string('diagnosa_penyerta3')->default("");
            $table->string('icd_penyerta3')->default("");
            $table->string('diagnosa_penyerta4')->default("");
            $table->string('icd_penyerta4')->default("");
            $table->string('diagnosa_penyerta5')->default("");
            $table->string('icd_penyerta5')->default("");
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
            $table->dropColumn([
                'pemeriksaan_lainnya',
                'diagnosa_sekunder2',
                'icd_sekunder2',
                'diagnosa_sekunder3',
                'icd_sekunder3',
                'diagnosa_sekunder4',
                'icd_sekunder4',
                'diagnosa_sekunder5',
                'icd_sekunder5',
                'diagnosa_penyerta1',
                'icd_penyerta1',
                'diagnosa_penyerta2',
                'icd_penyerta2',
                'diagnosa_penyerta3',
                'icd_penyerta3',
                'diagnosa_penyerta4',
                'icd_penyerta4',
                'diagnosa_penyerta5',
                'icd_penyerta5'
            ]);
        });
    }
}
