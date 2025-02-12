<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnIsianDrToSmisDocCatatanPerkembanganPasienTerintegrasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('smis_doc_catatan_perkembangan_pasien_terintegrasi', function (Blueprint $table) {
            $table->datetime('tanggal_dr')->nullable();
            $table->integer('id_ppa_dr')->default(0);
            $table->string('ppa_dr')->default('');
            $table->string('subjective_dr')->default('');
            $table->string('dokumen_penunjang')->default('');
            $table->string('tindak_lanjut_dr')->default('');
            $table->string('instruksi_dr')->default('');
            $table->integer('status_dr')->default(0);
            $table->integer('id_verifikator_dr')->default(0)->unsgined();
            $table->string('nama_verifikator_dr',128)->default('');
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
