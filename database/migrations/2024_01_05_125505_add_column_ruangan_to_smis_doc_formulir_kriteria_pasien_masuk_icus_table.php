<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnRuanganToSmisDocFormulirKriteriaPasienMasukIcusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('smis_doc_formulir_kriteria_pasien_masuk_icus', function (Blueprint $table) {
            $table->string('ruangan', 128)->default('')->after('id_ttv');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('smis_doc_formulir_kriteria_pasien_masuk_icus', function (Blueprint $table) {
            //
        });
    }
}
