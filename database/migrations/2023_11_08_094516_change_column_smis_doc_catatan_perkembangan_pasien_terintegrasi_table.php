<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnSmisDocCatatanPerkembanganPasienTerintegrasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('smis_doc_catatan_perkembangan_pasien_terintegrasi', function (Blueprint $table) {
            $table->string('active_form')->default('')->after('id_dokumen'); 
            $table->dateTime('tanggal_ns')->nullable()->after('active_form');
            $table->renameColumn('subyektif', 'subjective_ns');
            $table->string('asesmen_ns')->default('');
            $table->string('planning_ns')->default('')->after('asesmen_ns');
            $table->renameColumn('instruksi_kesehatan', 'instruksi_ns');
            $table->integer('status_ns')->default(0)->unsgined();
            $table->integer('id_verifikator_ns')->default(0)->unsgined()->after('status_ns');
            $table->string('nama_verifikator_ns',128)->default('')->after('id_verifikator_ns');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
