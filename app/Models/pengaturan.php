<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pengaturan extends Model
{
    use HasFactory;

    protected $fillable = [
        'batas_pendaptaran',
        'batas_umur'
    ];

}
