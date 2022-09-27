<?php

namespace Database\Factories;

use App\Models\file;
use Illuminate\Database\Eloquent\Factories\Factory;
use Ramsey\Uuid\Exception\RandomSourceException;

class PendaptaranFactory extends Factory
{
    public function definition()
    {
        $file = file::get();
        return [
            'nama' => $this->faker->name,
            'user_id' => rand(1,3),
            'asal_sekolah' => $this->faker->title,
            'jenis_kelamin' => $this->faker->title,
            'tanggal_lahir' => $this->faker->date(),
            'agama' => $this->faker->name,
            'alamat' => $this->faker->city(),
            'file_id' => rand(1, 20),
            'status' => rand(0,1),
            'nilai_id' => rand(80,100),
        ];
    }
}
