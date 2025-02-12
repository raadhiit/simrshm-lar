<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmisDocAssesmentUlangNyeriIntervensi extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'smis_doc_assesment_ulang_nyeri_intervensi';

    protected $casts = [
        'tanggal1' => 'datetime',
        'tanggal2' => 'datetime',
        'tanggal_kaji_ulang' => 'datetime',
        'status' => 'boolean',
    ];

    protected $appends = ['Tanggal1Nice','Tanggal2Nice','TanggalKajiUlangNice',];

    function getTanggal1NiceAttribute(){
        if($this->tanggal1){
            return $this->tanggal1->format('d/m/Y H:i');
        }
        return null;
    }

    function getTanggal2NiceAttribute(){
        if($this->tanggal2){
            return $this->tanggal2->format('d/m/Y H:i');
        }
        return null;
    }

    function getTanggalKajiUlangNiceAttribute(){
        if($this->tanggal_kaji_ulang){
            return $this->tanggal_kaji_ulang->format('d/m/Y H:i');
        }
        return null;
    }

    public $with = ['user_verifikator1.hrd_employee','user_verifikator2.hrd_employee'];

    public function user_verifikator1()
    {
        return $this->belongsTo(User::class, 'verifikator1', 'username');
    }

    public function user_verifikator2()
    {
        return $this->belongsTo(User::class, 'verifikator2', 'username');
    }


}
