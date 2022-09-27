<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class datawali extends Model
{
    use HasFactory;

    protected $fillable = [
            'user_id',
            'nama_ayah',
            'tanggal_lahir_ayah',
            'perkerjaan_ayah',
            'nomor_ktp_ayah',
            'agama_ayah',
            'alamat_ayah',
            'pendidikan_ayah',
            'nama_ibu',
            'tanggal_lahir_ibu',
            'perkerjaan_ibu',
            'nomor_ktp_ibu',
            'agama_ibu',
            'alamat_ibu',
            'pendidikan_ibu',
         ];

    // setiap wali mempunyai seorang pendaptar
    public function pendaptaran(){
        return $this->belongsTo(pendaptaran::class);
    }
}
