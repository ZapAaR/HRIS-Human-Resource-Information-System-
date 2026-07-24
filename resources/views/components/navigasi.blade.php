<ul class="space-y-1">
    {{-- ============ HR ROLE MENU ============ --}}
    {{-- Dashboard --}}
    @can('dashboard.view')
        <li class="relative group">
            <a href="{{ route('dashboard') }}"
                class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-200 {{ request()->routeIs('dashboard') ? 'bg-[#2563EB] text-white shadow-lg shadow-blue-600/30' : 'text-[#CBD5E1] hover:bg-white/5 hover:text-white' }}">
                <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3.75 6a2.25 2.25 0 012.25-2.25h2.25a2.25 2.25 0 012.25 2.25v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75a2.25 2.25 0 012.25-2.25h2.25a2.25 2.25 0 012.25 2.25v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25h2.25A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25h2.25a2.25 2.25 0 012.25 2.25v2.25A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
                </svg>
                <span class="sidebar-label whitespace-nowrap transition-all duration-300">Dashboard</span>
            </a>
            <div class="sidebar-tooltip">Dashboard</div>
        </li>
    @endcan

    {{-- Administration Accordion --}}
    @canany(['user.view'])
        <li class="relative group">
            <button type="button" data-accordion
                class="accordion-trigger flex items-center justify-between w-full px-3 py-2.5 rounded-xl transition-all duration-200 {{ request()->routeIs(['users.*', 'roles.*', 'permissions.*']) ? 'bg-white/5 text-white' : 'text-[#CBD5E1] hover:bg-white/5 hover:text-white' }}">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <span class="sidebar-label whitespace-nowrap transition-all duration-300">Administration</span>
                </div>
                <svg class="accordion-chevron sidebar-label w-4 h-4 transition-transform duration-300 {{ request()->routeIs(['user.*']) ? 'rotate-90' : '' }}"
                    fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                </svg>
            </button>
            <ul
                class="accordion-content mt-1 space-y-1 pl-10 overflow-hidden transition-all duration-300 {{ request()->routeIs(['user.*']) ? 'max-h-96' : 'max-h-0' }}">

                @can('user.view')
                    <li><a href="{{ route('user.index') }}"
                            class="block px-3 py-2 text-sm rounded-lg transition {{ request()->routeIs('user.*') ? 'text-[#2563EB] font-medium bg-[#2563EB]/10' : 'text-[#CBD5E1]/70 hover:text-white hover:bg-white/5' }}"><span
                                class="sidebar-label">Users</span></a></li>
                    {{-- <li><a href="#"
                    class="block px-3 py-2 text-sm rounded-lg transition {{ request()->routeIs('roles.*') ? 'text-[#2563EB] font-medium bg-[#2563EB]/10' : 'text-[#CBD5E1]/70 hover:text-white hover:bg-white/5' }}"><span
                        class="sidebar-label">Roles</span></a></li>
            <li><a href="#"
                    class="block px-3 py-2 text-sm rounded-lg transition {{ request()->routeIs('permissions.*') ? 'text-[#2563EB] font-medium bg-[#2563EB]/10' : 'text-[#CBD5E1]/70 hover:text-white hover:bg-white/5' }}"><span
                        class="sidebar-label">Permissions</span></a></li> --}}
                @endcan

            </ul>
            <div class="sidebar-tooltip">Administration</div>
        </li>
    @endcanany

    {{-- Organization Accordion --}}
    @canany(['karyawan.view', 'posisi.view', 'divisi.view'])
        <li class="relative group">
            <button type="button" data-accordion
                class="accordion-trigger flex items-center justify-between w-full px-3 py-2.5 rounded-xl transition-all duration-200 {{ request()->routeIs(['employees.*', 'departments.*', 'positions.*']) ? 'bg-white/5 text-white' : 'text-[#CBD5E1] hover:bg-white/5 hover:text-white' }}">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                    </svg>
                    <span class="sidebar-label whitespace-nowrap transition-all duration-300">Organization</span>
                </div>
                <svg class="accordion-chevron sidebar-label w-4 h-4 transition-transform duration-300 {{ request()->routeIs(['employees.*', 'departments.*', 'positions.*']) ? 'rotate-90' : '' }}"
                    fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                </svg>
            </button>
            <ul
                class="accordion-content mt-1 space-y-1 pl-10 overflow-hidden transition-all duration-300 {{ request()->routeIs(['karyawan.*', 'divisi.*', 'posisi.*']) ? 'max-h-96' : 'max-h-0' }}">

                @can('karyawan.view')
                    <li><a href="{{ route('karyawan.index') }}"
                            class="block px-3 py-2 text-sm rounded-lg transition {{ request()->routeIs('karyawan.*') ? 'text-[#2563EB] font-medium bg-[#2563EB]/10' : 'text-[#CBD5E1]/70 hover:text-white hover:bg-white/5' }}"><span
                                class="sidebar-label">Karyawan</span></a></li>
                @endcan
                @can('divisi.view')
                    <li><a href="{{ route('divisi.index') }}"
                            class="block px-3 py-2 text-sm rounded-lg transition {{ request()->routeIs('divisi.*') ? 'text-[#2563EB] font-medium bg-[#2563EB]/10' : 'text-[#CBD5E1]/70 hover:text-white hover:bg-white/5' }}"><span
                                class="sidebar-label">Divisi</span></a></li>
                @endcan
                @can('posisi.view')
                    <li><a href="{{ route('posisi.index') }}"
                            class="block px-3 py-2 text-sm rounded-lg transition {{ request()->routeIs('posisi.*') ? 'text-[#2563EB] font-medium bg-[#2563EB]/10' : 'text-[#CBD5E1]/70 hover:text-white hover:bg-white/5' }}"><span
                                class="sidebar-label">Posisi</span></a></li>
                @endcan

            </ul>
            <div class="sidebar-tooltip">Organization</div>
        </li>
    @endcanany

    {{-- Kehadiran --}}
    @can('kehadiran.view')
    <li class="relative group">
        <a href="{{ route('kehadiran.index') }}"
            class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-200 {{ request()->routeIs('kehadiran.*') ? 'bg-[#2563EB] text-white shadow-lg shadow-blue-600/30' : 'text-[#CBD5E1] hover:bg-white/5 hover:text-white' }}">
            <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span class="sidebar-label whitespace-nowrap transition-all duration-300">Kehadiran</span>
        </a>
        <div class="sidebar-tooltip">Kehadiran</div>
    </li>
    @endcan

    {{-- Leave --}}
    @can('cuti.view')
    <li class="relative group">
        <a href="#"
            class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-200 {{ request()->routeIs('leave.*') ? 'bg-[#2563EB] text-white shadow-lg shadow-blue-600/30' : 'text-[#CBD5E1] hover:bg-white/5 hover:text-white' }}">
            <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
            </svg>
            <span class="sidebar-label whitespace-nowrap transition-all duration-300">Leave</span>
        </a>
        <div class="sidebar-tooltip">Leave</div>
    </li>
    @endcan

    {{-- Overtime --}}
    @can('lembur.view')
    <li class="relative group">
        <a href="#"
            class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-200 {{ request()->routeIs('overtime.*') ? 'bg-[#2563EB] text-white shadow-lg shadow-blue-600/30' : 'text-[#CBD5E1] hover:bg-white/5 hover:text-white' }}">
            <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span class="sidebar-label whitespace-nowrap transition-all duration-300">Overtime</span>
        </a>
        <div class="sidebar-tooltip">Overtime</div>
    </li>
    @endcan

    {{-- Payroll --}}
    @can('gaji.view')
    <li class="relative group">
        <a href="#"
            class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-200 {{ request()->routeIs('payroll.*') ? 'bg-[#2563EB] text-white shadow-lg shadow-blue-600/30' : 'text-[#CBD5E1] hover:bg-white/5 hover:text-white' }}">
            <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z" />
            </svg>
            <span class="sidebar-label whitespace-nowrap transition-all duration-300">Payroll</span>
        </a>
        <div class="sidebar-tooltip">Payroll</div>
    </li>
    @endcan

    {{-- Reports --}}
    @can('laporan.view')
    <li class="relative group">
        <a href="#"
            class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-200 {{ request()->routeIs('reports.*') ? 'bg-[#2563EB] text-white shadow-lg shadow-blue-600/30' : 'text-[#CBD5E1] hover:bg-white/5 hover:text-white' }}">
            <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z" />
            </svg>
            <span class="sidebar-label whitespace-nowrap transition-all duration-300">Reports</span>
        </a>
        <div class="sidebar-tooltip">Reports</div>
    </li>
    @endcan

    {{-- Settings --}}
    <li class="relative group">
        <a href="#"
            class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-200 {{ request()->routeIs('settings.*') ? 'bg-[#2563EB] text-white shadow-lg shadow-blue-600/30' : 'text-[#CBD5E1] hover:bg-white/5 hover:text-white' }}">
            <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            <span class="sidebar-label whitespace-nowrap transition-all duration-300">Settings</span>
        </a>
        <div class="sidebar-tooltip">Settings</div>
    </li>
