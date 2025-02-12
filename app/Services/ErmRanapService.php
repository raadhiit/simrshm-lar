<?php

namespace App\Services;

use App\Models\DokumenKunjungan;
use App\Models\SerahTerimaBayiRawatGabung;
use App\Models\SMIS_Diagnosa;
use App\Models\Smis_Doc_Asesmen_Awal_Kebidanan_Ranap;
use App\Models\Smis_Doc_Asesment_Medis_Awal;
use App\Models\Smis_Doc_Asesmen_Awal_Pasien_Ranap_Neonatus;
use App\Models\Smis_Doc_Asesmen_Awal_Pasien_Ranap_Petriadik;
use App\Models\SMIS_Er_Resep;
use App\Models\Smis_Lab_Hasil;
use App\Models\Smis_Lab_Layanan;
use App\Models\SMIS_LabPesanan;
use App\Models\SMIS_LayananPasien;
use App\Models\Smis_Mjm_Kelas;
use App\Models\Smis_Mr_Icd;
use App\Models\Smis_Mr_Tanda_Vital;
use App\Models\SMIS_Pasien;
use App\Models\Smis_Rad_Layanan;
use App\Models\Smis_Rad_Pesanan;
use App\Models\SMIS_Rg_Asuransi;
use App\Models\SmisAdmPrototype;
use App\Models\SmisAdmSettings;
use App\Models\SmisDocCatatanPerkembanganPasienTerintegrasiRawatInap;
use App\Models\SmisHrdEmployee;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;

class ErmRanapService
{

    function asesmen_awal_kebidanan_rawat_inap($req)
    {
        $dokumen = DokumenKunjungan::with('asesmen_awal_kebidanan_ranap')->findOrFail($req->dokumen);
        $data['layanan'] = SMIS_LayananPasien::with('tanda_vital', 'pesanan_lab', 'pesanan_radiologi')->where('id', $dokumen->noreg)->first();
        $data['ruangan'] = DB::table('smis_adm_prototype')->where(function ($q) {
            $q->where('jenis_ruangan', 'URI')->orWhere('jenis_ruangan', 'URJI');
        })->where('prop', '')->get();
        $data['dokter'] = DB::table('smis_hrd_employee')->where('jabatan', 1)->where('prop', '')->get();
        $data['pasien'] = SMIS_Pasien::where('id', $data['layanan']->nrm)->first();
        $data['pemeriksaan'] = Smis_Lab_Layanan::where('prop', '')->get();
        $data['pemeriksaan_radiologi'] = Smis_Rad_Layanan::where('prop', '')->get();
        $data['master_hasil'] = Smis_Lab_Hasil::where('prop', '')->orderBy('grup')->get();
        $data['dokumen'] = $dokumen;
        $data['employee'] = SmisHrdEmployee::where('nama', $dokumen->nama_verifikator)->where('prop', '')->first();
        return $data;
    }

    function save_asesmen_awal_kebidanan_rawat_inap($req)
    {
        $query = Smis_Doc_Asesmen_Awal_Kebidanan_Ranap::updateOrCreate([
            'id_dokumen' => $req->dokumen
        ], [
            'ruangan' => $req->ruangan ? $req->ruangan : '',
            'dpjp' => $req->dpjp ? $req->dpjp : '',
            'caradatang_ruangan' => $req->caradatang_ruangan ? $req->caradatang_ruangan : '',
            'rujukan' => $req->rujukan ? $req->rujukan : '',
            'rujukan_lain' => $req->rujukan_lain ? $req->rujukan_lain : '',
            'caradatang' => $req->caradatang ? $req->caradatang : '',
            'riwayat_alergi' => $req->riwayat_alergi ? $req->riwayat_alergi : '',
            'riwayat_alergi_ada' => $req->riwayat_alergi_ada ? $req->riwayat_alergi_ada : '',
            'keluhan_utama' => $req->keluhan_utama ? $req->keluhan_utama : '',
            'nyeri' => $req->nyeri ? $req->nyeri : '',
            'skor_nyeri' => $req->skor_nyeri ? $req->skor_nyeri : '',
            'skrining_satu' => $req->skrining_satu ? $req->skrining_satu : '',
            'penurunan_bb' => $req->penurunan_bbs ? $req->penurunan_bbs : '',
            'skrining_dua' => $req->skrining_dua ? $req->skrining_dua : '',
            'skor_risiko_jatuh' => $req->skor_risiko_jatuh ? $req->skor_risiko_jatuh : '',
            'menarche' => $req->menarche ? $req->menarche : '',
            'siklus' => $req->siklus ? $req->siklus : '',
            'teratur_menarche' => $req->teratur_menarche ? $req->teratur_menarche : '',
            'lama_hari_menarche' => $req->lama_hari_menarche ? $req->lama_hari_menarche : '',
            'keluhan' => $req->keluhans ? $req->keluhans : '',
            'keluhan_lain' => $req->keluhan_lain ? $req->keluhan_lain : '',
            'hpht' => $req->hpht ? $req->hpht : '',
            'hpl' => $req->hpl ? $req->hpl : '',
            'uk' => $req->uk ? $req->uk : '',
            'menikah' => $req->menikah ? $req->menikah : '',
            // 'jumlah_pernikahan' => $req->jumlah_pernikahan ? $req->jumlah_pernikahan : '',
            'jumlah_pernikahan' => $req->jumlah_pernikahan ? $req->jumlah_pernikahan : '[]',
            'usia_pernikahan' => $req->usia_pernikahan ? $req->usia_pernikahan : '',
            'keluarga_terdekat' => $req->keluarga_terdekat ? $req->keluarga_terdekat : '',
            'hubungan' => $req->hubungan ? $req->hubungan : '',
            'tinggal_dengan' => $req->tinggal_dengan ? $req->tinggal_dengan : '',
            'tinggal_dengan_lain' => $req->tinggal_dengan_lain ? $req->tinggal_dengan_lain : '',
            'curiga' => $req->curiga ? $req->curiga : '',
            'ibadah' => $req->ibadah ? $req->ibadah : '',
            'status_emosional' => $req->status_emosional ? $req->status_emosional : '',
            'g' => $req->g ? $req->g : '',
            'p' => $req->p ? $req->p : '',
            'a' => $req->a ? $req->a : '',
            'riwayat_kehamilan' => $req->riwayat_kehamilan ? $req->riwayat_kehamilan : '',
            'riwayat_penyakit_dahulu' => $req->riwayat_penyakit_dahulu ? $req->riwayat_penyakit_dahulu : '',
            'riwayat_operasi' => $req->riwayat_operasi ? $req->riwayat_operasi : '',
            'tahun_operasi' => $req->tahun_operasi ? $req->tahun_operasi : '',
            'riwayat_penyakit_keluarga' => $req->riwayat_penyakit_keluarga ? $req->riwayat_penyakit_keluarga : '',
            'riwayat_ginekologi' => $req->riwayat_ginekologi ? $req->riwayat_ginekologi : '',
            'riwayat_ginekologi_lain' => $req->riwayat_ginekologi_lain ? $req->riwayat_ginekologi_lain : '',
            'flour_albus' => $req->flour_albus ? $req->flour_albus : '',
            'berbau' => $req->berbaus ? $req->berbaus : '',
            'warna' => $req->warna ? $req->warna : '',
            'metode_kb' => $req->metode_kb ? $req->metode_kb : '',
            'komplikasi_kb' => $req->komplikasi_kb ? $req->komplikasi_kb : '',
            'komplikasi_kb_lain' => $req->komplikasi_kb_lain ? $req->komplikasi_kb_lain : '',
            'bak' => $req->bak ? $req->bak : '',
            'bab' => $req->bab ? $req->bab : '',
            'warna_eliminasi' => $req->warna_eliminasi ? $req->warna_eliminasi : '',
            'karakteristik' => $req->karakteristik ? $req->karakteristik : '',
            'tidur_malam' => $req->tidur_malam ? $req->tidur_malam : '',
            'tidur_siang' => $req->tidur_siang ? $req->tidur_siang : '',
            'kepala' => $req->kepala ? $req->kepala : '',
            'kepala_lain' => $req->kepala_lain ? $req->kepala_lain : '',
            'rambut' => $req->rambut ? $req->rambut : '',
            'muka' => $req->muka ? $req->muka : '',
            'mata' => $req->mata ? $req->mata : '',
            'hidung' => $req->hidung ? $req->hidung : '',
            'telinga' => $req->telinga ? $req->telinga : '',
            'mulut' => $req->mulut ? $req->mulut : '',
            'mulut_lain' => $req->mulut_lain ? $req->mulut_lain : '',
            'leher' => $req->leher ? $req->leher : '',
            'dada' => $req->dada ? $req->dada : '',
            'payudara' => $req->payudaras ? $req->payudaras : '',
            'payudara_lain' => $req->payudara_lain ? $req->payudara_lain : '',
            'abdomen' => $req->abdomens ? $req->abdomens : '',
            'abdomen_lain' => $req->abdomen_lain ? $req->abdomen_lain : '',
            'inspeksi' => $req->inspeksi ? $req->inspeksi : '',
            'inspeksi_lain' => $req->inspeksi_lain ? $req->inspeksi_lain : '',
            'palpasi' => $req->palpasi ? $req->palpasi : '',
            'obstetri' => $req->obstetri ? $req->obstetri : '',
            'tfu' => $req->tfu ? $req->tfu : '',
            'tfj' => $req->tfj ? $req->tfj : '',
            'his' => $req->his ? $req->his : '',
            'teratur_his' => $req->teratur_his ? $req->teratur_his : '',
            'durasi' => $req->durasi ? $req->durasi : '',
            'kriteria_durasi' => $req->kriteria_durasis ? $req->kriteria_durasis : '',
            'djj' => $req->djj ? $req->djj : '',
            'kriteria_djj' => $req->kriteria_djjs ? $req->kriteria_djjs : '',
            'inspeksi_genitalia' => $req->inspeksi_genitalia ? $req->inspeksi_genitalia : '',
            'banyaknya' => $req->banyaknya ? $req->banyaknya : '',
            'konsistensi' => $req->konsistensi ? $req->konsistensi : '',
            'inspekulo' => $req->inspekulo ? $req->inspekulo : '',
            'inspekulo_lain' => $req->inspekulo_lain ? $req->inspekulo_lain : '',
            'uretra' => $req->uretra ? $req->uretra : '',
            'vulva' => $req->vulva ? $req->vulva : '',
            'vagina' => $req->vagina ? $req->vagina : '',
            'portio' => $req->portio ? $req->portio : '',
            'pembukaan' => $req->pembukaan ? $req->pembukaan : '',
            'selaput' => $req->selaput ? $req->selaput : '',
            'srld' => $req->srld ? $req->srld : '',
            'mekonium' => $req->mekonium ? $req->mekonium : '',
            'bg_terendah' => $req->bg_terendah ? $req->bg_terendah : '',
            'uuk' => $req->uuk ? $req->uuk : '',
            'penurunan' => $req->penurunan ? $req->penurunan : '',
            'pecah_ketuban' => $req->pecah_ketuban ? $req->pecah_ketuban : '',
            'bishope' => $req->bishope ? $req->bishope : '',
            'ekstremitas' => $req->ekstremitas ? $req->ekstremitas : '',
            'diagnosa_kebidanan' => $req->diagnosa_kebidanan ? $req->diagnosa_kebidanan : '',
            'rencana' => $req->rencana ? $req->rencana : '',
            'kesadaran' => $req->kesadaran ? $req->kesadaran : '',
            'tb' => $req->tb ? $req->tb : '',
            'gcs_e' => $req->gcs_e ? $req->gcs_e : '',
            'gcs_v' => $req->gcs_v ? $req->gcs_v : '',
            'gcs_m' => $req->gcs_m ? $req->gcs_m : '',
        ]);

        $dokumen = DokumenKunjungan::findOrFail($req->dokumen);

        DB::table('smis_mr_tanda_vital')->updateOrInsert([
            'noreg_pasien' => $dokumen->noreg
        ], [
            'keadaan_umum' => $req->keadaan_umum ? $req->keadaan_umum : '',
            'tensi' => $req->td ? $req->td : '',
            'berat_badan' => $req->bb ? $req->bb : '',
            'rr' => $req->rr ? $req->rr : '',
            'nadi' => $req->nadi ? $req->nadi : '',
            'suhu' => $req->suhu ? $req->suhu : '',
        ]);

        return $query;
    }

