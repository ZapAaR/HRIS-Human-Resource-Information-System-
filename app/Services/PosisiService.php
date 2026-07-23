<?php

namespace App\Services;

use App\Models\Divisi;
use App\Models\Posisi;
use Illuminate\Http\Request;

class PosisiService
{
    protected $karyawanService;

    public function __construct(KaryawanService $karyawanService)
    {
        $this->karyawanService = $karyawanService;
    }

    public function byDivisi($divisi)
    {
        return response()->json(
            $this->karyawanService->getPosisiByDivisi($divisi)
        );
    }
    
    public function getAll(Request $request)
    {
        $query = Posisi::with('divisi');

        if ($search = $request->get('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('nama_posisi', 'like', "%{$search}%")
                    ->orWhere('deskripsi', 'like', "%{$search}%")
                    ->orWhereHas('divisi', function ($q2) use ($search) {
                        $q2->where('nama_divisi', 'like', "%{$search}%");
                    });
            });
        }

        return $query->latest()->paginate(5)->withQueryString();
    }

    public function getDivisis()
    {
        return Divisi::orderBy('nama_divisi')->get();
    }

    public function store(array $data): Posisi
    {
        return Posisi::create($data);
    }

    public function update(Posisi $posisi, array $data): bool
    {
        return $posisi->update($data);
    }

    public function delete(Posisi $posisi): bool
    {
        return $posisi->delete();
    }

    public function find(Posisi $posisi): Posisi
    {
        return $posisi->load('divisi');
    }
}
