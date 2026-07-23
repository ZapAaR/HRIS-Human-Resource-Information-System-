<?php

namespace App\Services;

use App\Models\Karyawan;
use App\Models\Kehadiran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;

class KehadiranService
{
    public function getAll(Request $request)
    {
        $query = Kehadiran::with('karyawan');

        if ($search = $request->search) {
            $query->whereHas('karyawan', function ($q) use ($search) {
                $q->where('nama_karyawan', 'like', "%{$search}%")
                    ->orWhere('kode_karyawan', 'like', "%{$search}%");
            });
        }

        if ($request->tanggal) {
            $query->whereDate(
                'tanggal_kehadiran',
                $request->tanggal
            );
        }

        if ($request->tanggal_dari) {
            $query->whereDate(
                'tanggal_kehadiran',
                '>=',
                $request->tanggal_dari
            );
        }

        if ($request->tanggal_sampai) {
            $query->whereDate(
                'tanggal_kehadiran',
                '<=',
                $request->tanggal_sampai
            );
        }

        if ($request->status) {
            $query->where(
                'status',
                $request->status
            );
        }


        return $query
            ->orderByDesc('tanggal_kehadiran')
            ->orderByDesc('jam_masuk')
            ->paginate(10)
            ->withQueryString();
    }

    public function getKaryawanAktif()
    {
        return Karyawan::where('status', 'Aktif')
            ->orderBy('nama_karyawan')
            ->get([
                'id',
                'nama_karyawan',
                'kode_karyawan'
            ]);
    }

    public function store(array $data)
    {
        $jamMasukKantor = Carbon::createFromTime(8, 0);

        $menitTerlambat = 0;

        if (!empty($data['jam_masuk'])) {
            $jamMasuk = Carbon::createFromFormat('H:i', $data['jam_masuk']);

            if ($jamMasuk->greaterThan($jamMasukKantor)) {
                $menitTerlambat = $jamMasukKantor->diffInMinutes($jamMasuk);
            }
        }

        $data['menit_keterlambatan'] = $menitTerlambat;

        return Kehadiran::create($data);
    }

    public function update(Kehadiran $kehadiran, array $data)
    {
        $jamMasukKantor = Carbon::createFromTime(8, 0);

        $menitTerlambat = 0;

        if (!empty($data['jam_masuk'])) {
            $jamMasuk = Carbon::createFromFormat('H:i', $data['jam_masuk']);

            if ($jamMasuk->greaterThan($jamMasukKantor)) {
                $menitTerlambat = $jamMasukKantor->diffInMinutes($jamMasuk);
            }
        }

        $data['menit_keterlambatan'] = $menitTerlambat;

        $kehadiran->update($data);

        return $kehadiran;
    }

    public function destroy(Kehadiran $kehadiran)
    {
        return $kehadiran->delete();
    }

    public function checkIn(User $user)
    {
        $karyawan = $user->karyawan;

        $sudahAbsen = Kehadiran::where('karyawan_id', $karyawan->id)
            ->whereDate('tanggal_kehadiran', today())
            ->exists();

        if ($sudahAbsen) {
            throw ValidationException::withMessages([
                'checkin' => 'Anda sudah melakukan Check In.'
            ]);
        }

        $jamSekarang = now();
        $jamMasukKantor = Carbon::today()->setTime(8, 0, 0);

        $menitTerlambat = 0;

        if ($jamSekarang->greaterThan($jamMasukKantor)) {
            $menitTerlambat = $jamMasukKantor->diffInMinutes($jamSekarang);
        }

        Kehadiran::create([
            'karyawan_id'         => $karyawan->id,
            'tanggal_kehadiran'   => today(),
            'jam_masuk'           => $jamSekarang,
            'jam_keluar'          => null,
            'status'              => 'Hadir',
            'menit_keterlambatan' => $menitTerlambat,
        ]);
    }

    public function checkOut(User $user)
    {
        $karyawan = $user->karyawan;

        $kehadiran = Kehadiran::where('karyawan_id', $karyawan->id)
            ->whereDate('tanggal_kehadiran', today())
            ->first();

        if (!$kehadiran) {
            throw ValidationException::withMessages([
                'checkout' => 'Silakan lakukan Check In terlebih dahulu.'
            ]);
        }

        if ($kehadiran->jam_keluar) {
            throw ValidationException::withMessages([
                'checkout' => 'Anda sudah melakukan Check Out.'
            ]);
        }

        $kehadiran->update([
            'jam_keluar' => now(),
        ]);
    }
}
