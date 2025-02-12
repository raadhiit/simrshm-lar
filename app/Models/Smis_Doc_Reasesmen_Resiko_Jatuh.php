<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Smis_Doc_Reasesmen_Resiko_Jatuh extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'reassesment_resiko_jatuh';


    public function user_verifikator1()
    {
        return $this->belongsTo(User::class, 'verifikator1', 'username');
    }

    public function user_verifikator2()
    {
        return $this->belongsTo(User::class, 'verifikator2', 'username');
    }

    public function user_verifikator3()
    {
        return $this->belongsTo(User::class, 'verifikator3', 'username');
    }

    public function user_verifikator4()
    {
        return $this->belongsTo(User::class, 'verifikator4', 'username');
    }

    public function user_verifikator5()
    {
        return $this->belongsTo(User::class, 'verifikator5', 'username');
    }
}
