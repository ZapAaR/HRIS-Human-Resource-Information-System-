<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermintaanLembur extends Model
{
    protected $table = 'permintaan_lemburs';

    protected $fillable = [
        'karyawan_id',
        'tanggal_lembur',
        'jam_mulai',
        'jam_selesai',
        'total_jam_lembur',
        'alasan',
        'status',
        'disetujui_oleh',
        'tanggal_disetujui',
    ];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'karyawan_id');
    }
}
