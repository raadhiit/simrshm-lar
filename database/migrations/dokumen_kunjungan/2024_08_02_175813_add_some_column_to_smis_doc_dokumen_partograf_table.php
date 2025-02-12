<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSomeColumnToSmisDocDokumenPartografTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('smis_doc_partograf', function (Blueprint $table) {
            $table->text('ketuban_penyusupan')->nullable();
            $table->text('denyut_jantung_janin')->nullable();
            $table->text('pembukaan_serviks')->nullable();
            $table->text('obat_dan_cairan')->nullable();
            $table->text('suhu')->nullable();
            $table->text('urin')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('smis_doc_partograf', function (Blueprint $table) {
            //
        });
    }
}
