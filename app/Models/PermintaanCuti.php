<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermintaanCuti extends Model
{
    protected $table = 'permintaan_cutis';

    protected $fillable = [
        'karyawan_id',
        'tanggal_mulai',
        'tanggal_selesai',
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
