<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnDpjpToSmisDocCatatanPerkembanganPasienTerintegrasiRawatInapTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('smis_doc_catatan_perkembangan_pasien_terintegrasi_rawat_inap', function (Blueprint $table) {
            $table->integer('id_dpjp')->default(0);
            $table->string('nama_dpjp', 64)->default('');
            $table->text('catatan_dpjp')->default('');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('smis_doc_catatan_perkembangan_pasien_terintegrasi_rawat_inap', function (Blueprint $table) {
            //
        });
    }
}