    function data_asesmen_awal_pasien_ranap_neonatus($req)
    {
        $dokumen = DokumenKunjungan::findOrFail($req->dokumen);
        $neonatus = Smis_Doc_Asesmen_Awal_Pasien_Ranap_Neonatus::where('id_dokumen', $dokumen->id)->first();
        $data['pasien'] = SMIS_Pasien::where('id', $dokumen->nrm)->first();
        $data['dokumen'] = $dokumen;
        $data['layanan'] = SMIS_LayananPasien::with('tanda_vital')
            ->leftJoin('smis_rg_asuransi', 'smis_rg_asuransi.id', 'smis_rg_layananpasien.asuransi')
            ->select('smis_rg_layananpasien.*', 'smis_rg_asuransi.nama as asuransi')
            ->where('smis_rg_layananpasien.id', $dokumen->noreg)->where('smis_rg_layananpasien.prop', '')->first();
        $data['pesanan_lab'] = SMIS_LabPesanan::where('id', ($neonatus ? $neonatus->id_pesanan_lab : 0))->where('prop', '')->first();
        $data['pesanan_rad'] = Smis_Rad_Pesanan::where('id', ($neonatus ? $neonatus->id_pesanan_rad : 0))->where('prop', '')->first();
        $data['neonatus'] = $neonatus;
        $data['employee'] = SmisHrdEmployee::where('nama', $dokumen->nama_verifikator)->first();
        $data['perawat'] = $neonatus ? SmisHrdEmployee::where('nama', $neonatus->nama_perawat_verif)->first() : null;
        $data['ruangan'] = SmisAdmPrototype::where('prop', '')->get();
        $data['list_kelas'] = Smis_Mjm_Kelas::where('prop', '')->get();
        $diagnosa = SMIS_Diagnosa::where('id', ($neonatus ? $neonatus->id_diagnosa : 0))->where('prop', '')->first();
        $data['kelas_lab'] = SmisAdmSettings::where('name', 'laboratory-ui-pemeriksaan-default-kelas')->first();
        $data['kelas_rad'] = SmisAdmSettings::where('name', 'radiology-ui-pemeriksaan-default-jenis')->first();
        $data['pemeriksaan'] = Smis_Lab_Layanan::where('prop', '')->get();
        $data['pemeriksaan_radiologi'] = Smis_Rad_Layanan::where('prop', '')->get();
        $data['master_hasil'] = Smis_Lab_Hasil::where('prop', '')->orderBy('grup')->get();
        $data['resep'] = SMIS_Er_Resep::with('detail')->where('id', ($neonatus ? $neonatus->id_e_resep : 0))->where('prop', '')->first();

        $data['diagnosa'] = $diagnosa;
        $data['kode_sekunder1'] = Smis_Mr_Icd::where('nama', ($diagnosa ? $diagnosa->diagnosa_sekunder1 : ''))->first();
        $data['kode_sekunder2'] = Smis_Mr_Icd::where('nama', ($diagnosa ? $diagnosa->diagnosa_sekunder2 : ''))->first();
        $data['kode_sekunder3'] = Smis_Mr_Icd::where('nama', ($diagnosa ? $diagnosa->diagnosa_sekunder3 : ''))->first();
        $data['kode_sekunder4'] = Smis_Mr_Icd::where('nama', ($diagnosa ? $diagnosa->diagnosa_sekunder4 : ''))->first();
        $data['kode_sekunder5'] = Smis_Mr_Icd::where('nama', ($diagnosa ? $diagnosa->diagnosa_sekunder5 : ''))->first();
        return $data;
    }

