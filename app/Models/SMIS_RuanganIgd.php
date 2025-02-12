<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SMIS_RuanganIgd extends Model
{
    use HasFactory;

    protected $table = 'setting_ruangan_igd';

    protected $fillable = ['nama', 'alias', 'kabupaten', 'provinsi'];
}
