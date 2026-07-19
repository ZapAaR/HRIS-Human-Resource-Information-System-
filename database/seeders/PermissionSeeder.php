<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [

            // Dashboard
            'dashboard.view',

            // User
            'user.view',
            'user.create',
            'user.edit',
            'user.delete',

            // Divisi
            'divisi.view',
            'divisi.create',
            'divisi.edit',
            'divisi.delete',

            // Posisi
            'posisi.view',
            'posisi.create',
            'posisi.edit',
            'posisi.delete',

            // Karyawan
            'karyawan.view',
            'karyawan.create',
            'karyawan.edit',
            'karyawan.delete',

            // Kehadiran
            'kehadiran.view',
            'kehadiran.create',
            'kehadiran.edit',
            'kehadiran.delete',

            // Cuti
            'cuti.view',
            'cuti.request',
            'cuti.approve',
            'cuti.reject',

            // Lembur
            'lembur.view',
            'lembur.request',
            'lembur.approve',

            // Daftar Gaji
            'gaji.view',
            'gaji.generate',
            'gaji.export',

            // Laporan
            'laporan.view',
            'laporan.export',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web',
            ]);
        }
    }
}