    function store_asesmen_awal_pasien_ranap_neonatus($req)
    {
        $data = [
            'id_pesanan_lab' => $req->id_pesanan_lab,
            'id_pesanan_rad' => $req->id_pesanan_rad,
            'id_e_resep' => $req->id_e_resep,
            'id_diagnosa' => $req->id_diagnosa,
            'tanggal_tiba' => $req->tiba_tanggal && $req->tiba_jam ? date('Y-m-d', strtotime($req->tiba_tanggal)) . ' ' . $req->tiba_jam : null,
            'tanggal_pengkajian' => $req->pengkajian_tanggal && $req->pengkajian_jam ? date('Y-m-d', strtotime($req->pengkajian_tanggal)) . ' ' . $req->pengkajian_jam : null,
            'diperoleh_dari' => $req->diperoleh_dari ? $req->diperoleh_dari : '',
            'hubungan_dengan_pasien' => $req->hubungan_dengan_pasien ? $req->hubungan_dengan_pasien : '',
            'nama_perawat' => $req->nama_perawat ? $req->nama_perawat : '',
            'keluhan_utama' => $req->keluhan_utama ? $req->keluhan_utama : '',
            'riwayat_penyakit_sekarang' => $req->riwayat_penyakit_sekarang ? $req->riwayat_penyakit_sekarang : '',
            'riwayat_penyakit_dahulu' => $req->riwayat_penyakit_dahulu ? $req->riwayat_penyakit_dahulu : '',
            'riwayat_penyakit_keluarga' => $req->riwayat_penyakit_keluarga ? $req->riwayat_penyakit_keluarga : '',
            'desc_riwayat_penyakit_keluarga' => $req->desc_riwayat_penyakit_keluarga ? $req->desc_riwayat_penyakit_keluarga : '',
            'riwayat_penggunaan_obat' => $req->riwayat_penggunaan_obat ? $req->riwayat_penggunaan_obat : '',
            'desc_riwayat_penggunaan_obat' => $req->desc_riwayat_penggunaan_obat ? $req->desc_riwayat_penggunaan_obat : '',
            'list_penggunaan_obat' => $req->list_penggunaan_obat ? $req->list_penggunaan_obat : '',
            'riwayat_alergi' => $req->riwayat_alergi ? $req->riwayat_alergi : '',
            'desc_riwayat_alergi' => $req->desc_riwayat_alergi ? $req->desc_riwayat_alergi : '',
            'keadaan_umum' => $req->keadaan_umum ? $req->keadaan_umum : '',
            'kesadaran' => $req->kesadaran ? $req->kesadaran : '',
            'gcs_e' => $req->gcs_e ? $req->gcs_e : '',
            'gcs_m' => $req->gcs_m ? $req->gcs_m : '',
            'gcs_v' => $req->gcs_v ? $req->gcs_v : '',
            'td' => $req->td ? $req->td : '',
            'suhu' => $req->suhu ? $req->suhu : '',
            'nadi' => $req->nadi ? $req->nadi : '',
            'rr' => $req->rr ? $req->rr : '',
            'periksa_di' => $req->periksa_di ? $req->periksa_di : '',
            'periksa_di_lain' => $req->periksa_di_lain ? $req->periksa_di_lain : '',
            'penyakit_kehamilan' => $req->penyakit_kehamilan ? $req->penyakit_kehamilan : '',
            'desc_penyakit_kehamilan' => $req->desc_penyakit_kehamilan ? $req->desc_penyakit_kehamilan : '',
            'obat_obatan_dikonsumsi' => $req->obat_obatan_dikonsumsi ? $req->obat_obatan_dikonsumsi : '',
            'desc_obat_obatan_dikonsumsi' => $req->desc_obat_obatan_dikonsumsi ? $req->desc_obat_obatan_dikonsumsi : '',
            'lahir_di' => $req->lahir_di ? $req->lahir_di : '',
            'ditolong' => $req->ditolong ? $req->ditolong : '',
            'status_generalis' => $req->status_generalis ? $req->status_generalis : '',
            'tindakan_perawat' => $req->tindakan_perawat ? $req->tindakan_perawat : '',
            'tanggal_tiba_p' => $req->tiba_tanggal_p && $req->tiba_jam_p ? date('Y-m-d', strtotime($req->tiba_tanggal_p)) . ' ' . $req->tiba_jam_p : null,
            'tanggal_pengkajian_p' => $req->pengkajian_tanggal_p && $req->pengkajian_jam_p ? date('Y-m-d', strtotime($req->pengkajian_tanggal_p)) . ' ' . $req->pengkajian_jam_p : null,
            'diperoleh_dari_p' => $req->diperoleh_dari_p ? $req->diperoleh_dari_p : '',
            'hubungan_dengan_pasien_p' => $req->hubungan_dengan_pasien_p ? $req->hubungan_dengan_pasien_p : '',
            'cara_masuk' => $req->caramasuk ? $req->caramasuk : '',
            'asal_pasien' => $req->asal_pasien ? $req->asal_pasien : '',
            'nama_pj' => $req->nama_pj ? $req->nama_pj : '',
            'usia_pj' => $req->usia_pj ? $req->usia_pj : '',
            'pekerjaan_pj' => $req->pekerjaan_pj ? $req->pekerjaan_pj : '',
            'ayah' => $req->ayah ? $req->ayah : '',
            'ibu' => $req->ibu ? $req->ibu : '',
            'pekerjaan_ayah' => $req->pekerjaan_ayah ? $req->pekerjaan_ayah : '',
            'pekerjaan_ibu' => $req->pekerjaan_ibu ? $req->pekerjaan_ibu : '',
            'suku_ayah' => $req->suku_ayah ? $req->suku_ayah : '',
            'suku_ibu' => $req->suku_ibu ? $req->suku_ibu : '',
            'tgl_lahir_ayah' => $req->tgl_lahir_ayah ? date('Y-m-d', strtotime($req->tgl_lahir_ayah)) : null,
            'tgl_lahir_ibu' => $req->tgl_lahir_ibu ? date('Y-m-d', strtotime($req->tgl_lahir_ibu)) : null,
            'agama_ayah' => $req->agama_ayah ? $req->agama_ayah : '',
            'agama_ibu' => $req->agama_ibu ? $req->agama_ibu : '',
            'alamat_ayah' => $req->alamat_ayah ? $req->alamat_ayah : '',
            'alamat_ibu' => $req->alamat_ibu ? $req->alamat_ibu : '',
            'keluhan_utama_p' => $req->keluhan_utama_p ? $req->keluhan_utama_p : '',
            'riwayat_obstetric_g' => $req->riwayat_obstetric_g ? $req->riwayat_obstetric_g : '',
            'riwayat_obstetric_p' => $req->riwayat_obstetric_p ? $req->riwayat_obstetric_p : '',
            'riwayat_obstetric_a' => $req->riwayat_obstetric_a ? $req->riwayat_obstetric_a : '',
            'usia_gestasi' => $req->usia_gestasi ? $req->usia_gestasi : '',
            'pernah_dirawat' => $req->pernah_dirawat ? $req->pernah_dirawat : '',
            'indikasi_rawat' => $req->indikasi_rawat ? $req->indikasi_rawat : '',
            'status_gizi_ibu' => $req->status_gizi_ibu ? $req->status_gizi_ibu : '',
            'obat_obatan_yang_dikonsumsi_selama_hamil' => $req->obat_obatan_yang_dikonsumsi_selama_hamil ? $req->obat_obatan_yang_dikonsumsi_selama_hamil : '',
            'desc_obat_dikonsumsi_selama_hamil' => $req->desc_obat_dikonsumsi_selama_hamil ? $req->desc_obat_dikonsumsi_selama_hamil : '',
            'kebiasaan_ibu' => $req->kebiasaan_ibu ? $req->kebiasaan_ibu : '',
            'kebiasaan_ibu_lain' => $req->kebiasaan_ibu_lain ? $req->kebiasaan_ibu_lain : '',
            'riwayat_persalinan' => $req->riwayat_persalinan ? $req->riwayat_persalinan : '',
            'ketuban' => $req->ketuban ? $req->ketuban : '',
            'ketuban_lain' => $req->ketuban_lain ? $req->ketuban_lain : '',
            'volume' => $req->volume ? $req->volume : '',
            'apgar_score' => $req->apgar_score ? $req->apgar_score : '',
            'bb_p' => $req->bb_p ? $req->bb_p : '',
            'pb_p' => $req->pb_p ? $req->pb_p : '',
            'lk' => $req->lk ? $req->lk : '',
            'ld' => $req->ld ? $req->ld : '',
            'lp' => $req->lp ? $req->lp : '',
            'riwayat_penyakit_keluarga_p' => $req->riwayat_penyakit_keluarga_p ? $req->riwayat_penyakit_keluarga_p : '',
            'desc_riwayat_penyakit_keluarga_p' => $req->desc_riwayat_penyakit_keluarga_p ? $req->desc_riwayat_penyakit_keluarga_p : '',
            'riwayat_alergi_obat' => $req->riwayat_alergi_obat ? $req->riwayat_alergi_obat : '',
            'desc_riwayat_alergi_obat' => $req->desc_riwayat_alergi_obat ? $req->desc_riwayat_alergi_obat : '',
            'riwayat_transfusi_darah' => $req->riwayat_transfusi_darah ? $req->riwayat_transfusi_darah : '',
            'desc_riwayat_transfusi_darah' => $req->desc_riwayat_transfusi_darah ? $req->desc_riwayat_transfusi_darah : '',
            'timbul_reaksi' => $req->timbul_reaksi ? $req->timbul_reaksi : '',
            'desc_timbul_reaksi' => $req->desc_timbul_reaksi ? $req->desc_timbul_reaksi : '',
            'riwayat_imunisasi' => $req->riwayat_imunisasi ? $req->riwayat_imunisasi : '',
            'desc_riwayat_imunisasi' => $req->desc_riwayat_imunisasi ? $req->desc_riwayat_imunisasi : '',
            'keadaan_umum_p' => $req->keadaan_umum_p ? $req->keadaan_umum_p : '',
            'kesadaran_p' => $req->kesadaran_p ? $req->kesadaran_p : '',
            'gcs_e_p' => $req->gcs_e_p ? $req->gcs_e_p : '',
            'gcs_m_p' => $req->gcs_m_p ? $req->gcs_m_p : '',
            'gcs_v_p' => $req->gcs_v_p ? $req->gcs_v_p : '',
            'td_p' => $req->td_p ? $req->td_p : '',
            's_p' => $req->s_p ? $req->s_p : '',
            'n_p' => $req->n_p ? $req->n_p : '',
            'rr_p' => $req->rr_p ? $req->rr_p : '',
            'bb' => $req->bb ? $req->bb : '',
            'tb' => $req->tb ? $req->tb_p : '',
            'lingkar_kepala' => $req->lingkar_kepala ? $req->lingkar_kepala : '',
            'lingkar_dada' => $req->lingkar_dada ? $req->lingkar_dada : '',
            'lingkar_perut' => $req->lingkar_perut ? $req->lingkar_perut : '',
            'goldar_bayi' => $req->goldar_bayi ? $req->goldar_bayi : '',
            'rh_bayi' => $req->rh_bayi ? $req->rh_bayi : '',
            'goldar_ibu' => $req->goldar_ibu ? $req->goldar_ibu : '',
            'rh_ibu' => $req->rh_ibu ? $req->rh_ibu : '',
            'goldar_ayah' => $req->goldar_ayah ? $req->goldar_ayah : '',
            'rh_ayah' => $req->rh_ayah ? $req->rh_ayah : '',
            'gerak_bayi' => $req->gerak_bayi ? $req->gerak_bayi : '',
            'ubun_ubun' => $req->ubun_ubun ? $req->ubun_ubun : '',
            'ubun_ubun_lain' => $req->ubun_ubun_lain ? $req->ubun_ubun_lain : '',
            'kejang' => $req->kejang ? $req->kejang : '',
            'desc_kejang' => $req->desc_kejang ? $req->desc_kejang : '',
            'refleks' => $req->refleks ? $req->refleks : '',
            'refleks_lain' => $req->refleks_lain ? $req->refleks_lain : '',
            'tangis_bayi' => $req->tangis_bayi ? $req->tangis_bayi : '',
            'tangis_bayi_lain' => $req->tangis_bayi_lain ? $req->tangis_bayi_lain : '',
            'posisi_mata' => $req->posisi_mata ? $req->posisi_mata : '',
            'pupil' => $req->pupil ? $req->pupil : '',
            'kelopak_mata' => $req->kelopak_mata ? $req->kelopak_mata : '',
            'kelopak_mata_lain' => $req->kelopak_mata_lain ? $req->kelopak_mata_lain : '',
            'konjungtiva' => $req->konjungtiva ? $req->konjungtiva : '',
            'konjungtiva_lain' => $req->konjungtiva_lain ? $req->konjungtiva_lain : '',
            'sklera' => $req->sklera ? $req->sklera : '',
            'sklera_lain' => $req->sklera_lain ? $req->sklera_lain : '',
            'sistem_pendengaran' => $req->sistem_pendengaran ? $req->sistem_pendengaran : '',
            'sistem_pendengaran_lain' => $req->sistem_pendengaran_lain ? $req->sistem_pendengaran_lain : '',
            'sistem_penciuman' => $req->sistem_penciuman ? $req->sistem_penciuman : '',
            'sistem_penciuman_lain' => $req->sistem_penciuman_lain ? $req->sistem_penciuman_lain : '',
            'pola_napas' => $req->pola_napas ? $req->pola_napas : '',
            'jenis_pernapasan' => $req->jenis_pernapasan ? $req->jenis_pernapasan : '',
            'desc_jenis_pernapasan' => $req->desc_jenis_pernapasan ? $req->desc_jenis_pernapasan : '',
            'irama_napas' => $req->irama_napas ? $req->irama_napas : '',
            'retraksi' => $req->retraksi ? $req->retraksi : '',
            'air_entri' => $req->air_entri ? $req->air_entri : '',
            'merintih' => $req->merintih ? $req->merintih : '',
            'suara_napas' => $req->suara_napas ? $req->suara_napas : '',
            'warna_kulit' => $req->warna_kulit ? $req->warna_kulit : '',
            'warna_kulit_lain' => $req->warna_kulit_lain ? $req->warna_kulit_lain : '',
            'denyut_nadi' => $req->denyut_nadi ? $req->denyut_nadi : '',
            'sirkulasi' => $req->sirkulasi ? $req->sirkulasi : '',
            'crt' => $req->crt ? $req->crt : '',
            'edema' => $req->edema ? $req->edema : '',
            'pulsasi' => $req->pulsasi ? $req->pulsasi : '',
            'pulsasi_lain' => $req->pulsasi_lain ? $req->pulsasi_lain : '',
            'mulut' => $req->mulut ? $req->mulut : '',
            'mulut_lain' => $req->mulut_lain ? $req->mulut_lain : '',
            'gigi' => $req->gigi ? $req->gigi : '',
            'gigi_lain' => $req->gigi_lain ? $req->gigi_lain : '',
            'lidah' => $req->lidah ? $req->lidah : '',
            'lidah_lain' => $req->lidah_lain ? $req->lidah_lain : '',
            'oesofagus' => $req->oesofagus ? $req->oesofagus : '',
            'oesofagus_lain' => $req->oesofagus_lain ? $req->oesofagus_lain : '',
            'abdomen' => $req->abdomen ? $req->abdomen : '',
            'abdomen_lain' => $req->abdomen_lain ? $req->abdomen_lain : '',
            'bab' => $req->bab ? $req->bab : '',
            'frekuensi_diare' => $req->frekuensi_diare ? $req->frekuensi_diare : '',
            'meco_pertama' => $req->meco_pertama ? date('Y-m-d H:i', strtotime($req->meco_pertama)) : null,
            'warna_bab' => $req->warna_bab ? $req->warna_bab : '',
            'warna_bab_lain' => $req->warna_bab_lain ? $req->warna_bab_lain : '',
            'bak' => $req->bak ? $req->bak : '',
            'bak_pertama' => $req->bak_pertama ? date('Y-m-d H:i', strtotime($req->bak_pertama)) : null,
            'warna_bak' => $req->warna_bak ? $req->warna_bak : '',
            'warna_bak_lain' => $req->warna_bak_lain ? $req->warna_bak_lain : '',
            'sistem_reproduksi_l' => $req->sistem_reproduksi_l ? $req->sistem_reproduksi_l : '',
            'sistem_reproduksi_l_lain' => $req->sistem_reproduksi_l_lain ? $req->sistem_reproduksi_l_lain : '',
            'sistem_reproduksi_p' => $req->sistem_reproduksi_p ? $req->sistem_reproduksi_p : '',
            'sistem_reproduksi_p_lain' => $req->sistem_reproduksi_p_lain ? $req->sistem_reproduksi_p_lain : '',
            'vernic_kaseosa' => $req->vernic_kaseosa ? $req->vernic_kaseosa : '',
            'vernic_kaseosa_lain' => $req->vernic_kaseosa_lain ? $req->vernic_kaseosa_lain : '',
            'lanugo' => $req->lanugo ? $req->lanugo : '',
            'warna_integumen' => $req->warna_integumen ? $req->warna_integumen : '',
            'warna_integumen_lain' => $req->warna_integumen_lain ? $req->warna_integumen_lain : '',
            'tugor' => $req->tugor ? $req->tugor : '',
            'kulit' => $req->kulit ? $req->kulit : '',
            'kriteria_resiko_dekubitus' => $req->kriteria_resiko_dekubitus ? $req->kriteria_resiko_dekubitus : '',
            'lengan' => $req->lengan ? $req->lengan : '',
            'lengan_lain' => $req->lengan_lain ? $req->lengan_lain : '',
            'tungkai' => $req->tungkai ? $req->tungkai : '',
            'tungkai_lain' => $req->tungkai_lain ? $req->tungkai_lain : '',
            'rekoil_telinga' => $req->rekoil_telinga ? $req->rekoil_telinga : '',
            'rekoil_telinga_lain' => $req->rekoil_telinga_lain ? $req->rekoil_telinga_lain : '',
            'garis_telapak_kaki' => $req->garis_telapak_kaki ? $req->garis_telapak_kaki : '',
            'nyeri' => $req->nyeri ? $req->nyeri : '',
            'skor_nyeri' => $req->skor_nyeri ? $req->skor_nyeri : '',
            'skala_nyeri' => $req->skala_nyeri ? $req->skala_nyeri : '',
            'tipe' => $req->tipe ? $req->tipe : '',
            'desc_tipe' => $req->desc_tipe ? $req->desc_tipe : '',
            'frekuensi' => $req->frekuensi ? $req->frekuensi : '',
            'lama_nyeri' => $req->lama_nyeri ? $req->lama_nyeri : '',
            'lama_kehamilan' => $req->lama_kehamilan ? $req->lama_kehamilan : '',
            'komplikasi' => $req->komplikasi ? $req->komplikasi : '',
            'desc_komplikasi' => $req->desc_komplikasi ? $req->desc_komplikasi : '',
            'masalah_neonatus' => $req->masalah_neonatus ? $req->masalah_neonatus : '',
            'desc_masalah_neonatus' => $req->desc_masalah_neonatus ? $req->desc_masalah_neonatus : '',
            'masalah_maternal' => $req->masalah_maternal ? $req->masalah_maternal : '',
            'desc_masalah_maternal' => $req->desc_masalah_maternal ? $req->desc_masalah_maternal : '',
            'bb_anak_saat_lahir' => $req->bb_anak_saat_lahir ? $req->bb_anak_saat_lahir : '',
            'pb_anak_saat_lahir' => $req->pb_anak_saat_lahir ? $req->pb_anak_saat_lahir : '',
            'asi_sampai_umur' => $req->asi_sampai_umur ? $req->asi_sampai_umur : '',
            'susu_formula_dimulai' => $req->susu_formula_dimulai ? $req->susu_formula_dimulai : '',
            'makanan_padat_dimulai' => $req->makanan_padat_dimulai ? $req->makanan_padat_dimulai : '',
            'makanan_tambahan_mulai_umur' => $req->makanan_tambahan_mulai_umur ? $req->makanan_tambahan_mulai_umur : '',
            'tengkurap' => $req->tengkurap ? $req->tengkurap : '',
            'duduk' => $req->duduk ? $req->duduk : '',
            'berdiri' => $req->berdiri ? $req->berdiri : '',
            'berjalan' => $req->berjalan ? $req->berjalan : '',
            'list_riwayat_imunisasi' => $req->list_riwayat_imunisasi ? $req->list_riwayat_imunisasi : '',
            'spiritual' => $req->spiritual ? $req->spiritual : '',
            'status_psikologis' => $req->status_psikologis ? $req->status_psikologis : '',
            'skrining_nyeri' => $req->skrining_nyeri ? $req->skrining_nyeri : '',
            'skrining_resiko_cedera' => $req->skrining_resiko_cedera ? $req->skrining_resiko_cedera : '',
            'kebutuhan_komunikasi' => $req->kebutuhan_komunikasi ? $req->kebutuhan_komunikasi : '',
            'kebutuhan_privasi_orang_tua' => $req->kebutuhan_privasi_orang_tua ? $req->kebutuhan_privasi_orang_tua : '',
            'skrining_gizi' => $req->skrining_gizi ? $req->skrining_gizi : '',
            'daftar_masalah_keperawatan' => $req->daftar_masalah_keperawatan ? $req->daftar_masalah_keperawatan : '',
            'rencana_perawatan' => $req->rencana_keperawatan ? $req->rencana_keperawatan : '',
            'perencanaan_perawatan' => $req->perencanaan_perawatan ? $req->perencanaan_perawatan : '',
            'perencanaan_pulang' => $req->perencanaan_pulang ? $req->perencanaan_pulang : '',
        ];

        $dokumen = DokumenKunjungan::where('id', $req->dokumen)->first();
        $layanan = SMIS_LayananPasien::where("id", $dokumen->noreg)->first();

        DB::table('smis_mr_tanda_vital')->updateOrInsert([
            'waktu' =>  $layanan->tanggal,
            'nrm_pasien' => $dokumen->nrm,
            'noreg_pasien' => $dokumen->noreg,
            'nama_pasien' => $layanan->nama_pasien,
            'ruangan' => $layanan->last_ruangan,
        ], [
            'time_updated' => Carbon::now()->toDateTimeString(),
            'keadaan_umum' => $req->keadaan_umum ? $req->keadaan_umum : '',
            'kesadaran' => $req->kesadaran ? $req->kesadaran : '',
            'berat_badan' => $req->bb ? $req->bb : '',
            'tinggi_badan' => $req->tb_p ? $req->tb_p : '',
            'tensi' => $req->td ? $req->td : '',
            'nadi' => $req->nadi ? $req->nadi : '',
            'suhu' => $req->suhu ? $req->suhu : '',
            'rr' => $req->rr ? $req->rr : '',
        ]);
        $neonatus = Smis_Doc_Asesmen_Awal_Pasien_Ranap_Neonatus::updateOrCreate(['id_dokumen' => $req->dokumen], $data);
        return $neonatus;
    }

