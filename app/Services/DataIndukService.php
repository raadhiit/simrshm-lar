<?php

namespace App\Services;

use App\Models\SmisSbAutonomous;
use Illuminate\Support\Facades\DB;

/**
 * Class Services
 * @author rivald 
 */

class DataIndukService
{

    private $autonomousId;
    private $originAutonomous;

    /**
     * @param 
     */
    public function __construct()
    {
        $this->autonomousId = new SmisSbAutonomous();
        $this->originAutonomous = $this->autonomousId->getIdAutonomous()->autonomous_id;
    }

    //Action Bagian 
    public function getBagian()
    {
        return DB::table('smis_hrd_job')->where('prop', " ");
    }

    public function createBagian($request)
    {
        try {
            $inserData = DB::table('smis_hrd_job')->insertGetId([
                'nama' => $request->nama,
                'slug' => $request->slug,
                'keterangan' => $request->keterangan ?? " ",
                'prop' =>  " ",
                'autonomous' => $this->originAutonomous,
                'duplicate' => 0,
                'origin' => $this->originAutonomous,
                'origin_id' => 0,
                'time_updated' => date('Y-m-d H:i:s'),
                'origin_updated' => ''
            ]);
            DB::table('smis_hrd_job')
                ->where('id', $inserData)->update([
                    'origin_id' => $inserData
                ]);
            return 'sukses';
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function updateBagian($request)
    {
        try {
            DB::table('smis_hrd_job')
                ->where('id', $request->id)
                ->update([
                    'nama' => $request->nama,
                    'slug' => $request->slug,
                    'keterangan' => $request->keterangan ?? " ",
                    'time_updated' => date('Y-m-d H:i:s')
                ]);

            return 'sukses';
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function getBagianById($id)
    {
        return DB::table('smis_hrd_job')->where([
            ['id', $id],
            ['prop', ' '],
        ])
            ->select('id', 'nama', 'slug', 'keterangan')
            ->first();
    }

    public function deleteBagian($id)
    {
        try {
            DB::table('smis_hrd_job')
                ->where('id', $id)
                ->update([
                    'prop' => "del",
                    'time_updated' => date('Y-m-d H:i:s')
                ]);
            return 'sukses';
        } catch (Exception $th) {
            return $th->getMessage();
        }
    }

    public function getSearchBagian($request)
    {
        $data = DB::table('smis_hrd_job')
            ->where([
                ['prop', ' '],
                ['nama', 'like', '%' . $request->keyword . '%']
            ])
            ->orWhere([
                ['prop', ' '],
                ['slug', 'like', '%' . $request->keyword . '%']
            ])
            ->orWhere([
                ['prop', ' '],
                ['keterangan', 'like', '%' . $request->keyword . '%']
            ]);

        return $data;
    }

    public function getDownloadBagian($request)
    {
        if ($request->keyword == null) {
            return $this->getBagian()->get();
        } else {
            return $this->getSearchBagian($request)->get();
        }
    }

    //Ruangan Pegawai Action
    public function getRuanganPegawai()
    {
        return DB::table('smis_hrd_ruangan_pegawai')->where('prop', ' ');
    }

    public function createRuanganPegawai($request)
    {
        try {
            $idRuangan = DB::table('smis_hrd_ruangan_pegawai')->insertGetId([
                'ruangan_pegawai' => $request->nama,
                'keterangan' => $request->keterangan ?? " ",
                'prop' =>  " ",
                'autonomous' => $this->originAutonomous,
                'duplicate' => 0,
                'origin' => $this->originAutonomous,
                'origin_id' => 0,
                'time_updated' => date('Y-m-d H:i:s'),
                'origin_updated' => ''
            ]);
            DB::table('smis_hrd_ruangan_pegawai')
                ->where('id', $idRuangan)->update([
                    'origin_id' => $idRuangan
                ]);
            return 'sukses';
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function getRuanganPegawaiById($id)
    {
        return DB::table('smis_hrd_ruangan_pegawai')->where([
            ['id', $id],
            ['prop', ' '],
        ])
            ->select('id', 'ruangan_pegawai', 'keterangan')
            ->first();
    }

    public function updateRuanganPegawai($request)
    {
        try {
            DB::table('smis_hrd_ruangan_pegawai')
                ->where('id', $request->id)
                ->update([
                    'ruangan_pegawai' => $request->nama,
                    'keterangan' => $request->keterangan ?? " ",
                    'time_updated' => date('Y-m-d H:i:s')
                ]);

            return 'sukses';
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function deleteRuanganPegawai($id)
    {
        try {
            DB::table('smis_hrd_ruangan_pegawai')
                ->where('id', $id)
                ->update([
                    'prop' => "del",
                    'time_updated' => date('Y-m-d H:i:s')
                ]);
            return 'sukses';
        } catch (Exception $th) {
            return $th->getMessage();
        }
    }

    public function getSearchRuanganPegawai($request)
    {
        $data = DB::table('smis_hrd_ruangan_pegawai')
            ->where([
                ['prop', ' '],
                ['ruangan_pegawai', 'like', '%' . $request->keyword . '%']
            ])
            ->orWhere([
                ['prop', ' '],
                ['keterangan', 'like', '%' . $request->keyword . '%']
            ]);

        return $data;
    }

    public function getDownloadRuanganPegawai($request)
    {
        if ($request->keyword == null) {
            return $this->getRuanganPegawai()->get();
        } else {
            return $this->getSearchRuanganPegawai($request)->get();
        }
    }

    // Action Status Tenaga
    public function getStatusTenaga()
    {
        return DB::table('smis_hrd_status_tenaga')->where('prop', ' ');
    }

    public function createStatusTenaga($request)
    {
        try {
            $idRuangan = DB::table('smis_hrd_status_tenaga')->insertGetId([
                'status_tenaga' => $request->nama,
                'keterangan' => $request->keterangan ?? " ",
                'prop' =>  " ",
                'autonomous' => $this->originAutonomous,
                'duplicate' => 0,
                'origin' => $this->originAutonomous,
                'origin_id' => 0,
                'time_updated' => date('Y-m-d H:i:s'),
                'origin_updated' => ''
            ]);
            DB::table('smis_hrd_ruangan_pegawai')
                ->where('id', $idRuangan)->update([
                    'origin_id' => $idRuangan
                ]);
            return 'sukses';
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function getStatusTenagaById($id)
    {
        return DB::table('smis_hrd_status_tenaga')->where([
            ['id', $id],
            ['prop', ' '],
        ])
            ->select('id', 'status_tenaga', 'keterangan')
            ->first();
    }

    public function updateStatusTenaga($request)
    {
        try {
            DB::table('smis_hrd_status_tenaga')
                ->where('id', $request->id)
                ->update([
                    'status_tenaga' => $request->nama,
                    'keterangan' => $request->keterangan ?? " ",
                    'time_updated' => date('Y-m-d H:i:s')
                ]);

            return 'sukses';
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function deleteStatusTenaga($id)
    {
        try {
            DB::table('smis_hrd_status_tenaga')
                ->where('id', $id)
                ->update([
                    'prop' => "del",
                    'time_updated' => date('Y-m-d H:i:s')
                ]);
            return 'sukses';
        } catch (Exception $th) {
            return $th->getMessage();
        }
    }

    public function getSearchStatusTenaga($request)
    {
        $data = DB::table('smis_hrd_status_tenaga')
            ->where([
                ['prop', ' '],
                ['status_tenaga', 'like', '%' . $request->keyword . '%']
            ])
            ->orWhere([
                ['prop', ' '],
                ['keterangan', 'like', '%' . $request->keyword . '%']
            ]);

        return $data;
    }

    public function getDownloadStatusTenaga($request)
    {
        if ($request->keyword == null) {
            return $this->getStatusTenaga()->get();
        } else {
            return $this->getSearchStatusTenaga($request)->get();
        }
    }

    //Action Pendidikan
    public function getPendidikan()
    {
        return DB::table('smis_hrd_pendidikan')->where('prop', " ");
    }

    public function getHrdEmploye($jk, $pendidikan)
    {
        return DB::table('smis_hrd_employee')
            ->where('jk', $jk)
            ->where('pendidikan', $pendidikan)
            ->count();
    }

    public function createPendidikan($request)
    {
        try {
            $inserData = DB::table('smis_hrd_pendidikan')->insertGetId([
                'pendidikan' => $request->nama,
                'butuh_lk' => $request->k_laki,
                'keterangan' => $request->keterangan ?? " ",
                'butuh_pr' => $request->k_perempuan,
                'prop' =>  " ",
                'autonomous' => $this->originAutonomous,
                'duplicate' => 0,
                'origin' => $this->originAutonomous,
                'origin_id' => 0,
                'time_updated' => date('Y-m-d H:i:s'),
                'origin_updated' => ''
            ]);
            DB::table('smis_hrd_job')
                ->where('id', $inserData)->update([
                    'origin_id' => $inserData
                ]);
            return 'sukses';
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function updatePendidikan($request)
    {
        try {
            DB::table('smis_hrd_pendidikan')
                ->where('id', $request->id)
                ->update([
                    'pendidikan' => $request->nama,
                    'butuh_lk' => $request->k_laki,
                    'butuh_pr' => $request->k_perempuan,
                    'keterangan' => $request->keterangan ?? " ",
                    'time_updated' => date('Y-m-d H:i:s')
                ]);

            return 'sukses';
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function getPendidikanById($id)
    {
        return DB::table('smis_hrd_pendidikan')->where([
            ['id', $id],
            ['prop', ' '],
        ])
            ->select('id', 'pendidikan', 'keterangan', 'butuh_pr', 'butuh_lk')
            ->first();
    }

    public function deletePendidikan($id)
    {
        try {
            DB::table('smis_hrd_pendidikan')
                ->where('id', $id)
                ->update([
                    'prop' => "del",
                    'time_updated' => date('Y-m-d H:i:s')
                ]);
            return 'sukses';
        } catch (Exception $th) {
            return $th->getMessage();
        }
    }

    public function getSearchPendidikan($request)
    {
        $data = DB::table('smis_hrd_pendidikan')
            ->where([
                ['prop', ' '],
                ['pendidikan', 'like', '%' . $request->keyword . '%']
            ])
            ->orWhere([
                ['prop', ' '],
                ['keterangan', 'like', '%' . $request->keyword . '%']
            ])
            ->orWhere([
                ['prop', ' '],
                ['butuh_pr', 'like', '%' . $request->keyword . '%']
            ])
            ->orWhere([
                ['prop', ' '],
                ['butuh_lk', 'like', '%' . $request->keyword . '%']
            ]);

        return $data;
    }

    public function getDownloadPendidikan($request)
    {
        if ($request->keyword == null) {
            return $this->getPendidikan()->get();
        } else {
            return $this->getSearchPendidikan($request)->get();
        }
    }
}
