<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToSmisDocPartografTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('smis_doc_partograf', function (Blueprint $table) {
            $table->renameColumn('ketuban_penyusupan', 'ketuban');
            $table->text('penyusupan')->nullable();
            $table->text('tetes_menit')->nullable();
            $table->text('oksilosin')->nullable();
            $table->text('kontraksi')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('smis_doc_partograf', function (Blueprint $table) {
            //
        });
    }
}
