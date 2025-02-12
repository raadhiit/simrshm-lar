<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmisDocPemantauanTandaTandaVital extends Model
{
    use HasFactory;

    protected $table = 'smis_doc_pemantauan_tanda_tanda_vital';

    protected $casts = [
        'checklist' => 'array',
    ];

    public function detail()
    {
        return $this->hasMany(Smis_Mr_Tanda_Vital::class, 'prop', 'id_dokumen');
    }
}
