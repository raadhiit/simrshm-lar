<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSomeColumnToSmisDocAsesmenAwalKeperawatanGeriatriTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('smis_doc_asesmen_awal_keperawatan_geriatri', function (Blueprint $table) {
            $table->text('eliminasi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('smis_doc_asesmen_awal_keperawatan_geriatri', function (Blueprint $table) {
            //
        });
    }
}
