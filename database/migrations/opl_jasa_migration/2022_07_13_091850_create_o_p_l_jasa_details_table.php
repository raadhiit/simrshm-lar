<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOPLJasaDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('o_p_l_jasa_details', function (Blueprint $table) {
            $table->id();
            $table->integer('id_header');
            $table->string('prop', 10);
            $table->string('kode_barang', 12);
            $table->string('nama_barang');
            $table->string('jenis_barang');
            $table->string('jumlah_dipesan', 12);
            $table->string('satuan');
            $table->string('hna', 12);
            $table->string('diskon', 12);
            $table->string('subtotal', 12);
            $table->string('konversi');
            $table->string('satuan_konversi');
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
        Schema::dropIfExists('o_p_l_jasa_details');
    }
}
