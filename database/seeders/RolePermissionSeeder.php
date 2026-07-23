<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $admin = Role::findByName('admin');
        $hr = Role::findByName('hr');
        $manager = Role::findByName('manager');
        $karyawan = Role::findByName('karyawan');

        //admin
        $admin->givePermissionTo(
            Permission::all()
        );

        //hr
        $hr->givePermissionTo(
            Permission::all()
        );

        // Manager
        $manager->givePermissionTo([
            'dashboard.view',

            'karyawan.view',

            'kehadiran.view',

            'cuti.view',
            'cuti.approve',
            'cuti.reject',

            'lembur.view',
            'lembur.approve',

            'laporan.view',
        ]);

        // Karyawan
        $karyawan->givePermissionTo([
            'dashboard.view',

            'kehadiran.view',

            'cuti.view',
            'cuti.request',

            'lembur.view',
            'lembur.request',
        ]);
    }
}