    function save_asesmen_awal_keperawatan_geriatri($req)
    {
        $data_penunjang = [
            ($req->data_penunjang_a ? $req->data_penunjang_a : ''),
            ($req->data_penunjang_b ? $req->data_penunjang_b : '')
        ];
        DB::table('smis_doc_asesmen_awal_keperawatan_geriatri')->updateOrInsert([
            'id_dokumen' => $req->dokumen
        ], [
            'ruangan' => $req->ruangan ? $req->ruangan : '',
            'kelas' => $req->kelas ? $req->kelas : '',
            'data_penunjang' => json_encode($data_penunjang),
            'id_dokter_pengirim' => $req->id_dokter_pengirim ? $req->id_dokter_pengirim : '',
            'dokter_pengirim' => $req->dokter_pengirim ? $req->dokter_pengirim : '',
            'id_dokter_merawat' => $req->id_dokter_merawat ? $req->id_dokter_merawat : '',
            'dokter_merawat' => $req->dokter_merawat ? $req->dokter_merawat : '',
            'tgl_masuk' => $req->tgl_masuk ? $req->tgl_masuk : '',
            'pendidikan' => $req->pendidikan ? $req->pendidikan : '',
            'tgl_pengkajian' => $req->tgl_pengkajian ? $req->tgl_pengkajian : '',
            'pekerjaan' => $req->pekerjaans ? $req->pekerjaans : '',
            'diagnosis_medik' => $req->diagnosis_medik ? $req->diagnosis_medik : '',
            'berat_badan' => $req->berat_badan ? $req->berat_badan : '',
            'tinggi_badan' => $req->tinggi_badan ? $req->tinggi_badan : '',
            'status_perkawinan' => $req->status_perkawinan ? $req->status_perkawinan : '',
            'kondisi_saat_masuk' => $req->kondisi_saat_masuk ? $req->kondisi_saat_masuk : '',
            'kondisi_saat_masuk_lain' => $req->kondisi_saat_masuk_lain ? $req->kondisi_saat_masuk_lain : '',
            'telpon' => $req->telpon ? $req->telpon : '',
            'data_diperoleh' => $req->data_diperoleh ? $req->data_diperoleh : '',
            'hubungan' => $req->hubungan ? $req->hubungan : '',
            'asal_pasien' => $req->asal_pasien ? $req->asal_pasien : '',
            'bahasa' => $req->bahasa ? $req->bahasa : '',
            'keluhan_utama' => $req->keluhan_utama ? $req->keluhan_utama : '',
            'keluhan_menyertai' => $req->keluhan_menyertai ? $req->keluhan_menyertai : '',
            'waktu_pengobatan_terakhir' => $req->waktu_pengobatan_terakhir ? $req->waktu_pengobatan_terakhir : '',
            'tempat_pengobatan_terakhir' => $req->tempat_pengobatan_terakhir ? $req->tempat_pengobatan_terakhir : '',
            'riwayat_alergi' => $req->riwayat_alergi ? $req->riwayat_alergi : '',
            'reaksi' => $req->reaksi ? $req->reaksi : '',
            'riwayat_penyakit_dahulu' => $req->riwayat_penyakit_dahulu ? $req->riwayat_penyakit_dahulu : '',
            'riwayat_imuno' => $req->riwayat_imuno ? $req->riwayat_imuno : '',
            'riwayat_penyakit_keluarga' => $req->riwayat_penyakit_keluarga ? $req->riwayat_penyakit_keluarga : '',
            'pernah_dirawat' => $req->pernah_di_rawats ? $req->pernah_di_rawats : '',
            'pernah_operasi' => $req->pernah_di_operasis ? $req->pernah_di_operasis : '',
            'nyeri' => $req->skrining_nyeri ? $req->skrining_nyeri : '',
            'ttv' => $req->ttv ? $req->ttv : '',
            'glasglow_coma' => $req->glasglow_coma ? $req->glasglow_coma : '',
            'kepala' => $req->kepalas ? $req->kepalas : '',
            'rambut' => $req->rambuts ? $req->rambuts : '',
            'muka' => $req->mukas ? $req->mukas : '',
            'mata' => $req->matas ? $req->matas : '',
            'telinga' => $req->telingas ? $req->telingas : '',
            'hidung' => $req->hidungs ? $req->hidungs : '',
            'mulut' => $req->muluts ? $req->muluts : '',
            'gigi' => $req->gigis ? $req->gigis : '',
            'lidah' => $req->lidahs ? $req->lidahs : '',
            'tenggorokan' => $req->tenggorokans ? $req->tenggorokans : '',
            'leher' => $req->lehers ? $req->lehers : '',
            'dada' => $req->dadas ? $req->dadas : '',
            'abdomen' => $req->abdomens ? $req->abdomens : '',
            'genitalia_wanita' => $req->genitalia_wanitas ? $req->genitalia_wanitas : '',
            'genitalia_pria' => $req->genitalia_prias ? $req->genitalia_prias : '',
            'integumen' => $req->integumens ? $req->integumens : '',
            'kondisi' => $req->kondisi ? $req->kondisi : '',
            'balutan' => $req->balutan ? $req->balutan : '',
            'ekstremitas' => $req->ekstremitass ? $req->ekstremitass : '',
            'eliminasi' => $req->eliminasi ? $req->eliminasi : '',
            'obat_dirumah' => $req->obat_dirumah ? $req->obat_dirumah : '',
            'resiko_cidera_jatuh' => $req->resiko_cidera_jatuh ? $req->resiko_cidera_jatuh : '',
            'kesimpulan_resiko_jatuh' => $req->kesimpulan_resiko ? $req->kesimpulan_resiko : '',
            'tindakan_resiko_jatuh' => $req->tindakan_resiko_jatuh ? $req->tindakan_resiko_jatuh : '',
            'resiko_dekubitus' => $req->resiko_dekubitus ? $req->resiko_dekubitus : '',
            'kesimpulan_resiko_dekubitus' => $req->kesimpulan_resiko_dekubitus ? $req->kesimpulan_resiko_dekubitus : '',
            'nutrisi' => $req->nutrisi ? $req->nutrisi : '',
            'rujuk_ahli_gizi' => $req->skor ? $req->skor : '',
            'status_fungsional' => $req->status_fungsional ? $req->status_fungsional : '',
            'kesimpulan_status_fungsional' => $req->kesimpulan_status_fungsional ? $req->kesimpulan_status_fungsional : '',
            'perlu_bantuan' => $req->perlu_bantuan ? $req->perlu_bantuan : '',
            'alat_bantu' => $req->alat_bantu ? $req->alat_bantu : '',
            'kebutuhan_komunikasi' => $req->kebutuhan_komunikasi ? $req->kebutuhan_komunikasi : '',
            'status_ekonomi' => $req->status_ekonomi ? $req->status_ekonomi : '',
            'riwayat_psikisosial' => $req->riwayat_psikososial ? $req->riwayat_psikososial : '',
            'pola_aktivitas' => $req->pola_aktivitas ? $req->pola_aktivitas : '',
            'pola_kebiasaan' => $req->pola_kebiasaan ? $req->pola_kebiasaan : '',
            'ketergantungan_zat' => $req->ketergantungan_zat ? $req->ketergantungan_zat : '',
            'orientasi_pada_pasien' => $req->orientasi_pada_pasien ? $req->orientasi_pada_pasien : '',
            'informasi_pada_pasien' => $req->informasi_pada_pasien ? $req->informasi_pada_pasien : '',
            'penggunaan_alat_medik' => $req->penggunaan_alat_mediks ? $req->penggunaan_alat_mediks : '',
            'masalah_keperawatan' => $req->masalah_keperawatan ? $req->masalah_keperawatan : '',
            'tanggal' => $req->tanggal_pengkajian ? $req->tanggal_pengkajian : '0000-00-00',
            'jam' => $req->jam_pengkajian ? $req->jam_pengkajian : '',
        ]);
    }

