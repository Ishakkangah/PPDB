<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FileFactory extends Factory
{
    public function definition()
    {
        return [
            'photo' => $this->faker->image(),
            'akta_kelahiran' => $this->faker->image(),
            'kartu_keluarga' => $this->faker->image(),
            'ijazah' => $this->faker->image(),
            'nilai_rapot' => rand(50, 10),
        ];
    }
}
