<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Penduduk>
 */
class PendudukFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = \Faker\Factory::create('id_ID');

        $jenisKelamin = $faker->randomElement(['L', 'P']);

        return [
            'nama_lengkap' => $faker->name($jenisKelamin == 'L' ? 'male' : 'female'),
            'jenis_kelamin' => $jenisKelamin,
            'tempat_lahir' => $faker->city(),
            'tanggal_lahir' => $faker->date('Y-m-d', '-17 years'), // Anggap warga dewasa
            'status_keluarga' => $faker->randomElement(['kepala keluarga', 'istri', 'anak', 'lainnya']),
            'alamat' => $faker->streetAddress(),
            'rt' => $faker->numberBetween(1, 5), // Random RT 1-5
            'rw' => $faker->numberBetween(1, 2), // Random RW 1-2
            'agama' => $faker->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu']),
            'pekerjaan' => $faker->jobTitle(),
            'status_perkawinan' => $faker->randomElement(['Belum Kawin', 'Kawin', 'Cerai Hidup', 'Cerai Mati']),
            'disabilitas' => $faker->randomElement(['Tidak Ada', 'Tidak Ada', 'Tidak Ada', 'Fisik', 'Netra']), // Diperbanyak 'Tidak Ada' biar realistis
            'keterangan_tambahan' => null,
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