    function tanda_tangan_formulir_penandaan_lokasi_operasi($req)
    {
        $data = DB::table('smis_doc_formulir_penandaan_lokasi_operasi')->where('id_dokumen', $req->dokumen)->first();
        $folderPath = public_path('signature_patient/');

        $image_parts = explode(";base64,", $req->tanda_tangan);

        $image_type_aux = explode("image/", $image_parts[0]);

        $image_type = $image_type_aux[1];

        $image_base64 = base64_decode($image_parts[1]);

        $fileName = uniqid() . '.' . $image_type;
        $file = $folderPath . $fileName;
        file_put_contents($file, $image_base64);

        $query = DB::table('smis_doc_formulir_penandaan_lokasi_operasi')->updateOrInsert([
            'id_dokumen' => $req->dokumen
        ], [
            'prosedur' => $req->prosedur ? $req->prosedur : ($data ? $data->prosedur : ''),
            'tanggal' => $req->tanggal ? $req->tanggal : ($data ? $data->tanggal : ''),
            'lokasi_operasi' => $req->lokasi_operasi ? $req->lokasi_operasi : ($data ? $data->lokasi_operasi : ''),
            'nama' => $req->nama ? $req->nama : '',
            'tanda_tangan' => $fileName,
        ]);

        return $query;
    }

    function formulir_penandaan_lokasi_operasi_store($req)
    {
        $data = DB::table('smis_doc_formulir_penandaan_lokasi_operasi')->where('id_dokumen', $req->dokumen)->first();
        $fileName = $data ? $data->lokasi_operasi : '';

        if ($req->lokasi_operasi) {
            $folderPath = public_path('penandaan_lokasi_operasi/');

            $image_parts = explode(";base64,", $req->lokasi_operasi);

            $image_type_aux = explode("image/", $image_parts[0]);

            $image_type = $image_type_aux[1];

            $image_base64 = base64_decode($image_parts[1]);

            $fileName = uniqid() . '.' . $image_type;
            $file = $folderPath . $fileName;
            file_put_contents($file, $image_base64);
        }

        $query = DB::table('smis_doc_formulir_penandaan_lokasi_operasi')->updateOrInsert([
            'id_dokumen' => $req->dokumen
        ], [
            'prosedur' => $req->prosedur ? $req->prosedur : '',
            'tanggal' => $req->tanggal ? $req->tanggal : '',
            'lokasi_operasi' => $fileName,
            'nama' => $data ? $data->nama : '',
            'tanda_tangan' => $data ? $data->tanda_tangan : '',
        ]);

        return $query;
    }

    function catatan_perkembangan_pasien_terintegrasi_rawat_inap($req)
    {
        $dokumen = DokumenKunjungan::findOrFail($req->dokumen);
        $pasien = SMIS_Pasien::where('id', $dokumen->nrm)->where('prop', '')->first();
        $layanan = SMIS_LayananPasien::with('tanda_vital')
            ->leftJoin('smis_rg_asuransi', 'smis_rg_asuransi.id', 'smis_rg_layananpasien.asuransi')
            ->select('smis_rg_layananpasien.*', 'smis_rg_asuransi.nama as asuransi')
            ->where('smis_rg_layananpasien.id', $dokumen->noreg)->where('smis_rg_layananpasien.prop', '')->first();
        $employee  = SmisHrdEmployee::where('nama', $dokumen->nama_verifikator)->where('prop', '')->first();
        $data = $this->data_cppt_ranap($req);
        $ruangan = SmisAdmPrototype::where('prop', '')->get();
        $list_kelas = Smis_Mjm_Kelas::where('prop', '')->get();
        $kelas_lab = SmisAdmSettings::where('name', 'laboratory-ui-pemeriksaan-default-kelas')->first();
        $kelas_rad = SmisAdmSettings::where('name', 'radiology-ui-pemeriksaan-default-jenis')->first();
        $pemeriksaan = Smis_Lab_Layanan::where('prop', '')->get();
        $pemeriksaan_radiologi = Smis_Rad_Layanan::where('prop', '')->get();
        $master_hasil = Smis_Lab_Hasil::where('prop', '')->orderBy('grup')->get();
        $asuransi = $layanan->asuransi == 0 ? null : SMIS_Rg_Asuransi::where('id', $layanan->asuransi)->where('prop', '')->first();
        return [
            'dokumen' => $dokumen,
            'pasien' => $pasien,
            'layanan' => $layanan,
            'employee' => $employee,
            'data' => $data,
            'ruangan' => $ruangan,
            'list_kelas' => $list_kelas,
            'kelas_lab' => $kelas_lab,
            'kelas_rad' => $kelas_rad,
            'pemeriksaan' => $pemeriksaan,
            'pemeriksaan_radiologi' => $pemeriksaan_radiologi,
            'master_hasil' => $master_hasil,
            'asuransi' => $asuransi
        ];
    }

    function data_cppt_ranap($req)
    {
        $query = SmisDocCatatanPerkembanganPasienTerintegrasiRawatInap::with(['ttv', 'diagnosa', 'lab', 'rad', 'resep.detail'])
            ->leftJoin('smis_adm_user as dokter', 'dokter.id', 'smis_doc_catatan_perkembangan_pasien_terintegrasi_rawat_inap.id_verifikator')
            ->leftJoin('smis_hrd_employee as employee_dokter', 'employee_dokter.username', 'dokter.username')
            ->leftJoin('smis_adm_user as dpjp', 'dpjp.id', 'smis_doc_catatan_perkembangan_pasien_terintegrasi_rawat_inap.id_dpjp')
            ->leftJoin('smis_hrd_employee as employee_dpjp', 'employee_dpjp.username', 'dpjp.username')
            ->select('smis_doc_catatan_perkembangan_pasien_terintegrasi_rawat_inap.*', 'employee_dokter.ttd as ttd', 'employee_dpjp.ttd as ttd_dpjp')
            ->where('smis_doc_catatan_perkembangan_pasien_terintegrasi_rawat_inap.id_dokumen', $req->dokumen)
            ->where('smis_doc_catatan_perkembangan_pasien_terintegrasi_rawat_inap.prop', '')
            ->groupBy('smis_doc_catatan_perkembangan_pasien_terintegrasi_rawat_inap.id')
            ->orderBy('smis_doc_catatan_perkembangan_pasien_terintegrasi_rawat_inap.id', 'desc');

        if (isset($req->history) && $req->history == 1) {
            $query->whereIn('jenis_ppa', ['dr', 'dpjp_utama', 'dpjp_pendamping']);
        }

        return $query->get();
    }

