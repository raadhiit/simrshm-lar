<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnIsianAptToSmisDocCatatanPerkembanganPasienTerintegrasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('smis_doc_catatan_perkembangan_pasien_terintegrasi', function (Blueprint $table) {
            $table->datetime('tanggal_apt')->nullable();
            $table->integer('id_ppa_apt')->default(0);
            $table->string('ppa_apt')->default('');
            $table->string('subjective_apt')->default('');
            $table->string('objective_apt')->default('');
            $table->string('asesmen_apt')->default('');
            $table->string('planning_apt')->default('');
            $table->string('instruksi_apt')->default('');
            $table->integer('status_apt')->default(0);
            $table->integer('id_verifikator_apt')->default(0)->unsgined();
            $table->string('nama_verifikator_apt',128)->default('');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
    }
}
