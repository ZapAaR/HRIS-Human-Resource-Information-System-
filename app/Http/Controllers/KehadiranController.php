<?php

namespace App\Http\Controllers;

use App\Http\Requests\KehadiranStoreRequest;
use App\Http\Requests\KehadiranUpdateRequest;
use App\Models\Kehadiran;
use App\Services\KehadiranService;
use Illuminate\Http\Request;

class KehadiranController extends Controller
{
    public function __construct(
        protected KehadiranService $kehadiranService
    ) {}

    public function index(Request $request)
    {
        $kehadirans = $this->kehadiranService->getAll($request);

        $karyawans = $this->kehadiranService->getKaryawanAktif();

        $karyawan = auth()->user()->karyawan;

        $kehadiranHariIni = Kehadiran::where('karyawan_id', $karyawan->id)
            ->whereDate('tanggal_kehadiran', today())
            ->first();

        return view('kehadiran.index', compact(
            'kehadirans',
            'karyawans',
            'kehadiranHariIni'
        ));
    }

    public function store(KehadiranStoreRequest $request)
    {
        $this->kehadiranService->store(
            $request->validated()
        );

        return redirect()
            ->route('kehadiran.index')
            ->with('success', 'Data kehadiran berhasil ditambahkan.');
    }

    public function update(KehadiranUpdateRequest $request, Kehadiran $kehadiran)
    {
        $this->kehadiranService->update(
            $kehadiran,
            $request->validated()
        );

        return redirect()
            ->route('kehadiran.index')
            ->with('success', 'Data kehadiran berhasil diperbarui.');
    }

    public function destroy(Kehadiran $kehadiran)
    {
        $this->kehadiranService->destroy($kehadiran);

        return redirect()
            ->route('kehadiran.index')
            ->with('success', 'Data kehadiran berhasil dihapus.');
    }

    public function checkIn()
    {
        $this->kehadiranService->checkIn(auth()->user());

        return back()->with('success', 'Check In berhasil.');
    }

    public function checkOut()
    {
        $this->kehadiranService->checkOut(auth()->user());

        return back()->with('success', 'Check Out berhasil.');
    }
}
