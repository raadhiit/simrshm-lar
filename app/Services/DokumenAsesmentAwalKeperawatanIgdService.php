<?php

namespace App\Services;

use App\Models\DokumenKunjungan;
use App\Models\Smis_Doc_Dokumen_Asesment_Awal_Keperawatan_Igd;
use App\Models\SMIS_Er_Resep;
use App\Models\SMIS_Ksr_Kolektif;
use App\Models\Smis_Lab_Hasil;
use App\Models\Smis_Lab_Layanan;
use App\Models\SMIS_LayananPasien;
use App\Models\Smis_Mr_Icd;
use App\Models\Smis_Rad_Layanan;
use App\Models\SMIS_Rg_Perujuk;
use App\Models\SmisHrdEmployee;
use App\Models\SmisAdmPrototype;
use App\Models\SmisAdmSettings;
use App\Models\Smis_Mjm_Kelas;
use Illuminate\Support\Facades\Auth;

class DokumenAsesmentAwalKeperawatanIgdService
{
    function create($data)
    {
        $tes = Smis_Doc_Dokumen_Asesment_Awal_Keperawatan_Igd::updateOrCreate([
            'id_dokumen' => $data->dokumen,
        ], [
            'tgl_respon_time' => $data->tgl_respon_time,
            'jam_respon_time' => $data->jam_respon_time,
            'jenis_pembayaran' => $data->jenis_pembayaran,
            'jenis_kasus' => $data->jenis_kasus,
            'jenis_kasus_lainnya' => $data->jenis_kasus_lainnya,
            // 'transportasi' => $data->transportasi,
            'transportasi' => $data->transportasi ? $data->transportasi : '[]',
            'rujukan_dari' => $data->rujukan_dari,
            'allo_anamnesa' => $data->allo_anamnesa,
            'nama' => $data->nama,
            'kelamin' => $data->kelamin,
            'alamat' => $data->alamat,
            'agama' => $data->agama,
            'agama_lain' => $data->agama_lain,
            'status_pasien' => $data->status_pasien,
            'hambatan_pasien' => $data->hambatan_pasien,
            'jenis_hambatan_pasien' => $data->jenis_hambatan_pasien,
            'ket_jenis_hambatan_pasien' => $data->ket_jenis_hambatan_pasien,
            'keluhan_utama' => $data->keluhan_utama,
            'airway' => $data->airway,
            'airway_lain' => $data->airway_lain,
            'breathing' => $data->breathing,
            'breathing_lain' => $data->breathing_lain,
            'pola_pernafasan' => $data->pola_pernafasan,
            'pernafasan_lain' => $data->pernafasan_lain,
            'circulation' => $data->circulation,
            'pendarahan' => $data->pendarahan,
            'pendarahan_lain' => $data->pendarahan_lain,
            'luka_bakar' => $data->luka_bakar,
            'crt' => $data->crt,
            'kulit' => $data->kulit,
            'akral' => $data->akral,
            'turgor' => $data->turgor,
            'skor_buka_mata' => $data->skor_buka_mata,
            'skor_respon_verbal' => $data->skor_respon_verbal,
            'skor_respon_motorik' => $data->skor_respon_motorik,
            'e_kesadaran' => $data->e_kesadaran,
            'm_kesadaran' => $data->m_kesadaran,
            'v_kesadaran' => $data->v_kesadaran,
            'reflek_cahaya' => $data->reflek_cahaya,
            'kesadaran' => $data->kesadaran,
            'diameter_pupil' => $data->diameter_pupil,
            'diameter_pupil1' => $data->diameter_pupil1,
            'ekstramitas_atas' => $data->ekstramitas_atas,
            'ekstramitas_atas1' => $data->ekstramitas_atas1,
            'ekstramitas_bawah' => $data->ekstramitas_bawah,
            'ekstramitas_bawah1' => $data->ekstramitas_bawah1,
            'kesadaran2' => $data->kesadaran2,
            // 'tanda_kehidupan' => $data->tanda_kehidupan,
            'tanda_kehidupan' => $data->tanda_kehidupan ? $data->tanda_kehidupan : '[]',
            'jam_penentuan_kematian' => $data->jam_penentuan_kematian,
            'eksposure' => $data->eksposure,
            'hptp' => $data->hptp,
            'tafsiran_partus' => $data->tafsiran_partus,
            'perkawinan' => $data->perkawinan,
            'lama_perkawinan' => $data->lama_perkawinan,
            'pemeriksaan_antenatal' => $data->pemeriksaan_antenatal ? $data->pemeriksaan_antenatal : [],
            'ket_pemeriksaan_antenatal' => $data->ket_pemeriksaan_antenatal,
            'riwayat_kb' => $data->riwayat_kb,
            'ket_riwayat_kb' => $data->ket_riwayat_kb,
            'riwayat_ginekologi' => $data->riwayat_ginekologi,
            'ket_riwayat_ginekologi' => $data->ket_riwayat_ginekologi,
            'riwayat_penyakit_kehamilan' => $data->riwayat_penyakit_kehamilan,
            'riwayat_operasi' => $data->riwayat_operasi,
            'ket_riwayat_operasi' => $data->ket_riwayat_operasi,
            'tempat_riwayat_operasi' => $data->tempat_riwayat_operasi,
            'komplikasi_kehamilan' => $data->komplikasi_kehamilan,
            'det_komplikasi_kehamilan' => $data->det_komplikasi_kehamilan,
            'ket_det_komplikasi_kehamilan' => $data->ket_det_komplikasi_kehamilan,
            'riwayat_imunisasi' => $data->riwayat_imunisasi,
            'g_riwayat_kehamilan' => $data->g_riwayat_kehamilan,
            'p_riwayat_kehamilan' => $data->p_riwayat_kehamilan,
            'a_riwayat_kehamilan' => $data->a_riwayat_kehamilan,
            'hidup_riwayat_kehamilan' => $data->hidup_riwayat_kehamilan,
            'kebiasaan_ibu_hamil' => $data->kebiasaan_ibu_hamil,
            'obat_minum' => $data->obat_minum,
            'ket_obat_minum_lain_lain' => $data->ket_obat_minum_lain_lain,
            'tfu' => $data->tfu,
            'tbj' => $data->tbj,
            'letak' => $data->letak,
            'persentase_kebidanan' => $data->persentase_kebidanan ? $data->persentase_kebidanan : [],
            'ket_persentase_kebidanan' => $data->ket_persentase_kebidanan,
            'kontraksi' => $data->kontraksi,
            'kekuatan' => $data->kekuatan,
            'lama' => $data->lama,
            'gerak_janin' => $data->gerak_janin,
            'bjs' => $data->bjs,
            'rad_gerak_janin' => $data->rad_gerak_janin,
            'pd' => $data->pd,
            'oleh' => $data->oleh,
            'partio' => $data->partio,
            'pembukaan_servik' => $data->pembukaan_servik,
            'hodge' => $data->hodge,
            // 'tanda_persalinan' => $data->tanda_persalinan,
            'tanda_persalinan' => $data->tanda_persalinan ? $data->tanda_persalinan : [],
            'tgl_kontraksi' => $data->tgl_kontraksi,
            'jam_kontraksi' => $data->jam_kontraksi,
            'keluar' => $data->keluar,
            'keluar_darah' => $data->keluar_darah,
            'keluar_air_ketuban' => $data->keluar_air_ketuban,
            'keluar_lendir' => $data->keluar_lendir,
            'keluar_dislokasi' => $data->keluar_dislokasi,
            'anak_ke' => $data->anak_ke,
            'ket_anak_ke' => $data->ket_anak_ke,
            'umur_kehamilan' => $data->umur_kehamilan,
            // 'penyakit_ibu' => $data->penyakit_ibu,
            'penyakit_ibu' => $data->penyakit_ibu ? $data->penyakit_ibu : [],

            'ket_penyakit_ibu' => $data->ket_penyakit_ibu,
            'riwayat_pengobatan_ibu' => $data->riwayat_pengobatan_ibu,
            'riwayat_persalinan' => $data->riwayat_persalinan,
            'ket_riwayat_persalinan' => $data->ket_riwayat_persalinan,
            'riwayat_diagnosa_ibu' => $data->riwayat_diagnosa_ibu,
            'tanggal_lahir_intranatal' => $data->tanggal_lahir_intranatal,
            'kondisi_saat_lahir' => $data->kondisi_saat_lahir,
            'riwayat_intranatal' => $data->riwayat_intranatal,
            'ket_riwayat_intranatal' => $data->ket_riwayat_intranatal,
            'cara_bersalin' => $data->cara_bersalin,
            'letak_tali_pusat' => $data->letak_tali_pusat,
            'tali_pusat' => $data->tali_pusat,
            'ket_tali_pusat' => $data->ket_tali_pusat,
            'perkembangan_anak' => $data->perkembangan_anak,
            'ket_berguling' => $data->ket_berguling,
            'ket_duduk' => $data->ket_duduk,
            'ket_berjalan' => $data->ket_berjalan,
            'ket_berdiri' => $data->ket_berdiri,
            'resiko_infeksi' => $data->resiko_infeksi,
            // 'mayor' => $data->mayor,
            'mayor' => $data->mayor ? $data->mayor : [],
            'minor' => $data->minor,
            'kesadaran3' => $data->kesadaran3,
            'ket_kesadaran3' => $data->ket_kesadaran3,
            'keadaan_umum2' => $data->keadaan_umum2,
            'bb2' => $data->bb2,
            'uraian_kepala' => $data->uraian_kepala,
            'ket_uraian_kepala' => $data->ket_uraian_kepala,
            'uraian_mata' => $data->uraian_mata,
            'ket_uraian_mata' => $data->ket_uraian_mata,
            'uraian_tht' => $data->uraian_tht,
            'ket_uraian_tht' => $data->ket_uraian_tht,
            'uraian_mulut' => $data->uraian_mulut,
            'ket_uraian_mulut' => $data->ket_uraian_mulut,
            'uraian_leher' => $data->uraian_leher,
            'ket_uraian_leher' => $data->ket_uraian_leher,
            'uraian_thorax' => $data->uraian_thorax,
            'ket_uraian_thorax' => $data->ket_uraian_thorax,
            'uraian_payudara' => $data->uraian_payudara,
            'ket_uraian_payudara' => $data->ket_uraian_payudara,
            'uraian_abdomen' => $data->uraian_abdomen,
            'ket_uraian_abdomen' => $data->ket_uraian_abdomen,
            'uraian_urogenital' => $data->uraian_urogenital,
            'ket_uraian_urogenital' => $data->ket_uraian_urogenital,
            'uraian_ekstermitas' => $data->uraian_ekstermitas,
            'uraian_kulit' => $data->uraian_kulit,
            'uraian_jantung' => $data->uraian_jantung,
            'saudara' => $data->saudara,
            'ket_kandung' => $data->ket_kandung,
            'ket_tiri' => $data->ket_tiri,
            'tinggal_bersama' => $data->tinggal_bersama,
            'ket_tinggal_lainnya' => $data->ket_tinggal_lainnya,
            'bicara' => $data->bicara,
            'komunikasi' => $data->komunikasi,
            'emosional' => $data->emosional,
            'gangguan_jiwa' => $data->gangguan_jiwa,
            'tahun_gangguan_jiwa' => $data->tahun_gangguan_jiwa,
            'riwayat_trauma' => $data->riwayat_trauma,
            'ket_kriminal' => $data->ket_kriminal,
            'perasaan' => $data->perasaan,
            'wawancara' => $data->wawancara,
            'spiritual' => $data->spiritual,
            'kebutuhan_spiritual' => $data->kebutuhan_spiritual,
            'bantuan_ibadah' => $data->bantuan_ibadah,
            'riwayat_alergi' => $data->riwayat_alergi,
            'riwayat_alergi1' => $data->riwayat_alergi1,
            'reaksis1' => $data->reaksis1,
            'riwayat_alergi2' => $data->riwayat_alergi2,
            'reaksis2' => $data->reaksis2,
            'riwayat_alergi3' => $data->riwayat_alergi3,
            'reaksis3' => $data->reaksis3,
            'nyeri' => $data->nyeri,
            'sifat_nyeri' => $data->sifat_nyeri,
            'kualitas_nyeri' => $data->kualitas_nyeri,
            'nyeri_menjalar' => $data->nyeri_menjalar,
            'ket_nyeri_menjalar' => $data->ket_nyeri_menjalar,
            'skor_nyeri' => $data->skor_nyeri,
            'frekuensi_nyeri' => $data->frekuensi_nyeri,
            'pengaruh_nyeri' => $data->pengaruh_nyeri,
            'nilai_wajah' => $data->nilai_wajah,
            'nilai_kaki' => $data->nilai_kaki,
            'nilai_aktifitas' => $data->nilai_aktifitas,
            'nilai_menangis' => $data->nilai_menangis,
            'nilai_bersuara' => $data->nilai_bersuara,
            'faktor_pencetus' => $data->faktor_pencetus,
            'kualitas' => $data->kualitas,
            'lokasi' => $data->lokasi,
            'skala_nyeri' => $data->skala_nyeri,
            'lama_nyeri' => $data->lama_nyeri,
            'resiko_jatuh_anak' => $data->resiko_jatuh_anak,
            'resiko_jatuh_dewasa' => $data->resiko_jatuh_dewasa,
            'resiko_jatuh' => $data->resiko_jatuh,
            'bb_gizi' => $data->bb_gizi,
            'pb_gizi' => $data->pb_gizi,
            'imt_gizi' => $data->imt_gizi,
            'tampak_kurus' => $data->tampak_kurus,
            'penurunan_bb' => $data->penurunan_bb,
            'asupan_makanan' => $data->asupan_makanan,
            'hasil_skrining_gizi' => $data->hasil_skrining_gizi,
            'saran_skrining_gizi' => $data->saran_skrining_gizi,
            'sensorik_penglihatan' => $data->sensorik_penglihatan,
            'sensorik_penciuman' => $data->sensorik_penciuman,
            'sensorik_pendengaran' => $data->sensorik_pendengaran,
            'kognitif_satu' => $data->kognitif_satu,
            'motorik_satu' => $data->motorik_satu,
            'motorik_dua' => $data->motorik_dua,
            'saran_satu' => $data->saran_satu,
            'saran_dua' => $data->saran_dua,
            'saran_tiga' => $data->saran_tiga,
            'hasil_discharge_planning' => $data->hasil_discharge_planning,
            'saran_discharge_planning' => $data->saran_discharge_planning,

            'nama_obat_satu' => $data->nama_obat_satu,
            'nama_obat_dua' => $data->nama_obat_dua,
            'nama_obat_tiga' => $data->nama_obat_tiga,
            'nama_obat_empat' => $data->nama_obat_empat,
            'nama_obat_lima' => $data->nama_obat_lima,
            'nama_obat_enam' => $data->nama_obat_enam,
            'jumlah_satu' => $data->jumlah_satu,
            'jumlah_dua' => $data->jumlah_dua,
            'jumlah_tiga' => $data->jumlah_tiga,
            'jumlah_empat' => $data->jumlah_empat,
            'jumlah_lima' => $data->jumlah_lima,
            'jumlah_enam' => $data->jumlah_enam,
            'aturan_pakai_satu' => $data->aturan_pakai_satu,
            'aturan_pakai_dua' => $data->aturan_pakai_dua,
            'aturan_pakai_tiga' => $data->aturan_pakai_tiga,
            'aturan_pakai_empat' => $data->aturan_pakai_empat,
            'aturan_pakai_lima' => $data->aturan_pakai_lima,
            'aturan_pakai_enam' => $data->aturan_pakai_enam,
            'tgl_satu' => $data->tgl_satu,
            'tgl_dua' => $data->tgl_dua,
            'tgl_tiga' => $data->tgl_tiga,
            'tgl_empat' => $data->tgl_empat,
            'tgl_lima' => $data->tgl_lima,
            'tgl_enam' => $data->tgl_enam,
            'keterangan_satu' => $data->keterangan_satu,
            'keterangan_dua' => $data->keterangan_dua,
            'keterangan_tiga' => $data->keterangan_tiga,
            'keterangan_empat' => $data->keterangan_empat,
            'keterangan_lima' => $data->keterangan_lima,
            'keterangan_enam' => $data->keterangan_enam,
            'masalah_keperawatan' => $data->masalah_keperawatan ? $data->masalah_keperawatan : [],
            // 'masalah_keperawatan_nyeri' => $data->masalah_keperawatan_nyeri,
            // 'gangguan_pernafasan' => $data->gangguan_pernafasan,
            // 'potensi_infeksi' => $data->potensi_infeksi,
            // 'volume_cairan' => $data->volume_cairan,
            // 'perubahan_nutrisi' => $data->perubahan_nutrisi,
            // 'cemas' => $data->cemas,
            // 'perfusi_jaringan' => $data->perfusi_jaringan,
            // 'hipertensi' => $data->hipertensi,
            'jam_satu' => $data->jam_satu,
            'jam_dua' => $data->jam_dua,
            'jam_tiga' => $data->jam_tiga,
            'jam_empat' => $data->jam_empat,
            'jam_lima' => $data->jam_lima,
            'jam_enam' => $data->jam_enam,
            'jam_tujuh' => $data->jam_tujuh,
            'jam_delapan' => $data->jam_delapan,
            'jam_sembilan' => $data->jam_sembilan,
            'jam_sepuluh' => $data->jam_sepuluh,
            'jam_sebelas' => $data->jam_sebelas,
            'jam_duabelas' => $data->jam_duabelas,
            'jam_tigabelas' => $data->jam_tigabelas,
            'jam_empatbelas' => $data->jam_empatbelas,
            'jam_limabelas' => $data->jam_limabelas,
            'jam_enambelas' => $data->jam_enambelas,

            'implementasi_keperawatan' => $data->implementasi_keperawatan ? $data->implementasi_keperawatan : [],
            // 'observasi_ttv' => $data->observasi_ttv,
            // 'intake_output' => $data->intake_output,
            // 'monitor_pernafasan' => $data->monitor_pernafasan,
            // 'oksimetri' => $data->oksimetri,
            // 'semi_flower' => $data->semi_flower,
            // 'pemasangan_opa' => $data->pemasangan_opa,
            // 'sutlon' => $data->sutlon,
            // 'nafas_efektif' => $data->nafas_efektif,
            // 'oksigen' => $data->oksigen,
            // 'imobilisasi' => $data->imobilisasi,
            // 'perawatan_luka' => $data->perawatan_luka,
            // 'pengelolaan_nyeri' => $data->pengelolaan_nyeri,
            // 'teknik_asepti' => $data->teknik_asepti,
            'liter' => $data->liter,
            'ik_satu' => $data->ik_satu,
            'ik_dua' => $data->ik_dua,
            'ik_tiga' => $data->ik_tiga,

            'tgljamsatu' => $data->tgljamsatu,
            'tgljamdua' => $data->tgljamdua,
            'tgljamtiga' => $data->tgljamtiga,
            'tgljamempat' => $data->tgljamempat,
            'tgljamlima' => $data->tgljamlima,
            'tgljamenam' => $data->tgljamenam,
            'tgljamtujuh' => $data->tgljamtujuh,
            'tgljamdelapan' => $data->tgljamdelapan,
            'tgljamsembilan' => $data->tgljamsembilan,
            'tgljamsepuluh' => $data->tgljamsepuluh,
            'tindakansatu' => $data->tindakansatu,
            'tindakandua' => $data->tindakandua,
            'tindakantiga' => $data->tindakantiga,
            'tindakanempat' => $data->tindakanempat,
            'tindakanlima' => $data->tindakanlima,
            'tindakanenam' => $data->tindakanenam,
            'tindakantujuh' => $data->tindakantujuh,
            'tindakandelapan' => $data->tindakandelapan,
            'tindakansembilan' => $data->tindakansembilan,
            'tindakansepuluh' => $data->tindakansepuluh,
            'id_perawat_verif' => $data->id_perawat_verif,
            'nama_perawat_verif' => $data->nama_perawat_verif,

            'obat_cairan_satu' => $data->obat_cairan_satu,
            'obat_cairan_dua' => $data->obat_cairan_dua,
            'obat_cairan_tiga' => $data->obat_cairan_tiga,
            'obat_cairan_empat' => $data->obat_cairan_empat,
            'obat_cairan_lima' => $data->obat_cairan_lima,
            'obat_cairan_enam' => $data->obat_cairan_enam,
            'obat_cairan_tujuh' => $data->obat_cairan_tujuh,
            'obat_cairan_delapan' => $data->obat_cairan_delapan,
            'obat_cairan_sembilan' => $data->obat_cairan_sembilan,
            'obat_cairan_sepuluh' => $data->obat_cairan_sepuluh,
            'dosis_satu' => $data->dosis_satu,
            'dosis_dua' => $data->dosis_dua,
            'dosis_tiga' => $data->dosis_tiga,
            'dosis_empat' => $data->dosis_empat,
            'dosis_lima' => $data->dosis_lima,
            'dosis_enam' => $data->dosis_enam,
            'dosis_tujuh' => $data->dosis_tujuh,
            'dosis_delapan' => $data->dosis_delapan,
            'dosis_sembilan' => $data->dosis_sembilan,
            'dosis_sepuluh' => $data->dosis_sepuluh,
            'oral_satu' => $data->oral_satu,
            'oral_dua' => $data->oral_dua,
            'oral_tiga' => $data->oral_tiga,
            'oral_empat' => $data->oral_empat,
            'oral_lima' => $data->oral_lima,
            'oral_enam' => $data->oral_enam,
            'oral_tujuh' => $data->oral_tujuh,
            'oral_delapan' => $data->oral_delapan,
            'oral_sembilan' => $data->oral_sembilan,
            'oral_sepuluh' => $data->oral_sepuluh,
            'jampemberian_satu' => $data->jampemberian_satu,
            'jampemberian_dua' => $data->jampemberian_dua,
            'jampemberian_tiga' => $data->jampemberian_tiga,
            'jampemberian_empat' => $data->jampemberian_empat,
            'jampemberian_lima' => $data->jampemberian_lima,
            'jampemberian_enam' => $data->jampemberian_enam,
            'jampemberian_tujuh' => $data->jampemberian_tujuh,
            'jampemberian_delapan' => $data->jampemberian_delapan,
            'jampemberian_sembilan' => $data->jampemberian_sembilan,
            'jampemberian_sepuluh' => $data->jampemberian_sepuluh,

        ]);
    }

