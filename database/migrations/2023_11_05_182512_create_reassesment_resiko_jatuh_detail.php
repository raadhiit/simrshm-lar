<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReassesmentResikoJatuhDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reassesment_resiko_jatuh_detail', function (Blueprint $table) {
            $table->id();

            $table->integer('id_dokumen')->unsigned();
            $table->integer('idx')->unsigned();
            $table->string('jenis', 100);
            $table->string('parameter', 200);

            $table->datetime('TanggalJam1')->nullable();
            $table->datetime('TanggalJam2')->nullable();
            $table->datetime('TanggalJam3')->nullable();
            $table->datetime('TanggalJam4')->nullable();
            $table->datetime('TanggalJam5')->nullable();

            $table->integer('P1')->nullable();
            $table->integer('P2')->nullable();
            $table->integer('P3')->nullable();
            $table->integer('P4')->nullable();
            $table->integer('P5')->nullable();

            $table->integer('S1')->nullable();
            $table->integer('S2')->nullable();
            $table->integer('S3')->nullable();
            $table->integer('S4')->nullable();
            $table->integer('S5')->nullable();

            $table->integer('M1')->nullable();
            $table->integer('M2')->nullable();
            $table->integer('M3')->nullable();
            $table->integer('M4')->nullable();
            $table->integer('M5')->nullable();

            $table->string('verifikatorP1')->nullable();
            $table->string('verifikatorP2')->nullable();
            $table->string('verifikatorP3')->nullable();
            $table->string('verifikatorP4')->nullable();
            $table->string('verifikatorP5')->nullable();

            $table->string('verifikatorS1')->nullable();
            $table->string('verifikatorS2')->nullable();
            $table->string('verifikatorS3')->nullable();
            $table->string('verifikatorS4')->nullable();
            $table->string('verifikatorS5')->nullable();

            $table->string('verifikatorM1')->nullable();
            $table->string('verifikatorM2')->nullable();
            $table->string('verifikatorM3')->nullable();
            $table->string('verifikatorM4')->nullable();
            $table->string('verifikatorM5')->nullable();

            $table->integer('statusP1')->nullable();
            $table->integer('statusP2')->nullable();
            $table->integer('statusP3')->nullable();
            $table->integer('statusP4')->nullable();
            $table->integer('statusP5')->nullable();

            $table->integer('statusS1')->nullable();
            $table->integer('statusS2')->nullable();
            $table->integer('statusS3')->nullable();
            $table->integer('statusS4')->nullable();
            $table->integer('statusS5')->nullable();

            $table->integer('statusM1')->nullable();
            $table->integer('statusM2')->nullable();
            $table->integer('statusM3')->nullable();
            $table->integer('statusM4')->nullable();
            $table->integer('statusM5')->nullable();

            $table->integer('tipe');

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
        Schema::dropIfExists('reassesment_resiko_jatuh_detail');
    }
}
