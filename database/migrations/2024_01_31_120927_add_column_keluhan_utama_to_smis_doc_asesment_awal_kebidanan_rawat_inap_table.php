<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnKeluhanUtamaToSmisDocAsesmentAwalKebidananRawatInapTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('smis_doc_asesmen_awal_kebidanan_rawat_inap', function (Blueprint $table) {
            $table->text('keluhan_utama')->after('riwayat_alergi_ada');
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
