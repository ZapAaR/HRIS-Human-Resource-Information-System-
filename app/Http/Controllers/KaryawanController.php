<?php

namespace App\Http\Controllers;

use App\Http\Requests\KaryawanStoreRequest;
use App\Http\Requests\KaryawanUpdateRequest;
use App\Http\Requests\StoreKaryawanRequest;
use App\Http\Requests\UpdateKaryawanRequest;
use App\Models\Divisi;
use App\Models\Karyawan;
use App\Models\Posisi;
use App\Services\KaryawanService;
use Illuminate\Http\Request;

class KaryawanController extends Controller
{
     public function __construct(protected KaryawanService $service)
    {
    }

    public function index(Request $request)
    {
        $karyawans = $this->service->getAll($request);

        $divisis = Divisi::orderBy('nama_divisi')->get();

        $posisis = Posisi::orderBy('nama_posisi')->get();

        $jk = Karyawan::orderBy('jenis_kelamin')->get();

        return view('karyawan.index', compact('karyawans', 'divisis', 'posisis', 'jk'));
    }

    public function create()
    {
        return view('karyawan.create', [
            'users'    => $this->service->getUsers(),
            'divisis'  => $this->service->getDivisis(),
            'posisis'  => $this->service->getPosisis(),
        ]);
    }

    public function store(KaryawanStoreRequest $request)
    {
        $this->service->store($request->validated());

        return redirect()
            ->route('karyawan.index')
            ->with('success', 'Karyawan berhasil ditambahkan.');
    }

    public function show(Karyawan $karyawan)
    {
        return view('karyawan.show', [
            'karyawan' => $this->service->find($karyawan)
        ]);
    }

    public function edit(Karyawan $karyawan)
    {
        return view('karyawan.edit', [
            'karyawan' => $karyawan,
            'users'    => $this->service->getUsers(),
            'divisis'  => $this->service->getDivisis(),
            'posisis'  => $this->service->getPosisis(),
        ]);
    }

    public function update(KaryawanUpdateRequest $request, Karyawan $karyawan)
    {
        $this->service->update($karyawan, $request->validated());

        return redirect()
            ->route('karyawan.index')
            ->with('success', 'Karyawan berhasil diperbarui.');
    }

    public function destroy(Karyawan $karyawan)
    {
        $this->service->delete($karyawan);

        return redirect()
            ->route('karyawan.index')
            ->with('success', 'Karyawan berhasil dihapus.');
    }
}
