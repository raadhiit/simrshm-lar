<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SatuSehatReferensiOrganisasi extends Model
{
    use HasFactory;

    protected $table = 'smis_ss_referensi_organisasi';

    protected $guarded = ['id'];
}
