<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Dosen>
 */
class DosenFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nip' => fake()->unique()->numerify('############'),
            'nama' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'jurusan' => fake()->randomElement(['Informatika', 'Sistem Informasi', 'Teknik Elektro', 'Manajemen Informatika', 'Teknologi Informasi']),
            'telepon' => fake()->phoneNumber(),
        ];
    }
}
