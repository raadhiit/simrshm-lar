<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoaderBpjsDiverifikasiDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loader_bpjs_diverifikasi_details', function (Blueprint $table) {
            $table->id();
            $table->integer('id_header');
            $table->integer('kelas_rawat');
            $table->integer('ptd');
            $table->date('admission_date');
            $table->date('discharge_date');
            $table->date('birth_date');
            $table->string('nama_pasien');
            $table->integer('mrn');
            $table->integer('umur_tahun');
            $table->string('dpjp');
            $table->string('sep');
            $table->integer('noreg')->nullable();
            $table->string('inacbgs')->nullable();
            $table->integer('plafon_bpjs')->nullable();
            $table->integer('total_hpp')->nullable();
            $table->integer('selisih')->nullable();
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
        Schema::dropIfExists('loader_bpjs_diverifikasi_details');
    }
}
