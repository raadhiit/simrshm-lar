<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToSmisMrDiagnosaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('smis_mr_diagnosa', function (Blueprint $table) {
            $table->string('diagnosa_pra_bedah', 64)->default('');
            $table->string('kode_icd_diagnosa_pra_bedah', 10)->default('');
            $table->string('nama_diagnosa_pra_bedah', 128)->default('');
            $table->string('diagnosa_pasca_bedah', 64)->default('');
            $table->string('kode_icd_diagnosa_pasca_bedah', 10)->default('');
            $table->string('nama_diagnosa_pasca_bedah', 128)->default('');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('smis_mr_diagnosa', function (Blueprint $table) {
            //
        });
    }
}
