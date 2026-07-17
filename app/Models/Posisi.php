<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Posisi extends Model
{
    protected $table = 'posisis';

    protected $fillable = [
        'divisi_id',
        'nama_posisi',
        'deskripsi',
    ];

    public function karyawan()
    {
        return $this->hasMany(Karyawan::class, 'posisi_id');
    }

    public function divisi()
    {
        return $this->belongsTo(Divisi::class, 'divisi_id');
    }
}
