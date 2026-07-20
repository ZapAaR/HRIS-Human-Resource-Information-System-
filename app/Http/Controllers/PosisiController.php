<?php

namespace App\Http\Controllers;

use App\Http\Requests\PosisiStoreRequest;
use App\Http\Requests\PosisiUpdateRequest;
use App\Models\Posisi;
use App\Services\PosisiService;
use Illuminate\Http\Request;

class PosisiController extends Controller
{
    public function __construct(protected PosisiService $posisiService) {}

    public function index(Request $request)
    {
        $posisis = $this->posisiService->getAll($request);
        $divisis = $this->posisiService->getDivisis();

        return view('posisi.index', compact('posisis', 'divisis'));
    }

    public function store(PosisiStoreRequest $request)
    {
        $this->posisiService->store($request->validated());

        return redirect()
            ->route('posisi.index')
            ->with('success', 'Posisi berhasil ditambahkan.');
    }

    public function show(Posisi $posisi)
    {
        return response()->json(
            $this->posisiService->find($posisi)
        );
    }

    public function update(PosisiUpdateRequest $request, Posisi $posisi)
    {

        $this->posisiService->update($posisi, $request->validated());

        return redirect()
            ->route('posisi.index')
            ->with('success', 'Posisi berhasil diperbarui.');
    }

    public function destroy(Posisi $posisi)
    {
        $this->posisiService->delete($posisi);

        return redirect()
            ->route('posisi.index')
            ->with('success', 'Posisi berhasil dihapus.');
    }
}
