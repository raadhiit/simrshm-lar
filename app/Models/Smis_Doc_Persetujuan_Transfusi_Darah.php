<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Smis_Doc_Persetujuan_Transfusi_Darah extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $table = 'smis_doc_persetujuan_transfusi_darah';

        public function hrd_dokter()
    {
        return $this->belongsTo(SmisHrdEmployee::class, 'username_ttd_dokter', 'username');
    }

}
