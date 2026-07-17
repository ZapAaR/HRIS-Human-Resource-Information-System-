<?php

namespace App\Http\Controllers;

use App\Services\DivisiService;
use Illuminate\Http\Request;
use App\Http\Requests\DivisiStoreRequest;
use App\Http\Requests\DivisiUpdateRequest;
use App\Models\Divisi;

class DivisiController extends Controller
{
    public function __construct(protected DivisiService $service) {}

    public function index()
    {
        $divisis = $this->service->getAll();

        return view('divisi.index', compact('divisis'));
    }

    public function store(DivisiStoreRequest $request)
    {
        $this->service->store($request->validated());

        return redirect()
            ->route('divisi.index')
            ->with('success', 'Divisi berhasil ditambahkan.');
    }

    public function update(DivisiUpdateRequest $request, Divisi $divisi)
    {
        $this->service->update($divisi, $request->validated());

        return redirect()
            ->route('divisi.index')
            ->with('success', 'Divisi berhasil diperbarui.');
    }

    public function destroy(Divisi $divisi)
    {
        $this->service->delete($divisi);

        return redirect()
            ->route('divisi.index')
            ->with('success', 'Divisi berhasil dihapus.');
    }
}
