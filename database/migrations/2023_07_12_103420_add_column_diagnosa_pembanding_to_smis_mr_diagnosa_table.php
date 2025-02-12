<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnDiagnosaPembandingToSmisMrDiagnosaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('smis_mr_diagnosa', function (Blueprint $table) {
            $table->string('diagnosa_pembanding', 64)->default('');
            $table->string('kode_icd_diagnosa_pembanding', 10)->default('');
            $table->string('nama_diagnosa_pembanding', 128)->default('');
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
