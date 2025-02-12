<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnSejawatToSmisDocLembarKonsultasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('smis_doc_lembar_konsultasi', function (Blueprint $table) {
            $table->string('sejawat', 64)->after('kepada')->default('');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('smis_doc_lembar_konsultasi', function (Blueprint $table) {
            //
        });
    }
}
