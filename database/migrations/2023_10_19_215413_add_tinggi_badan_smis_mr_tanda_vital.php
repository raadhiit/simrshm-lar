<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTinggiBadanSmisMrTandaVital extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('smis_mr_tanda_vital', 'tinggi_badan')) {
            Schema::table('smis_mr_tanda_vital', function (Blueprint $table) {
                $table->string('tinggi_badan')->nullable()->after('berat_badan');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('smis_mr_tanda_vital', 'tinggi_badan')) {
            Schema::table('smis_mr_tanda_vital', function (Blueprint $table) {
                $table->dropColumn('tinggi_badan');
            });
        }
    }
}
