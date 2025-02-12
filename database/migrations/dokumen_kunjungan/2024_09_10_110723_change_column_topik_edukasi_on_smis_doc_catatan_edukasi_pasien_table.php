<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnTopikEdukasiOnSmisDocCatatanEdukasiPasienTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('smis_doc_catatan_edukasi_pasien', function (Blueprint $table) {
            $table->text('topik_edukasi_a')->nullable()->change();
            $table->text('topik_edukasi_b')->nullable()->change();
            $table->text('topik_edukasi_c')->nullable()->change();
            $table->text('topik_edukasi_d')->nullable()->change();
            $table->text('topik_edukasi_e')->nullable()->change();
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
