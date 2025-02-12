<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->integer('id_vendor');
            $table->string('no_invoice');
            $table->string('prop', 10);
            $table->string('tanggal');
            $table->string('kode_vendor');
            $table->string('nama_vendor');
            $table->string('alamat')->nullable();
            $table->string('kode_rekanan')->nullable();
            $table->string('inc_ppn', 12)->nullable();
            $table->tinyInteger('ppn')->nullable();
            $table->integer('pph')->nullable();
            $table->integer('jml_pph')->nullable();
            $table->integer('total');
            $table->integer('jml_ppn');
            $table->integer('jml_bayar');
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
        Schema::dropIfExists('invoices');
    }
}
