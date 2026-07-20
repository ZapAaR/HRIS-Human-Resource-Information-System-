<?php

namespace Database\Factories;

use App\Models\Karyawan;
use App\Models\Divisi;
use App\Models\Posisi;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Karyawan>
 */
class KaryawanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $jenisKelamin = fake()->randomElement([
            'Laki-laki',
            'Perempuan',
        ]);

        // Ambil satu posisi beserta divisinya
        $posisi = Posisi::with('divisi')
            ->inRandomOrder()
            ->first();

        return [
            'user_id' => User::inRandomOrder()->value('id'),

            // Divisi mengikuti posisi
            'divisi_id' => $posisi->divisi_id,

            'posisi_id' => $posisi->id,

            'kode_karyawan' => 'KRY-' . fake()->unique()->numberBetween(1000, 9999),

            'nik' => fake()->unique()->numerify('################'),

            'nama_karyawan' => fake()->name(),

            'jenis_kelamin' => $jenisKelamin,

            'tanggal_lahir' => fake()->dateTimeBetween('-45 years', '-20 years')->format('Y-m-d'),

            'no_telepon' => fake()->phoneNumber(),

            'email' => fake()->unique()->safeEmail(),

            'alamat' => fake()->address(),

            'tanggal_masuk' => fake()->dateTimeBetween('-5 years', 'now')->format('Y-m-d'),

            'gaji_pokok' => fake()->numberBetween(4_000_000, 15_000_000),

            'foto' => null,

            'status' => fake()->randomElement([
                'Aktif',
                'Aktif',
                'Aktif',
                'Tidak Aktif',
                'Tidak Aktif',
            ]),
        ];
    }
}
