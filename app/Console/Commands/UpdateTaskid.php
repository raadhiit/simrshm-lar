<?php

namespace App\Console\Commands;

use App\Http\Controllers\CheckinController;
use App\Models\Antrian;
use Illuminate\Console\Command;

class UpdateTaskid extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:taskid';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $antrian = Antrian::where('tanggalperiksa', date('Y-m-d'))->get();
        $controller_checkin = new CheckinController();

        foreach ($antrian as $ant) {
            if ($ant->waktu_checkin != null  && $ant->pasien_baru == 1) {
                $hit_bpjs = $controller_checkin->update_waktu_antrian(1,$ant->kodebooking,$ant->waktu_checkin);
            }
            if ($ant->waktu_checkin != null  && $ant->pasien_baru == 1) {
                $hit_bpjs = $controller_checkin->update_waktu_antrian(3,$ant->kodebooking,$ant->waktu_checkin);
            }
            if ($ant->waktu_taskid_dua != null) {
                $hit_bpjs = $controller_checkin->update_waktu_antrian(2,$ant->kodebooking,$ant->waktu_taskid_dua);
            }
            if ($ant->waktu_taskid_tiga != null && $ant->pasien_baru == 1) {
                $hit_bpjs = $controller_checkin->update_waktu_antrian(3,$ant->kodebooking,$ant->waktu_taskid_tiga);
            }
            if ($ant->waktu_taskid_empat != null) {
                $hit_bpjs = $controller_checkin->update_waktu_antrian(4,$ant->kodebooking,$ant->waktu_taskid_empat);
            }
            if ($ant->waktu_taskid_lima != null) {
                $hit_bpjs = $controller_checkin->update_waktu_antrian(5,$ant->kodebooking,$ant->waktu_taskid_lima);
            }
            if ($ant->waktu_taskid_enam != null) {
                $hit_bpjs = $controller_checkin->update_waktu_antrian(6,$ant->kodebooking,$ant->waktu_taskid_enam);
            }
            if ($ant->waktu_taskid_tujuh != null) {
                $hit_bpjs = $controller_checkin->update_waktu_antrian(7,$ant->kodebooking,$ant->waktu_taskid_tujuh);
            }
        }

        \Log::info("Update task id selesai !");
    }
}
