<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldToSmisDocDokumenAsesmentAwalKeperawatanIgdTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('smis_doc_dokumen_asesment_awal_keperawatan_igd', function (Blueprint $table) {
            $table->string('nama_obat_satu', 64)->nullable();
            $table->string('nama_obat_dua', 64)->nullable();
            $table->string('nama_obat_tiga', 64)->nullable();
            $table->string('nama_obat_empat', 64)->nullable();
            $table->string('nama_obat_lima', 64)->nullable();
            $table->string('nama_obat_enam', 64)->nullable();
            $table->string('jumlah_satu', 10)->nullable();
            $table->string('jumlah_dua', 10)->nullable();
            $table->string('jumlah_tiga', 10)->nullable();
            $table->string('jumlah_empat', 10)->nullable();
            $table->string('jumlah_lima', 10)->nullable();
            $table->string('jumlah_enam', 10)->nullable();
            $table->string('aturan_pakai_satu', 5)->nullable();
            $table->string('aturan_pakai_dua', 5)->nullable();
            $table->string('aturan_pakai_tiga', 5)->nullable();
            $table->string('aturan_pakai_empat', 5)->nullable();
            $table->string('aturan_pakai_lima', 5)->nullable();
            $table->string('aturan_pakai_enam', 5)->nullable();
            $table->date('tgl_satu')->nullable();
            $table->date('tgl_dua')->nullable();
            $table->date('tgl_tiga')->nullable();
            $table->date('tgl_empat')->nullable();
            $table->date('tgl_lima')->nullable();
            $table->date('tgl_enam')->nullable();
            $table->string('keterangan_satu', 32)->nullable();
            $table->string('keterangan_dua', 32)->nullable();
            $table->string('keterangan_tiga', 32)->nullable();
            $table->string('keterangan_empat', 32)->nullable();
            $table->string('keterangan_lima', 32)->nullable();
            $table->string('keterangan_enam', 32)->nullable();
            $table->string('masalah_keperawatan_nyeri', 32)->nullable();
            $table->string('gangguan_pernafasan', 32)->nullable();
            $table->string('potensi_infeksi', 32)->nullable();
            $table->string('volume_cairan', 32)->nullable();
            $table->string('perubahan_nutrisi', 32)->nullable();
            $table->string('cemas', 32)->nullable();
            $table->string('perfusi_jaringan', 32)->nullable();
            $table->string('hipertensi', 32)->nullable();
            $table->time('jam_satu')->nullable();
            $table->time('jam_dua')->nullable();
            $table->time('jam_tiga')->nullable();
            $table->time('jam_empat')->nullable();
            $table->time('jam_lima')->nullable();
            $table->time('jam_enam')->nullable();
            $table->time('jam_tujuh')->nullable();
            $table->time('jam_delapan')->nullable();
            $table->time('jam_sembilan')->nullable();
            $table->time('jam_sepuluh')->nullable();
            $table->time('jam_sebelas')->nullable();
            $table->time('jam_duabelas')->nullable();
            $table->time('jam_tigabelas')->nullable();
            $table->time('jam_empatbelas')->nullable();
            $table->time('jam_limabelas')->nullable();
            $table->time('jam_enambelas')->nullable();

            $table->string('observasi_ttv', 32)->nullable();
            $table->string('intake_output', 32)->nullable();
            $table->string('monitor_pernafasan', 32)->nullable();
            $table->string('oksimetri', 15)->nullable();
            $table->string('semi_flower', 32)->nullable();
            $table->string('pemasangan_opa', 32)->nullable();
            $table->string('sutlon', 32)->nullable();
            $table->string('nafas_efektif', 32)->nullable();
            $table->string('oksigen', 32)->nullable();
            $table->string('liter', 32)->nullable();
            $table->string('imobilisasi', 32)->nullable();
            $table->string('perawatan_luka', 32)->nullable();
            $table->string('pengelolaan_nyeri', 32)->nullable();
            $table->string('teknik_asepti', 32)->nullable();
            $table->string('ik_satu', 32)->nullable();
            $table->string('ik_dua', 32)->nullable();
            $table->string('ik_tiga', 32)->nullable();

            $table->dateTime('tgljamsatu')->nullable();
            $table->dateTime('tgljamdua')->nullable();
            $table->dateTime('tgljamtiga')->nullable();
            $table->dateTime('tgljamempat')->nullable();
            $table->dateTime('tgljamlima')->nullable();
            $table->dateTime('tgljamenam')->nullable();
            $table->dateTime('tgljamtujuh')->nullable();
            $table->dateTime('tgljamselapan')->nullable();
            $table->dateTime('tgljamsembilan')->nullable();
            $table->dateTime('tgljamsepuluh')->nullable();
            $table->string('tindakansatu', 32)->nullable();
            $table->string('tindakandua', 32)->nullable();
            $table->string('tindakantiga', 32)->nullable();
            $table->string('tindakanempat', 32)->nullable();
            $table->string('tindakanlima', 32)->nullable();
            $table->string('tindakanenam', 32)->nullable();
            $table->string('tindakantujuh', 32)->nullable();
            $table->string('tindakandelapan', 32)->nullable();
            $table->string('tindakansembilan', 32)->nullable();
            $table->string('tindakansepuluh', 32)->nullable();
            $table->integer('id_perawat_verif')->unsigned();
            $table->string('nama_perawat_verif', 64);

            $table->string('obat_cairan_satu', 64)->nullable();
            $table->string('obat_cairan_dua', 64)->nullable();
            $table->string('obat_cairan_tiga', 64)->nullable();
            $table->string('obat_cairan_empat', 64)->nullable();
            $table->string('obat_cairan_lima', 64)->nullable();
            $table->string('obat_cairan_enam', 64)->nullable();
            $table->string('obat_cairan_tujuh', 64)->nullable();
            $table->string('obat_cairan_delapan', 64)->nullable();
            $table->string('obat_cairan_sembilan', 64)->nullable();
            $table->string('obat_cairan_sepuluh', 64)->nullable();
            $table->string('dosis_satu', 5)->nullable();
            $table->string('dosis_dua', 5)->nullable();
            $table->string('dosis_tiga', 5)->nullable();
            $table->string('dosis_empat', 5)->nullable();
            $table->string('dosis_lima', 5)->nullable();
            $table->string('dosis_enam', 5)->nullable();
            $table->string('dosis_tujuh', 5)->nullable();
            $table->string('dosis_delapan', 5)->nullable();
            $table->string('dosis_sembilan', 5)->nullable();
            $table->string('dosis_sepuluh', 5)->nullable();
            $table->string('oral_satu', 5)->nullable();
            $table->string('oral_dua', 5)->nullable();
            $table->string('oral_tiga', 5)->nullable();
            $table->string('oral_empat', 5)->nullable();
            $table->string('oral_lima', 5)->nullable();
            $table->string('oral_enam', 5)->nullable();
            $table->string('oral_tujuh', 5)->nullable();
            $table->string('oral_delapan', 5)->nullable();
            $table->string('oral_sembilan', 5)->nullable();
            $table->string('oral_sepuluh', 5)->nullable();
            $table->time('jampemberian_satu')->nullable();
            $table->time('jampemberian_dua')->nullable();
            $table->time('jampemberian_tiga')->nullable();
            $table->time('jampemberian_empat')->nullable();
            $table->time('jampemberian_lima')->nullable();
            $table->time('jampemberian_enam')->nullable();
            $table->time('jampemberian_tujuh')->nullable();
            $table->time('jampemberian_delapan')->nullable();
            $table->time('jampemberian_sembilan')->nullable();
            $table->time('jampemberian_sepuluh')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('smis_doc_dokumen_asesment_awal_keperawatan_igd', function (Blueprint $table) {
            //
        });
    }
}
