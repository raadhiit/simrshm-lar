<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterSmisDocSuratPernyataanPenitipanKelasUpdateTanggal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // alter update column to nullable using raw query
        DB::statement("ALTER TABLE smis_doc_surat_pernyataan_penitipan_kelas MODIFY tanggal DATE NULL DEFAULT NULL AFTER signature_saksi");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // alter update column to not nullable using raw query
        DB::statement("ALTER TABLE smis_doc_surat_pernyataan_penitipan_kelas MODIFY tanggal DATE NOT NULL DEFAULT '0000-00-00' AFTER signature_saksi");
    }
}
