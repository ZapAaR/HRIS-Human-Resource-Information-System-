<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kehadiran extends Model
{
    protected $table = 'kehadirans';

    protected $fillable = [
        'karyawan_id',
        'tanggal_kehadiran',
        'jam_masuk',
        'jam_keluar',
        'status',
        'menit_keterlambatan',
        'keterangan',
    ];

    protected $casts = [
        'tanggal_kehadiran' => 'date',
    ];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'karyawan_id');
    }

}
