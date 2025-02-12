<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnIdPerawatAndNamaPerawatToSmisDocAsesmenAwalPasienRanapPetriadikTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('smis_doc_asesmen_awal_pasien_ranap_petriadik', function (Blueprint $table) {
            $table->integer('id_perawat')->default(0);
            $table->string('nama_perawat_verif', 64)->default('');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('smis_doc_asesmen_awal_pasien_ranap_petriadik', function (Blueprint $table) {
            //
        });
    }
}
