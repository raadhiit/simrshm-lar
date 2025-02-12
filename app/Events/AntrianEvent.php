<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AntrianEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */

    public $jenis;
    public $loket;
    public $nomor;
    public $bagian;
    public $pasien;
    public $poli;
    public $lantai;
    public $baru_lama;
    public $manual;
    public $jadwal;

    public function __construct($jadwal, $jenis, $loket, $nomor, $bagian,$pasien,$poli,$lantai,$baru, $manual)
    {
        $this->loket = $loket;
        $this->nomor = $nomor;
        $this->bagian = $bagian;
        $this->pasien = $pasien;
        $this->poli = $poli;
        $this->lantai = $lantai;
        $this->baru_lama = $baru;
        $this->manual = $manual;
        $this->jenis = $jenis;
        $this->jadwal = $jadwal;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return ['my-channel'];
    }

    public function broadcastAs()
    {
        return 'my-event';
    }
}
