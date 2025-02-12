<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SmisSbAutonomous extends Model
{
    use HasFactory;

    public function getIdAutonomous()
    {
        return DB::table('smis_sb_autonomous')->first();
    }
}
