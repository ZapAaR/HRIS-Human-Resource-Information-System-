@extends('layouts.app')
@section('title', 'Detail Karyawan')

@section('content')
    <div class="space-y-6">

        {{-- Page Header --}}
        <div>
            <nav class="flex items-center gap-2 text-sm text-slate-500 mb-2">
                <a href="{{ route('dashboard') }}" class="hover:text-[#2563EB] transition">Dashboard</a>
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                </svg>
                <a href="{{ route('karyawan.index') }}" class="hover:text-[#2563EB] transition">Karyawan</a>
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                </svg>
                <span class="text-[#1E293B] font-medium">Detail</span>
            </nav>
            <div class="flex items-center justify-between flex-wrap gap-3">
                <div>
                    <h1 class="text-2xl lg:text-3xl font-bold text-[#1E293B]">Detail Karyawan</h1>
                </div>
                <div class="flex items-center gap-2">
                    <a href="{{ route('karyawan.index') }}"
                        class="inline-flex items-center gap-2 px-4 py-2.5 text-sm font-medium text-slate-600 hover:bg-slate-100 rounded-xl transition">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                        </svg>
                        <span>Kembali</span>
                    </a>
                    <a href="{{ route('karyawan.edit', $karyawan) }}"
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

                        @if ($karyawan->foto)
                            <img src="{{ asset('storage/karyawan/' . $karyawan->foto) }}" alt="{{ $karyawan->nama_karyawan }}"
                                class="w-full h-full rounded-xl object-cover">
                        @else
                            <div
                                class="w-full h-full rounded-xl bg-gradient-to-br from-blue-500 to-indigo-600 text-white flex items-center justify-center text-4xl font-bold">
                                {{ strtoupper(substr($karyawan->nama_karyawan, 0, 1)) }}
                            </div>
                        @endif

                    </div>
                </div>

            </div>

            {{-- Content --}}
            <div class="pt-20 pb-6 px-8">

                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">

                    <div>

                        <h2 class="text-2xl font-bold text-[#1E293B]">
                            {{ $karyawan->nama_karyawan }}
                        </h2>

                        <p class="mt-1 text-slate-500">
                            {{ $karyawan->posisi->nama_posisi ?? '-' }}
                            <span class="mx-1">•</span>
                            {{ $karyawan->divisi->nama_divisi ?? '-' }}
                        </p>

                    </div>

                    <div>

                        @php
                            $statusColors = [
                                'Aktif' => 'bg-green-50 text-green-700 border-green-200',
                                'Tidak Aktif' => 'bg-red-50 text-red-700 border-red-200',
                            ];

                            $statusColor =
                                $statusColors[$karyawan->status] ?? 'bg-slate-50 text-slate-700 border-slate-200';
                        @endphp

                        <span
                            class="inline-flex items-center px-4 py-2 rounded-xl border font-semibold {{ $statusColor }}">
                            {{ $karyawan->status }}
                        </span>

                    </div>

                </div>

            </div>

        </div>

        {{-- Detail Sections --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            {{-- Informasi Pribadi --}}
            <div class="bg-white rounded-xl border border-[#E2E8F0] shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-[#E2E8F0] bg-[#F8FAFC] flex items-center gap-2">
                    <svg class="w-5 h-5 text-[#2563EB]" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                    </svg>
                    <h3 class="text-base font-semibold text-[#1E293B]">Informasi Pribadi</h3>
                </div>
                <div class="p-6 space-y-4">
                    <div class="flex justify-between items-start py-2 border-b border-slate-100">
                        <span class="text-sm text-slate-500">Kode Karyawan</span>
                        <span class="text-sm font-medium text-[#1E293B]">{{ $karyawan->kode_karyawan }}</span>
                    </div>
                    <div class="flex justify-between items-start py-2 border-b border-slate-100">
                        <span class="text-sm text-slate-500">NIK</span>
                        <span class="text-sm font-medium text-[#1E293B]">{{ $karyawan->nik }}</span>
                    </div>
                    <div class="flex justify-between items-start py-2 border-b border-slate-100">
                        <span class="text-sm text-slate-500">Jenis Kelamin</span>
                        <span class="text-sm font-medium text-[#1E293B]">{{ $karyawan->jenis_kelamin }}</span>
                    </div>
                    <div class="flex justify-between items-start py-2 border-b border-slate-100">
                        <span class="text-sm text-slate-500">Tanggal Lahir</span>
                        <span
                            class="text-sm font-medium text-[#1E293B]">{{ $karyawan->tanggal_lahir->format('d M Y') }}</span>
                    </div>
                    <div class="flex justify-between items-start py-2">
                        <span class="text-sm text-slate-500">User</span>
                        <span class="text-sm font-medium text-[#1E293B]">{{ $karyawan->user->name ?? '-' }}</span>
                    </div>
                </div>
            </div>

            {{-- Informasi Kontak --}}
            <div class="bg-white rounded-xl border border-[#E2E8F0] shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-[#E2E8F0] bg-[#F8FAFC] flex items-center gap-2">
                    <svg class="w-5 h-5 text-[#2563EB]" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                    </svg>
                    <h3 class="text-base font-semibold text-[#1E293B]">Informasi Kontak</h3>
                </div>
                <div class="p-6 space-y-4">
                    <div class="flex justify-between items-start py-2 border-b border-slate-100">
                        <span class="text-sm text-slate-500">Email</span>
                        <span class="text-sm font-medium text-[#1E293B] break-all">{{ $karyawan->email }}</span>
                    </div>
                    <div class="flex justify-between items-start py-2 border-b border-slate-100">
                        <span class="text-sm text-slate-500">No Telepon</span>
                        <span class="text-sm font-medium text-[#1E293B]">{{ $karyawan->no_telepon ?? '-' }}</span>
                    </div>
                    <div class="py-2">
                        <span class="text-sm text-slate-500 block mb-1">Alamat</span>
                        <span class="text-sm font-medium text-[#1E293B]">{{ $karyawan->alamat ?? '-' }}</span>
                    </div>
                </div>
            </div>

            {{-- Informasi Pekerjaan --}}
            <div class="bg-white rounded-xl border border-[#E2E8F0] shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-[#E2E8F0] bg-[#F8FAFC] flex items-center gap-2">
                    <svg class="w-5 h-5 text-[#2563EB]" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 00.75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 00-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0112 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 01-.673-.38m0 0A2.18 2.18 0 013 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 013.413-.387m7.5 0V5.25A2.25 2.25 0 0013.5 3h-3a2.25 2.25 0 00-2.25 2.25v.894m7.5 0a48.667 48.667 0 00-7.5 0M12 12.75h.008v.008H12v-.008z" />
                    </svg>
                    <h3 class="text-base font-semibold text-[#1E293B]">Informasi Pekerjaan</h3>
                </div>
                <div class="p-6 space-y-4">
                    <div class="flex justify-between items-start py-2 border-b border-slate-100">
                        <span class="text-sm text-slate-500">Divisi</span>
                        <span
                            class="text-sm font-medium text-[#1E293B]">{{ $karyawan->divisi->nama_divisi ?? '-' }}</span>
                    </div>
                    <div class="flex justify-between items-start py-2 border-b border-slate-100">
                        <span class="text-sm text-slate-500">Posisi</span>
                        <span
                            class="text-sm font-medium text-[#1E293B]">{{ $karyawan->posisi->nama_posisi ?? '-' }}</span>
                    </div>
                    <div class="flex justify-between items-start py-2 border-b border-slate-100">
                        <span class="text-sm text-slate-500">Tanggal Masuk</span>
                        <span
                            class="text-sm font-medium text-[#1E293B]">{{ $karyawan->tanggal_masuk->format('d M Y') }}</span>
                    </div>
                    <div class="flex justify-between items-start py-2">
                        <span class="text-sm text-slate-500">Gaji Pokok</span>
                        <span class="text-sm font-semibold text-[#2563EB]">Rp
                            {{ number_format($karyawan->gaji_pokok, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

            {{-- Informasi Sistem --}}
            <div class="bg-white rounded-xl border border-[#E2E8F0] shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-[#E2E8F0] bg-[#F8FAFC] flex items-center gap-2">
                    <svg class="w-5 h-5 text-[#2563EB]" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                    </svg>
                    <h3 class="text-base font-semibold text-[#1E293B]">Informasi Sistem</h3>
                </div>
                <div class="p-6 space-y-4">
                    <div class="flex justify-between items-start py-2 border-b border-slate-100">
                        <span class="text-sm text-slate-500">Dibuat</span>
                        <span
                            class="text-sm font-medium text-[#1E293B]">{{ $karyawan->created_at->format('d M Y H:i') }}</span>
                    </div>
                    <div class="flex justify-between items-start py-2 border-b border-slate-100">
                        <span class="text-sm text-slate-500">Terakhir Diupdate</span>
                        <span
                            class="text-sm font-medium text-[#1E293B]">{{ $karyawan->updated_at->format('d M Y H:i') }}</span>
                    </div>
                    <div class="flex justify-between items-start py-2">
                        <span class="text-sm text-slate-500">Foto</span>
                        <span
                            class="text-sm font-medium text-[#1E293B]">{{ $karyawan->foto ? 'Ada' : 'Belum ada' }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
