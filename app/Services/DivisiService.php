<?php

namespace App\Services;

use App\Models\Divisi;
use Illuminate\Http\Request;

class DivisiService
{
    public function getAll(Request $request)
    {
        $query = Divisi::query();

        $search = $request->get('search');

        if ($search) {
            $query->where('nama_divisi', 'like', "%{$search}%")
                ->orWhere('deskripsi', 'like', "%{$search}%");
        }

        return $query->orderBy('created_at', 'desc')
            ->paginate(5)
            ->withQueryString();
    }

    public function store(array $data)
    {
        return Divisi::create($data);
    }

    public function update(Divisi $divisi, array $data)
    {
        $divisi->update($data);

        return $divisi;
    }

    public function delete(Divisi $divisi)
    {
        return $divisi->delete();
    }
}
