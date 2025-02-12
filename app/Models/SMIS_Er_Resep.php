<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SMIS_Er_Resep extends Model
{
    use HasFactory;

    protected $table = 'smis_er_resep';

    protected $guarded = ['id'];

    function detail(){
        return $this->hasMany('App\Models\SMIS_Er_Dresep', 'id_resep', 'id')->where('prop','');
    }
}
