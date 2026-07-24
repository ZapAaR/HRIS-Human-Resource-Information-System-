@extends('layouts.app')
@section('title', 'Edit Karyawan')

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
            <span class="text-[#1E293B] font-medium">Edit</span>
        </nav>
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl lg:text-3xl font-bold text-[#1E293B]">Edit Karyawan</h1>
                <p class="text-slate-500 mt-1">Perbarui data {{ $karyawan->nama_karyawan }}</p>
            </div>
            <a href="{{ route('karyawan.index') }}" class="inline-flex items-center gap-2 px-4 py-2.5 text-sm font-medium text-slate-600 hover:bg-slate-100 rounded-xl transition">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
                <span>Kembali</span>
            </a>
        </div>
    </div>

    {{-- Form --}}
    <form action="{{ route('karyawan.update', $karyawan) }}" method="POST" enctype="multipart/form-data" class="space-y-6" novalidate>
        @csrf
        @method('PUT')

        {{-- Informasi Dasar --}}
        <div class="bg-white rounded-xl border border-[#E2E8F0] shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-[#E2E8F0] bg-[#F8FAFC]">
                <h2 class="text-base font-semibold text-[#1E293B]">Informasi Dasar</h2>
                <p class="text-sm text-slate-500 mt-0.5">Data identitas karyawan</p>
            </div>
            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-5">

                <div class="md:col-span-2">
                    <label for="user_id" class="block text-sm font-medium text-[#1E293B] mb-1.5">
                        User <span class="text-red-500">*</span>
                    </label>
                    <select id="user_id" name="user_id" class="w-full px-4 py-2.5 bg-white border border-[#E2E8F0] rounded-xl text-sm text-[#1E293B] focus:outline-none focus:ring-2 focus:ring-[#2563EB]/30 focus:border-[#2563EB] transition @error('user_id') border-red-400 @enderror">
                        <option value="">-- Pilih User --</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ old('user_id', $karyawan->user_id) == $user->id ? 'selected' : '' }}>{{ $user->name }} ({{ $user->email }})</option>
                        @endforeach
                    </select>
                    @error('user_id')
                        <p class="mt-1.5 text-xs text-red-500 flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" /></svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div>
                    <label for="kode_karyawan" class="block text-sm font-medium text-[#1E293B] mb-1.5">
                        Kode Karyawan <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="kode_karyawan" name="kode_karyawan" value="{{ old('kode_karyawan', $karyawan->kode_karyawan) }}" class="w-full px-4 py-2.5 bg-white border border-[#E2E8F0] rounded-xl text-sm text-[#1E293B] focus:outline-none focus:ring-2 focus:ring-[#2563EB]/30 focus:border-[#2563EB] transition @error('kode_karyawan') border-red-400 @enderror">
                    @error('kode_karyawan')
                        <p class="mt-1.5 text-xs text-red-500 flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" /></svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div>
                    <label for="nik" class="block text-sm font-medium text-[#1E293B] mb-1.5">
                        NIK <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="nik" name="nik" value="{{ old('nik', $karyawan->nik) }}" class="w-full px-4 py-2.5 bg-white border border-[#E2E8F0] rounded-xl text-sm text-[#1E293B] focus:outline-none focus:ring-2 focus:ring-[#2563EB]/30 focus:border-[#2563EB] transition @error('nik') border-red-400 @enderror">
                    @error('nik')
                        <p class="mt-1.5 text-xs text-red-500 flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" /></svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="md:col-span-2">
                    <label for="nama_karyawan" class="block text-sm font-medium text-[#1E293B] mb-1.5">
                        Nama Karyawan <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="nama_karyawan" name="nama_karyawan" value="{{ old('nama_karyawan', $karyawan->nama_karyawan) }}" class="w-full px-4 py-2.5 bg-white border border-[#E2E8F0] rounded-xl text-sm text-[#1E293B] focus:outline-none focus:ring-2 focus:ring-[#2563EB]/30 focus:border-[#2563EB] transition @error('nama_karyawan') border-red-400 @enderror">
                    @error('nama_karyawan')
                        <p class="mt-1.5 text-xs text-red-500 flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" /></svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-[#1E293B] mb-1.5">
                        Jenis Kelamin <span class="text-red-500">*</span>
                    </label>
                    <div class="flex items-center gap-4">
                        <label class="inline-flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="jenis_kelamin" value="Laki-laki" {{ old('jenis_kelamin', $karyawan->jenis_kelamin) == 'Laki-laki' ? 'checked' : '' }} class="w-4 h-4 text-[#2563EB] border-slate-300 focus:ring-[#2563EB]">
                            <span class="text-sm text-[#1E293B]">Laki-laki</span>
                        </label>
                        <label class="inline-flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="jenis_kelamin" value="Perempuan" {{ old('jenis_kelamin', $karyawan->jenis_kelamin) == 'Perempuan' ? 'checked' : '' }} class="w-4 h-4 text-[#2563EB] border-slate-300 focus:ring-[#2563EB]">
                            <span class="text-sm text-[#1E293B]">Perempuan</span>
                        </label>
                    </div>
                    @error('jenis_kelamin')
                        <p class="mt-1.5 text-xs text-red-500 flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" /></svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div>
                    <label for="tanggal_lahir" class="block text-sm font-medium text-[#1E293B] mb-1.5">
                        Tanggal Lahir <span class="text-red-500">*</span>
                    </label>
                    <input type="date" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir', $karyawan->tanggal_lahir->format('Y-m-d')) }}" class="w-full px-4 py-2.5 bg-white border border-[#E2E8F0] rounded-xl text-sm text-[#1E293B] focus:outline-none focus:ring-2 focus:ring-[#2563EB]/30 focus:border-[#2563EB] transition @error('tanggal_lahir') border-red-400 @enderror">
                    @error('tanggal_lahir')
                        <p class="mt-1.5 text-xs text-red-500 flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" /></svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>
            </div>
        </div>

        {{-- Informasi Kontak --}}
        <div class="bg-white rounded-xl border border-[#E2E8F0] shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-[#E2E8F0] bg-[#F8FAFC]">
                <h2 class="text-base font-semibold text-[#1E293B]">Informasi Kontak</h2>
                <p class="text-sm text-slate-500 mt-0.5">Data kontak dan alamat</p>
            </div>
            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-5">

                <div>
                    <label for="email" class="block text-sm font-medium text-[#1E293B] mb-1.5">
                        Email <span class="text-red-500">*</span>
                    </label>
                    <input type="email" id="email" name="email" value="{{ old('email', $karyawan->email) }}" class="w-full px-4 py-2.5 bg-white border border-[#E2E8F0] rounded-xl text-sm text-[#1E293B] focus:outline-none focus:ring-2 focus:ring-[#2563EB]/30 focus:border-[#2563EB] transition @error('email') border-red-400 @enderror">
                    @error('email')
                        <p class="mt-1.5 text-xs text-red-500 flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" /></svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div>
                    <label for="no_telepon" class="block text-sm font-medium text-[#1E293B] mb-1.5">No Telepon</label>
                    <input type="text" id="no_telepon" name="no_telepon" value="{{ old('no_telepon', $karyawan->no_telepon) }}" class="w-full px-4 py-2.5 bg-white border border-[#E2E8F0] rounded-xl text-sm text-[#1E293B] focus:outline-none focus:ring-2 focus:ring-[#2563EB]/30 focus:border-[#2563EB] transition @error('no_telepon') border-red-400 @enderror">
                    @error('no_telepon')
                        <p class="mt-1.5 text-xs text-red-500 flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" /></svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="md:col-span-2">
                    <label for="alamat" class="block text-sm font-medium text-[#1E293B] mb-1.5">Alamat</label>
                    <textarea id="alamat" name="alamat" rows="3" class="w-full px-4 py-2.5 bg-white border border-[#E2E8F0] rounded-xl text-sm text-[#1E293B] focus:outline-none focus:ring-2 focus:ring-[#2563EB]/30 focus:border-[#2563EB] transition resize-none @error('alamat') border-red-400 @enderror">{{ old('alamat', $karyawan->alamat) }}</textarea>
                    @error('alamat')
                        <p class="mt-1.5 text-xs text-red-500 flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" /></svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>
            </div>
        </div>

        {{-- Informasi Pekerjaan --}}
        <div class="bg-white rounded-xl border border-[#E2E8F0] shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-[#E2E8F0] bg-[#F8FAFC]">
                <h2 class="text-base font-semibold text-[#1E293B]">Informasi Pekerjaan</h2>
                <p class="text-sm text-slate-500 mt-0.5">Data posisi dan divisi</p>
            </div>
            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-5">

                <div>
                    <label for="divisi_id" class="block text-sm font-medium text-[#1E293B] mb-1.5">
                        Divisi <span class="text-red-500">*</span>
                    </label>
                    <select id="divisi_id" name="divisi_id" class="w-full px-4 py-2.5 bg-white border border-[#E2E8F0] rounded-xl text-sm text-[#1E293B] focus:outline-none focus:ring-2 focus:ring-[#2563EB]/30 focus:border-[#2563EB] transition @error('divisi_id') border-red-400 @enderror">
                        <option value="">-- Pilih Divisi --</option>
                        @foreach($divisis as $divisi)
                            <option value="{{ $divisi->id }}" {{ old('divisi_id', $karyawan->divisi_id) == $divisi->id ? 'selected' : '' }}>{{ $divisi->nama_divisi }}</option>
                        @endforeach
                    </select>
                    @error('divisi_id')
                        <p class="mt-1.5 text-xs text-red-500 flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" /></svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div>
                    <label for="posisi_id" class="block text-sm font-medium text-[#1E293B] mb-1.5">
                        Posisi <span class="text-red-500">*</span>
                    </label>
                    <select id="posisi_id" name="posisi_id" class="w-full px-4 py-2.5 bg-white border border-[#E2E8F0] rounded-xl text-sm text-[#1E293B] focus:outline-none focus:ring-2 focus:ring-[#2563EB]/30 focus:border-[#2563EB] transition @error('posisi_id') border-red-400 @enderror">
                        <option value="">-- Pilih Posisi --</option>
                        @foreach($posisis as $posisi)
                            <option value="{{ $posisi->id }}" {{ old('posisi_id', $karyawan->posisi_id) == $posisi->id ? 'selected' : '' }}>
                                {{ $posisi->nama_posisi }} ({{ $posisi->divisi->nama_divisi ?? '-' }})
                            </option>
                        @endforeach
                    </select>
                    @error('posisi_id')
                        <p class="mt-1.5 text-xs text-red-500 flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" /></svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div>
                    <label for="tanggal_masuk" class="block text-sm font-medium text-[#1E293B] mb-1.5">
                        Tanggal Masuk <span class="text-red-500">*</span>
                    </label>
                    <input type="date" id="tanggal_masuk" name="tanggal_masuk" value="{{ old('tanggal_masuk', $karyawan->tanggal_masuk->format('Y-m-d')) }}" class="w-full px-4 py-2.5 bg-white border border-[#E2E8F0] rounded-xl text-sm text-[#1E293B] focus:outline-none focus:ring-2 focus:ring-[#2563EB]/30 focus:border-[#2563EB] transition @error('tanggal_masuk') border-red-400 @enderror">
                    @error('tanggal_masuk')
                        <p class="mt-1.5 text-xs text-red-500 flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" /></svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div>
                    <label for="gaji_pokok" class="block text-sm font-medium text-[#1E293B] mb-1.5">
                        Gaji Pokok <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-500 text-sm">Rp</span>
                        <input type="number" id="gaji_pokok" name="gaji_pokok" value="{{ old('gaji_pokok', $karyawan->gaji_pokok) }}" step="0.01" min="0" class="w-full pl-12 pr-4 py-2.5 bg-white border border-[#E2E8F0] rounded-xl text-sm text-[#1E293B] focus:outline-none focus:ring-2 focus:ring-[#2563EB]/30 focus:border-[#2563EB] transition @error('gaji_pokok') border-red-400 @enderror">
                    </div>
                    @error('gaji_pokok')
                        <p class="mt-1.5 text-xs text-red-500 flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" /></svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div>
                    <label for="status" class="block text-sm font-medium text-[#1E293B] mb-1.5">
                        Status <span class="text-red-500">*</span>
                    </label>
                    <select id="status" name="status" class="w-full px-4 py-2.5 bg-white border border-[#E2E8F0] rounded-xl text-sm text-[#1E293B] focus:outline-none focus:ring-2 focus:ring-[#2563EB]/30 focus:border-[#2563EB] transition @error('status') border-red-400 @enderror">
                        <option value="Aktif" {{ old('status', $karyawan->status) == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="Tidak Aktif" {{ old('status', $karyawan->status) == 'Tidak Aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                    </select>
                    @error('status')
                        <p class="mt-1.5 text-xs text-red-500 flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" /></svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>
            </div>
        </div>

        {{-- Foto --}}
        <div class="bg-white rounded-xl border border-[#E2E8F0] shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-[#E2E8F0] bg-[#F8FAFC]">
                <h2 class="text-base font-semibold text-[#1E293B]">Foto Profil</h2>
                <p class="text-sm text-slate-500 mt-0.5">Upload foto karyawan (opsional)</p>
            </div>
            <div class="p-6">
                <div>
                    <label for="foto" class="block text-sm font-medium text-[#1E293B] mb-1.5">Foto</label>
                    <div class="flex items-center gap-4">
                        <div id="foto-preview" class="w-20 h-20 rounded-xl bg-slate-100 border-2 border-dashed border-slate-300 flex items-center justify-center overflow-hidden">
                            @if($karyawan->foto)
                                <img src="{{ asset('storage/karyawan/' . $karyawan->foto) }}" class="w-full h-full object-cover">
                            @else
                                <svg class="w-8 h-8 text-slate-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                </svg>
                            @endif
                        </div>
                        <div class="flex-1">
                            <input type="file" id="foto" name="foto" accept="image/*" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition">
                            <p class="text-xs text-slate-500 mt-1">JPG, PNG, maksimal 2MB. Kosongkan jika tidak ingin mengubah foto.</p>
                        </div>
                    </div>
                    @error('foto')
                        <p class="mt-1.5 text-xs text-red-500 flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" /></svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>
            </div>
        </div>

        {{-- Action Buttons --}}
        <div class="flex items-center justify-end gap-3">
            <a href="{{ route('karyawan.index') }}" class="px-4 py-2.5 text-sm font-medium text-slate-600 hover:bg-slate-100 rounded-xl transition">
                Batal
            </a>
            <button type="submit" class="px-6 py-2.5 bg-[#2563EB] hover:bg-[#1D4ED8] text-white text-sm font-medium rounded-xl shadow-sm shadow-blue-600/20 transition">
                Update
            </button>
        </div>
    </form>
</div>

<script>
document.getElementById('foto')?.addEventListener('change', function(e) {
    const file = e.target.files[0];
    const preview = document.getElementById('foto-preview');
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.innerHTML = '<img src="' + e.target.result + '" class="w-full h-full object-cover">';
        };
        reader.readAsDataURL(file);
    }
});

const divisi = document.getElementById('divisi_id');
const posisi = document.getElementById('posisi_id');

divisi.addEventListener('change', function () {

    posisi.innerHTML = '<option>Loading...</option>';

    fetch(`/divisi/${this.value}/posisi`)
        .then(response => response.json())
        .then(data => {

            posisi.innerHTML = '<option value="">-- Pilih Posisi --</option>';

            data.forEach(item => {

                posisi.innerHTML += `
                    <option value="${item.id}">
                        ${item.nama_posisi}
                    </option>`;

            });

        });

});
</script>
@endsection
