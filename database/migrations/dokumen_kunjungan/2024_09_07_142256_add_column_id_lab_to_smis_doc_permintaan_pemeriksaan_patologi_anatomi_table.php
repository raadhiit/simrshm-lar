<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnIdLabToSmisDocPermintaanPemeriksaanPatologiAnatomiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('smis_doc_permintaan_pemeriksaan_patologi_anatomi', function (Blueprint $table) {
            $table->string('id_lab', 32)->after('id_dokumen')->default('0');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('smis_doc_permintaan_pemeriksaan_patologi_anatomi', function (Blueprint $table) {
            //
        });
    }
}
