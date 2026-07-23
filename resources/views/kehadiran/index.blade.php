@extends('layouts.app')
@section('title', 'Kehadiran')

@section('content')
    <div class="space-y-6">

        {{-- Page Header --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <nav class="flex items-center gap-2 text-sm text-slate-500 mb-2">
                    <a href="{{ route('dashboard') }}" class="hover:text-[#2563EB] transition">Dashboard</a>
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                    </svg>
                    <span class="text-[#1E293B] font-medium">Kehadiran</span>
                </nav>
                <h1 class="text-2xl lg:text-3xl font-bold text-[#1E293B]">Kehadiran</h1>
                <p class="text-slate-500 mt-1">Kelola data kehadiran karyawan</p>
            </div>
            @can('kehadiran.create')
                <button type="button" id="btn-open-create"
                    class="inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-[#2563EB] hover:bg-[#1D4ED8] text-white text-sm font-medium rounded-xl shadow-sm shadow-blue-600/20 hover:shadow-md hover:shadow-blue-600/30 transition-all duration-200">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    <span>Tambah Kehadiran</span>
                </button>
            @endcan
        </div>

        {{-- Success Alert --}}
        @if (session('success'))
            <div class="flex items-center gap-3 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl"
                role="alert">
                <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="text-sm font-medium">{{ session('success') }}</span>
            </div>
        @endif

        @role('karyawan')
            @if (!$kehadiranHariIni)
                <form action="{{ route('kehadiran.checkin') }}" method="POST">
                    @csrf

                    <button class="btn btn-success">
                        Check In
                    </button>
                </form>
            @elseif (!$kehadiranHariIni->jam_keluar)
                <form action="{{ route('kehadiran.checkout') }}" method="POST">
                    @csrf

                    <button class="btn btn-danger">
                        Check Out
                    </button>
                </form>
            @else
                <button disabled class="btn btn-secondary">
                    Kehadiran Selesai
                </button>
            @endif
        @endrole

        {{-- Filter Card --}}
        <div class="bg-white rounded-xl border border-[#E2E8F0] shadow-sm overflow-hidden">
            <form action="{{ route('kehadiran.index') }}" method="GET" class="p-4 lg:p-5">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-3">

                    {{-- Search --}}
                    <div class="lg:col-span-2">
                        <label class="block text-xs font-medium text-slate-500 uppercase tracking-wider mb-1.5">Cari
                            Karyawan</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                                </svg>
                            </span>
                            <input type="text" name="search" value="{{ request('search') }}"
                                placeholder="Nama atau kode karyawan..."
                                class="w-full pl-10 pr-4 py-2.5 bg-[#F8FAFC] border border-[#E2E8F0] rounded-xl text-sm text-[#1E293B] placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-[#2563EB]/30 focus:border-[#2563EB] transition">
                        </div>
                    </div>

                    {{-- Tanggal --}}
                    <div>
                        <label
                            class="block text-xs font-medium text-slate-500 uppercase tracking-wider mb-1.5">Tanggal</label>
                        <input type="date" name="tanggal" value="{{ request('tanggal') }}"
                            class="w-full px-4 py-2.5 bg-[#F8FAFC] border border-[#E2E8F0] rounded-xl text-sm text-[#1E293B] focus:outline-none focus:ring-2 focus:ring-[#2563EB]/30 focus:border-[#2563EB] transition">
                    </div>

                    {{-- Status --}}
                    <div>
                        <label
                            class="block text-xs font-medium text-slate-500 uppercase tracking-wider mb-1.5">Status</label>
                        <select name="status"
                            class="w-full px-4 py-2.5 bg-[#F8FAFC] border border-[#E2E8F0] rounded-xl text-sm text-[#1E293B] focus:outline-none focus:ring-2 focus:ring-[#2563EB]/30 focus:border-[#2563EB] transition">
                            <option value="">Semua Status</option>
                            <option value="Hadir" {{ request('status') == 'Hadir' ? 'selected' : '' }}>Hadir</option>
                            <option value="Izin" {{ request('status') == 'Izin' ? 'selected' : '' }}>Izin</option>
                            <option value="Sakit" {{ request('status') == 'Sakit' ? 'selected' : '' }}>Sakit</option>
                            <option value="Cuti" {{ request('status') == 'Cuti' ? 'selected' : '' }}>Cuti</option>
                            <option value="Alpha" {{ request('status') == 'Alpha' ? 'selected' : '' }}>Alpha</option>
                        </select>
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="flex items-center justify-between mt-4 pt-4 border-t border-[#E2E8F0]">
                    <p class="text-sm text-slate-500">
                        Total <span class="font-semibold text-[#1E293B]">{{ $kehadirans->total() }}</span> data
                    </p>
                    <div class="flex items-center gap-2">
                        <a href="{{ route('kehadiran.index') }}"
                            class="px-4 py-2 text-sm font-medium text-slate-600 hover:bg-slate-100 rounded-lg transition">
                            Reset
                        </a>
                        <button type="submit"
                            class="px-4 py-2 bg-[#2563EB] hover:bg-[#1D4ED8] text-white text-sm font-medium rounded-lg transition">
                            Filter
                        </button>
                    </div>
                </div>
            </form>
        </div>

        {{-- Status Quick Filter --}}
        <div class="flex flex-wrap items-center gap-2">
            <a href="{{ route('kehadiran.index') }}"
                class="px-3 py-1.5 text-xs font-medium rounded-lg border transition {{ !request('status') ? 'bg-[#2563EB] text-white border-[#2563EB]' : 'bg-white text-slate-600 border-[#E2E8F0] hover:bg-[#F8FAFC]' }}">
                Semua
            </a>
            <a href="{{ route('kehadiran.index', ['status' => 'Hadir']) }}"
                class="px-3 py-1.5 text-xs font-medium rounded-lg border transition {{ request('status') == 'Hadir' ? 'bg-green-600 text-white border-green-600' : 'bg-white text-slate-600 border-[#E2E8F0] hover:bg-[#F8FAFC]' }}">
                Hadir
            </a>
            <a href="{{ route('kehadiran.index', ['status' => 'Izin']) }}"
                class="px-3 py-1.5 text-xs font-medium rounded-lg border transition {{ request('status') == 'Izin' ? 'bg-blue-600 text-white border-blue-600' : 'bg-white text-slate-600 border-[#E2E8F0] hover:bg-[#F8FAFC]' }}">
                Izin
            </a>
            <a href="{{ route('kehadiran.index', ['status' => 'Sakit']) }}"
                class="px-3 py-1.5 text-xs font-medium rounded-lg border transition {{ request('status') == 'Sakit' ? 'bg-amber-600 text-white border-amber-600' : 'bg-white text-slate-600 border-[#E2E8F0] hover:bg-[#F8FAFC]' }}">
                Sakit
            </a>
            <a href="{{ route('kehadiran.index', ['status' => 'Cuti']) }}"
                class="px-3 py-1.5 text-xs font-medium rounded-lg border transition {{ request('status') == 'Cuti' ? 'bg-purple-600 text-white border-purple-600' : 'bg-white text-slate-600 border-[#E2E8F0] hover:bg-[#F8FAFC]' }}">
                Cuti
            </a>
            <a href="{{ route('kehadiran.index', ['status' => 'Alpha']) }}"
                class="px-3 py-1.5 text-xs font-medium rounded-lg border transition {{ request('status') == 'Alpha' ? 'bg-red-600 text-white border-red-600' : 'bg-white text-slate-600 border-[#E2E8F0] hover:bg-[#F8FAFC]' }}">
                Alpha
            </a>
        </div>

        {{-- ============================================= --}}
        {{-- DESKTOP TABLE (hidden di mobile)              --}}
        {{-- ============================================= --}}
        <div class="hidden lg:block bg-white rounded-xl border border-[#E2E8F0] shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-[#F8FAFC] border-b border-[#E2E8F0]">
                        <tr>
                            <th class="px-4 py-3.5 text-left font-semibold text-[#1E293B] w-14">No</th>
                            <th class="px-4 py-3.5 text-left font-semibold text-[#1E293B]">Nama Karyawan</th>
                            <th class="px-4 py-3.5 text-left font-semibold text-[#1E293B]">Tanggal</th>
                            <th class="px-4 py-3.5 text-left font-semibold text-[#1E293B]">Jam Masuk</th>
                            <th class="px-4 py-3.5 text-left font-semibold text-[#1E293B]">Jam Keluar</th>
                            <th class="px-4 py-3.5 text-left font-semibold text-[#1E293B]">Status</th>
                            <th class="px-4 py-3.5 text-left font-semibold text-[#1E293B]">Keterlambatan</th>
                            <th class="px-4 py-3.5 text-left font-semibold text-[#1E293B]">Keterangan</th>
                            @can('kehadiran.edit')
                                <th class="px-4 py-3.5 text-right font-semibold text-[#1E293B] w-40">Aksi</th>
                            @endcan
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#E2E8F0]">
                        @forelse($kehadirans as $index => $item)
                            <tr class="hover:bg-[#F8FAFC] transition-colors duration-150">
                                <td class="px-4 py-4 text-slate-600 font-medium">
                                    {{ $kehadirans->firstItem() + $index }}
                                </td>
                                <td class="px-4 py-4">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-9 h-9 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 text-white flex items-center justify-center font-semibold text-xs shrink-0 overflow-hidden">
                                            @if ($item->karyawan?->foto)
                                                <img src="{{ asset('storage/' . $item->karyawan->foto) }}"
                                                    class="w-full h-full object-cover">
                                            @else
                                                {{ strtoupper(substr($item->karyawan->nama_karyawan ?? '?', 0, 1)) }}
                                            @endif
                                        </div>
                                        <div class="min-w-0">
                                            <p class="font-medium text-[#1E293B] truncate">
                                                {{ $item->karyawan->nama_karyawan ?? '-' }}</p>
                                            <p class="text-xs text-slate-500 truncate">
                                                {{ $item->karyawan->kode_karyawan ?? '-' }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-4 text-slate-600">
                                    {{ $item->tanggal_kehadiran->format('d M Y') }}
                                </td>
                                <td class="px-4 py-4">
                                    <span class="inline-flex items-center gap-1.5 text-slate-700 font-medium">
                                        <svg class="w-4 h-4 text-green-500" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15.75 19.5L8.25 12l7.5-7.5" />
                                        </svg>
                                        {{ $item->jam_masuk ?? '-' }}
                                    </span>
                                </td>
                                <td class="px-4 py-4">
                                    <span class="inline-flex items-center gap-1.5 text-slate-700 font-medium">
                                        <svg class="w-4 h-4 text-red-500" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                        </svg>
                                        {{ $item->jam_keluar ?? '-' }}
                                    </span>
                                </td>
                                <td class="px-4 py-4">
                                    @php
                                        $statusColors = [
                                            'Hadir' => 'bg-green-50 text-green-700 border-green-200',
                                            'Izin' => 'bg-blue-50 text-blue-700 border-blue-200',
                                            'Sakit' => 'bg-amber-50 text-amber-700 border-amber-200',
                                            'Cuti' => 'bg-purple-50 text-purple-700 border-purple-200',
                                            'Alpha' => 'bg-red-50 text-red-700 border-red-200',
                                        ];
                                        $statusColor =
                                            $statusColors[$item->status] ??
                                            'bg-slate-50 text-slate-700 border-slate-200';
                                    @endphp
                                    <span
                                        class="inline-flex items-center px-2.5 py-1 text-xs font-medium rounded-lg border {{ $statusColor }}">
                                        {{ $item->status }}
                                    </span>
                                </td>
                                <td class="px-4 py-4">
                                    @if ($item->menit_keterlambatan > 0)
                                        <span
                                            class="inline-flex items-center gap-1 px-2 py-1 text-xs font-medium rounded-lg bg-red-50 text-red-700 border border-red-200">
                                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            {{ $item->menit_keterlambatan }} mnt
                                        </span>
                                    @else
                                        <span class="text-xs text-slate-400">Tepat waktu</span>
                                    @endif
                                </td>
                                <td class="px-4 py-4 text-slate-600 max-w-xs">
                                    <span class="line-clamp-2">{{ $item->keterangan ?? '-' }}</span>
                                </td>
                                <td class="px-4 py-4">
                                    <div class="flex items-center justify-end gap-2">
                                        @can('kehadiran.edit')
                                            <button type="button"
                                                class="btn-edit inline-flex items-center gap-1 px-2.5 py-1.5 bg-amber-50 hover:bg-amber-100 text-amber-600 hover:text-amber-700 text-xs font-medium rounded-lg border border-amber-200 transition-all duration-200"
                                                data-id="{{ $item->id }}" data-karyawan-id="{{ $item->karyawan_id }}"
                                                data-tanggal="{{ $item->tanggal_kehadiran->format('Y-m-d') }}"
                                                data-jam-masuk="{{ $item->jam_masuk }}"
                                                data-jam-keluar="{{ $item->jam_keluar }}" data-status="{{ $item->status }}"
                                                data-keterlambatan="{{ $item->menit_keterlambatan }}"
                                                data-keterangan="{{ $item->keterangan }}"
                                                data-action="{{ route('kehadiran.update', $item) }}">
                                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125" />
                                                </svg>
                                                <span>Edit</span>
                                            </button>
                                        @endcan

                                        @can('kehadiran.delete')
                                            <button type="button"
                                                class="btn-delete inline-flex items-center gap-1 px-2.5 py-1.5 bg-red-50 hover:bg-red-100 text-red-600 hover:text-red-700 text-xs font-medium rounded-lg border border-red-200 transition-all duration-200"
                                                data-action="{{ route('kehadiran.destroy', $item) }}"
                                                data-nama="{{ $item->karyawan->nama_karyawan ?? 'Karyawan' }}"
                                                data-tanggal="{{ $item->tanggal_kehadiran->format('d M Y') }}">
                                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                </svg>
                                                <span>Hapus</span>
                                            </button>
                                        @endcan

                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="px-6 py-16 text-center">
                                    <div class="flex flex-col items-center">
                                        <div
                                            class="w-16 h-16 rounded-2xl bg-slate-100 text-slate-400 flex items-center justify-center mb-4">
                                            <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                                            </svg>
                                        </div>
                                        <h3 class="text-base font-semibold text-[#1E293B] mb-1">Belum ada data kehadiran
                                        </h3>
                                        @can('kehadiran.create')
                                            <p class="text-sm text-slate-500 mb-4">Mulai catat kehadiran karyawan</p>
                                            <button type="button" id="btn-open-create-empty"
                                                class="inline-flex items-center gap-2 px-4 py-2 bg-[#2563EB] hover:bg-[#1D4ED8] text-white text-sm font-medium rounded-xl transition">
                                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M12 4.5v15m7.5-7.5h-15" />
                                                </svg>
                                                <span>Tambah Kehadiran</span>
                                            </button>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if ($kehadirans->hasPages())
                <div
                    class="px-4 py-4 border-t border-[#E2E8F0] flex flex-col sm:flex-row items-center justify-between gap-3">
                    <p class="text-sm text-slate-500">
                        Menampilkan <span class="font-medium text-[#1E293B]">{{ $kehadirans->firstItem() }}</span>
                        sampai <span class="font-medium text-[#1E293B]">{{ $kehadirans->lastItem() }}</span>
                        dari <span class="font-medium text-[#1E293B]">{{ $kehadirans->total() }}</span> data
                    </p>
                    @include('kehadiran._pagination', ['paginator' => $kehadirans])
                </div>
            @endif
        </div>

        {{-- ============================================= --}}
        {{-- MOBILE CARD (hidden di desktop)               --}}
        {{-- ============================================= --}}
        <div class="lg:hidden space-y-3">
            @forelse($kehadirans as $item)
                @php
                    $statusColors = [
                        'Hadir' => 'bg-green-50 text-green-700 border-green-200',
                        'Izin' => 'bg-blue-50 text-blue-700 border-blue-200',
                        'Sakit' => 'bg-amber-50 text-amber-700 border-amber-200',
                        'Cuti' => 'bg-purple-50 text-purple-700 border-purple-200',
                        'Alpha' => 'bg-red-50 text-red-700 border-red-200',
                    ];
                    $statusColor = $statusColors[$item->status] ?? 'bg-slate-50 text-slate-700 border-slate-200';
                @endphp
                <div class="bg-white rounded-xl border border-[#E2E8F0] shadow-sm overflow-hidden">
                    {{-- Card Header --}}
                    <div class="p-4 border-b border-[#E2E8F0] bg-[#F8FAFC]">
                        <div class="flex items-center justify-between gap-3">
                            <div class="flex items-center gap-3 min-w-0">
                                <div
                                    class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 text-white flex items-center justify-center font-semibold text-sm shrink-0 overflow-hidden">
                                    @if ($item->karyawan?->foto)
                                        <img src="{{ asset('storage/' . $item->karyawan->foto) }}"
                                            class="w-full h-full object-cover">
                                    @else
                                        {{ strtoupper(substr($item->karyawan->nama_karyawan ?? '?', 0, 1)) }}
                                    @endif
                                </div>
                                <div class="min-w-0">
                                    <p class="font-semibold text-[#1E293B] truncate">
                                        {{ $item->karyawan->nama_karyawan ?? '-' }}</p>
                                    <p class="text-xs text-slate-500 truncate">{{ $item->karyawan->kode_karyawan ?? '-' }}
                                    </p>
                                </div>
                            </div>
                            <span
                                class="inline-flex items-center px-2.5 py-1 text-xs font-medium rounded-lg border shrink-0 {{ $statusColor }}">
                                {{ $item->status }}
                            </span>
                        </div>
                    </div>

                    {{-- Card Body --}}
                    <div class="p-4 space-y-3">
                        {{-- Tanggal --}}
                        <div class="flex items-center gap-2 text-sm">
                            <svg class="w-4 h-4 text-slate-400 shrink-0" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25" />
                            </svg>
                            <span class="text-slate-600">{{ $item->tanggal_kehadiran->format('d M Y') }}</span>
                        </div>

                        {{-- Jam Masuk & Keluar --}}
                        <div class="grid grid-cols-2 gap-3">
                            <div class="p-3 bg-green-50 rounded-lg border border-green-100">
                                <p class="text-xs text-green-600 font-medium mb-0.5">Jam Masuk</p>
                                <p class="text-sm font-semibold text-green-700">{{ $item->jam_masuk ?? '-' }}</p>
                            </div>
                            <div class="p-3 bg-red-50 rounded-lg border border-red-100">
                                <p class="text-xs text-red-600 font-medium mb-0.5">Jam Keluar</p>
                                <p class="text-sm font-semibold text-red-700">{{ $item->jam_keluar ?? '-' }}</p>
                            </div>
                        </div>

                        {{-- Keterlambatan --}}
                        <div class="flex items-center justify-between p-3 bg-[#F8FAFC] rounded-lg border border-[#E2E8F0]">
                            <span class="text-xs text-slate-500">Keterlambatan</span>
                            @if ($item->menit_keterlambatan > 0)
                                <span
                                    class="inline-flex items-center gap-1 px-2 py-0.5 text-xs font-semibold rounded-md bg-red-100 text-red-700">
                                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    {{ $item->menit_keterlambatan }} menit
                                </span>
                            @else
                                <span class="text-xs font-medium text-green-600">Tepat waktu</span>
                            @endif
                        </div>

                        {{-- Keterangan --}}
                        @if ($item->keterangan)
                            <div class="p-3 bg-[#F8FAFC] rounded-lg border border-[#E2E8F0]">
                                <p class="text-xs text-slate-500 mb-1">Keterangan</p>
                                <p class="text-sm text-[#1E293B]">{{ $item->keterangan }}</p>
                            </div>
                        @endif
                    </div>

                    {{-- Card Footer - Actions --}}
                    <div class="p-3 border-t border-[#E2E8F0] bg-[#F8FAFC] flex items-center gap-2">
                        <button type="button"
                            class="btn-edit flex-1 inline-flex items-center justify-center gap-1.5 px-3 py-2 bg-amber-50 hover:bg-amber-100 text-amber-600 hover:text-amber-700 text-xs font-medium rounded-lg border border-amber-200 transition"
                            data-id="{{ $item->id }}" data-karyawan-id="{{ $item->karyawan_id }}"
                            data-tanggal="{{ $item->tanggal_kehadiran->format('Y-m-d') }}"
                            data-jam-masuk="{{ $item->jam_masuk }}" data-jam-keluar="{{ $item->jam_keluar }}"
                            data-status="{{ $item->status }}" data-keterlambatan="{{ $item->menit_keterlambatan }}"
                            data-keterangan="{{ $item->keterangan }}"
                            data-action="{{ route('kehadiran.update', $item) }}">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125" />
                            </svg>
                            <span>Edit</span>
                        </button>
                        <button type="button"
                            class="btn-delete flex-1 inline-flex items-center justify-center gap-1.5 px-3 py-2 bg-red-50 hover:bg-red-100 text-red-600 hover:text-red-700 text-xs font-medium rounded-lg border border-red-200 transition"
                            data-action="{{ route('kehadiran.destroy', $item) }}"
                            data-nama="{{ $item->karyawan->nama_karyawan ?? 'Karyawan' }}"
                            data-tanggal="{{ $item->tanggal_kehadiran->format('d M Y') }}">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                            </svg>
                            <span>Hapus</span>
                        </button>
                    </div>
                </div>
            @empty
                <div class="bg-white rounded-xl border border-[#E2E8F0] shadow-sm p-12 text-center">
                    <div class="flex flex-col items-center">
                        <div
                            class="w-16 h-16 rounded-2xl bg-slate-100 text-slate-400 flex items-center justify-center mb-4">
                            <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                            </svg>
                        </div>
                        <h3 class="text-base font-semibold text-[#1E293B] mb-1">Belum ada data kehadiran</h3>
                        <p class="text-sm text-slate-500 mb-4">Mulai catat kehadiran karyawan</p>
                        <button type="button" id="btn-open-create-empty-mobile"
                            class="inline-flex items-center gap-2 px-4 py-2 bg-[#2563EB] hover:bg-[#1D4ED8] text-white text-sm font-medium rounded-xl transition">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                            <span>Tambah Kehadiran</span>
                        </button>
                    </div>
                </div>
            @endforelse

            {{-- Mobile Pagination --}}
            @if ($kehadirans->hasPages())
                <div class="bg-white rounded-xl border border-[#E2E8F0] shadow-sm p-4">
                    <div class="flex items-center justify-between mb-3">
                        <p class="text-xs text-slate-500">
                            {{ $kehadirans->firstItem() }}-{{ $kehadirans->lastItem() }} dari {{ $kehadirans->total() }}
                        </p>
                        <p class="text-xs font-medium text-[#1E293B]">
                            Halaman {{ $kehadirans->currentPage() }} / {{ $kehadirans->lastPage() }}
                        </p>
                    </div>
                    <div class="flex items-center gap-2">
                        @if ($kehadirans->onFirstPage())
                            <span
                                class="flex-1 px-3 py-2 text-sm text-slate-300 bg-slate-50 rounded-lg text-center cursor-not-allowed">←
                                Sebelumnya</span>
                        @else
                            <a href="{{ $kehadirans->previousPageUrl() }}"
                                class="flex-1 px-3 py-2 text-sm text-slate-700 bg-white border border-[#E2E8F0] hover:bg-[#F8FAFC] rounded-lg text-center font-medium transition">←
                                Sebelumnya</a>
                        @endif
                        @if ($kehadirans->hasMorePages())
                            <a href="{{ $kehadirans->nextPageUrl() }}"
                                class="flex-1 px-3 py-2 text-sm text-white bg-[#2563EB] hover:bg-[#1D4ED8] rounded-lg text-center font-medium transition">Selanjutnya
                                →</a>
                        @else
                            <span
                                class="flex-1 px-3 py-2 text-sm text-slate-300 bg-slate-50 rounded-lg text-center cursor-not-allowed">Selanjutnya
                                →</span>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>

    {{-- ============================================= --}}
    {{-- MODAL CREATE                                   --}}
    {{-- ============================================= --}}
    <div id="modal-create" class="fixed inset-0 z-50 hidden">
        <div
            class="modal-backdrop fixed inset-0 bg-slate-900/60 backdrop-blur-sm opacity-0 transition-opacity duration-300">
        </div>
        <div class="flex min-h-full items-center justify-center p-4">
            <div
                class="modal-panel relative w-full max-w-2xl max-h-[90vh] transform overflow-hidden rounded-2xl bg-white shadow-2xl transition-all duration-300 scale-95 opacity-0 flex flex-col">

                <div class="flex items-center justify-between border-b border-[#E2E8F0] px-6 py-4 shrink-0">
                    <div class="flex items-center gap-2">
                        <div class="w-9 h-9 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-[#1E293B]">Tambah Kehadiran</h3>
                    </div>
                    <button type="button"
                        class="btn-close-modal rounded-lg p-1.5 text-slate-400 hover:bg-slate-100 hover:text-slate-600 transition">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <form action="{{ route('kehadiran.store') }}" method="POST" class="px-6 py-5 space-y-4 overflow-y-auto"
                    novalidate>
                    @csrf

                    {{-- Karyawan --}}
                    <div>
                        <label for="create-karyawan" class="block text-sm font-medium text-[#1E293B] mb-1.5">
                            Karyawan <span class="text-red-500">*</span>
                        </label>
                        <select id="create-karyawan" name="karyawan_id"
                            class="w-full px-4 py-2.5 bg-white border border-[#E2E8F0] rounded-xl text-sm text-[#1E293B] focus:outline-none focus:ring-2 focus:ring-[#2563EB]/30 focus:border-[#2563EB] transition @error('karyawan_id') border-red-400 @enderror">
                            <option value="">-- Pilih Karyawan --</option>
                            @foreach ($karyawans as $k)
                                <option value="{{ $k->id }}" {{ old('karyawan_id') == $k->id ? 'selected' : '' }}>
                                    {{ $k->nama_karyawan }} ({{ $k->kode_karyawan }})
                                </option>
                            @endforeach
                        </select>
                        @error('karyawan_id')
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

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        {{-- Tanggal --}}
                        <div>
                            <label for="create-tanggal" class="block text-sm font-medium text-[#1E293B] mb-1.5">
                                Tanggal Kehadiran <span class="text-red-500">*</span>
                            </label>
                            <input type="date" id="create-tanggal" name="tanggal_kehadiran"
                                value="{{ old('tanggal_kehadiran', date('Y-m-d')) }}"
                                class="w-full px-4 py-2.5 bg-white border border-[#E2E8F0] rounded-xl text-sm text-[#1E293B] focus:outline-none focus:ring-2 focus:ring-[#2563EB]/30 focus:border-[#2563EB] transition @error('tanggal_kehadiran') border-red-400 @enderror">
                            @error('tanggal_kehadiran')
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

                        {{-- Status --}}
                        <div>
                            <label for="create-status" class="block text-sm font-medium text-[#1E293B] mb-1.5">
                                Status <span class="text-red-500">*</span>
                            </label>
                            <select id="create-status" name="status"
                                class="w-full px-4 py-2.5 bg-white border border-[#E2E8F0] rounded-xl text-sm text-[#1E293B] focus:outline-none focus:ring-2 focus:ring-[#2563EB]/30 focus:border-[#2563EB] transition @error('status') border-red-400 @enderror">
                                <option value="Hadir" {{ old('status') == 'Hadir' ? 'selected' : '' }}>Hadir</option>
                                <option value="Izin" {{ old('status') == 'Izin' ? 'selected' : '' }}>Izin</option>
                                <option value="Sakit" {{ old('status') == 'Sakit' ? 'selected' : '' }}>Sakit</option>
                                <option value="Cuti" {{ old('status') == 'Cuti' ? 'selected' : '' }}>Cuti</option>
                                <option value="Alpha" {{ old('status') == 'Alpha' ? 'selected' : '' }}>Alpha</option>
                            </select>
                            @error('status')
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
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        {{-- Jam Masuk --}}
                        <div>
                            <label for="create-jam-masuk" class="block text-sm font-medium text-[#1E293B] mb-1.5">Jam
                                Masuk</label>
                            <input type="time" id="create-jam-masuk" name="jam_masuk" value="{{ old('jam_masuk') }}"
                                class="w-full px-4 py-2.5 bg-white border border-[#E2E8F0] rounded-xl text-sm text-[#1E293B] focus:outline-none focus:ring-2 focus:ring-[#2563EB]/30 focus:border-[#2563EB] transition @error('jam_masuk') border-red-400 @enderror">
                            @error('jam_masuk')
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

                        {{-- Jam Keluar --}}
                        <div>
                            <label for="create-jam-keluar" class="block text-sm font-medium text-[#1E293B] mb-1.5">Jam
                                Keluar</label>
                            <input type="time" id="create-jam-keluar" name="jam_keluar"
                                value="{{ old('jam_keluar') }}"
                                class="w-full px-4 py-2.5 bg-white border border-[#E2E8F0] rounded-xl text-sm text-[#1E293B] focus:outline-none focus:ring-2 focus:ring-[#2563EB]/30 focus:border-[#2563EB] transition @error('jam_keluar') border-red-400 @enderror">
                            @error('jam_keluar')
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
                    </div>

                    {{-- Menit Keterlambatan --}}
                    <div>
                        <label for="create-keterlambatan" class="block text-sm font-medium text-[#1E293B] mb-1.5">
                            Menit Keterlambatan
                            <span class="text-xs text-slate-400 font-normal">(isi 0 jika tepat waktu)</span>
                        </label>
                        <div class="relative">
                            <input type="number" id="create-keterlambatan" name="menit_keterlambatan"
                                value="{{ old('menit_keterlambatan', 0) }}" min="0"
                                class="w-full px-4 py-2.5 bg-white border border-[#E2E8F0] rounded-xl text-sm text-[#1E293B] focus:outline-none focus:ring-2 focus:ring-[#2563EB]/30 focus:border-[#2563EB] transition">
                            <span
                                class="absolute inset-y-0 right-0 flex items-center pr-4 text-sm text-slate-400">menit</span>
                        </div>
                    </div>

                    {{-- Keterangan --}}
                    <div>
                        <label for="create-keterangan"
                            class="block text-sm font-medium text-[#1E293B] mb-1.5">Keterangan</label>
                        <textarea id="create-keterangan" name="keterangan" rows="3" placeholder="Catatan tambahan (opsional)..."
                            class="w-full px-4 py-2.5 bg-white border border-[#E2E8F0] rounded-xl text-sm text-[#1E293B] placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-[#2563EB]/30 focus:border-[#2563EB] transition resize-none">{{ old('keterangan') }}</textarea>
                    </div>

                    <div class="flex items-center justify-end gap-2 pt-4 border-t border-[#E2E8F0]">
                        <button type="button"
                            class="btn-close-modal px-4 py-2.5 text-sm font-medium text-slate-600 hover:bg-slate-100 rounded-xl transition">Batal</button>
                        <button type="submit"
                            class="px-4 py-2.5 bg-[#2563EB] hover:bg-[#1D4ED8] text-white text-sm font-medium rounded-xl shadow-sm shadow-blue-600/20 transition">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- ============================================= --}}
    {{-- MODAL EDIT                                     --}}
    {{-- ============================================= --}}
    <div id="modal-edit" class="fixed inset-0 z-50 hidden">
        <div
            class="modal-backdrop fixed inset-0 bg-slate-900/60 backdrop-blur-sm opacity-0 transition-opacity duration-300">
        </div>
        <div class="flex min-h-full items-center justify-center p-4">
            <div
                class="modal-panel relative w-full max-w-2xl max-h-[90vh] transform overflow-hidden rounded-2xl bg-white shadow-2xl transition-all duration-300 scale-95 opacity-0 flex flex-col">

                <div class="flex items-center justify-between border-b border-[#E2E8F0] px-6 py-4 shrink-0">
                    <div class="flex items-center gap-2">
                        <div class="w-9 h-9 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-[#1E293B]">Edit Kehadiran</h3>
                    </div>
                    <button type="button"
                        class="btn-close-modal rounded-lg p-1.5 text-slate-400 hover:bg-slate-100 hover:text-slate-600 transition">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <form id="form-edit" action="" method="POST" class="px-6 py-5 space-y-4 overflow-y-auto"
                    novalidate>
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="edit-karyawan" class="block text-sm font-medium text-[#1E293B] mb-1.5">
                            Karyawan <span class="text-red-500">*</span>
                        </label>
                        <select id="edit-karyawan" name="karyawan_id"
                            class="w-full px-4 py-2.5 bg-white border border-[#E2E8F0] rounded-xl text-sm text-[#1E293B] focus:outline-none focus:ring-2 focus:ring-[#2563EB]/30 focus:border-[#2563EB] transition">
                            <option value="">-- Pilih Karyawan --</option>
                            @foreach ($karyawans as $k)
                                <option value="{{ $k->id }}">{{ $k->nama_karyawan }} ({{ $k->kode_karyawan }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="edit-tanggal" class="block text-sm font-medium text-[#1E293B] mb-1.5">
                                Tanggal Kehadiran <span class="text-red-500">*</span>
                            </label>
                            <input type="date" id="edit-tanggal" name="tanggal_kehadiran"
                                class="w-full px-4 py-2.5 bg-white border border-[#E2E8F0] rounded-xl text-sm text-[#1E293B] focus:outline-none focus:ring-2 focus:ring-[#2563EB]/30 focus:border-[#2563EB] transition">
                        </div>

                        <div>
                            <label for="edit-status" class="block text-sm font-medium text-[#1E293B] mb-1.5">
                                Status <span class="text-red-500">*</span>
                            </label>
                            <select id="edit-status" name="status"
                                class="w-full px-4 py-2.5 bg-white border border-[#E2E8F0] rounded-xl text-sm text-[#1E293B] focus:outline-none focus:ring-2 focus:ring-[#2563EB]/30 focus:border-[#2563EB] transition">
                                <option value="Hadir">Hadir</option>
                                <option value="Izin">Izin</option>
                                <option value="Sakit">Sakit</option>
                                <option value="Cuti">Cuti</option>
                                <option value="Alpha">Alpha</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="edit-jam-masuk" class="block text-sm font-medium text-[#1E293B] mb-1.5">Jam
                                Masuk</label>
                            <input type="time" id="edit-jam-masuk" name="jam_masuk"
                                class="w-full px-4 py-2.5 bg-white border border-[#E2E8F0] rounded-xl text-sm text-[#1E293B] focus:outline-none focus:ring-2 focus:ring-[#2563EB]/30 focus:border-[#2563EB] transition">
                        </div>

                        <div>
                            <label for="edit-jam-keluar" class="block text-sm font-medium text-[#1E293B] mb-1.5">Jam
                                Keluar</label>
                            <input type="time" id="edit-jam-keluar" name="jam_keluar"
                                class="w-full px-4 py-2.5 bg-white border border-[#E2E8F0] rounded-xl text-sm text-[#1E293B] focus:outline-none focus:ring-2 focus:ring-[#2563EB]/30 focus:border-[#2563EB] transition">
                        </div>
                    </div>

                    <div>
                        <label for="edit-keterlambatan" class="block text-sm font-medium text-[#1E293B] mb-1.5">Menit
                            Keterlambatan</label>
                        <div class="relative">
                            <input type="number" id="edit-keterlambatan" name="menit_keterlambatan" min="0"
                                class="w-full px-4 py-2.5 bg-white border border-[#E2E8F0] rounded-xl text-sm text-[#1E293B] focus:outline-none focus:ring-2 focus:ring-[#2563EB]/30 focus:border-[#2563EB] transition">
                            <span
                                class="absolute inset-y-0 right-0 flex items-center pr-4 text-sm text-slate-400">menit</span>
                        </div>
                    </div>

                    <div>
                        <label for="edit-keterangan"
                            class="block text-sm font-medium text-[#1E293B] mb-1.5">Keterangan</label>
                        <textarea id="edit-keterangan" name="keterangan" rows="3"
                            class="w-full px-4 py-2.5 bg-white border border-[#E2E8F0] rounded-xl text-sm text-[#1E293B] placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-[#2563EB]/30 focus:border-[#2563EB] transition resize-none"></textarea>
                    </div>

                    <div class="flex items-center justify-end gap-2 pt-4 border-t border-[#E2E8F0]">
                        <button type="button"
                            class="btn-close-modal px-4 py-2.5 text-sm font-medium text-slate-600 hover:bg-slate-100 rounded-xl transition">Batal</button>
                        <button type="submit"
                            class="px-4 py-2.5 bg-[#2563EB] hover:bg-[#1D4ED8] text-white text-sm font-medium rounded-xl shadow-sm shadow-blue-600/20 transition">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- ============================================= --}}
    {{-- MODAL DELETE                                   --}}
    {{-- ============================================= --}}
    <div id="modal-delete" class="fixed inset-0 z-50 hidden">
        <div
            class="modal-backdrop fixed inset-0 bg-slate-900/60 backdrop-blur-sm opacity-0 transition-opacity duration-300">
        </div>
        <div class="flex min-h-full items-center justify-center p-4">
            <div
                class="modal-panel relative w-full max-w-md transform overflow-hidden rounded-2xl bg-white shadow-2xl transition-all duration-300 scale-95 opacity-0">
                <div class="flex items-center justify-between border-b border-[#E2E8F0] px-6 py-4">
                    <h3 class="text-lg font-semibold text-[#1E293B]">Hapus Kehadiran</h3>
                    <button type="button"
                        class="btn-close-modal rounded-lg p-1.5 text-slate-400 hover:bg-slate-100 hover:text-slate-600 transition">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <form id="form-delete" action="" method="POST" class="px-6 py-5">
                    @csrf
                    @method('DELETE')
                    <div class="flex flex-col items-center text-center py-2">
                        <div class="w-14 h-14 rounded-2xl bg-red-50 text-red-500 flex items-center justify-center mb-4">
                            <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                            </svg>
                        </div>
                        <p class="text-sm text-slate-600 leading-relaxed">
                            Apakah Anda yakin ingin menghapus data kehadiran <strong id="delete-nama"></strong> pada
                            tanggal <strong id="delete-tanggal"></strong>?
                        </p>
                    </div>
                    <div class="flex items-center justify-end gap-2 pt-4 border-t border-[#E2E8F0]">
                        <button type="button"
                            class="btn-close-modal px-4 py-2.5 text-sm font-medium text-slate-600 hover:bg-slate-100 rounded-xl transition">Batal</button>
                        <button type="submit"
                            class="px-4 py-2.5 bg-red-500 hover:bg-red-600 text-white text-sm font-medium rounded-xl shadow-sm shadow-red-600/20 transition">Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Loading Overlay --}}
    <div id="loading-overlay"
        class="hidden fixed inset-0 z-[60] bg-white/70 backdrop-blur-sm flex items-center justify-center">
        <div class="flex flex-col items-center gap-3">
            <div class="w-10 h-10 border-4 border-[#E2E8F0] border-t-[#2563EB] rounded-full animate-spin"></div>
            <p class="text-sm font-medium text-[#1E293B]">Memproses...</p>
        </div>
    </div>

    {{-- Pagination Partial (reusable) --}}
    {{-- Note: Jika Anda ingin membuat file _pagination.blade.php terpisah, buat di resources/views/kehadiran/_pagination.blade.php --}}

    {{-- Inline JavaScript --}}
    <script>
        (function() {
            'use strict';

            let activeModal = null;

            const modalCreate = document.getElementById('modal-create');
            const modalEdit = document.getElementById('modal-edit');
            const modalDelete = document.getElementById('modal-delete');
            const formEdit = document.getElementById('form-edit');
            const formDelete = document.getElementById('form-delete');
            const loadingOverlay = document.getElementById('loading-overlay');
            const deleteNama = document.getElementById('delete-nama');
            const deleteTanggal = document.getElementById('delete-tanggal');

            // Edit form elements
            const editKaryawan = document.getElementById('edit-karyawan');
            const editTanggal = document.getElementById('edit-tanggal');
            const editJamMasuk = document.getElementById('edit-jam-masuk');
            const editJamKeluar = document.getElementById('edit-jam-keluar');
            const editStatus = document.getElementById('edit-status');
            const editKeterlambatan = document.getElementById('edit-keterlambatan');
            const editKeterangan = document.getElementById('edit-keterangan');

            // ============================================================
            // MODAL FUNCTIONS
            // ============================================================
            function openModal(modal) {
                if (!modal) return;
                modal.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
                requestAnimationFrame(() => {
                    modal.querySelector('.modal-backdrop')?.classList.remove('opacity-0');
                    const panel = modal.querySelector('.modal-panel');
                    panel?.classList.remove('scale-95', 'opacity-0');
                    panel?.classList.add('scale-100', 'opacity-100');
                });
                activeModal = modal;
            }

            function closeModal() {
                if (!activeModal) return;
                activeModal.querySelector('.modal-backdrop')?.classList.add('opacity-0');
                const panel = activeModal.querySelector('.modal-panel');
                panel?.classList.remove('scale-100', 'opacity-100');
                panel?.classList.add('scale-95', 'opacity-0');
                setTimeout(() => {
                    activeModal.classList.add('hidden');
                    document.body.style.overflow = '';
                    activeModal = null;
                }, 200);
            }

            function showLoading() {
                if (loadingOverlay) loadingOverlay.classList.remove('hidden');
            }

            // ============================================================
            // OPEN CREATE
            // ============================================================
            function openCreate() {
                const form = modalCreate.querySelector('form');
                if (form) form.reset();
                // Set default tanggal ke hari ini
                const tanggalInput = document.getElementById('create-tanggal');
                if (tanggalInput) tanggalInput.value = new Date().toISOString().split('T')[0];
                const keterlambatanInput = document.getElementById('create-keterlambatan');
                if (keterlambatanInput) keterlambatanInput.value = 0;
                openModal(modalCreate);
            }

            document.getElementById('btn-open-create')?.addEventListener('click', openCreate);
            document.getElementById('btn-open-create-empty')?.addEventListener('click', openCreate);
            document.getElementById('btn-open-create-empty-mobile')?.addEventListener('click', openCreate);

            // ============================================================
            // OPEN EDIT - Populate data
            // ============================================================
            document.querySelectorAll('.btn-edit').forEach(btn => {
                btn.addEventListener('click', function() {
                    if (editKaryawan) editKaryawan.value = this.dataset.karyawanId || '';
                    if (editTanggal) editTanggal.value = this.dataset.tanggal || '';
                    if (editJamMasuk) editJamMasuk.value = this.dataset.jamMasuk || '';
                    if (editJamKeluar) editJamKeluar.value = this.dataset.jamKeluar || '';
                    if (editStatus) editStatus.value = this.dataset.status || 'Hadir';
                    if (editKeterlambatan) editKeterlambatan.value = this.dataset.keterlambatan || 0;
                    if (editKeterangan) editKeterangan.value = this.dataset.keterangan || '';
                    if (formEdit) formEdit.action = this.dataset.action || '';
                    openModal(modalEdit);
                });
            });

            // ============================================================
            // OPEN DELETE
            // ============================================================
            document.querySelectorAll('.btn-delete').forEach(btn => {
                btn.addEventListener('click', function() {
                    if (formDelete) formDelete.action = this.dataset.action || '';
                    if (deleteNama) deleteNama.textContent = this.dataset.nama || '';
                    if (deleteTanggal) deleteTanggal.textContent = this.dataset.tanggal || '';
                    openModal(modalDelete);
                });
            });

            // ============================================================
            // CLOSE MODAL
            // ============================================================
            document.querySelectorAll('.btn-close-modal').forEach(btn => {
                btn.addEventListener('click', closeModal);
            });

            document.querySelectorAll('.modal-backdrop').forEach(b => {
                b.addEventListener('click', closeModal);
            });

            document.addEventListener('keydown', e => {
                if (e.key === 'Escape' && activeModal) closeModal();
            });

            // ============================================================
            // FORM SUBMIT - Show loading
            // ============================================================
            document.querySelectorAll('form').forEach(form => {
                form.addEventListener('submit', () => {
                    setTimeout(showLoading, 50);
                });
            });

            // ============================================================
            // AUTO REOPEN MODAL IF VALIDATION ERROR
            // ============================================================
            @if ($errors->any())
                @if (old('_method') === 'PUT')
                    openModal(modalEdit);
                @else
                    openModal(modalCreate);
                @endif
            @endif

        })();
    </script>

    <style>
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
@endsection
