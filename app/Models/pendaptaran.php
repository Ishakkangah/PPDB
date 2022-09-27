<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pendaptaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama',
        'asal_sekolah',
        'jenis_kelamin',
        'tanggal_lahir',
        'agama',
        'alamat',
        'file_id',
        'status',
        'nilai_id',
    ];

    protected $casts = [
        'created_at' => 'datetime:d-m-Y',
        'updated_at' => 'datetime:d-m-Y'
    ];


    // pendaptar mempunyai satu nilai
    public function nilai(){
        return $this->belongsTo(nilai::class);
    }
    // pendaptar memiliki satu file
    public function file(){
        return $this->belongsTo(file::class);
    }
    // pendaptar memiliki satu user
    public function user(){
        return $this->belongsTo(User::class);
    }
}
