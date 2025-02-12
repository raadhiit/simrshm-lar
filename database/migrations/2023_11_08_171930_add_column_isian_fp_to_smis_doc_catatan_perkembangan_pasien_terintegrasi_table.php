<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnIsianFpToSmisDocCatatanPerkembanganPasienTerintegrasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('smis_doc_catatan_perkembangan_pasien_terintegrasi', function (Blueprint $table) {
            $table->datetime('tanggal_fp')->nullable();
            $table->integer('id_ppa_fp')->default(0);
            $table->string('ppa_fp')->default('');
            $table->string('subjective_fp')->default('');
            $table->string('objective_fp')->default('');
            $table->string('asesmen_fp')->default('');
            $table->string('planning_fp')->default('');
            $table->string('instruksi_fp')->default('');
            $table->integer('status_fp')->default(0);
            $table->integer('id_verifikator_fp')->default(0)->unsgined();
            $table->string('nama_verifikator_fp',128)->default('');
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
