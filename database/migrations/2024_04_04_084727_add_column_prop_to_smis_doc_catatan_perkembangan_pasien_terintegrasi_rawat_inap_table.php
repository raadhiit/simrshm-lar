<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnPropToSmisDocCatatanPerkembanganPasienTerintegrasiRawatInapTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('smis_doc_catatan_perkembangan_pasien_terintegrasi_rawat_inap', function (Blueprint $table) {
            $table->string('prop', 10)->default('')->after('id');
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
