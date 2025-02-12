<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SMIS_Setting_Id_Asuransi extends Model
{
    use HasFactory;

    protected $table = 'smis_setting_id_asuransi';

    protected $fillable = ['id_asuransi'];
}
