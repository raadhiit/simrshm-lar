<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMasalahKeperawatanToAskepIgd extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('smis_doc_dokumen_asesment_awal_keperawatan_igd', function (Blueprint $table) {
            $table->string('masalah_keperawatan', 64)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('smis_doc_dokumen_asesment_awal_keperawatan_igd', function (Blueprint $table) {
            //
        });
    }
}
