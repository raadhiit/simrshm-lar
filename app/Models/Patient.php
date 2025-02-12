<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $table = "smis_rg_patient";


    public function getAgeAttribute()
    {
        $date = Carbon::parse($this->tgl_lahir);
        $today = Carbon::now();

        $year = $date->diffInYears(Carbon::now());
        $month = $date->diffInMonths(Carbon::now()) % 12;
        $day = $today->diffInDays($today->format('Y'). "-" . ($date->month-1) . "-" . $date->day) % 30;

        return $year . ' Tahun ' . $month . ' Bulan ' . $day . ' Hari';
    }
}
