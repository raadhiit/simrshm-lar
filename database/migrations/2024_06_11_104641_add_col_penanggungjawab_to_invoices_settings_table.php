<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColPenanggungjawabToInvoicesSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('invoice_settings', function (Blueprint $table) {
            $table->string('nama_penanggungjawab')->after('nama_perusahaan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('invoice_settings', function (Blueprint $table) {
            $table->dropColumn('nama_penanggungjawab');
        });
    }
}
