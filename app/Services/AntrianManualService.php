<?php

namespace App\Services;

use App\Models\AntrianPendaftaran;

/**
 * Class Services
 * @author mrivaldo 
 */
class AntrianManualService
{
    public function getLastAntrian($jenis)
    {
        $lastQueue = AntrianPendaftaran::where([
            ['tanggal', date('Y-m-d')],
            ['jenis', $jenis]
        ])->first();
        return $lastQueue;
    }

    public function getAntrian($jenis)
    {
        $lastQueue = AntrianPendaftaran::where([
            ['tanggal', date('Y-m-d')],
            ['jenis', $jenis]
        ])->first();

        try {
            AntrianPendaftaran::updateOrCreate(
                [
                    'tanggal' => date('Y-m-d'),
                    'jenis' => $jenis
                ],
                [
                    'last_queue' => empty($lastQueue) ? 1 : $lastQueue->last_queue + 1,
                    'last_call' => empty($lastQueue) ? 0 : $lastQueue->last_call
                ]
            );

            return empty($lastQueue) ? 1 : $lastQueue->last_queue + 1;
        } catch (Exception $e) {
            return false;
        }
    }

    function next($data)
    {
        $data = AntrianPendaftaran::where('tanggal', date('Y-m-d'))->where('jenis', $data['jenis'])->first();
        $query = AntrianPendaftaran::where('tanggal', date('Y-m-d'))->where('jenis', $data['jenis'])
            ->update([
                'last_call' => $data->last_call + 1
            ]);
        return $query;
    }
}
