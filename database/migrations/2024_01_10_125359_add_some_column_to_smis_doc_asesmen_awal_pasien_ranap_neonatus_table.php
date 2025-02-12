<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSomeColumnToSmisDocAsesmenAwalPasienRanapNeonatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('smis_doc_asesmen_awal_pasien_ranap_neonatus', function (Blueprint $table) {
            $table->text('spiritual');
            $table->text('status_psikologis');
            $table->string('skrining_nyeri')->default('');
            $table->string('skrining_resiko_cedera',10)->default('');
            $table->text('kebutuhan_komunikasi');
            $table->text('kebutuhan_privasi_orang_tua');
            $table->text('skrining_gizi');
            $table->text('daftar_masalah_keperawatan');
            $table->text('rencana_perawatan');
            $table->text('perencanaan_perawatan');
            $table->text('perencanaan_pulang');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('smis_doc_asesmen_awal_pasien_ranap_neonatus', function (Blueprint $table) {
            //
        });
    }
}
