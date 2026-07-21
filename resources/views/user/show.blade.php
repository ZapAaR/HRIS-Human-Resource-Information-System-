@extends('layouts.app')
@section('title', 'Detail User')

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
                <span class="text-[#1E293B] font-medium">Detail</span>
            </nav>
            <div class="flex items-center justify-between flex-wrap gap-3">
                <div>
                    <h1 class="text-2xl lg:text-3xl font-bold text-[#1E293B]">Detail User</h1>
                    <p class="text-slate-500 mt-1">{{ $user->name }}</p>
                </div>
                <div class="flex items-center gap-2">
                    <a href="{{ route('user.index') }}"
                        class="inline-flex items-center gap-2 px-4 py-2.5 text-sm font-medium text-slate-600 hover:bg-slate-100 rounded-xl transition">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                        </svg>
                        <span>Kembali</span>
                    </a>
                    <a href="{{ route('user.edit', $user) }}"
                        class="inline-flex items-center gap-2 px-4 py-2.5 bg-amber-500 hover:bg-amber-600 text-white text-sm font-medium rounded-xl shadow-sm transition">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                        </svg>
                        <span>Edit</span>
                    </a>
                </div>
            </div>
        </div>

        {{-- Profile Card --}}
        <div class="bg-white rounded-xl border border-[#E2E8F0] shadow-sm overflow-hidden">

            {{-- Cover --}}
            <div class="relative h-40 bg-gradient-to-r from-blue-500 via-indigo-500 to-violet-600">

                {{-- Avatar --}}
                <div class="absolute left-8 -bottom-14">
                    <div class="w-28 h-28 rounded-2xl bg-white p-1 shadow-xl border-4 border-white">

                        <div
                            class="w-full h-full rounded-xl bg-gradient-to-br from-blue-500 to-indigo-600 text-white flex items-center justify-center text-4xl font-bold uppercase">
                            {{ substr($user->name, 0, 1) }}
                        </div>

                    </div>
                </div>

            </div>

            {{-- Content --}}
            <div class="pt-20 pb-6 px-8">

                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">

                    <div>

                        <h2 class="text-2xl font-bold text-[#1E293B]">
                            {{ $user->name }}
                        </h2>

                        <p class="mt-1 text-slate-500">
                            {{ $user->email }}
                        </p>

                    </div>

                    <div>

                        @php
                            $role = $user->roles->first();

                            $roleColors = [
                                'admin' => 'bg-blue-50 text-blue-700 border-blue-200',
                                'hr' => 'bg-green-50 text-green-700 border-green-200',
                                'manager' => 'bg-amber-50 text-amber-700 border-amber-200',
                                'employee' => 'bg-slate-50 text-slate-700 border-slate-200',
                            ];

                            $roleColor = $roleColors[$role?->name] ?? 'bg-indigo-50 text-indigo-700 border-indigo-200';
                        @endphp

                        @if ($role)
                            <span
                                class="inline-flex items-center gap-2 px-4 py-2 rounded-xl border font-semibold {{ $roleColor }}">

                                <span class="w-2 h-2 rounded-full bg-current"></span>

                                {{ ucfirst($role->name) }}

                            </span>
                        @endif

                    </div>

                </div>

            </div>

        </div>

        {{-- Detail Sections --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            {{-- Informasi Akun --}}
            <div class="bg-white rounded-xl border border-[#E2E8F0] shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-[#E2E8F0] bg-[#F8FAFC] flex items-center gap-2">
                    <svg class="w-5 h-5 text-[#2563EB]" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                    </svg>
                    <h3 class="text-base font-semibold text-[#1E293B]">Informasi Akun</h3>
                </div>
                <div class="p-6 space-y-4">
                    <div class="flex justify-between items-start py-2 border-b border-slate-100">
                        <span class="text-sm text-slate-500">Nama Lengkap</span>
                        <span class="text-sm font-medium text-[#1E293B]">{{ $user->name }}</span>
                    </div>
                    <div class="flex justify-between items-start py-2 border-b border-slate-100">
                        <span class="text-sm text-slate-500">Email</span>
                        <span class="text-sm font-medium text-[#1E293B] break-all">{{ $user->email }}</span>
                    </div>
                </div>
            </div>

            {{-- Role  --}}
            <div class="bg-white rounded-xl border border-[#E2E8F0] shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-[#E2E8F0] bg-[#F8FAFC] flex items-center gap-2">
                    <svg class="w-5 h-5 text-[#2563EB]" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                    </svg>
                    <h3 class="text-base font-semibold text-[#1E293B]">Role </h3>
                </div>
                <div class="p-6 space-y-4">
                    <div class="py-2 border-b border-slate-100">
                        <span class="text-sm text-slate-500 block mb-2">Role yang Dimiliki</span>
                        <div class="flex flex-wrap gap-1.5">
                            @forelse($user->roles as $role)
                                @php
                                    $roleColors = [
                                        'admin' => 'bg-blue-50 text-blue-700 border-blue-200',
                                        'hr' => 'bg-green-50 text-green-700 border-green-200',
                                        'manager' => 'bg-amber-50 text-amber-700 border-amber-200',
                                        'employee' => 'bg-slate-50 text-slate-700 border-slate-200',
                                    ];
                                    $color =
                                        $roleColors[$role->name] ?? 'bg-indigo-50 text-indigo-700 border-indigo-200';
                                @endphp
                                <span
                                    class="inline-flex items-center px-2.5 py-1 text-xs font-medium rounded-lg border {{ $color }}">
                                    {{ ucfirst(str_replace('-', ' ', $role->name)) }}
                                </span>
                            @empty
                                <span class="text-sm text-slate-400">Tidak ada role</span>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            {{-- Informasi Sistem --}}
            <div class="bg-white rounded-xl border border-[#E2E8F0] shadow-sm overflow-hidden lg:col-span-2">
                <div class="px-6 py-4 border-b border-[#E2E8F0] bg-[#F8FAFC] flex items-center gap-2">
                    <svg class="w-5 h-5 text-[#2563EB]" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                    </svg>
                    <h3 class="text-base font-semibold text-[#1E293B]">Informasi Sistem</h3>
                </div>
                <div class="p-6 grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="p-4 bg-[#F8FAFC] rounded-xl border border-[#E2E8F0]">
                        <p class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">ID User</p>
                        <p class="text-sm font-semibold text-[#1E293B]">#{{ $user->id }}</p>
                    </div>
                    <div class="p-4 bg-[#F8FAFC] rounded-xl border border-[#E2E8F0]">
                        <p class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">Terdaftar Sejak</p>
                        <p class="text-sm font-semibold text-[#1E293B]">{{ $user->created_at->format('d M Y') }}</p>
                    </div>
                    <div class="p-4 bg-[#F8FAFC] rounded-xl border border-[#E2E8F0]">
                        <p class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">Terakhir Update</p>
                        <p class="text-sm font-semibold text-[#1E293B]">{{ $user->updated_at->format('d M Y H:i') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
