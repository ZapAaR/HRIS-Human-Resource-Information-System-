@extends('layouts.app')
@section('title', 'Edit User')

@section('content')
    <div class="space-y-6">

        {{-- Page Header --}}
        <div>
            <nav class="flex items-center gap-2 text-sm text-slate-500 mb-2">
                <a href="{{ route('dashboard') }}" class="hover:text-[#2563EB] transition">Dashboard</a>
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                </svg>
                <a href="{{ route('user.index') }}" class="hover:text-[#2563EB] transition">Manajemen User</a>
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                </svg>
                <span class="text-[#1E293B] font-medium">Edit</span>
            </nav>
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl lg:text-3xl font-bold text-[#1E293B]">Edit User</h1>
                    <p class="text-slate-500 mt-1">Perbarui data user {{ $user->name }}</p>
                </div>
                <a href="{{ route('user.index') }}"
                    class="inline-flex items-center gap-2 px-4 py-2.5 text-sm font-medium text-slate-600 hover:bg-slate-100 rounded-xl transition">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                    </svg>
                    <span>Kembali</span>
                </a>
            </div>
        </div>

        <form action="{{ route('user.update', $user) }}" method="POST" enctype="multipart/form-data" class="space-y-6"
            novalidate>
            @csrf
            @method('PUT')

            {{-- Informasi Akun --}}
            <div class="bg-white rounded-xl border border-[#E2E8F0] shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-[#E2E8F0] bg-[#F8FAFC] flex items-center gap-2">
                    <svg class="w-5 h-5 text-[#2563EB]" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                    </svg>
                    <h2 class="text-base font-semibold text-[#1E293B]">Informasi Akun</h2>
                </div>
                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-5">

                    <div class="md:col-span-2">
                        <label for="name" class="block text-sm font-medium text-[#1E293B] mb-1.5">
                            Nama Lengkap <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}"
                            class="w-full px-4 py-2.5 bg-white border border-[#E2E8F0] rounded-xl text-sm text-[#1E293B] focus:outline-none focus:ring-2 focus:ring-[#2563EB]/30 focus:border-[#2563EB] transition @error('name') border-red-400 @enderror">
                        @error('name')
                            <p class="mt-1.5 text-xs text-red-500 flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-[#1E293B] mb-1.5">
                            Email <span class="text-red-500">*</span>
                        </label>
                        <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                            class="w-full px-4 py-2.5 bg-white border border-[#E2E8F0] rounded-xl text-sm text-[#1E293B] focus:outline-none focus:ring-2 focus:ring-[#2563EB]/30 focus:border-[#2563EB] transition @error('email') border-red-400 @enderror">
                        @error('email')
                            <p class="mt-1.5 text-xs text-red-500 flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-[#1E293B] mb-1.5">
                            Password Baru <span class="text-xs text-slate-400 font-normal">(kosongkan jika tidak
                                diubah)</span>
                        </label>
                        <input type="password" id="password" name="password" placeholder="Minimal 8 karakter"
                            class="w-full px-4 py-2.5 bg-white border border-[#E2E8F0] rounded-xl text-sm text-[#1E293B] placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-[#2563EB]/30 focus:border-[#2563EB] transition @error('password') border-red-400 @enderror">
                        @error('password')
                            <p class="mt-1.5 text-xs text-red-500 flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div>
                        <label for="password_confirmation"
                            class="block text-sm font-medium text-[#1E293B] mb-1.5">Konfirmasi Password Baru</label>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                            placeholder="Ulangi password baru"
                            class="w-full px-4 py-2.5 bg-white border border-[#E2E8F0] rounded-xl text-sm text-[#1E293B] placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-[#2563EB]/30 focus:border-[#2563EB] transition">
                    </div>
                </div>
            </div>

            {{-- Role --}}
            <div class="bg-white rounded-xl border border-[#E2E8F0] shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-[#E2E8F0] bg-[#F8FAFC] flex items-center gap-2">
                    <svg class="w-5 h-5 text-[#2563EB]" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                    </svg>
                    <h2 class="text-base font-semibold text-[#1E293B]">Role</h2>
                </div>
                <div class="p-6 space-y-5">

                    <div>
                        <label class="block text-sm font-medium text-[#1E293B] mb-3">
                            Role <span class="text-red-500">*</span>
                        </label>

                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
                            @foreach ($roles as $role)
                                @php
                                    $checked = old('role', $user->roles->first()?->name) == $role->name;
                                @endphp

                                <label
                                    class="flex items-center gap-3 p-3 rounded-xl border-2 cursor-pointer transition-all
                {{ $checked ? 'border-blue-500 bg-blue-50' : 'border-[#E2E8F0] hover:bg-[#F8FAFC]' }}">

                                    <input type="radio" name="role" value="{{ $role->name }}"
                                        {{ $checked ? 'checked' : '' }}
                                        class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500">

                                    <span class="text-sm font-medium text-slate-700">
                                        {{ ucfirst(str_replace('-', ' ', $role->name)) }}
                                    </span>
                                </label>
                            @endforeach
                        </div>

                        @error('role')
                            <p class="mt-2 text-xs text-red-500 flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                </div>
            </div>

            {{-- Action Buttons --}}
            <div class="flex items-center justify-end gap-3">
                <a href="{{ route('user.index') }}"
                    class="px-4 py-2.5 text-sm font-medium text-slate-600 hover:bg-slate-100 rounded-xl transition">Batal</a>
                <button type="submit"
                    class="px-6 py-2.5 bg-[#2563EB] hover:bg-[#1D4ED8] text-white text-sm font-medium rounded-xl shadow-sm shadow-blue-600/20 transition">Update</button>
            </div>
        </form>
    </div>

@endsection
