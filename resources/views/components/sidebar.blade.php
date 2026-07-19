<aside id="app-sidebar"
    class="fixed top-0 left-0 z-40 h-screen bg-[#0F172A] flex flex-col shadow-xl w-[280px] transition-all duration-300 -translate-x-full lg:translate-x-0">

    {{-- Logo Header --}}
    <div class="flex items-center h-16 px-5 border-b border-white/5 shrink-0">

        {{-- Logo --}}
        <a href="{{ route('dashboard') }}" class="flex items-center gap-3 flex-1 overflow-hidden">

            <div
                class="w-10 h-10 flex items-center justify-center rounded-xl bg-[#2563EB] shadow-lg shadow-blue-600/30 shrink-0">

                <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                </svg>

            </div>

            <span class="sidebar-label text-white text-xl font-bold whitespace-nowrap">
                HRIS
            </span>

        </a>

        {{-- Hamburger --}}
        <button id="sidebar-toggle"
            class="hidden lg:flex items-center justify-center w-10 h-10 rounded-xl
               text-slate-300 hover:text-white hover:bg-white/10
               transition duration-300">

            <svg class="w-5 h-5 transition-transform duration-300" id="sidebar-icon" fill="none"
                stroke="currentColor" viewBox="0 0 24 24">

                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />

            </svg>

        </button>

    </div>

    {{-- Search Bar --}}
    <div class="px-4 py-4 shrink-0">
        <div class="relative">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-[#CBD5E1]/60">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                </svg>
            </span>
            <input type="text" placeholder="Search..."
                class="w-full bg-white/5 text-[#CBD5E1] placeholder-[#CBD5E1]/50 pl-9 pr-4 py-2.5 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2563EB]/50 transition border border-white/5 focus:border-[#2563EB]/50">
        </div>
    </div>

    {{-- Navigation --}}
    <nav class="flex-1 overflow-y-auto px-3 pb-4">
        @include('components.navigasi')
    </nav>

    {{-- User Profile Footer --}}
    <div class="p-4 border-t border-white/5 shrink-0">
        <div class="flex items-center gap-3">
            <img class="w-10 h-10 rounded-xl object-cover ring-2 ring-[#2563EB]/40"
                src="https://ui-avatars.com/api/?name={{ auth()->user()->name ?? 'User' }}&background=2563EB&color=fff"
                alt="User">
            <div class="sidebar-label flex-1 min-w-0 transition-all duration-300">
                <p class="text-sm font-semibold text-white truncate">{{ auth()->user()->name ?? 'User Name' }}</p>
                <p class="text-xs text-[#CBD5E1]/60 truncate">{{ auth()->user()->email ?? 'user@hris.com' }}</p>
            </div>

            <form action="{{ route('logout') }}" method="POST">
            @csrf

            <button
                class="sidebar-label text-[#CBD5E1]/60 hover:text-white transition p-1.5 rounded-lg hover:bg-white/5">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                </svg>
            </button>
        </form>
        
        </div>
    </div>
</aside>
