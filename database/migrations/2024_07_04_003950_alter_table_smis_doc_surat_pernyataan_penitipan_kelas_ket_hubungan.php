<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableSmisDocSuratPernyataanPenitipanKelasKetHubungan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('smis_doc_surat_pernyataan_penitipan_kelas', function (Blueprint $table) {
            $table->string('ket_hubungan', 64)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('smis_doc_surat_pernyataan_penitipan_kelas', function (Blueprint $table) {
            //
        });
    }
}
