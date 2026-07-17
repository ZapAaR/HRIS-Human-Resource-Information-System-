<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Divisi extends Model
{
    use HasFactory;
    protected $table = 'divisis';

    protected $fillable = [
        'nama_divisi',
        'deskripsi',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function karyawan()
    {
        return $this->hasMany(Karyawan::class, 'divisi_id');
    }

    public function posisi()
    {
        return $this->hasMany(Posisi::class, 'divisi_id');
    }

    protected function namaDivisi(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ucwords($value),
            set: fn ($value) => strtolower($value),
        );
    }

}