    function data($req)
    {
        $data['dokumen'] = DokumenKunjungan::with('dokumen_asesment_awal_keperawatan_igd')
            ->leftJoin('smis_adm_user', 'smis_adm_user.id', 'dokumen_kunjungan_pasien.id_verifikator')
            ->select('dokumen_kunjungan_pasien.*', 'smis_adm_user.username')
            ->where('dokumen_kunjungan_pasien.id', $req->dokumen)->first();
        $data['employee'] = SmisHrdEmployee::where('nama', $data['dokumen']->nama_verifikator)->first();
        $data['data_ppa'] = SmisHrdEmployee::where('nama', $data['dokumen']->ppa)->first();
        $data['petugas_penyerahan'] = SmisHrdEmployee::where('nama', $data['dokumen']->petugas_penyerahan)->first();

        $layanan = SMIS_LayananPasien::with(['diagnosa', 'pesanan_lab', 'pesanan_radiologi'])
            ->join('smis_rg_patient', 'smis_rg_patient.id', 'smis_rg_layananpasien.nrm')
            ->select(
                'smis_rg_patient.telpon',
                'smis_rg_patient.nama',
                'smis_rg_patient.tgl_lahir',
                'smis_rg_patient.kelamin',
                'smis_rg_patient.alamat',
                'smis_rg_patient.rt',
                'smis_rg_patient.rw',
                'smis_rg_patient.nama_kelurahan',
                'smis_rg_patient.nama_kecamatan',
                'smis_rg_patient.nama_kabupaten',
                'smis_rg_layananpasien.id',
                'smis_rg_layananpasien.nrm',
                'smis_rg_patient.ktp',
                'smis_rg_layananpasien.umur',
                'smis_rg_layananpasien.carabayar',
                'smis_rg_layananpasien.nama_pasien',
                'smis_rg_layananpasien.last_ruangan',
                'smis_rg_layananpasien.tanggal'
            )
            ->where('smis_rg_layananpasien.id', $data['dokumen']->noreg)
            ->first();

        $data['pemeriksaan'] = Smis_Lab_Layanan::where('prop', '')->get();
        $data['pemeriksaan_radiologi'] = Smis_Rad_Layanan::where('prop', '')->get();
        $data['master_hasil'] = Smis_Lab_Hasil::where('prop', '')->orderBy('grup')->get();
        $data['ruangan'] = SmisAdmPrototype::where('prop', '')->get();
        $data['list_kelas'] = Smis_Mjm_Kelas::where('prop', '')->get();
        $data['kelas'] = SmisAdmSettings::where('name', 'smis-rs-kelas-' . $layanan->last_ruangan)->first();
        $data['baru_lama'] = SMIS_LayananPasien::where('nrm', $data['dokumen']->nrm)->where('prop', '')->count();

        if ($layanan->diagnosa) {
            if ($layanan->diagnosa->diagnosa_sekunder1) {
                $data['kode_sekunder1'] = Smis_Mr_Icd::where('nama', $layanan->diagnosa->diagnosa_sekunder1)->first();
            }
            if ($layanan->diagnosa->diagnosa_sekunder2) {
                $data['kode_sekunder2'] = Smis_Mr_Icd::where('nama', $layanan->diagnosa->diagnosa_sekunder2)->first();
            }
            if ($layanan->diagnosa->diagnosa_sekunder3) {
                $data['kode_sekunder3'] = Smis_Mr_Icd::where('nama', $layanan->diagnosa->diagnosa_sekunder3)->first();
            }
            if ($layanan->diagnosa->diagnosa_sekunder4) {
                $data['kode_sekunder4'] = Smis_Mr_Icd::where('nama', $layanan->diagnosa->diagnosa_sekunder4)->first();
            }
            if ($layanan->diagnosa->diagnosa_sekunder5) {
                $data['kode_sekunder5'] = Smis_Mr_Icd::where('nama', $layanan->diagnosa->diagnosa_sekunder5)->first();
            }
            if ($layanan->diagnosa->diagnosa_pra_bedah) {
                $data['kode_diagnosa_pra_bedah'] = Smis_Mr_Icd::where('nama', $layanan->diagnosa->diagnosa_pra_bedah)->first();
            }
            if ($layanan->diagnosa->diagnosa_pasca_bedah) {
                $data['kode_diagnosa_pasca_bedah'] = Smis_Mr_Icd::where('nama', $layanan->diagnosa->diagnosa_pasca_bedah)->first();
            }
        }

        $data['layanan'] = $layanan;
        $data['tindakan_dokter'] = SMIS_Ksr_Kolektif::where('noreg_pasien', $data['dokumen']->noreg)
            ->where('nama_grup', 'tindakan_dokter')
            ->get();
        $data['tindakan_perawat'] = SMIS_Ksr_Kolektif::where('noreg_pasien', $data['dokumen']->noreg)
            ->where('nama_grup', 'tindakan_perawat')
            ->get();
        $data['oksigen_manual'] = SMIS_Ksr_Kolektif::where('noreg_pasien', $data['dokumen']->noreg)
            ->where('nama_grup', 'oksigen_manual')
            ->get();
        $data['oksigen_central'] = SMIS_Ksr_Kolektif::where('noreg_pasien', $data['dokumen']->noreg)
            ->where('nama_grup', 'oksigen_central')
            ->get();
        $data['all_resep'] = SMIS_Er_Resep::with('detail')->where('noreg_pasien', $data['layanan']->id)->get();
        $data['perujuk'] = SMIS_Rg_Perujuk::all();
        $data['dokter'] = SmisHrdEmployee::join('smis_hrd_job', 'smis_hrd_job.id', 'smis_hrd_employee.jabatan')
            ->select('smis_hrd_employee.id', 'smis_hrd_employee.nama', 'smis_hrd_job.nama as nama_jabatan')
            ->where('smis_hrd_job.nama', 'dokter')->get();
        $data['data_employee'] = SmisHrdEmployee::join('smis_hrd_job', 'smis_hrd_job.id', 'smis_hrd_employee.jabatan')
            ->select('smis_hrd_employee.id', 'smis_hrd_employee.nama', 'smis_hrd_job.nama as nama_jabatan')
            ->where('smis_hrd_job.nama', '!=', 'dokter')->get();
        $data['klinik'] = SmisAdmPrototype::where('prop', '!=', 'del')
            ->where('nama', 'LIKE', '%poli%')
            ->where('status', 'actived')
            ->get();
        // dd($data['dokumen']);
        return $data;
    }

    function save_gambar_lokasi_pengkajian_awal_medis($req)
    {
        $folderPath = public_path('status_lokalis/');

        $image_parts = explode(";base64,", $req->signed);

        $image_type_aux = explode("image/", $image_parts[0]);

        $image_type = $image_type_aux[1];

        $image_base64 = base64_decode($image_parts[1]);

        $fileName = uniqid() . '.' . $image_type;
        $file = $folderPath . $fileName;
        file_put_contents($file, $image_base64);

        $query = Smis_Doc_Dokumen_Asesment_Awal_Keperawatan_Igd::where('id_dokumen', $req->dokumen)->update([
            'gambar_status_lokalis' => $fileName
        ]);

        return $query;
    }
}
