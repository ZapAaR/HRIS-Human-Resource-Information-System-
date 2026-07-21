<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Services\UserService;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\User;

class UserController extends Controller
{
    public function __construct(protected UserService $user)
    {
    }

     public function index(Request $request)
    {
        $users = $this->user->getAll($request);
        $roles = Role::orderBy('name')->get();

        return view('user.index', compact('users', 'roles'));
    }

    public function create()
    {
        $roles = Role::orderBy('name')->get();

        return view('user.create', compact('roles'));
    }

    public function store(UserStoreRequest $request)
    {
        $this->user->store($request->validated());

        return redirect()
            ->route('user.index')
            ->with('success', 'User berhasil ditambahkan.');
    }

    public function show(User $user)
    {
        $user = $this->user->findById($user);

        return view('user.show', compact('user'));
    }

    public function edit(User $user)
    {
        $roles = Role::orderBy('name')->get();
        $userRoles = $user->roles->pluck('name')->toArray();

        return view('user.edit', compact(
            'user',
            'roles',
            'userRoles'
        ));
    }

    public function update(UserUpdateRequest $request, User $user)
    {
        $this->user->update($user, $request->validated());

        return redirect()
            ->route('user.index')
            ->with('success', 'User berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        $this->user->destroy($user);

        return redirect()
            ->route('user.index')
            ->with('success', 'User berhasil dihapus.');
    }
}
