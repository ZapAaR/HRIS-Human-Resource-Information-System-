<?php

namespace Database\Seeders;

use App\Models\Posisi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PosisiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posisis = [
            [
                'divisi_id' => 1,
                'nama_posisi' => 'HR Manager',
                'deskripsi' => 'Bertanggung jawab mengelola seluruh kegiatan Human Resources.',
            ],
            [
                'divisi_id' => 1,
                'nama_posisi' => 'HR Staff',
                'deskripsi' => 'Mengelola administrasi dan data karyawan.',
            ],
            [
                'divisi_id' => 2,
                'nama_posisi' => 'Finance Manager',
                'deskripsi' => 'Mengelola keuangan dan anggaran perusahaan.',
            ],
            [
                'divisi_id' => 2,
                'nama_posisi' => 'Accounting Staff',
                'deskripsi' => 'Menyusun laporan keuangan dan pembukuan perusahaan.',
            ],
            [
                'divisi_id' => 3,
                'nama_posisi' => 'Backend Developer',
                'deskripsi' => 'Mengembangkan dan memelihara sistem backend perusahaan.',
            ],
            [
                'divisi_id' => 3,
                'nama_posisi' => 'Frontend Developer',
                'deskripsi' => 'Mengembangkan antarmuka pengguna aplikasi web.',
            ],
            [
                'divisi_id' => 4,
                'nama_posisi' => 'IT Support',
                'deskripsi' => 'Memberikan dukungan teknis kepada seluruh karyawan.',
            ],
            [
                'divisi_id' => 4,
                'nama_posisi' => 'Digital Marketing Specialist',
                'deskripsi' => 'Mengelola strategi pemasaran digital perusahaan.',
            ],
            [
                'divisi_id' => 5,
                'nama_posisi' => 'Sales Executive',
                'deskripsi' => 'Menjalankan aktivitas penjualan dan menjaga hubungan dengan pelanggan.',
            ],
            [
                'divisi_id' => 5,
                'nama_posisi' => 'Operation Supervisor',
                'deskripsi' => 'Mengawasi kegiatan operasional harian perusahaan.',
            ],
        ];

        foreach ($posisis as $posisi) {
            Posisi::create($posisi);
        }
    }
}
