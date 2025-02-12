<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AvailableBed extends Model
{
    use HasFactory;

    protected $table = 'available_beds';
    // protected $table = 'available_beds_new';

    protected $guarded = ['id'];
    
}
