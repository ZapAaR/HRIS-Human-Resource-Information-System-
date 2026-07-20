<?php

namespace App\Services;

use App\Models\Divisi;
use App\Models\Karyawan;
use App\Models\Posisi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KaryawanService
{
    public function getAll(Request $request)
    {
        $query = Karyawan::with([
            'user:id,name',
            'divisi:id,nama_divisi',
            'posisi:id,divisi_id,nama_posisi'
        ]);

        if ($search = $request->search) {
            $query->where(function ($q) use ($search) {

                $q->where('nama_karyawan', 'like', "%{$search}%")
                    ->orWhere('kode_karyawan', 'like', "%{$search}%")
                    ->orWhere('nik', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhereHas('divisi', fn($d) => $d->where('nama_divisi', 'like', "%{$search}%"))
                    ->orWhereHas('posisi', fn($p) => $p->where('nama_posisi', 'like', "%{$search}%"));
            });
        }

        // Filter Status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter Divisi
        if ($request->filled('divisi_id')) {
            $query->where('divisi_id', $request->divisi_id);
        }

        // Filter Posisi
        if ($request->filled('posisi_id')) {
            $query->where('posisi_id', $request->posisi_id);
        }

        //filter Jenis kelamin
        if ($request->filled('jenis_kelamin')) {
            $query->where('jenis_kelamin', $request->jenis_kelamin);
        }

        return $query->latest()->paginate(10)->withQueryString();
    }

    public function getUsers()
    {
        return User::orderBy('name')->get();
    }

    public function getDivisis()
    {
        return Divisi::orderBy('nama_divisi')->get();
    }

    public function getPosisis()
    {
        return Posisi::with('divisi')->orderBy('nama_posisi')->get();
    }

    public function store(array $data): void
    {
        if (request()->hasFile('foto')) {
            $data['foto'] = request()->file('foto')->store('karyawan', 'public');
        }

        Karyawan::create($data);
    }

    public function update(Karyawan $karyawan, array $data): void
    {
        if (request()->hasFile('foto')) {

            if ($karyawan->foto) {
                Storage::disk('public')->delete($karyawan->foto);
            }

            $data['foto'] = request()->file('foto')->store('karyawan', 'public');
        }

        $karyawan->update($data);
    }

    public function delete(Karyawan $karyawan): void
    {
        if ($karyawan->foto) {
            Storage::disk('public')->delete($karyawan->foto);
        }

        $karyawan->delete();
    }

    public function find(Karyawan $karyawan): Karyawan
    {
        return $karyawan->load([
            'user',
            'divisi',
            'posisi.divisi'
        ]);
    }
}
