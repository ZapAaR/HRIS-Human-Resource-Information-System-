@extends('layouts.app')
@section('title', 'Karyawan')

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
                    <span>Organization</span>
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                    </svg>
                    <span class="text-[#1E293B] font-medium">Karyawan</span>
                </nav>
                <h1 class="text-2xl lg:text-3xl font-bold text-[#1E293B]">Karyawan</h1>
                <p class="text-slate-500 mt-1">Kelola data karyawan perusahaan</p>
            </div>
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

        <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">

            {{-- Status --}}
            <select name="status" class="rounded-lg border-slate-300">

                <option value="">Semua Status</option>

                <option value="Aktif" @selected(request('status') == 'Aktif')>
                    Aktif
                </option>

                <option value="Tidak Aktif" @selected(request('status') == 'Tidak Aktif')>
                    Tidak Aktif
                </option>

            </select>

            {{-- Divisi --}}
            <select name="divisi_id" class="rounded-lg border-slate-300">

                <option value="">Semua Divisi</option>

                @foreach ($divisis as $divisi)
                    <option value="{{ $divisi->id }}" @selected(request('divisi_id') == $divisi->id)>
                        {{ $divisi->nama_divisi }}
                    </option>
                @endforeach

            </select>

            {{-- Posisi --}}
            <select name="posisi_id" class="rounded-lg border-slate-300">

                <option value="">Semua Posisi</option>

                @foreach ($posisis as $posisi)
                    <option value="{{ $posisi->id }}" @selected(request('posisi_id') == $posisi->id)>
                        {{ $posisi->nama_posisi }}
                    </option>
                @endforeach

            </select>

             {{-- Jenis Kelamin --}}
            <select name="jenis_kelamin" class="rounded-lg border-slate-300">

                <option value="">Semua Jenis Kelamin</option>

                <option value="Laki-laki" @selected(request('jenis_kelamin') == 'Laki-laki')>
                    Laki-laki
                </option>

                <option value="Perempuan" @selected(request('jenis_kelamin') == 'Perempuan')>
                    Perempuan
                </option>

            </select>

            <div class="md:col-span-4 flex gap-2">

                <button class="px-5 py-2 bg-blue-600 text-white rounded-lg">
                    Filter
                </button>

                <a href="{{ route('karyawan.index') }}" class="px-5 py-2 bg-slate-200 rounded-lg">
                    Reset
                </a>

            </div>

        </form>

        {{-- Card Container --}}
        <div class="bg-white rounded-xl border border-[#E2E8F0] shadow-sm overflow-hidden">

            {{-- Top Actions --}}
            <div
                class="p-4 lg:p-5 border-b border-[#E2E8F0] flex flex-col sm:flex-row gap-3 sm:items-center sm:justify-between">
                <form action="{{ route('karyawan.index') }}" method="GET" class="relative flex-1 max-w-md">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                        </svg>
                    </span>
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari nama, kode, NIK, email..."
                        class="w-full pl-10 pr-4 py-2.5 bg-[#F8FAFC] border border-[#E2E8F0] rounded-xl text-sm text-[#1E293B] placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-[#2563EB]/30 focus:border-[#2563EB] transition">
                </form>

                <a href="{{ route('karyawan.create') }}"
                    class="inline-flex items-center gap-2 px-4 py-2.5 bg-[#2563EB] hover:bg-[#1D4ED8] text-white text-sm font-medium rounded-xl shadow-sm shadow-blue-600/20 hover:shadow-md hover:shadow-blue-600/30 transition-all duration-200">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    <span>Tambah Karyawan</span>
                </a>
            </div>

            {{-- Table --}}
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-[#F8FAFC] border-b border-[#E2E8F0]">
                        <tr>
                            <th class="px-4 lg:px-6 py-3.5 text-left font-semibold text-[#1E293B] w-16">No</th>
                            <th class="px-4 lg:px-6 py-3.5 text-left font-semibold text-[#1E293B]">Karyawan</th>
                            <th class="px-4 lg:px-6 py-3.5 text-left font-semibold text-[#1E293B]">Divisi</th>
                            <th class="px-4 lg:px-6 py-3.5 text-left font-semibold text-[#1E293B]">Posisi</th>
                            <th class="px-4 lg:px-6 py-3.5 text-left font-semibold text-[#1E293B]">Status</th>
                            <th class="px-4 lg:px-6 py-3.5 text-right font-semibold text-[#1E293B] w-56">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#E2E8F0]">
                        @forelse($karyawans as $index => $karyawan)
                            <tr class="hover:bg-[#F8FAFC] transition-colors duration-150">
                                <td class="px-4 lg:px-6 py-4 text-slate-600 font-medium">
                                    {{ $karyawans->firstItem() + $index }}
                                </td>
                                <td class="px-4 lg:px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 text-white flex items-center justify-center font-semibold text-sm shrink-0 overflow-hidden">
                                            @if ($karyawan->foto)
                                                <img src="{{ asset('storage/' . $karyawan->foto) }}"
                                                    alt="{{ $karyawan->nama_karyawan }}"
                                                    class="w-full h-full object-cover">
                                            @else
                                                {{ substr($karyawan->nama_karyawan, 0, 1) }}
                                            @endif
                                        </div>
                                        <div class="min-w-0">
                                            <p class="font-medium text-[#1E293B] truncate">{{ $karyawan->nama_karyawan }}
                                            </p>
                                            <p class="text-xs text-slate-500 truncate">{{ $karyawan->email }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 lg:px-6 py-4 text-slate-600">{{ $karyawan->divisi->nama_divisi ?? '-' }}
                                </td>
                                <td class="px-4 lg:px-6 py-4 text-slate-600">{{ $karyawan->posisi->nama_posisi ?? '-' }}
                                </td>
                                <td class="px-4 lg:px-6 py-4">
                                    @php
                                        $statusColors = [
                                            'Aktif' => 'bg-green-50 text-green-700 border-green-200',
                                            'Tidak Aktif' => 'bg-red-50 text-red-700 border-red-200',
                                        ];
                                        $statusColor =
                                            $statusColors[$karyawan->status] ??
                                            'bg-slate-50 text-slate-700 border-slate-200';
                                    @endphp
                                    <span
                                        class="inline-flex items-center px-2.5 py-1 text-xs font-medium rounded-lg border {{ $statusColor }}">
                                        {{ $karyawan->status }}
                                    </span>
                                </td>
                                <td class="px-4 lg:px-6 py-4">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('karyawan.show', $karyawan) }}"
                                            class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-blue-50 hover:bg-blue-100 text-blue-600 hover:text-blue-700 text-xs font-medium rounded-lg border border-blue-200 transition-all duration-200">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                            <span>Show</span>
                                        </a>

                                        <a href="{{ route('karyawan.edit', $karyawan) }}"
                                            class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-amber-50 hover:bg-amber-100 text-amber-600 hover:text-amber-700 text-xs font-medium rounded-lg border border-amber-200 transition-all duration-200">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                            </svg>
                                            <span>Edit</span>
                                        </a>

                                        <button type="button"
                                            class="btn-delete inline-flex items-center gap-1.5 px-3 py-1.5 bg-red-50 hover:bg-red-100 text-red-600 hover:text-red-700 text-xs font-medium rounded-lg border border-red-200 transition-all duration-200"
                                            data-action="{{ route('karyawan.destroy', $karyawan) }}"
                                            data-nama="{{ $karyawan->nama_karyawan }}">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                            </svg>
                                            <span>Hapus</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-16 text-center">
                                    <div class="flex flex-col items-center">
                                        <div
                                            class="w-16 h-16 rounded-2xl bg-slate-100 text-slate-400 flex items-center justify-center mb-4">
                                            <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                                            </svg>
                                        </div>
                                        <h3 class="text-base font-semibold text-[#1E293B] mb-1">Belum ada data karyawan
                                        </h3>
                                        <p class="text-sm text-slate-500 mb-4">Mulai tambahkan karyawan pertama Anda</p>
                                        <a href="{{ route('karyawan.create') }}"
                                            class="inline-flex items-center gap-2 px-4 py-2 bg-[#2563EB] hover:bg-[#1D4ED8] text-white text-sm font-medium rounded-xl transition">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M12 4.5v15m7.5-7.5h-15" />
                                            </svg>
                                            <span>Tambah Karyawan</span>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if ($karyawans->hasPages())
                <div
                    class="px-4 lg:px-6 py-4 border-t border-[#E2E8F0] flex flex-col sm:flex-row items-center justify-between gap-3">
                    <p class="text-sm text-slate-500">
                        Menampilkan <span class="font-medium text-[#1E293B]">{{ $karyawans->firstItem() }}</span>
                        sampai <span class="font-medium text-[#1E293B]">{{ $karyawans->lastItem() }}</span>
                        dari <span class="font-medium text-[#1E293B]">{{ $karyawans->total() }}</span> data
                    </p>
                    <nav class="flex items-center gap-1">
                        @if ($karyawans->onFirstPage())
                            <span class="px-3 py-1.5 text-sm text-slate-300 cursor-not-allowed">Previous</span>
                        @else
                            <a href="{{ $karyawans->previousPageUrl() }}"
                                class="px-3 py-1.5 text-sm text-slate-600 hover:bg-[#F8FAFC] rounded-lg transition">Previous</a>
                        @endif

                        @foreach ($karyawans->getUrlRange(1, $karyawans->lastPage()) as $page => $url)
                            @if ($page == $karyawans->currentPage())
                                <span
                                    class="w-9 h-9 flex items-center justify-center text-sm font-medium bg-[#2563EB] text-white rounded-lg">{{ $page }}</span>
                            @else
                                <a href="{{ $url }}"
                                    class="w-9 h-9 flex items-center justify-center text-sm text-slate-600 hover:bg-[#F8FAFC] rounded-lg transition">{{ $page }}</a>
                            @endif
                        @endforeach

                        @if ($karyawans->hasMorePages())
                            <a href="{{ $karyawans->nextPageUrl() }}"
                                class="px-3 py-1.5 text-sm text-slate-600 hover:bg-[#F8FAFC] rounded-lg transition">Next</a>
                        @else
                            <span class="px-3 py-1.5 text-sm text-slate-300 cursor-not-allowed">Next</span>
                        @endif
                    </nav>
                </div>
            @endif
        </div>
    </div>

    {{-- Modal Delete --}}
    <div id="modal-delete" class="fixed inset-0 z-50 hidden">
        <div
            class="modal-backdrop fixed inset-0 bg-slate-900/60 backdrop-blur-sm opacity-0 transition-opacity duration-300">
        </div>
        <div class="flex min-h-full items-center justify-center p-4">
            <div
                class="modal-panel relative w-full max-w-md transform overflow-hidden rounded-2xl bg-white shadow-2xl transition-all duration-300 scale-95 opacity-0">
                <div class="flex items-center justify-between border-b border-[#E2E8F0] px-6 py-4">
                    <h3 class="text-lg font-semibold text-[#1E293B]">Hapus Karyawan</h3>
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
                            Apakah Anda yakin ingin menghapus karyawan ini? Data yang dihapus tidak dapat dikembalikan.
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

    <script>
        (function() {
            'use strict';
            let activeModal = null;
            const modalDelete = document.getElementById('modal-delete');
            const formDelete = document.getElementById('form-delete');

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

            document.querySelectorAll('.btn-delete').forEach(btn => {
                btn.addEventListener('click', function() {
                    if (formDelete) formDelete.action = this.dataset.action;
                    openModal(modalDelete);
                });
            });

            document.querySelectorAll('.btn-close-modal').forEach(btn => {
                btn.addEventListener('click', closeModal);
            });

            document.querySelectorAll('.modal-backdrop').forEach(b => {
                b.addEventListener('click', closeModal);
            });

            document.addEventListener('keydown', e => {
                if (e.key === 'Escape' && activeModal) closeModal();
            });

            formDelete?.addEventListener('submit', () => {
                document.body.insertAdjacentHTML('beforeend',
                    '<div id="loading-overlay" class="fixed inset-0 z-[60] bg-white/70 backdrop-blur-sm flex items-center justify-center"><div class="flex flex-col items-center gap-3"><div class="w-10 h-10 border-4 border-[#E2E8F0] border-t-[#2563EB] rounded-full animate-spin"></div><p class="text-sm font-medium text-[#1E293B]">Memproses...</p></div></div>'
                    );
            });
        })();
    </script>
@endsection
