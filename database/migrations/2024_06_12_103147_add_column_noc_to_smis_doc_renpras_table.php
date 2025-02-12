<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnNocToSmisDocRenprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('smis_doc_renpras', function (Blueprint $table) {
            $table->json('noc')->nullable()->after('lama_tindakan');
            $table->text('ket_intervensi')->nullable()->after('intervensi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('smis_doc_renpras', function (Blueprint $table) {
            //
        });
    }
}
