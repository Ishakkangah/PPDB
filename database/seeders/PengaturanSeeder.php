<?php

namespace Database\Seeders;

use App\Models\pengaturan;
use Illuminate\Database\Seeder;

class PengaturanSeeder extends Seeder
{
    public function run()
    {
        pengaturan::create([
            'batas_umur' => now(),
            'batas_pendaptaran' => now()
        ]);
    }
}
