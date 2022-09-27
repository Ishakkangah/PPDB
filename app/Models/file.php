<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class file extends Model
{
    use HasFactory;

    protected $fillable = [
        'photo',
        'akta_kelahiran',
        'kartu_keluarga',
        'ijazah',
        'nilai_rapot',
    ];

}
