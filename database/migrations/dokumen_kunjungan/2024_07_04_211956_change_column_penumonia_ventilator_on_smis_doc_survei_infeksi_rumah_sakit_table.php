<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnPenumoniaVentilatorOnSmisDocSurveiInfeksiRumahSakitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('smis_doc_survei_infeksi_rumah_sakit', function (Blueprint $table) {
            $table->renameColumn('penumonia_ventilator', 'pneumonia_ventilator')->default('')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
