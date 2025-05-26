<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mahasiswa>
 */
class MahasiswaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nim' => $this->faker->unique()->numerify('22########'),
            'nama' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'jurusan' => $this->faker->randomElement([
                'Informatika', 'Sistem Informasi', 'Teknik Elektro', 'Manajemen Informatika', 'Teknologi Informasi',
            ]),
            'telepon' => $this->faker->phoneNumber(),
        ];
    }
}
