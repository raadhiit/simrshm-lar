<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSomeFieldToFormulirTriageTerintegrasi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('smis_doc_formulir_triage_terintegrasi', function (Blueprint $table) {
            $table->string('checkbox_diagnosa')->nullable();
            $table->string('checkbox_emergent')->nullable();
            $table->string('checkbox_urgent')->nullable();
            $table->string('checkbox_not_urgent')->nullable();
            $table->string('checkbox_false_emergency')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('smis_doc_formulir_triage_terintegrasi', function (Blueprint $table) {
            //
        });
    }
}