    function cppt_store($req)
    {
        switch ($req->jenis_ppa) {
            case 'ns':
                $select = DokumenKunjungan::where('id', $req->dokumen)->where('prop', '')->first();
                $dokumen = SmisDocCatatanPerkembanganPasienTerintegrasiRawatInap::updateOrCreate([
                    'id' => $req->id
                ], [
                    'id_ppa' => $req->id_ppa,
                    'nama_ppa' => $req->nama_ppa,
                    'subjective' => $req->subjective,
                    'asesmen' => $req->asesmen,
                    'planning' => $req->planning,
                    'instruksi' => $req->instruksi,
                    'id_verifikator' => Auth::user()->id,
                    'nama_verifikator' => Auth::user()->realname,
                    'status' => 1
                ]);

                if ($dokumen->id_ttv == 0) {
                    DB::table('smis_mr_tanda_vital')->insert([
                        'nrm_pasien' => $select->nrm,
                        'noreg_pasien' => $select->noreg,
                        'keadaan_umum' => $req->keadaan_umum,
                        'kesadaran' => $req->kesadaran,
                        'tensi' => $req->tensi,
                        'nadi' => $req->nadi,
                        'suhu' => $req->suhu,
                        'rr' => $req->rr,
                        'spo2' => $req->spo,
                        'status_gizi' => $req->status_gizi,
                        'tinggi_badan' => $req->tinggi_badan,
                        'berat_badan' => $req->berat_badan,
                    ]);
                } else {
                    DB::table('smis_mr_tanda_vital')->where('id', $dokumen->id_ttv)->update([
                        'nrm_pasien' => $select->nrm,
                        'noreg_pasien' => $select->noreg,
                        'keadaan_umum' => $req->keadaan_umum,
                        'kesadaran' => $req->kesadaran,
                        'tensi' => $req->tensi,
                        'nadi' => $req->nadi,
                        'suhu' => $req->suhu,
                        'rr' => $req->rr,
                        'spo2' => $req->spo,
                        'status_gizi' => $req->status_gizi,
                        'tinggi_badan' => $req->tinggi_badan,
                        'berat_badan' => $req->berat_badan,
                    ]);
                }

                if ($dokumen->id_ttv == 0) {
                    $last_ttv = Smis_Mr_Tanda_Vital::where('nrm_pasien', $select->nrm)->where('noreg_pasien', $select->noreg)->where('prop', '')
                        ->orderBy('id', 'desc')->first();

                    SmisDocCatatanPerkembanganPasienTerintegrasiRawatInap::where('id', $dokumen->id)->update([
                        'id_ttv' => $last_ttv->id
                    ]);
                }

                DokumenKunjungan::where('id', $req->dokumen)->update([
                    'tanggal_update' => date('Y-m-d H:i:s'),
                    'nama_verifikator' => Auth::user()->realname,
                    'id_verifikator' => Auth::user()->id
                ]);

                break;
            case 'fp':
                SmisDocCatatanPerkembanganPasienTerintegrasiRawatInap::updateOrCreate([
                    'id' => $req->id
                ], [
                    'id_ppa' => $req->id_ppa,
                    'nama_ppa' => $req->nama_ppa,
                    'subjective' => $req->subjective,
                    'objective_lain' => $req->objective,
                    'asesmen' => $req->asesmen,
                    'planning' => $req->planning,
                    'instruksi' => $req->instruksi,
                    'id_verifikator' => Auth::user()->id,
                    'nama_verifikator' => Auth::user()->realname,
                    'status' => 1
                ]);

                DokumenKunjungan::where('id', $req->dokumen)->update([
                    'tanggal_update' => date('Y-m-d H:i:s'),
                    'nama_verifikator' => Auth::user()->realname,
                    'id_verifikator' => Auth::user()->id
                ]);
                return true;
                break;
            case 'apt':
                SmisDocCatatanPerkembanganPasienTerintegrasiRawatInap::updateOrCreate([
                    'id' => $req->id
                ], [
                    'id_ppa' => $req->id_ppa,
                    'nama_ppa' => $req->nama_ppa,
                    'subjective' => $req->subjective,
                    'objective_lain' => $req->objective,
                    'asesmen' => $req->asesmen,
                    'planning' => $req->planning,
                    'instruksi' => $req->instruksi,
                    'id_verifikator' => Auth::user()->id,
                    'nama_verifikator' => Auth::user()->realname,
                    'status' => 1
                ]);

                DokumenKunjungan::where('id', $req->dokumen)->update([
                    'tanggal_update' => date('Y-m-d H:i:s'),
                    'nama_verifikator' => Auth::user()->realname,
                    'id_verifikator' => Auth::user()->id
                ]);
                return true;
                break;
            case 'gizi':
                SmisDocCatatanPerkembanganPasienTerintegrasiRawatInap::updateOrCreate([
                    'id' => $req->id
                ], [
                    'id_ppa' => $req->id_ppa,
                    'nama_ppa' => $req->nama_ppa,
                    'subjective' => $req->subjective,
                    'objective_lain' => $req->objective,
                    'asesmen' => $req->asesmen,
                    'planning' => $req->planning,
                    'catatan_asesmen' => $req->catatan_asesmen,
                    'instruksi' => $req->instruksi,
                    'id_verifikator' => Auth::user()->id,
                    'nama_verifikator' => Auth::user()->realname,
                    'status' => 1
                ]);

                DokumenKunjungan::where('id', $req->dokumen)->update([
                    'tanggal_update' => date('Y-m-d H:i:s'),
                    'nama_verifikator' => Auth::user()->realname,
                    'id_verifikator' => Auth::user()->id
                ]);
                return true;
                break;
            case 'dr':
                $select = SmisDocCatatanPerkembanganPasienTerintegrasiRawatInap::where('id', $req->id)->first();
                $file_penunjang = $select ? $select->file_penunjang_eksternal : '';

                if ($req->file('file_penunjang')) {
                    $file_penunjang = $this->upload_file_penunjang_cppt($req);
                }

                if ($req->is_dpjp == 0) {
                    SmisDocCatatanPerkembanganPasienTerintegrasiRawatInap::updateOrCreate([
                        'id' => $req->id
                    ], [
                        'id_ppa' => $req->id_ppa,
                        'nama_ppa' => $req->nama_ppa,
                        'subjective' => $req->subjective,
                        'objective_lain' => $req->objective,
                        'instruksi' => $req->instruksi,
                        'tindak_lanjut' => $req->tindak_lanjut,
                        'id_verifikator' => Auth::user()->id,
                        'nama_verifikator' => Auth::user()->realname,
                        'status' => 1,
                        'file_penunjang_eksternal' => $file_penunjang
                    ]);

                    DokumenKunjungan::where('id', $req->dokumen)->update([
                        'tanggal_update' => date('Y-m-d H:i:s'),
                        'nama_verifikator' => Auth::user()->realname,
                        'id_verifikator' => Auth::user()->id
                    ]);
                } else {
                    SmisDocCatatanPerkembanganPasienTerintegrasiRawatInap::updateOrCreate([
                        'id' => $req->id
                    ], [
                        'id_dpjp' => Auth::user()->id,
                        'nama_dpjp' => Auth::user()->realname,
                        'catatan_dpjp' => $req->catatan_dpjp,
                    ]);
                }

                return true;
                break;
            case 'dpjp_utama':
                $select = SmisDocCatatanPerkembanganPasienTerintegrasiRawatInap::where('id', $req->id)->first();
                $file_penunjang = $select ? $select->file_penunjang_eksternal : '';

                if ($req->file('file_penunjang')) {
                    $file_penunjang = $this->upload_file_penunjang_cppt($req);
                }

                SmisDocCatatanPerkembanganPasienTerintegrasiRawatInap::updateOrCreate([
                    'id' => $req->id
                ], [
                    'id_ppa' => $req->id_ppa,
                    'nama_ppa' => $req->nama_ppa,
                    'objective_lain' => $req->objective,
                    'subjective' => $req->subjective,
                    'instruksi' => $req->instruksi,
                    'tindak_lanjut' => $req->tindak_lanjut,
                    'id_verifikator' => Auth::user()->id,
                    'nama_verifikator' => Auth::user()->realname,
                    'status' => 1,
                    'file_penunjang_eksternal' => $file_penunjang
                ]);

                DokumenKunjungan::where('id', $req->dokumen)->update([
                    'tanggal_update' => date('Y-m-d H:i:s'),
                    'nama_verifikator' => Auth::user()->realname,
                    'id_verifikator' => Auth::user()->id
                ]);
                return true;
                break;
            case 'dpjp_pendamping':
                $select = SmisDocCatatanPerkembanganPasienTerintegrasiRawatInap::where('id', $req->id)->first();
                $file_penunjang = $select ? $select->file_penunjang_eksternal : '';

                if ($req->file('file_penunjang')) {
                    $file_penunjang = $this->upload_file_penunjang_cppt($req);
                }

                SmisDocCatatanPerkembanganPasienTerintegrasiRawatInap::updateOrCreate([
                    'id' => $req->id
                ], [
                    'id_ppa' => $req->id_ppa,
                    'nama_ppa' => $req->nama_ppa,
                    'objective_lain' => $req->objective,
                    'subjective' => $req->subjective,
                    'instruksi' => $req->instruksi,
                    'tindak_lanjut' => $req->tindak_lanjut,
                    'id_verifikator' => Auth::user()->id,
                    'nama_verifikator' => Auth::user()->realname,
                    'status' => 1,
                    'file_penunjang_eksternal' => $file_penunjang
                ]);

                DokumenKunjungan::where('id', $req->dokumen)->update([
                    'tanggal_update' => date('Y-m-d H:i:s'),
                    'nama_verifikator' => Auth::user()->realname,
                    'id_verifikator' => Auth::user()->id
                ]);
                return true;
                break;
            default:
                # code...
                break;
        }

        return false;
    }

    function upload_file_penunjang_cppt($req)
    {
        $file = $req->file('file_penunjang');
        $nama_file = time() . "_" . $file->getClientOriginalName();
        $tujuan_upload = 'file_penunjang_eksternal_cppt';
        $file->move($tujuan_upload, $nama_file);
        return $nama_file;
    }

