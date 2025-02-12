<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SMIS_Er_Dresep extends Model
{
    use HasFactory;

    protected $table = 'smis_er_dresep';

    protected $guarded = ['id'];
}
