<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToFormulirLayananKedokteranFisikRehabilitasis extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('formulir_layanan_kedokteran_fisik_rehabilitasis', function (Blueprint $table) {
            $table->string('suami', 32)->nullable();
            $table->string('anak', 32)->nullable();
            $table->string('tanggal_dokumen', 32)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('formulir_layanan_kedokteran_fisik_rehabilitasis', function (Blueprint $table) {
            //
        });
    }
}
