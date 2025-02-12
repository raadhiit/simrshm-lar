<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmisDocDaftarPemberianObatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('smis_doc_daftar_pemberian_obat', function (Blueprint $table) {
            $table->id();
            $table->integer('id_dokumen');
            $table->string('tanggal');
            $table->text('list_pemberian_obat');
            $table->text('paraf');
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
        Schema::dropIfExists('smis_doc_daftar_pemberian_obat');
    }
}
