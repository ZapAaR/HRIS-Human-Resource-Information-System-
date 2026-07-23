<?php

namespace Database\Seeders;

use App\Models\Divisi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DivisiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $divisis = [
            [
                'nama_divisi' => 'Operational',
                'deskripsi' => 'Mengelola proses operasional perusahaan agar berjalan efektif dan efisien.',
            ],
            [
                'nama_divisi' => 'Sales',
                'deskripsi' => 'Melakukan penjualan produk atau layanan serta menjaga hubungan dengan pelanggan.',
            ],
            [
                'nama_divisi' => 'Marketing',
                'deskripsi' => 'Mengelola strategi pemasaran, promosi, branding, dan hubungan dengan pelanggan.',
            ],
            [
                'nama_divisi' => 'Information Technology',
                'deskripsi' => 'Bertanggung jawab terhadap pengembangan sistem, infrastruktur, dan keamanan teknologi informasi.',
            ],
            [
                'nama_divisi' => 'Finance',
                'deskripsi' => 'Mengelola keuangan perusahaan, pembayaran, anggaran, dan laporan keuangan.',
            ],
            [
                'nama_divisi' => 'Human Resources',
                'deskripsi' => 'Mengelola rekrutmen, administrasi karyawan, pelatihan, dan pengembangan SDM.',
            ],
        ];

        foreach ($divisis as $divisi) {
            Divisi::create($divisi);
        }
    }
}