    function cppt_diagnosa_store($req)
    {
        $dokumen = DokumenKunjungan::join('smis_rg_patient', 'smis_rg_patient.id', 'dokumen_kunjungan_pasien.nrm')
            ->select(
                'dokumen_kunjungan_pasien.*',
                'smis_rg_patient.nama_provinsi',
                'smis_rg_patient.nama_kabupaten',
                'smis_rg_patient.nama_kecamatan',
                'smis_rg_patient.nama_kelurahan',
                'smis_rg_patient.alamat',
                'smis_rg_patient.sebutan',
                'smis_rg_patient.profile_number',
                'smis_rg_patient.kelamin',
                'smis_rg_patient.tgl_lahir',
                'smis_rg_patient.id as nrm',
            )->where('dokumen_kunjungan_pasien.id', $req->dokumen)->first();
        $diagnosa = Smis_Mr_Icd::where('nama', $req->diagnosa)->first();
        $diagnosa_pembanding = Smis_Mr_Icd::where('nama', $req->diagnosa_pembanding)->first();
        $diagnosa_pra_bedah = Smis_Mr_Icd::where('nama', $req->diagnosa_pra_bedah)->first();
        $diagnosa_pasca_bedah = Smis_Mr_Icd::where('nama', $req->diagnosa_pasca_bedah)->first();

        $diagnosa_sekunder_satu = Smis_Mr_Icd::where('nama', $req->diagnosa_sekunder_satu)->first();
        $diagnosa_sekunder_dua = Smis_Mr_Icd::where('nama', $req->diagnosa_sekunder_dua)->first();

        $diagnosa_sekunder_tiga = Smis_Mr_Icd::where('nama', $req->diagnosa_sekunder_tiga)->first();
        $diagnosa_sekunder_empat = Smis_Mr_Icd::where('nama', $req->diagnosa_sekunder_empat)->first();
        $diagnosa_sekunder_lima = Smis_Mr_Icd::where('nama', $req->diagnosa_sekunder_lima)->first();

        if ($req->id_diagnosa == 0) {
            $id = DB::table('smis_mr_diagnosa')->insertGetId([
                'noreg_pasien' => $req->noreg,
                'tanggal' => $req->tanggal,
                'diagnosa' => $req->diagnosa,
                'kode_icd_diagnosa_sekunder1' => $diagnosa_sekunder_satu ? $diagnosa_sekunder_satu->icd : '',
                'diagnosa_sekunder1' => $req->diagnosa_sekunder_satu ? $req->diagnosa_sekunder_satu : '',
                'kode_icd_diagnosa_sekunder2' => $diagnosa_sekunder_dua ? $diagnosa_sekunder_dua->icd : '',
                'diagnosa_sekunder2' => $req->diagnosa_sekunder_dua ? $req->diagnosa_sekunder_dua : '',
                'kode_icd_diagnosa_sekunder3' => $diagnosa_sekunder_tiga ? $diagnosa_sekunder_tiga->icd : '',
                'diagnosa_sekunder3' => $req->diagnosa_sekunder_tiga ? $req->diagnosa_sekunder_tiga : '',
                'kode_icd_diagnosa_sekunder4' => $diagnosa_sekunder_empat ? $diagnosa_sekunder_empat->icd : '',
                'diagnosa_sekunder4' => $req->diagnosa_sekunder_empat ? $req->diagnosa_sekunder_empat : '',
                'kode_icd_diagnosa_sekunder5' => $diagnosa_sekunder_lima ? $diagnosa_sekunder_lima->icd : '',
                'diagnosa_sekunder5' => $req->diagnosa_sekunder_lima ? $req->diagnosa_sekunder_lima : '',
                'diagnosa_tindakan' => $req->diagnosa_tindakan_satu ? $req->diagnosa_tindakan_satu : '',
                'diagnosa_tindakan2' => $req->diagnosa_tindakan_dua ? $req->diagnosa_tindakan_dua : '',
                'diagnosa_tindakan3' => $req->diagnosa_tindakan_tiga ? $req->diagnosa_tindakan_tiga : '',
                'diagnosa_kematian' => $req->diagnosa_kematian ? $req->diagnosa_kematian : '',
                'id_dokter' => $req->id_dokter,
                'nama_dokter' => $req->dokter,
                'nama_icd' => $diagnosa ? $diagnosa->nama : '',
                'kode_icd' => $diagnosa ? $diagnosa->icd : '',
                'kode_icd_tindakan' => $req->kode_icd_tindakan ? $req->kode_icd_tindakan : '',
                'sebab_sakit' => $req->penyebab ? $req->penyebab : '',
                'ruangan' => $req->ruangan,
                'nrm_pasien' => $dokumen ? $dokumen->nrm : '',
                'nama_pasien' => $dokumen ? $dokumen->nama_pasien : '',
                'time_updated' => date('Y-m-d H:i:s'),
                'origin' => 'rshm',
                'duplicate' => 0,
                'autonomous' => '[rshm]',
                'origin_updated' => 'rshm',
                'propinsi' => $dokumen ? $dokumen->nama_provinsi : '',
                'kabupaten' => $dokumen ? $dokumen->nama_kabupaten : '',
                'kecamatan' => $dokumen ? $dokumen->nama_kecamatan : '',
                'kelurahan' => $dokumen ? $dokumen->nama_kelurahan : '',
                'alamat' => $dokumen ? $dokumen->alamat : '',
                'sebutan' => $dokumen ? $dokumen->sebutan : '',
                'profile_number' => $dokumen ? $dokumen->profile_number : '',
                'jk' => $dokumen ? $dokumen->kelamin : '',
                'tgl_lahir' => $dokumen ? $dokumen->tgl_lahir : '',
                'diagnosa_pembanding' => $req->diagnosa_pembanding ? $req->diagnosa_pembanding : '',
                'nama_diagnosa_pembanding' => $diagnosa_pembanding ? $diagnosa_pembanding->nama : '',
                'kode_icd_diagnosa_pembanding' => $diagnosa_pembanding ? $diagnosa_pembanding->icd : '',
                'diagnosa_pra_bedah' => $req->diagnosa_pra_bedah ? $req->diagnosa_pra_bedah : '',
                'nama_diagnosa_pra_bedah' => $diagnosa_pra_bedah ? $diagnosa_pra_bedah->nama : '',
                'kode_icd_diagnosa_pra_bedah' => $diagnosa_pra_bedah ? $diagnosa_pra_bedah->icd : '',
                'diagnosa_pasca_bedah' => $req->diagnosa_pasca_bedah ? $req->diagnosa_pasca_bedah : '',
                'nama_diagnosa_pasca_bedah' => $diagnosa_pasca_bedah ? $diagnosa_pasca_bedah->nama : '',
                'kode_icd_diagnosa_pasca_bedah' => $diagnosa_pasca_bedah ? $diagnosa_pasca_bedah->icd : ''
            ]);
            $last = SMIS_Diagnosa::where('id', $id)->where('prop', '')->first();
            SmisDocCatatanPerkembanganPasienTerintegrasiRawatInap::where('id', $req->id)->update([
                'id_diagnosa' => $last->id
            ]);
            return true;
        } else {
            DB::table('smis_mr_diagnosa')->where('id', $req->id_diagnosa)->update([
                'tanggal' => $req->tanggal,
                'diagnosa' => $req->diagnosa,
                'kode_icd_diagnosa_sekunder1' => $diagnosa_sekunder_satu ? $diagnosa_sekunder_satu->icd : '',
                'diagnosa_sekunder1' => $req->diagnosa_sekunder_satu ? $req->diagnosa_sekunder_satu : '',
                'kode_icd_diagnosa_sekunder2' => $diagnosa_sekunder_dua ? $diagnosa_sekunder_dua->icd : '',
                'diagnosa_sekunder2' => $req->diagnosa_sekunder_dua ? $req->diagnosa_sekunder_dua : '',
                'kode_icd_diagnosa_sekunder3' => $diagnosa_sekunder_tiga ? $diagnosa_sekunder_tiga->icd : '',
                'diagnosa_sekunder3' => $req->diagnosa_sekunder_tiga ? $req->diagnosa_sekunder_tiga : '',
                'kode_icd_diagnosa_sekunder4' => $diagnosa_sekunder_empat ? $diagnosa_sekunder_empat->icd : '',
                'diagnosa_sekunder4' => $req->diagnosa_sekunder_empat ? $req->diagnosa_sekunder_empat : '',
                'kode_icd_diagnosa_sekunder5' => $diagnosa_sekunder_lima ? $diagnosa_sekunder_lima->icd : '',
                'diagnosa_sekunder5' => $req->diagnosa_sekunder_lima ? $req->diagnosa_sekunder_lima : '',
                'diagnosa_tindakan' => $req->diagnosa_tindakan_satu ? $req->diagnosa_tindakan_satu : '',
                'diagnosa_tindakan2' => $req->diagnosa_tindakan_dua ? $req->diagnosa_tindakan_dua : '',
                'diagnosa_tindakan3' => $req->diagnosa_tindakan_tiga ? $req->diagnosa_tindakan_tiga : '',
                'diagnosa_kematian' => $req->diagnosa_kematian ? $req->diagnosa_kematian : '',
                'id_dokter' => $req->id_dokter,
                'nama_dokter' => $req->dokter,
                'nama_icd' => $diagnosa ? $diagnosa->nama : '',
                'kode_icd' => $diagnosa ? $diagnosa->icd : '',
                'kode_icd_tindakan' => $req->kode_icd_tindakan ? $req->kode_icd_tindakan : '',
                'sebab_sakit' => $req->penyebab ? $req->penyebab : '',
                'ruangan' => $req->ruangan,
                'nrm_pasien' => $dokumen ? $dokumen->nrm : '',
                'nama_pasien' => $dokumen ? $dokumen->nama_pasien : '',
                'time_updated' => date('Y-m-d H:i:s'),
                'origin' => 'rshm',
                'duplicate' => 0,
                'autonomous' => '[rshm]',
                'origin_updated' => 'rshm',
                'propinsi' => $dokumen ? $dokumen->nama_provinsi : '',
                'kabupaten' => $dokumen ? $dokumen->nama_kabupaten : '',
                'kecamatan' => $dokumen ? $dokumen->nama_kecamatan : '',
                'kelurahan' => $dokumen ? $dokumen->nama_kelurahan : '',
                'alamat' => $dokumen ? $dokumen->alamat : '',
                'sebutan' => $dokumen ? $dokumen->sebutan : '',
                'profile_number' => $dokumen ? $dokumen->profile_number : '',
                'jk' => $dokumen ? $dokumen->kelamin : '',
                'tgl_lahir' => $dokumen ? $dokumen->tgl_lahir : '',
                'diagnosa_pembanding' => $req->diagnosa_pembanding ? $req->diagnosa_pembanding : '',
                'nama_diagnosa_pembanding' => $diagnosa_pembanding ? $diagnosa_pembanding->nama : '',
                'kode_icd_diagnosa_pembanding' => $diagnosa_pembanding ? $diagnosa_pembanding->icd : '',
                'diagnosa_pra_bedah' => $req->diagnosa_pra_bedah ? $req->diagnosa_pra_bedah : '',
                'nama_diagnosa_pra_bedah' => $diagnosa_pra_bedah ? $diagnosa_pra_bedah->nama : '',
                'kode_icd_diagnosa_pra_bedah' => $diagnosa_pra_bedah ? $diagnosa_pra_bedah->icd : '',
                'diagnosa_pasca_bedah' => $req->diagnosa_pasca_bedah ? $req->diagnosa_pasca_bedah : '',
                'nama_diagnosa_pasca_bedah' => $diagnosa_pasca_bedah ? $diagnosa_pasca_bedah->nama : '',
                'kode_icd_diagnosa_pasca_bedah' => $diagnosa_pasca_bedah ? $diagnosa_pasca_bedah->icd : ''
            ]);
            return true;
        }
        return false;
    }

