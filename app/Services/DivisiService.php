<?php

namespace App\Services;

use App\Models\Divisi;

class DivisiService
{
    public function getAll()
    {
        return Divisi::latest()->paginate(10);
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
