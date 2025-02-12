<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeSomeColumnLengthOnSmisDocCatatanPerkembanganPasienTerintegrasiRawatInapTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('smis_doc_catatan_perkembangan_pasien_terintegrasi_rawat_inap', function (Blueprint $table) {
            $table->text('subjective')->change();
            $table->text('objective_lain')->change();
            $table->text('asesmen')->change();
            $table->text('catatan_asesmen')->change();
            $table->text('planning')->change();
            $table->text('tindak_lanjut')->change();
            $table->text('instruksi')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
