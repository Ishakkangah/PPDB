<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class nilai extends Model
{
    use HasFactory;

    protected $fillable = [
        'nisn',
        'b_indonesia',
        'b_inggris',
        'matematika',
        'ipa',
        'jumlah',
    ];
}


