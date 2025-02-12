<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnGcsAndAddColumnKesadaranToSmisDocDokumenTransferPasienInternalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('smis_doc_dokumen_transfer_pasien_internal', function (Blueprint $table) {
            $table->renameColumn('e_kesadaran', 'gcs_e');
            $table->renameColumn('v_kesadaran', 'gcs_v');
            $table->renameColumn('m_kesadaran', 'gcs_m');
            $table->string('kesadaran', 64)->default('');
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
