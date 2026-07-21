<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;

class UserService
{
    public function getAll(Request $request)
    {
        $query = User::with('roles');

        if ($search = $request->search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($role = $request->role) {
            $query->role($role);
        }

        return $query->latest()
            ->paginate(10)
            ->withQueryString();
    }

    public function findById(User $user)
    {
        return $user->load('roles');
    }

    public function store(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        $user->syncRoles($data['role']);

        return $user;
    }

    public function update(User $user, array $data)
    {
        $payload = [
            'name' => $data['name'],
            'email' => $data['email'],
        ];

        if (!empty($data['password'])) {
            $payload['password'] = bcrypt($data['password']);
        }

        $user->update($payload);
        $user->syncRoles($data['role']);

        return $user;
    }

    public function destroy(User $user)
    {
        $user->delete();
    }
}
