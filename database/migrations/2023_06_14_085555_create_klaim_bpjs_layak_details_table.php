<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKlaimBpjsLayakDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('klaim_bpjs_layak_details', function (Blueprint $table) {
            $table->id();
            $table->integer('id_header');
            $table->string('no_sep');
            $table->date('tgl_verifikasi');
            $table->integer('biaya_rs');
            $table->integer('biaya_diajukan');
            $table->integer('biaya_disetujui');
            $table->string('id_detail_draft')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('klaim_bpjs_layak_details');
    }
}
