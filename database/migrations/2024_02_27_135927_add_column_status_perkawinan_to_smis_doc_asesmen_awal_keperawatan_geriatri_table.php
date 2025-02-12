<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnStatusPerkawinanToSmisDocAsesmenAwalKeperawatanGeriatriTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('smis_doc_asesmen_awal_keperawatan_geriatri', function (Blueprint $table) {
            $table->string('status_perkawinan', 32)->default('')->after('tinggi_badan');
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
