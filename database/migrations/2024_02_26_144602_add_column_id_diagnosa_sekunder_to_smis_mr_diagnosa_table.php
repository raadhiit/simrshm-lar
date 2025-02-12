<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnIdDiagnosaSekunderToSmisMrDiagnosaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('smis_mr_diagnosa', function (Blueprint $table) {
            $table->string('id_diagnosa_primer')->default('');
            $table->string('id_diagnosa_sekunder1')->default('');
            $table->string('id_diagnosa_sekunder2')->default('');
            $table->string('id_diagnosa_sekunder3')->default('');
            $table->string('id_diagnosa_sekunder4')->default('');
            $table->string('id_diagnosa_sekunder5')->default('');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
    }
}
