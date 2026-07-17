<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DaftarGaji extends Model
{
    protected $table = 'daftar_gajis';

    protected $fillable = [
        'karyawan_id',
        'bulan',
        'tahun',
        'gaji_pokok',
        'uang_lembur',
        'bonus',
        'potongan',
        'gaji_bersih',
        'status',
        'dihasilkan_pada',
    ];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'karyawan_id');
    }
}
