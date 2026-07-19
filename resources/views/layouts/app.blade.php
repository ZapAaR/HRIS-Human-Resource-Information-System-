<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'HRIS') }} - @yield('title', 'Dashboard')</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased font-sans bg-[#F8FAFC] text-slate-800">
    <div class="min-h-screen flex">

        {{-- Mobile Overlay --}}
        <div id="sidebar-overlay" class="fixed inset-0 bg-black/50 z-30 hidden lg:hidden"></div>

        {{-- Sidebar --}}
        @include('components.sidebar')

        {{-- Main Content --}}
        <div id="main-content" class="flex-1 lg:ml-[280px] transition-all duration-300">
            {{-- Top Header --}}
            <header class="sticky top-0 z-20 bg-white/80 backdrop-blur-md border-b border-slate-100 h-16 flex items-center justify-between px-4 lg:px-8">
                <button id="mobile-sidebar-toggle" class="lg:hidden p-2 rounded-lg text-slate-500 hover:bg-slate-100 transition">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </button>

                <div class="flex items-center gap-3 ml-auto">
                    <button class="p-2 rounded-lg text-slate-500 hover:bg-slate-100 transition relative">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                        </svg>
                        <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-red-500 rounded-full"></span>
                    </button>
                    <img class="w-9 h-9 rounded-full object-cover ring-2 ring-blue-600/30"
                         src="https://ui-avatars.com/api/?name={{ auth()->user()->name ?? 'User' }}&background=2563EB&color=fff" alt="User">
                </div>
            </header>

            {{-- Page Content --}}
            <main class="p-4 lg:p-8">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
