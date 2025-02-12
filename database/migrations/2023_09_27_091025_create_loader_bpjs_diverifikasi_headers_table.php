<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoaderBpjsDiverifikasiHeadersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loader_bpjs_diverifikasi_headers', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_jurnal');
            $table->string('bulan_klaim');
            $table->tinyInteger('jenis_layanan')->default(0);
            $table->string('prop')->default('');
            $table->timestamp('tanggal_upload')->nullable();
            $table->string('user_upload')->nullable();
            $table->timestamp('tanggal_hapus')->nullable();
            $table->string('user_hapus')->nullable();
            $table->integer('id_draft_jurnal')->nullable();
            $table->string('user_generate')->nullable();
            $table->timestamp('tanggal_generate')->nullable();
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
        Schema::dropIfExists('loader_bpjs_diverifikasi_headers');
    }
}
