<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddComeColumnToAntriansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('antrians', function (Blueprint $table) {
            $table->string('kedatangan', 32)->after('telppj');
            $table->string('jenis_perujuk', 64)->default('')->after('kedatangan');
            $table->tinyInteger('id_perujuk')->default(0)->after('jenis_perujuk');
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
