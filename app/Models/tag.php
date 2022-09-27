<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tag extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'tagName'];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'created_at' => 'datetime:d-m-Y',
        'updated_at' => 'datetime:d-m-Y'
    ];
}
