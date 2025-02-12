<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnIdDiagnosaToSmisDocDokumenAsesmentAwalMedisGawatDarurat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('smis_doc_dokumen_asesment_awal_medis_gawat_darurat', function (Blueprint $table) {
            $table->integer('id_diagnosa')->defuaflt(0)->after('id_dokumen');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('smis_doc_dokumen_asesment_awal_medis_gawat_darurat', function (Blueprint $table) {
            //
        });
    }
}
