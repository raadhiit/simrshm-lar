<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnIdPesananLabDanIdPesananRadToSmisDocCatatanPerkembanganPasienTerintegrasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('smis_doc_catatan_perkembangan_pasien_terintegrasi', function (Blueprint $table) {
            $table->integer('id_pesanan_lab')->default(0)->after('id_dokumen');
            $table->integer('id_pesanan_rad')->default(0)->after('id_pesanan_lab');
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
