<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTindakanperawatdokterToTransferPasienInternal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('smis_doc_dokumen_transfer_pasien_internal', function (Blueprint $table) {
            $table->text('tindakan_dokter', 64)->nullable();
            $table->text('tindakan_perawat', 64)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('smis_doc_dokumen_transfer_pasien_internal', function (Blueprint $table) {
            //
        });
    }
}
