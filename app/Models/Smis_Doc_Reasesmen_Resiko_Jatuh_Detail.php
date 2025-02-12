<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Smis_Doc_Reasesmen_Resiko_Jatuh_Detail extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'reassesment_resiko_jatuh_detail';

    public function user_verifikatorP1()
    {
        return $this->belongsTo(User::class, 'verifikatorP1', 'username');
    }

    public function user_verifikatorS1()
    {
        return $this->belongsTo(User::class, 'verifikatorS1', 'username');
    }

    public function user_verifikatorM1()
    {
        return $this->belongsTo(User::class, 'verifikatorM1', 'username');
    }

    public function user_verifikatorP2()
    {
        return $this->belongsTo(User::class, 'verifikatorP2', 'username');
    }

    public function user_verifikatorS2()
    {
        return $this->belongsTo(User::class, 'verifikatorS2', 'username');
    }

    public function user_verifikatorM2()
    {
        return $this->belongsTo(User::class, 'verifikatorM2', 'username');
    }

    public function user_verifikatorP3()
    {
        return $this->belongsTo(User::class, 'verifikatorP3', 'username');
    }

    public function user_verifikatorS3()
    {
        return $this->belongsTo(User::class, 'verifikatorS3', 'username');
    }

    public function user_verifikatorM3()
    {
        return $this->belongsTo(User::class, 'verifikatorM3', 'username');
    }

    public function user_verifikatorP4()
    {
        return $this->belongsTo(User::class, 'verifikatorP4', 'username');
    }

    public function user_verifikatorS4()
    {
        return $this->belongsTo(User::class, 'verifikatorS4', 'username');
    }

    public function user_verifikatorM4()
    {
        return $this->belongsTo(User::class, 'verifikatorM4', 'username');
    }

    public function user_verifikatorP5()
    {
        return $this->belongsTo(User::class, 'verifikatorP5', 'username');
    }

    public function user_verifikatorS5()
    {
        return $this->belongsTo(User::class, 'verifikatorS5', 'username');
    }

    public function user_verifikatorM5()
    {
        return $this->belongsTo(User::class, 'verifikatorM5', 'username');
    }
}