    function data_asesmen_awal_pasien_ranap_petriadik($req)
    {
        $dokumen = DokumenKunjungan::findOrFail($req->dokumen);
        $petriadik = Smis_Doc_Asesmen_Awal_Pasien_Ranap_Petriadik::where('id_dokumen', $dokumen->id)->first();
        $data['pasien'] = SMIS_Pasien::where('id', $dokumen->nrm)->first();
        $data['dokumen'] = $dokumen;
        $data['layanan'] = SMIS_LayananPasien::where('smis_rg_layananpasien.id', $dokumen->noreg)
            ->leftjoin('smis_rg_asuransi', 'smis_rg_asuransi.id', 'smis_rg_layananpasien.asuransi')
            ->select('smis_rg_layananpasien.*', 'smis_rg_asuransi.nama as asuransi')->first();
        $data['pesanan_lab'] = SMIS_LabPesanan::where('id', ($petriadik ? $petriadik->id_pesanan_lab : 0))->where('prop', '')->first();
        $data['pesanan_rad'] = Smis_Rad_Pesanan::where('id', ($petriadik ? $petriadik->id_pesanan_rad : 0))->where('prop', '')->first();
        $data['petriadik'] = $petriadik;
        $data['dokter'] = SmisHrdEmployee::where('nama', ($dokumen->nama_verifikator != '' ? $dokumen->nama_verifikator : Auth::user()->realname))->first();
        $data['perawat'] = SmisHrdEmployee::where('nama', ($petriadik ? $petriadik->nama_perawat_verif : ''))->first();
        $data['ruangan'] = SmisAdmPrototype::where('prop', '')->get();
        $data['list_kelas'] = Smis_Mjm_Kelas::where('prop', '')->get();
        $diagnosa = SMIS_Diagnosa::where('id', ($petriadik ? $petriadik->id_diagnosa : 0))->where('prop', '')->first();
        $data['kelas_lab'] = SmisAdmSettings::where('name', 'laboratory-ui-pemeriksaan-default-kelas')->first();
        $data['kelas_rad'] = SmisAdmSettings::where('name', 'radiology-ui-pemeriksaan-default-jenis')->first();
        $data['pemeriksaan'] = Smis_Lab_Layanan::where('prop', '')->get();
        $data['pemeriksaan_radiologi'] = Smis_Rad_Layanan::where('prop', '')->get();
        $data['master_hasil'] = Smis_Lab_Hasil::where('prop', '')->orderBy('grup')->get();
        $data['resep'] = SMIS_Er_Resep::with('detail')->where('id', ($petriadik ? $petriadik->id_e_resep : 0))->where('prop', '')->first();

        $data['diagnosa'] = $diagnosa;
        $data['kode_sekunder1'] = Smis_Mr_Icd::where('nama', ($diagnosa ? $diagnosa->diagnosa_sekunder1 : ''))->first();
        $data['kode_sekunder2'] = Smis_Mr_Icd::where('nama', ($diagnosa ? $diagnosa->diagnosa_sekunder2 : ''))->first();
        $data['kode_sekunder3'] = Smis_Mr_Icd::where('nama', ($diagnosa ? $diagnosa->diagnosa_sekunder3 : ''))->first();
        $data['kode_sekunder4'] = Smis_Mr_Icd::where('nama', ($diagnosa ? $diagnosa->diagnosa_sekunder4 : ''))->first();
        $data['kode_sekunder5'] = Smis_Mr_Icd::where('nama', ($diagnosa ? $diagnosa->diagnosa_sekunder5 : ''))->first();
        return $data;
    }

    function store_asesmen_awal_pasien_ranap_petriadik($req)
    {
        $data = [
            'id_pesanan_lab' => $req->id_pesanan_lab,
            'id_pesanan_rad' => $req->id_pesanan_rad,
            'id_e_resep' => $req->id_e_resep,
            'id_diagnosa' => $req->id_diagnosa,
            'tanggal_tiba' => $req->tiba_tanggal && $req->tiba_jam ? date('Y-m-d', strtotime($req->tiba_tanggal)) . ' ' . $req->tiba_jam : null,
            'tanggal_pengkajian' => $req->pengkajian_tanggal && $req->pengkajian_jam ? date('Y-m-d', strtotime($req->pengkajian_tanggal)) . ' ' . $req->pengkajian_jam : null,
            'diperoleh_dari' => $req->diperoleh_dari ? $req->diperoleh_dari : '',
            'hubungan_dengan_pasien' => $req->hubungan_dengan_pasien ? $req->hubungan_dengan_pasien : '',
            'nama_perawat' => $req->nama_perawat ? $req->nama_perawat : '',
            'anamnesis' => $req->anamnesis ? $req->anamnesis : '',
            'pemeriksaan_fisik' => $req->pemeriksaan_fisik ? $req->pemeriksaan_fisik : '',
            'tindakan_perawat' => $req->tindakan_perawat ? $req->tindakan_perawat : '',
            'anamnesis_perawat' => $req->anamnesis_p ? $req->anamnesis_p : '',
            'pemeriksaan_fisik_perawat' => $req->pemeriksaan_fisik_p ? $req->pemeriksaan_fisik_p : '',
            'spiritual' => $req->spiritual ? $req->spiritual : '',
            'status_psikologis' => $req->status_psikologis ? $req->status_psikologis : '',
            'skrining_nyeri' => $req->skrining_nyeri ? $req->skrining_nyeri : '',
            'skrining_resiko_cedera' => $req->skrining_resiko_cedera ? $req->skrining_resiko_cedera : '',
            'kebutuhan_komunikasi' => $req->kebutuhan_komunikasi ? $req->kebutuhan_komunikasi : '',
            'kebutuhan_privasi' => $req->kebutuhan_privasi_orang_tua ? $req->kebutuhan_privasi_orang_tua : '',
            'skrining_gizi' => $req->skrining_gizi ? $req->skrining_gizi : '',
            'daftar_masalah_keperawatan' => $req->daftar_masalah_keperawatan ? $req->daftar_masalah_keperawatan : '',
            'rencana_keperawatan' => $req->rencana_keperawatan ? $req->rencana_keperawatan : '',
            'perencanaan_perawatan' => $req->perencanaan_perawatan ? $req->perencanaan_perawatan : '',
            'perencanaan_pulang' => $req->perencanaan_pulang ? $req->perencanaan_pulang : '',
            'id_perawat' => Auth::user()->id,
            'nama_perawat_verif' => Auth::user()->realname,
        ];

        $dokumen = DokumenKunjungan::where('id', $req->dokumen)->first();
        $layanan = SMIS_LayananPasien::where("id", $dokumen->noreg)->first();

        DB::table('smis_mr_tanda_vital')->updateOrInsert([
            'waktu' =>  $layanan->tanggal,
            'nrm_pasien' => $dokumen->nrm,
            'noreg_pasien' => $dokumen->noreg,
            'nama_pasien' => $layanan->nama_pasien,
            'ruangan' => $layanan->last_ruangan,
        ], [
            'time_updated' => Carbon::now()->toDateTimeString(),
            'keadaan_umum' => $req->keadaan_umum ? $req->keadaan_umum : '',
            'kesadaran' => $req->kesadaran ? $req->kesadaran : '',
            'berat_badan' => $req->bb ? $req->bb : '',
            'tinggi_badan' => $req->tb_p ? $req->tb_p : '',
            'tensi' => $req->td ? $req->td : '',
            'nadi' => $req->nadi ? $req->nadi : '',
            'suhu' => $req->suhu ? $req->suhu : '',
            'rr' => $req->rr ? $req->rr : '',
        ]);
        $neonatus = Smis_Doc_Asesmen_Awal_Pasien_Ranap_Petriadik::updateOrCreate(['id_dokumen' => $req->dokumen], $data);
        return $neonatus;
    }

    /**
     * undocumented function
     *
     * @return void
     */
    public function serahTerimaBayiRawatGabung($idDokumen): array
    {
        $dokumen = DokumenKunjungan::findOrFail($idDokumen);
        $dataPasien = SMIS_Pasien::where('id', $dokumen->nrm)->first();
        $dataSerahTerima = SerahTerimaBayiRawatGabung::where('id_dokumen', $idDokumen)->first();
        $petugas = DB::table('smis_hrd_employee')->select("nama")->where('prop', '')->get();
        $employee = SmisHrdEmployee::where('nama', $dokumen->nama_verifikator)->where('prop', '')->first();
        return [
            'pasien' => $dataPasien,
            'dokumen' => $dokumen,
            'data_serah_terima' => $dataSerahTerima,
            'petugas' => $petugas,
            'employee' => $employee
        ];
    }

    /**
     * undocumented function
     *
     * @return array
     */
    public function storeSerahTerimaBayiRawatGabung($request): array
    {
        $folderPath = public_path('signature_patient/');

        $nameFileMengetahui = null;
        $nameFileMenerima = null;

        if (isset($request["ttd_mengetahui"])) {
            try {
                $image_parts_mengetahui = explode(";base64,", $request["ttd_mengetahui"]);

                $image_type_aux_mengetahui = explode("image/", $image_parts_mengetahui[0]);

                $image_type_mengetahui = $image_type_aux_mengetahui[1];

                $image_base64 = base64_decode($image_parts_mengetahui[1]);

                $fileName = uniqid() . '.' . $image_type_mengetahui;
                $file = $folderPath . $fileName;

                file_put_contents($file, $image_base64);
                $nameFileMengetahui = $fileName;
            } catch (\Throwable $th) {
                return [
                    'status' => false,
                    'message' => "gagal upload ttd mengetahui"
                ];
            }
        }

        if (isset($request["ttd_menerima"])) {
            try {
                $image_parts_penerima = explode(";base64,", $request["ttd_menerima"]);

                $image_type_aux_penerima = explode("image/", $image_parts_penerima[0]);

                $image_type_penerima = $image_type_aux_penerima[1];

                $image_base64_penerima = base64_decode($image_parts_penerima[1]);

                $fileNamePenerima = uniqid() . '.' . $image_type_penerima;
                $file = $folderPath . $fileNamePenerima;

                file_put_contents($file, $image_base64_penerima);
                $nameFileMenerima = $fileNamePenerima;
            } catch (\Throwable $th) {
                return [
                    'status' => false,
                    'message' => "gagal upload ttd menerima"
                ];
            }
        }

        $request["penerima_bayi"] = $request["penerima_bayi"];
        $request["keluarga_penerima_bayi"] = $request["keluarga_penerima_bayi"];
        $request["tgl_penyerahan"] = $request["tgl_penyerahan"] .  " " . $request["jam_penyerahan"];
        if (!is_null($nameFileMengetahui)) {
            $request["ttd_mengetahui"] = $nameFileMengetahui;
        }
        if (!is_null($nameFileMenerima)) {
            $request["ttd_menerima"] = $nameFileMenerima;
        }

        try {
            SerahTerimaBayiRawatGabung::updateOrCreate(['id_dokumen' => $request["id_dokumen"]], $request);
            return [
                'status' => true,
                'message' => "sukses memperbaharui data"
            ];
        } catch (Throwable $th) {
            return [
                'status' => false,
                'message' => $th->getMessage()
            ];
        }
    }
}
