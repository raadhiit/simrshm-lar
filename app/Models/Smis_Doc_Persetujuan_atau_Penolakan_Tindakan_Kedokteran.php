<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Smis_Doc_Persetujuan_atau_Penolakan_Tindakan_Kedokteran extends Model
{
    use HasFactory;

    protected $table = 'smis__doc__persetujuan_atau__penolakan__tindakan__kedokterans';

    protected $guarded = ['id'];
}
