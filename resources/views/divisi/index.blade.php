@extends('layouts.app')
@section('title', 'Divisi')

@section('content')
<div class="space-y-6">

    {{-- Page Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <nav class="flex items-center gap-2 text-sm text-slate-500 mb-2 flex-wrap">
                <a href="{{ route('dashboard') }}" class="hover:text-[#2563EB] transition">Dashboard</a>
                <svg class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                </svg>
                <span>Organization</span>
                <svg class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                </svg>
                <span class="text-[#1E293B] font-medium">Divisi</span>
            </nav>
            <h1 class="text-2xl lg:text-3xl font-bold text-[#1E293B]">Divisi</h1>
            <p class="text-slate-500 mt-1 text-sm lg:text-base">Kelola data divisi perusahaan Anda</p>
        </div>
    </div>

    {{-- Success Alert --}}
    @if(session('success'))
        <div class="flex items-start gap-3 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl" role="alert">
            <svg class="w-5 h-5 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span class="text-sm font-medium">{{ session('success') }}</span>
        </div>
    @endif

    {{-- Card Container --}}
    <div class="bg-white rounded-xl border border-[#E2E8F0] shadow-sm overflow-hidden">

        {{-- Top Actions --}}
        <div class="p-4 lg:p-5 border-b border-[#E2E8F0] flex flex-col gap-3">
            <div class="flex flex-col sm:flex-row gap-3 sm:items-center sm:justify-between w-full">
                <form action="{{ route('divisi.index') }}" method="GET" class="relative w-full sm:max-w-md">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                        </svg>
                    </span>
                    <input type="text"
                           name="search"
                           value="{{ request('search') }}"
                           placeholder="Cari divisi..."
                           class="w-full pl-10 pr-4 py-2.5 bg-[#F8FAFC] border border-[#E2E8F0] rounded-xl text-sm text-[#1E293B] placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-[#2563EB]/30 focus:border-[#2563EB] transition">
                </form>

                <button type="button"
                        id="btn-open-create"
                        class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-[#2563EB] hover:bg-[#1D4ED8] text-white text-sm font-medium rounded-xl shadow-sm shadow-blue-600/20 hover:shadow-md hover:shadow-blue-600/30 transition-all duration-200">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    <span>Tambah Divisi</span>
                </button>
            </div>
        </div>

        {{-- MOBILE VIEW: Card List (Visible only on mobile/tablet) --}}
        <div class="lg:hidden divide-y divide-[#E2E8F0]">
            @forelse($divisis as $index => $divisi)
                <div class="p-4 space-y-3">
                    <div class="flex items-start justify-between gap-3">
                        <div class="flex items-center gap-3 flex-1 min-w-0">
                            <div class="w-10 h-10 rounded-lg bg-blue-50 text-[#2563EB] flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" />
                                </svg>
                            </div>
                            <div class="min-w-0 flex-1">
                                <p class="font-semibold text-[#1E293B] truncate">{{ $divisi->nama_divisi }}</p>
                                <p class="text-xs text-slate-500">No. {{ $divisis->firstItem() + $index }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-slate-50 rounded-lg px-3 py-2.5">
                        <p class="text-xs text-slate-500 mb-1">Deskripsi</p>
                        <p class="text-sm text-slate-700 line-clamp-2">{{ $divisi->deskripsi ?? 'Tidak ada deskripsi' }}</p>
                    </div>

                    <div class="grid grid-cols-2 gap-2 pt-1">
                        <button type="button"
                                class="btn-edit inline-flex items-center justify-center gap-1.5 py-2.5 bg-amber-50 hover:bg-amber-100 text-amber-600 rounded-lg text-xs font-medium transition"
                                data-id="{{ $divisi->id }}"
                                data-nama="{{ $divisi->nama_divisi }}"
                                data-deskripsi="{{ $divisi->deskripsi }}"
                                data-action="{{ route('divisi.update', $divisi) }}">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                            </svg>
                            <span>Edit</span>
                        </button>

                        <button type="button"
                                class="btn-delete inline-flex items-center justify-center gap-1.5 py-2.5 bg-red-50 hover:bg-red-100 text-red-600 rounded-lg text-xs font-medium transition"
                                data-action="{{ route('divisi.destroy', $divisi) }}"
                                data-nama="{{ $divisi->nama_divisi }}">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                            </svg>
                            <span>Hapus</span>
                        </button>
                    </div>
                </div>
            @empty
                <div class="px-6 py-12 text-center">
                    <div class="w-16 h-16 rounded-2xl bg-slate-100 text-slate-400 flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" />
                        </svg>
                    </div>
                    <h3 class="text-base font-semibold text-[#1E293B] mb-1">Belum ada data divisi</h3>
                    <p class="text-sm text-slate-500 mb-4">Mulai tambahkan divisi pertama Anda</p>
                </div>
            @endforelse
        </div>

        {{-- DESKTOP VIEW: Table (Visible only on large screens) --}}
        <div class="hidden lg:block overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-[#F8FAFC] border-b border-[#E2E8F0]">
                    <tr>
                        <th class="px-6 py-3.5 text-left font-semibold text-[#1E293B] w-16">No</th>
                        <th class="px-6 py-3.5 text-left font-semibold text-[#1E293B]">Nama Divisi</th>
                        <th class="px-6 py-3.5 text-left font-semibold text-[#1E293B]">Deskripsi</th>
                        <th class="px-6 py-3.5 text-right font-semibold text-[#1E293B] w-40">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#E2E8F0]">
                    @forelse($divisis as $index => $divisi)
                        <tr class="hover:bg-[#F8FAFC] transition-colors duration-150">
                            <td class="px-6 py-4 text-slate-600 font-medium">
                                {{ $divisis->firstItem() + $index }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-lg bg-blue-50 text-[#2563EB] flex items-center justify-center shrink-0">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" />
                                        </svg>
                                    </div>
                                    <span class="font-medium text-[#1E293B]">{{ $divisi->nama_divisi }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-slate-600 max-w-xs">
                                <span class="line-clamp-2">{{ $divisi->deskripsi ?? '-' }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-end gap-2">
                                    <button type="button"
                                            class="btn-edit inline-flex items-center gap-1.5 px-3 py-1.5 bg-amber-50 hover:bg-amber-100 text-amber-600 hover:text-amber-700 text-xs font-medium rounded-lg border border-amber-200 transition-all duration-200"
                                            data-id="{{ $divisi->id }}"
                                            data-nama="{{ $divisi->nama_divisi }}"
                                            data-deskripsi="{{ $divisi->deskripsi }}"
                                            data-action="{{ route('divisi.update', $divisi) }}">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                        </svg>
                                        <span>Edit</span>
                                    </button>

                                    <button type="button"
                                            class="btn-delete inline-flex items-center gap-1.5 px-3 py-1.5 bg-red-50 hover:bg-red-100 text-red-600 hover:text-red-700 text-xs font-medium rounded-lg border border-red-200 transition-all duration-200"
                                            data-action="{{ route('divisi.destroy', $divisi) }}"
                                            data-nama="{{ $divisi->nama_divisi }}">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                        </svg>
                                        <span>Hapus</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-16 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="w-16 h-16 rounded-2xl bg-slate-100 text-slate-400 flex items-center justify-center mb-4">
                                        <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" />
                                        </svg>
                                    </div>
                                    <h3 class="text-base font-semibold text-[#1E293B] mb-1">Belum ada data divisi</h3>
                                    <p class="text-sm text-slate-500 mb-4">Mulai tambahkan divisi pertama Anda</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($divisis->hasPages())
            <div class="px-4 lg:px-6 py-4 border-t border-[#E2E8F0] flex flex-col sm:flex-row items-center justify-between gap-3 text-center sm:text-left">
                <p class="text-xs sm:text-sm text-slate-500">
                    Menampilkan <span class="font-medium text-[#1E293B]">{{ $divisis->firstItem() }}</span>
                    sampai <span class="font-medium text-[#1E293B]">{{ $divisis->lastItem() }}</span>
                    dari <span class="font-medium text-[#1E293B]">{{ $divisis->total() }}</span> data
                </p>
                <nav class="flex items-center gap-1 flex-wrap justify-center">
                    @if($divisis->onFirstPage())
                        <span class="px-3 py-1.5 text-sm text-slate-300 cursor-not-allowed">Prev</span>
                    @else
                        <a href="{{ $divisis->previousPageUrl() }}" class="px-3 py-1.5 text-sm text-slate-600 hover:bg-[#F8FAFC] rounded-lg transition">Prev</a>
                    @endif

                    @foreach($divisis->getUrlRange(1, $divisis->lastPage()) as $page => $url)
                        @if($page == $divisis->currentPage())
                            <span class="w-8 h-8 sm:w-9 sm:h-9 flex items-center justify-center text-sm font-medium bg-[#2563EB] text-white rounded-lg">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="w-8 h-8 sm:w-9 sm:h-9 flex items-center justify-center text-sm text-slate-600 hover:bg-[#F8FAFC] rounded-lg transition">{{ $page }}</a>
                        @endif
                    @endforeach

                    @if($divisis->hasMorePages())
                        <a href="{{ $divisis->nextPageUrl() }}" class="px-3 py-1.5 text-sm text-slate-600 hover:bg-[#F8FAFC] rounded-lg transition">Next</a>
                    @else
                        <span class="px-3 py-1.5 text-sm text-slate-300 cursor-not-allowed">Next</span>
                    @endif
                </nav>
            </div>
        @endif
    </div>
</div>

{{-- ============================================================ --}}
{{-- MODAL CREATE                                                  --}}
{{-- ============================================================ --}}
<div id="modal-create" class="fixed inset-0 z-50 hidden">
    <div class="modal-backdrop fixed inset-0 bg-slate-900/60 backdrop-blur-sm opacity-0 transition-opacity duration-300"></div>
    <div class="flex min-h-full items-center justify-center p-4">
        <div class="modal-panel relative w-full max-w-lg transform overflow-hidden rounded-2xl bg-white shadow-2xl transition-all duration-300 scale-95 opacity-0">

            <div class="flex items-center justify-between border-b border-[#E2E8F0] px-6 py-4">
                <h3 class="text-lg font-semibold text-[#1E293B]">Tambah Divisi</h3>
                <button type="button" class="btn-close-modal rounded-lg p-1.5 text-slate-400 hover:bg-slate-100 hover:text-slate-600 transition">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <form action="{{ route('divisi.store') }}" method="POST" class="px-6 py-5 space-y-4" novalidate>
                @csrf

                <div>
                    <label for="create-nama" class="block text-sm font-medium text-[#1E293B] mb-1.5">
                        Nama Divisi <span class="text-red-500">*</span>
                    </label>
                    <input type="text"
                           id="create-nama"
                           name="nama_divisi"
                           value="{{ old('nama_divisi') }}"
                           placeholder="Contoh: Human Resources"
                           class="w-full px-4 py-2.5 bg-white border border-[#E2E8F0] rounded-xl text-sm text-[#1E293B] placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-[#2563EB]/30 focus:border-[#2563EB] transition">
                    <p id="create-nama-error" class="hidden mt-1.5 text-xs text-red-500 flex items-center gap-1">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                        </svg>
                        <span>Nama Divisi wajib diisi.</span>
                    </p>
                    @error('nama_divisi')
                        <p class="mt-1.5 text-xs text-red-500 flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                            </svg>
                            <span>{{ $message }}</span>
                        </p>
                    @enderror
                </div>

                <div>
                    <label for="create-deskripsi" class="block text-sm font-medium text-[#1E293B] mb-1.5">Deskripsi</label>
                    <textarea id="create-deskripsi"
                              name="deskripsi"
                              rows="3"
                              placeholder="Deskripsi singkat tentang divisi..."
                              class="w-full px-4 py-2.5 bg-white border border-[#E2E8F0] rounded-xl text-sm text-[#1E293B] placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-[#2563EB]/30 focus:border-[#2563EB] transition resize-none">{{ old('deskripsi') }}</textarea>
                </div>

                <div class="flex flex-col sm:flex-row items-center justify-end gap-2 pt-4 border-t border-[#E2E8F0]">
                    <button type="button" class="btn-close-modal w-full sm:w-auto px-4 py-2.5 text-sm font-medium text-slate-600 hover:bg-slate-100 rounded-xl transition mb-2 sm:mb-0">
                        Batal
                    </button>
                    <button type="submit" class="w-full sm:w-auto px-4 py-2.5 bg-[#2563EB] hover:bg-[#1D4ED8] text-white text-sm font-medium rounded-xl shadow-sm shadow-blue-600/20 transition">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- ============================================================ --}}
{{-- MODAL EDIT                                                    --}}
{{-- ============================================================ --}}
<div id="modal-edit" class="fixed inset-0 z-50 hidden">
    <div class="modal-backdrop fixed inset-0 bg-slate-900/60 backdrop-blur-sm opacity-0 transition-opacity duration-300"></div>
    <div class="flex min-h-full items-center justify-center p-4">
        <div class="modal-panel relative w-full max-w-lg transform overflow-hidden rounded-2xl bg-white shadow-2xl transition-all duration-300 scale-95 opacity-0">

            <div class="flex items-center justify-between border-b border-[#E2E8F0] px-6 py-4">
                <h3 class="text-lg font-semibold text-[#1E293B]">Edit Divisi</h3>
                <button type="button" class="btn-close-modal rounded-lg p-1.5 text-slate-400 hover:bg-slate-100 hover:text-slate-600 transition">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <form id="form-edit" action="" method="POST" class="px-6 py-5 space-y-4" novalidate>
                @csrf
                @method('PUT')

                <div>
                    <label for="edit-nama" class="block text-sm font-medium text-[#1E293B] mb-1.5">
                        Nama Divisi <span class="text-red-500">*</span>
                    </label>
                    <input type="text"
                           id="edit-nama"
                           name="nama_divisi"
                           class="w-full px-4 py-2.5 bg-white border border-[#E2E8F0] rounded-xl text-sm text-[#1E293B] placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-[#2563EB]/30 focus:border-[#2563EB] transition">
                    <p id="edit-nama-error" class="hidden mt-1.5 text-xs text-red-500 flex items-center gap-1">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                        </svg>
                        <span>Nama Divisi wajib diisi.</span>
                    </p>
                </div>

                <div>
                    <label for="edit-deskripsi" class="block text-sm font-medium text-[#1E293B] mb-1.5">Deskripsi</label>
                    <textarea id="edit-deskripsi"
                              name="deskripsi"
                              rows="3"
                              class="w-full px-4 py-2.5 bg-white border border-[#E2E8F0] rounded-xl text-sm text-[#1E293B] placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-[#2563EB]/30 focus:border-[#2563EB] transition resize-none"></textarea>
                </div>

                <div class="flex flex-col sm:flex-row items-center justify-end gap-2 pt-4 border-t border-[#E2E8F0]">
                    <button type="button" class="btn-close-modal w-full sm:w-auto px-4 py-2.5 text-sm font-medium text-slate-600 hover:bg-slate-100 rounded-xl transition mb-2 sm:mb-0">
                        Batal
                    </button>
                    <button type="submit" class="w-full sm:w-auto px-4 py-2.5 bg-[#2563EB] hover:bg-[#1D4ED8] text-white text-sm font-medium rounded-xl shadow-sm shadow-blue-600/20 transition">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- ============================================================ --}}
{{-- MODAL DELETE                                                  --}}
{{-- ============================================================ --}}
<div id="modal-delete" class="fixed inset-0 z-50 hidden">
    <div class="modal-backdrop fixed inset-0 bg-slate-900/60 backdrop-blur-sm opacity-0 transition-opacity duration-300"></div>
    <div class="flex min-h-full items-center justify-center p-4">
        <div class="modal-panel relative w-full max-w-md transform overflow-hidden rounded-2xl bg-white shadow-2xl transition-all duration-300 scale-95 opacity-0">

            <div class="flex items-center justify-between border-b border-[#E2E8F0] px-6 py-4">
                <h3 class="text-lg font-semibold text-[#1E293B]">Hapus Divisi</h3>
                <button type="button" class="btn-close-modal rounded-lg p-1.5 text-slate-400 hover:bg-slate-100 hover:text-slate-600 transition">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <form id="form-delete" action="" method="POST" class="px-6 py-5">
                @csrf
                @method('DELETE')

                <div class="flex flex-col items-center text-center py-2">
                    <div class="w-14 h-14 rounded-2xl bg-red-50 text-red-500 flex items-center justify-center mb-4">
                        <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                        </svg>
                    </div>
                    <p class="text-sm text-slate-600 leading-relaxed">
                        Apakah Anda yakin ingin menghapus divisi <strong id="delete-nama" class="text-[#1E293B]"></strong>? Data yang dihapus tidak dapat dikembalikan.
                    </p>
                </div>

                <div class="flex flex-col sm:flex-row items-center justify-end gap-2 pt-4 border-t border-[#E2E8F0]">
                    <button type="button" class="btn-close-modal w-full sm:w-auto px-4 py-2.5 text-sm font-medium text-slate-600 hover:bg-slate-100 rounded-xl transition mb-2 sm:mb-0">
                        Batal
                    </button>
                    <button type="submit" class="w-full sm:w-auto px-4 py-2.5 bg-red-500 hover:bg-red-600 text-white text-sm font-medium rounded-xl shadow-sm shadow-red-600/20 transition">
                        Hapus
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- ============================================================ --}}
{{-- LOADING OVERLAY                                               --}}
{{-- ============================================================ --}}
<div id="loading-overlay" class="hidden fixed inset-0 z-[60] bg-white/70 backdrop-blur-sm flex items-center justify-center">
    <div class="flex flex-col items-center gap-3">
        <div class="w-10 h-10 border-4 border-[#E2E8F0] border-t-[#2563EB] rounded-full animate-spin"></div>
        <p class="text-sm font-medium text-[#1E293B]">Memproses...</p>
    </div>
</div>

{{-- ============================================================ --}}
{{-- INLINE JAVASCRIPT - VANILLA JS                                --}}
{{-- ============================================================ --}}
<script>
(function() {
    'use strict';

    // State
    let activeModal = null;

    // DOM Elements
    const modalCreate = document.getElementById('modal-create');
    const modalEdit = document.getElementById('modal-edit');
    const modalDelete = document.getElementById('modal-delete');
    const formEdit = document.getElementById('form-edit');
    const formDelete = document.getElementById('form-delete');
    const editNama = document.getElementById('edit-nama');
    const editDeskripsi = document.getElementById('edit-deskripsi');
    const editNamaError = document.getElementById('edit-nama-error');
    const createNama = document.getElementById('create-nama');
    const createNamaError = document.getElementById('create-nama-error');
    const deleteNama = document.getElementById('delete-nama');
    const loadingOverlay = document.getElementById('loading-overlay');

    // ============================================================
    // MODAL FUNCTIONS
    // ============================================================
    function openModal(modal) {
        if (!modal) return;
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';

        requestAnimationFrame(() => {
            const backdrop = modal.querySelector('.modal-backdrop');
            const panel = modal.querySelector('.modal-panel');
            if (backdrop) backdrop.classList.remove('opacity-0');
            if (panel) {
                panel.classList.remove('scale-95', 'opacity-0');
                panel.classList.add('scale-100', 'opacity-100');
            }
        });

        activeModal = modal;
    }

    function closeModal() {
        if (!activeModal) return;

        const backdrop = activeModal.querySelector('.modal-backdrop');
        const panel = activeModal.querySelector('.modal-panel');

        if (backdrop) backdrop.classList.add('opacity-0');
        if (panel) {
            panel.classList.remove('scale-100', 'opacity-100');
            panel.classList.add('scale-95', 'opacity-0');
        }

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
    // OPEN CREATE MODAL
    // ============================================================
    document.getElementById('btn-open-create')?.addEventListener('click', function() {
        // Reset form
        const form = modalCreate.querySelector('form');
        if (form) form.reset();
        createNama?.classList.remove('border-red-400', 'focus:ring-red-500/30', 'focus:border-red-500');
        createNamaError?.classList.add('hidden');
        openModal(modalCreate);
    });

    document.getElementById('btn-open-create-empty')?.addEventListener('click', function() {
        openModal(modalCreate);
    });

    // ============================================================
    // OPEN EDIT MODAL - Populate data from button
    // ============================================================
    document.querySelectorAll('.btn-edit').forEach(function(btn) {
        btn.addEventListener('click', function() {
            const nama = this.dataset.nama || '';
            const deskripsi = this.dataset.deskripsi || '';
            const action = this.dataset.action || '';

            if (editNama) editNama.value = nama;
            if (editDeskripsi) editDeskripsi.value = deskripsi;
            if (formEdit) formEdit.action = action;

            // Reset error state
            editNama?.classList.remove('border-red-400', 'focus:ring-red-500/30', 'focus:border-red-500');
            editNamaError?.classList.add('hidden');

            openModal(modalEdit);
        });
    });

    // ============================================================
    // OPEN DELETE MODAL - Set action URL & Name
    // ============================================================
    document.querySelectorAll('.btn-delete').forEach(function(btn) {
        btn.addEventListener('click', function() {
            const action = this.dataset.action || '';
            const nama = this.dataset.nama || '';
            if (formDelete) formDelete.action = action;
            if (deleteNama) deleteNama.textContent = nama;
            openModal(modalDelete);
        });
    });

    // ============================================================
    // CLOSE MODAL - All close triggers
    // ============================================================
    document.querySelectorAll('.btn-close-modal').forEach(function(btn) {
        btn.addEventListener('click', closeModal);
    });

    // Close on backdrop click
    document.querySelectorAll('.modal-backdrop').forEach(function(backdrop) {
        backdrop.addEventListener('click', closeModal);
    });

    // Close on ESC key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && activeModal) {
            closeModal();
        }
    });

    // ============================================================
    // FORM VALIDATION - Create
    // ============================================================
    if (modalCreate) {
        const form = modalCreate.querySelector('form');
        form?.addEventListener('submit', function(e) {
            const nama = createNama?.value.trim();
            if (!nama) {
                e.preventDefault();
                createNama?.classList.add('border-red-400', 'focus:ring-red-500/30', 'focus:border-red-500');
                createNamaError?.classList.remove('hidden');
                createNama?.focus();
                return false;
            }
            showLoading();
        });

        // Clear error on input
        createNama?.addEventListener('input', function() {
            if (this.value.trim()) {
                this.classList.remove('border-red-400', 'focus:ring-red-500/30', 'focus:border-red-500');
                createNamaError?.classList.add('hidden');
            }
        });
    }

    // ============================================================
    // FORM VALIDATION - Edit
    // ============================================================
    if (formEdit) {
        formEdit.addEventListener('submit', function(e) {
            const nama = editNama?.value.trim();
            if (!nama) {
                e.preventDefault();
                editNama?.classList.add('border-red-400', 'focus:ring-red-500/30', 'focus:border-red-500');
                editNamaError?.classList.remove('hidden');
                editNama?.focus();
                return false;
            }
            showLoading();
        });

        // Clear error on input
        editNama?.addEventListener('input', function() {
            if (this.value.trim()) {
                this.classList.remove('border-red-400', 'focus:ring-red-500/30', 'focus:border-red-500');
                editNamaError?.classList.add('hidden');
            }
        });
    }

    // ============================================================
    // FORM SUBMIT - Delete (show loading)
    // ============================================================
    if (formDelete) {
        formDelete.addEventListener('submit', function() {
            showLoading();
        });
    }

    // ============================================================
    // AUTO OPEN MODAL IF VALIDATION ERROR EXISTS (Laravel)
    // ============================================================
    @if($errors->has('nama_divisi') || $errors->has('deskripsi'))
        @if(old('_method') === 'PUT')
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
