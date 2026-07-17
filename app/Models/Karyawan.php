<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    protected $table = 'karyawans';

    protected $fillable = [
        'user_id',
        'divisi_id',
        'posisi_id',
        'kode_karyawan',
        'nik',
        'nama_karyawan',
        'jenis_kelamin',
        'tanggal_lahir',
        'no_telepon',
        'email',
        'alamat',
        'tanggal_masuk',
        'gaji_pokok',
        'foto',
        'status',
    ];

    public function posisi()
    {
        return $this->belongsTo(Posisi::class, 'posisi_id');
    }

    public function divisi()
    {
        return $this->belongsTo(Divisi::class, 'divisi_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function kehadiran()
    {
        return $this->hasMany(Kehadiran::class, 'karyawan_id');
    }

    public function permintaan_cuti()
    {
        return $this->hasMany(PermintaanCuti::class, 'karyawan_id');
    }

    public function permintaan_lembur()
    {
        return $this->hasMany(PermintaanLembur::class, 'karyawan_id');
    }

    public function daftar_gaji()
    {
        return $this->hasMany(DaftarGaji::class, 'karyawan_id');
    }
}
