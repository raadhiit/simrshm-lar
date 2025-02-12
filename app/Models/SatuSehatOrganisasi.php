<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SatuSehatOrganisasi extends Model
{
    use HasFactory;

    protected $table = 'smis_ss_organisasi';

    protected $guarded = ['id'];
}
