<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="HRIS - Modern Human Resource Information System. Manage employees, attendance, leave, payroll, overtime, and reports in one integrated platform.">
    <title>HRIS — Modern Human Resource Information System</title>

    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind CSS v4 (Browser CDN) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'ui-sans-serif', 'system-ui'],
                    },
                    colors: {
                        primary: '#2563EB',
                        primaryH: '#1D4ED8',
                        secondary: '#0F172A',
                        bg: '#F8FAFC',
                        card: '#FFFFFF',
                        border: '#E2E8F0',
                        text: '#1E293B',
                        muted: '#64748B',
                        success: '#22C55E',
                        warning: '#F59E0B',
                        danger: '#EF4444',
                    },
                    boxShadow: {
                        soft: '0 4px 24px -4px rgba(15, 23, 42, 0.06), 0 2px 8px -2px rgba(15, 23, 42, 0.04)',
                        lift: '0 20px 50px -12px rgba(37, 99, 235, 0.25)',
                    },
                }
            }
        }
    </script>

    <style>
        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #F8FAFC;
            color: #1E293B;
            -webkit-font-smoothing: antialiased;
        }

        /* Gradient text */
        .gradient-text {
            background: linear-gradient(135deg, #2563EB 0%, #1D4ED8 60%, #0F172A 100%);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        /* Animated background grid */
        .hero-grid {
            background-image:
                linear-gradient(#E2E8F0 1px, transparent 1px),
                linear-gradient(90deg, #E2E8F0 1px, transparent 1px);
            background-size: 48px 48px;
            mask-image: radial-gradient(ellipse at center, black 30%, transparent 75%);
            -webkit-mask-image: radial-gradient(ellipse at center, black 30%, transparent 75%);
        }

        /* Blob gradients */
        .blob {
            position: absolute;
            border-radius: 9999px;
            filter: blur(70px);
            opacity: 0.35;
            pointer-events: none;
        }

        /* Reveal animations */
        .reveal {
            opacity: 0;
            transform: translateY(24px);
            transition: opacity .7s cubic-bezier(.2, .7, .2, 1), transform .7s cubic-bezier(.2, .7, .2, 1);
            will-change: opacity, transform;
        }

        .reveal.is-visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* Staggered children */
        .stagger>.reveal:nth-child(1) {
            transition-delay: .05s;
        }

        .stagger>.reveal:nth-child(2) {
            transition-delay: .12s;
        }

        .stagger>.reveal:nth-child(3) {
            transition-delay: .19s;
        }

        .stagger>.reveal:nth-child(4) {
            transition-delay: .26s;
        }

        .stagger>.reveal:nth-child(5) {
            transition-delay: .33s;
        }

        .stagger>.reveal:nth-child(6) {
            transition-delay: .40s;
        }

        /* Floating dashboard animation */
        @keyframes floaty {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .float-slow {
            animation: floaty 6s ease-in-out infinite;
        }

        .float-mid {
            animation: floaty 5s ease-in-out infinite .6s;
        }

        .float-fast {
            animation: floaty 4s ease-in-out infinite 1.2s;
        }

        /* Pulse dot */
        @keyframes pulseDot {

            0%,
            100% {
                box-shadow: 0 0 0 0 rgba(34, 197, 94, .6);
            }

            50% {
                box-shadow: 0 0 0 8px rgba(34, 197, 94, 0);
            }
        }

        .pulse-dot {
            animation: pulseDot 2s infinite;
        }

        /* Bar grow */
        @keyframes barGrow {
            from {
                transform: scaleY(0);
            }

            to {
                transform: scaleY(1);
            }
        }

        .bar {
            transform-origin: bottom;
            animation: barGrow 1.2s cubic-bezier(.2, .7, .2, 1) both;
        }

        /* Workflow line dash */
        .workflow-line {
            background-image: linear-gradient(90deg, #2563EB 50%, transparent 50%);
            background-size: 10px 2px;
            background-repeat: repeat-x;
            background-position: center;
            height: 2px;
        }

        /* Button shine */
        .btn-shine {
            position: relative;
            overflow: hidden;
        }

        .btn-shine::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(120deg, transparent 30%, rgba(255, 255, 255, .35) 50%, transparent 70%);
            transform: translateX(-120%);
            transition: transform .8s ease;
        }

        .btn-shine:hover::after {
            transform: translateX(120%);
        }

        /* Scrollbar */
        ::-webkit-scrollbar {
            width: 10px;
        }

        ::-webkit-scrollbar-track {
            background: #F8FAFC;
        }

        ::-webkit-scrollbar-thumb {
            background: #CBD5E1;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #94A3B8;
        }

        /* Mobile menu */
        .mobile-menu {
            max-height: 0;
            overflow: hidden;
            transition: max-height .4s ease;
        }

        .mobile-menu.open {
            max-height: 500px;
        }
    </style>
</head>

<body class="bg-bg text-text">

    {{-- ================= NAVBAR ================= --}}
    <header id="navbar" class="fixed top-0 inset-x-0 z-50 transition-all duration-300">
        <div class="bg-white/70 backdrop-blur-xl border-b border-border/60">
            <nav class="max-w-7xl mx-auto px-6 lg:px-8 h-16 flex items-center justify-between">
                {{-- Logo --}}
                <a href="#" class="flex items-center gap-2 group">
                    <div
                        class="w-9 h-9 rounded-xl bg-gradient-to-br from-primary to-primaryH flex items-center justify-center shadow-soft group-hover:shadow-lift transition-shadow duration-300">
                        <svg class="w-5 h-5 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                            <circle cx="9" cy="7" r="4" />
                            <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                            <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                        </svg>
                    </div>
                    <span class="font-bold text-lg tracking-tight text-secondary">HRIS<span
                            class="text-primary">.</span></span>
                </a>

                {{-- Desktop Menu --}}
                <ul class="hidden lg:flex items-center gap-8 text-sm font-medium text-muted">
                    <li><a href="#home" class="hover:text-primary transition-colors duration-200">Home</a></li>
                    <li><a href="#features" class="hover:text-primary transition-colors duration-200">Features</a></li>
                    <li><a href="#about" class="hover:text-primary transition-colors duration-200">About</a></li>
                    <li><a href="#contact" class="hover:text-primary transition-colors duration-200">Contact</a></li>
                </ul>

                {{-- Auth Buttons --}}
                @guest
                    <div class="hidden lg:flex items-center gap-3">
                        <a href="{{ route('login') }}"
                            class="btn-shine inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-primary hover:bg-primaryH text-white text-sm font-semibold shadow-soft hover:shadow-lift transition-all duration-300">
                            Login
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5 12h14M13 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                @endguest

                @auth
                    <div class="hidden lg:flex items-center gap-3">
                        <a href="{{ route('dashboard') }}"
                            class="btn-shine inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-primary hover:bg-primaryH text-white text-sm font-semibold shadow-soft hover:shadow-lift transition-all duration-300">
                            Dashboard
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5 12h14M13 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                @endauth

                {{-- Mobile Toggle --}}
                <button id="menuToggle"
                    class="lg:hidden w-10 h-10 rounded-lg border border-border flex items-center justify-center text-text"
                    aria-label="Toggle menu">
                    <svg id="iconOpen" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M3 6h18M3 12h18M3 18h18" />
                    </svg>
                    <svg id="iconClose" class="w-5 h-5 hidden" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 6 6 18M6 6l12 12" />
                    </svg>
                </button>
            </nav>

            {{-- Mobile Menu --}}
            <div id="mobileMenu" class="mobile-menu lg:hidden border-t border-border bg-white/95 backdrop-blur-xl">
                <ul class="px-6 py-4 space-y-3 text-sm font-medium text-text">
                    <li><a href="#home" class="block py-2">Home</a></li>
                    <li><a href="#features" class="block py-2">Features</a></li>
                    <li><a href="#about" class="block py-2">About</a></li>
                    <li><a href="#contact" class="block py-2">Contact</a></li>
                    @guest
                        <li class="pt-3 border-t border-border flex gap-3">
                            <a href="{{ route('login') }}" class="flex-1 text-center py-2 rounded-lg bg-primary text-white">
                                Login
                            </a>
                        </li>
                    @endguest

                    @auth
                        <li class="pt-3 border-t border-border flex gap-3">
                            <a href="{{ route('dashboard') }}"
                                class="flex-1 text-center py-2 rounded-lg bg-primary text-white">
                                Dashboard
                            </a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </header>

    {{-- ================= HERO ================= --}}
    <section id="home" class="relative pt-32 pb-20 lg:pt-40 lg:pb-28 overflow-hidden">
        {{-- Background decorations --}}
        <div class="absolute inset-0 hero-grid"></div>
        <div class="blob bg-primary/40 w-[500px] h-[500px] -top-40 -left-40"></div>
        <div class="blob bg-indigo-400/30 w-[400px] h-[400px] top-40 -right-32"></div>

        <div class="relative max-w-7xl mx-auto px-6 lg:px-8 grid lg:grid-cols-2 gap-14 items-center">
            {{-- Left: Copy --}}
            <div class="reveal">

                <h1
                    class="mt-6 text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight leading-[1.05] text-secondary">
                    Modern <span class="gradient-text">Human Resource</span> Information System
                </h1>

                <p class="mt-6 text-lg text-muted leading-relaxed max-w-xl">
                    Manage employees, attendance, leave, payroll, overtime, and reports in one integrated platform —
                    built for modern teams that move fast.
                </p>

                <div class="mt-8 flex flex-col sm:flex-row gap-3">
                    @guest
                        <a href="{{ route('login') }}"
                            class="btn-shine inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-2xl bg-primary hover:bg-primaryH text-white font-semibold shadow-soft hover:shadow-lift transition-all duration-300">
                            Get Started
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5 12h14M13 5l7 7-7 7" />
                            </svg>
                        </a>
                    @endguest

                    @auth
                        <a href="{{ route('dashboard') }}"
                            class="btn-shine inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-2xl bg-primary hover:bg-primaryH text-white font-semibold shadow-soft hover:shadow-lift transition-all duration-300">
                            Go to Dashboard
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5 12h14M13 5l7 7-7 7" />
                            </svg>
                        </a>
                    @endauth
                    <a href="#features"
                        class="inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-2xl bg-white hover:bg-bg border border-border text-text font-semibold transition-all duration-300">
                        <svg class="w-4 h-4 text-primary" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                            <polygon points="6 3 20 12 6 21 6 3" />
                        </svg>
                        Learn More
                    </a>
                </div>

                {{-- Trust row --}}
                <div class="mt-10 flex items-center gap-6">
                    <div class="flex -space-x-2">
                        <div
                            class="w-9 h-9 rounded-full bg-gradient-to-br from-pink-400 to-rose-500 border-2 border-white">
                        </div>
                        <div
                            class="w-9 h-9 rounded-full bg-gradient-to-br from-amber-400 to-orange-500 border-2 border-white">
                        </div>
                        <div
                            class="w-9 h-9 rounded-full bg-gradient-to-br from-emerald-400 to-teal-500 border-2 border-white">
                        </div>
                        <div
                            class="w-9 h-9 rounded-full bg-gradient-to-br from-sky-400 to-indigo-500 border-2 border-white">
                        </div>
                    </div>
                    <div class="text-sm">
                        <div class="flex items-center gap-1 text-warning">
                            @for ($i = 0; $i < 5; $i++)
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                                    <path
                                        d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                                </svg>
                            @endfor
                            <span class="ml-1 text-text font-semibold">4.9</span>
                        </div>
                        <p class="text-muted">Trusted by 1,200+ HR teams</p>
                    </div>
                </div>
            </div>

            {{-- Right: Dashboard Illustration --}}
            <div class="relative reveal">
                <div class="relative rounded-3xl bg-white border border-border shadow-soft p-5 lg:p-6">
                    {{-- Top bar --}}
                    <div class="flex items-center justify-between mb-5">
                        <div class="flex items-center gap-2">
                            <span class="w-3 h-3 rounded-full bg-danger"></span>
                            <span class="w-3 h-3 rounded-full bg-warning"></span>
                            <span class="w-3 h-3 rounded-full bg-success"></span>
                        </div>
                        <div class="text-xs font-medium text-muted px-3 py-1 rounded-full bg-bg border border-border">
                            hris.app/dashboard</div>
                        <div class="w-12"></div>
                    </div>

                    <div class="grid grid-cols-3 gap-4">
                        {{-- Employee Card --}}
                        <div
                            class="float-slow col-span-2 rounded-2xl bg-gradient-to-br from-primary/5 to-indigo-50 border border-primary/10 p-4">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-xs text-muted font-medium">Active Employees</p>
                                    <p class="text-2xl font-bold text-secondary mt-1">1,248</p>
                                    <p class="text-xs text-success font-semibold mt-1 flex items-center gap-1">
                                        <svg class="w-3 h-3" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path d="m6 15 6-6 6 6" />
                                        </svg>
                                        +12.4% this month
                                    </p>
                                </div>
                                <div class="w-10 h-10 rounded-xl bg-primary/15 flex items-center justify-center">
                                    <svg class="w-5 h-5 text-primary" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                                        <circle cx="9" cy="7" r="4" />
                                        <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                                        <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                    </svg>
                                </div>
                            </div>
                            <div class="mt-4 flex gap-1.5 items-end h-12">
                                <div class="bar flex-1 bg-primary/30 rounded-t"
                                    style="height:40%; animation-delay:.1s"></div>
                                <div class="bar flex-1 bg-primary/40 rounded-t"
                                    style="height:60%; animation-delay:.2s"></div>
                                <div class="bar flex-1 bg-primary/50 rounded-t"
                                    style="height:45%; animation-delay:.3s"></div>
                                <div class="bar flex-1 bg-primary/60 rounded-t"
                                    style="height:80%; animation-delay:.4s"></div>
                                <div class="bar flex-1 bg-primary/70 rounded-t"
                                    style="height:65%; animation-delay:.5s"></div>
                                <div class="bar flex-1 bg-primary/80 rounded-t"
                                    style="height:90%; animation-delay:.6s"></div>
                                <div class="bar flex-1 bg-primary     rounded-t"
                                    style="height:100%; animation-delay:.7s"></div>
                            </div>
                        </div>

                        {{-- Attendance Widget --}}
                        <div class="float-mid rounded-2xl bg-white border border-border p-4 shadow-soft">
                            <p class="text-xs text-muted font-medium">Attendance</p>
                            <p class="text-xl font-bold text-secondary mt-1">98%</p>
                            <div class="mt-3 relative w-16 h-16 mx-auto">
                                <svg class="w-16 h-16 -rotate-90" viewBox="0 0 36 36">
                                    <circle cx="18" cy="18" r="15" fill="none" stroke="#E2E8F0"
                                        stroke-width="3" />
                                    <circle cx="18" cy="18" r="15" fill="none" stroke="#22C55E"
                                        stroke-width="3" stroke-dasharray="94.2" stroke-dashoffset="1.9"
                                        stroke-linecap="round" />
                                </svg>
                                <div class="absolute inset-0 flex items-center justify-center">
                                    <svg class="w-5 h-5 text-success" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M20 6 9 17l-5-5" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        {{-- Payroll Widget --}}
                        <div class="float-fast rounded-2xl bg-white border border-border p-4 shadow-soft">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 rounded-lg bg-warning/15 flex items-center justify-center">
                                    <svg class="w-4 h-4 text-warning" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <rect x="2" y="6" width="20" height="12" rx="2" />
                                        <circle cx="12" cy="12" r="2" />
                                        <path d="M6 12h.01M18 12h.01" />
                                    </svg>
                                </div>
                                <p class="text-xs text-muted font-medium">Payroll</p>
                            </div>
                            <p class="text-lg font-bold text-secondary mt-2">$ 84.2K</p>
                            <p class="text-[10px] text-muted mt-0.5">Disbursed today</p>
                        </div>

                        {{-- Calendar --}}
                        <div class="float-slow rounded-2xl bg-white border border-border p-4 shadow-soft">
                            <div class="flex items-center justify-between">
                                <p class="text-xs text-muted font-medium">July 2026</p>
                                <svg class="w-3.5 h-3.5 text-muted" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <rect x="3" y="4" width="18" height="18" rx="2" />
                                    <path d="M16 2v4M8 2v4M3 10h18" />
                                </svg>
                            </div>
                            <div class="mt-2 grid grid-cols-7 gap-1 text-[9px] text-center text-muted">
                                <span>M</span><span>T</span><span>W</span><span>T</span><span>F</span><span>S</span><span>S</span>
                            </div>
                            <div class="mt-1 grid grid-cols-7 gap-1 text-[10px] text-center">
                                @for ($d = 1; $d <= 18; $d++)
                                    @if ($d === 18)
                                        <span
                                            class="rounded-md bg-primary text-white font-bold py-0.5">{{ $d }}</span>
                                    @else
                                        <span class="py-0.5 text-text/70">{{ $d }}</span>
                                    @endif
                                @endfor
                            </div>
                        </div>

                        {{-- Analytics --}}
                        <div class="float-mid col-span-2 rounded-2xl bg-white border border-border p-4 shadow-soft">
                            <div class="flex items-center justify-between">
                                <p class="text-xs text-muted font-medium">Overtime Analytics</p>
                                <span
                                    class="text-[10px] font-semibold text-success bg-success/10 px-2 py-0.5 rounded-full">+8.2%</span>
                            </div>
                            <svg class="mt-3 w-full h-14" viewBox="0 0 200 60" preserveAspectRatio="none">
                                <defs>
                                    <linearGradient id="grad" x1="0" x2="0" y1="0"
                                        y2="1">
                                        <stop offset="0%" stop-color="#2563EB" stop-opacity=".35" />
                                        <stop offset="100%" stop-color="#2563EB" stop-opacity="0" />
                                    </linearGradient>
                                </defs>
                                <path
                                    d="M0,45 C20,30 40,40 60,25 C80,10 100,30 120,20 C140,10 160,25 180,15 L200,10 L200,60 L0,60 Z"
                                    fill="url(#grad)" />
                                <path d="M0,45 C20,30 40,40 60,25 C80,10 100,30 120,20 C140,10 160,25 180,15 L200,10"
                                    fill="none" stroke="#2563EB" stroke-width="2" stroke-linecap="round" />
                            </svg>
                        </div>
                    </div>
                </div>

                {{-- Floating badges --}}
                <div
                    class="hidden lg:flex absolute -left-6 top-10 bg-white border border-border rounded-2xl shadow-soft px-3 py-2 items-center gap-2 float-fast">
                    <div class="w-8 h-8 rounded-lg bg-success/15 flex items-center justify-center">
                        <svg class="w-4 h-4 text-success" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 6 9 17l-5-5" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-[11px] font-semibold text-text">Leave Approved</p>
                        <p class="text-[10px] text-muted">Just now</p>
                    </div>
                </div>
                <div
                    class="hidden lg:flex absolute -right-4 bottom-8 bg-white border border-border rounded-2xl shadow-soft px-3 py-2 items-center gap-2 float-slow">
                    <div class="w-8 h-8 rounded-lg bg-primary/15 flex items-center justify-center">
                        <svg class="w-4 h-4 text-primary" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path
                                d="M12 2v4M12 18v4M4.93 4.93l2.83 2.83M16.24 16.24l2.83 2.83M2 12h4M18 12h4M4.93 19.07l2.83-2.83M16.24 7.76l2.83-2.83" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-[11px] font-semibold text-text">Payroll Synced</p>
                        <p class="text-[10px] text-muted">2 min ago</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ================= FEATURES ================= --}}
    <section id="features" class="py-20 lg:py-28 relative">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto reveal">
                <span
                    class="inline-block px-3 py-1 rounded-full bg-primary/10 text-primary text-xs font-semibold">Features</span>
                <h2 class="mt-4 text-3xl lg:text-5xl font-bold tracking-tight text-secondary">Everything HR teams need,
                    in one place</h2>
                <p class="mt-4 text-muted text-lg">A complete suite of modules designed to automate your HR operations
                    and empower your workforce.</p>
            </div>

            <div class="mt-14 grid sm:grid-cols-2 lg:grid-cols-3 gap-6 stagger">
                {{-- Card: Employee Management --}}
                <div
                    class="reveal group relative bg-card border border-border rounded-2xl p-7 shadow-soft hover:shadow-lift hover:-translate-y-1 transition-all duration-300">
                    <div
                        class="w-12 h-12 rounded-2xl bg-primary/10 text-primary flex items-center justify-center group-hover:bg-primary group-hover:text-white transition-colors duration-300">
                        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                            <circle cx="9" cy="7" r="4" />
                            <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                            <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                        </svg>
                    </div>
                    <h3 class="mt-5 text-lg font-bold text-secondary">Employee Management</h3>
                    <p class="mt-2 text-sm text-muted leading-relaxed">Centralize employee data, contracts, documents,
                        and organizational structure in a single source of truth.</p>
                </div>

                {{-- Card: Attendance --}}
                <div
                    class="reveal group relative bg-card border border-border rounded-2xl p-7 shadow-soft hover:shadow-lift hover:-translate-y-1 transition-all duration-300">
                    <div
                        class="w-12 h-12 rounded-2xl bg-success/10 text-success flex items-center justify-center group-hover:bg-success group-hover:text-white transition-colors duration-300">
                        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10" />
                            <path d="M12 6v6l4 2" />
                        </svg>
                    </div>
                    <h3 class="mt-5 text-lg font-bold text-secondary">Attendance</h3>
                    <p class="mt-2 text-sm text-muted leading-relaxed">Track check-ins, geolocation, shift schedules,
                        and real-time attendance with biometric and mobile support.</p>
                </div>

                {{-- Card: Leave --}}
                <div
                    class="reveal group relative bg-card border border-border rounded-2xl p-7 shadow-soft hover:shadow-lift hover:-translate-y-1 transition-all duration-300">
                    <div
                        class="w-12 h-12 rounded-2xl bg-warning/10 text-warning flex items-center justify-center group-hover:bg-warning group-hover:text-white transition-colors duration-300">
                        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="4" width="18" height="18" rx="2" />
                            <path d="M16 2v4M8 2v4M3 10h18" />
                        </svg>
                    </div>
                    <h3 class="mt-5 text-lg font-bold text-secondary">Leave</h3>
                    <p class="mt-2 text-sm text-muted leading-relaxed">Automate leave requests, approvals, and balance
                        tracking. Support annual, sick, maternity, and custom leave types.</p>
                </div>

                {{-- Card: Payroll --}}
                <div
                    class="reveal group relative bg-card border border-border rounded-2xl p-7 shadow-soft hover:shadow-lift hover:-translate-y-1 transition-all duration-300">
                    <div
                        class="w-12 h-12 rounded-2xl bg-indigo-500/10 text-indigo-600 flex items-center justify-center group-hover:bg-indigo-600 group-hover:text-white transition-colors duration-300">
                        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="2" y="6" width="20" height="12" rx="2" />
                            <circle cx="12" cy="12" r="2" />
                            <path d="M6 12h.01M18 12h.01" />
                        </svg>
                    </div>
                    <h3 class="mt-5 text-lg font-bold text-secondary">Payroll</h3>
                    <p class="mt-2 text-sm text-muted leading-relaxed">Run payroll in minutes with auto tax
                        calculation, deductions, allowances, and seamless bank integration.</p>
                </div>

                {{-- Card: Overtime --}}
                <div
                    class="reveal group relative bg-card border border-border rounded-2xl p-7 shadow-soft hover:shadow-lift hover:-translate-y-1 transition-all duration-300">
                    <div
                        class="w-12 h-12 rounded-2xl bg-rose-500/10 text-rose-500 flex items-center justify-center group-hover:bg-rose-500 group-hover:text-white transition-colors duration-300">
                        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M13 2 3 14h9l-1 8 10-12h-9l1-8z" />
                        </svg>
                    </div>
                    <h3 class="mt-5 text-lg font-bold text-secondary">Overtime</h3>
                    <p class="mt-2 text-sm text-muted leading-relaxed">Capture overtime requests, apply custom rate
                        rules, and auto-sync with payroll for accurate compensation.</p>
                </div>

                {{-- Card: Reports --}}
                <div
                    class="reveal group relative bg-card border border-border rounded-2xl p-7 shadow-soft hover:shadow-lift hover:-translate-y-1 transition-all duration-300">
                    <div
                        class="w-12 h-12 rounded-2xl bg-sky-500/10 text-sky-600 flex items-center justify-center group-hover:bg-sky-600 group-hover:text-white transition-colors duration-300">
                        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M3 3v18h18" />
                            <path d="M7 14l4-4 4 4 5-5" />
                        </svg>
                    </div>
                    <h3 class="mt-5 text-lg font-bold text-secondary">Reports</h3>
                    <p class="mt-2 text-sm text-muted leading-relaxed">Generate insightful reports with drag-and-drop
                        analytics, export to PDF/Excel, and schedule automated delivery.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ================= STATISTICS ================= --}}
    <section class="py-20 relative">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="reveal rounded-3xl bg-secondary relative overflow-hidden border border-border">
                <div class="absolute inset-0 opacity-20"
                    style="background-image: radial-gradient(circle at 20% 30%, #2563EB 0%, transparent 40%), radial-gradient(circle at 80% 70%, #6366F1 0%, transparent 40%);">
                </div>
                <div class="relative grid sm:grid-cols-2 lg:grid-cols-4 gap-8 p-10 lg:p-14">
                    @php
                        $stats = [
                            [
                                'value' => '1,200+',
                                'label' => 'Employees Managed',
                                'icon' =>
                                    '<path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>',
                            ],
                            [
                                'value' => '98%',
                                'label' => 'Attendance Rate',
                                'icon' => '<circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/>',
                            ],
                            [
                                'value' => '350+',
                                'label' => 'Leave Requests',
                                'icon' =>
                                    '<rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/>',
                            ],
                            [
                                'value' => '99.9%',
                                'label' => 'System Uptime',
                                'icon' => '<path d="M22 12h-4l-3 9L9 3l-3 9H2"/>',
                            ],
                        ];
                    @endphp
                    @foreach ($stats as $s)
                        <div class="text-center lg:text-left">
                            <div
                                class="inline-flex w-12 h-12 rounded-2xl bg-white/10 text-white items-center justify-center mb-4">
                                <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">{!! $s['icon'] !!}</svg>
                            </div>
                            <div class="text-4xl lg:text-5xl font-extrabold text-white tracking-tight">
                                {{ $s['value'] }}</div>
                            <div class="mt-1 text-sm text-white/60 font-medium">{{ $s['label'] }}</div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- ================= WORKFLOW ================= --}}
    <section id="about" class="py-20 lg:py-28">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto reveal">
                <span
                    class="inline-block px-3 py-1 rounded-full bg-primary/10 text-primary text-xs font-semibold">Workflow</span>
                <h2 class="mt-4 text-3xl lg:text-5xl font-bold tracking-tight text-secondary">Seamless end-to-end HR
                    flow</h2>
                <p class="mt-4 text-muted text-lg">From onboarding to reporting — every step is connected, automated,
                    and transparent.</p>
            </div>

            <div class="mt-14 relative">
                {{-- Desktop workflow --}}
                <div class="hidden lg:grid grid-cols-6 gap-4 relative">
                    <div class="absolute left-[8%] right-[8%] top-10 workflow-line"></div>
                    @php
                        $steps = [
                            [
                                'title' => 'Employee',
                                'desc' => 'Onboard & manage',
                                'icon' =>
                                    '<path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/>',
                            ],
                            [
                                'title' => 'Attendance',
                                'desc' => 'Daily check-in',
                                'icon' => '<circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/>',
                            ],
                            [
                                'title' => 'Leave',
                                'desc' => 'Request & track',
                                'icon' => '<rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4"/>',
                            ],
                            [
                                'title' => 'Approval',
                                'desc' => 'Manager review',
                                'icon' => '<path d="M20 6 9 17l-5-5"/>',
                            ],
                            [
                                'title' => 'Payroll',
                                'desc' => 'Auto calculation',
                                'icon' =>
                                    '<rect x="2" y="6" width="20" height="12" rx="2"/><circle cx="12" cy="12" r="2"/>',
                            ],
                            [
                                'title' => 'Reports',
                                'desc' => 'Insights & export',
                                'icon' => '<path d="M3 3v18h18"/><path d="M7 14l4-4 4 4 5-5"/>',
                            ],
                        ];
                    @endphp
                    @foreach ($steps as $i => $step)
                        <div class="reveal relative">
                            <div
                                class="relative z-10 mx-auto w-20 h-20 rounded-2xl bg-white border border-border shadow-soft flex items-center justify-center text-primary hover:scale-110 hover:border-primary hover:shadow-lift transition-all duration-300">
                                <svg class="w-8 h-8" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">{!! $step['icon'] !!}</svg>
                                <span
                                    class="absolute -top-2 -right-2 w-7 h-7 rounded-full bg-primary text-white text-xs font-bold flex items-center justify-center shadow-soft">{{ $i + 1 }}</span>
                            </div>
                            <h4 class="mt-4 text-center font-bold text-secondary">{{ $step['title'] }}</h4>
                            <p class="text-center text-xs text-muted mt-1">{{ $step['desc'] }}</p>
                        </div>
                    @endforeach
                </div>

                {{-- Mobile workflow --}}
                <div class="lg:hidden space-y-4">
                    @foreach ($steps as $i => $step)
                        <div
                            class="reveal flex items-center gap-4 bg-white border border-border rounded-2xl p-4 shadow-soft">
                            <div
                                class="w-14 h-14 rounded-xl bg-primary/10 text-primary flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">{!! $step['icon'] !!}</svg>
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center gap-2">
                                    <span
                                        class="w-6 h-6 rounded-full bg-primary text-white text-xs font-bold flex items-center justify-center">{{ $i + 1 }}</span>
                                    <h4 class="font-bold text-secondary">{{ $step['title'] }}</h4>
                                </div>
                                <p class="text-xs text-muted mt-0.5">{{ $step['desc'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- ================= BENEFITS ================= --}}
    <section class="py-20 lg:py-28 bg-white border-y border-border">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto reveal">
                <span
                    class="inline-block px-3 py-1 rounded-full bg-primary/10 text-primary text-xs font-semibold">Benefits</span>
                <h2 class="mt-4 text-3xl lg:text-5xl font-bold tracking-tight text-secondary">Built for
                    enterprise-grade reliability</h2>
                <p class="mt-4 text-muted text-lg">Security, speed, and flexibility — the pillars of a modern HR
                    platform.</p>
            </div>

            <div class="mt-14 grid sm:grid-cols-2 lg:grid-cols-4 gap-6 stagger">
                {{-- Secure Data --}}
                <div
                    class="reveal group bg-bg hover:bg-white border border-transparent hover:border-border rounded-2xl p-6 text-center hover:shadow-lift hover:-translate-y-1 transition-all duration-300">
                    <div
                        class="w-14 h-14 mx-auto rounded-2xl bg-white border border-border group-hover:bg-success/10 group-hover:border-success/20 flex items-center justify-center text-primary group-hover:text-success transition-colors duration-300">
                        <svg class="w-7 h-7" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
                            <path d="m9 12 2 2 4-4" />
                        </svg>
                    </div>
                    <h3 class="mt-5 font-bold text-secondary">Secure Data</h3>
                    <p class="mt-2 text-sm text-muted">End-to-end encryption, ISO-27001 ready, and GDPR compliant.</p>
                </div>

                {{-- Fast Performance --}}
                <div
                    class="reveal group bg-bg hover:bg-white border border-transparent hover:border-border rounded-2xl p-6 text-center hover:shadow-lift hover:-translate-y-1 transition-all duration-300">
                    <div
                        class="w-14 h-14 mx-auto rounded-2xl bg-white border border-border group-hover:bg-warning/10 group-hover:border-warning/20 flex items-center justify-center text-primary group-hover:text-warning transition-colors duration-300">
                        <svg class="w-7 h-7" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M13 2 3 14h9l-1 8 10-12h-9l1-8z" />
                        </svg>
                    </div>
                    <h3 class="mt-5 font-bold text-secondary">Fast Performance</h3>
                    <p class="mt-2 text-sm text-muted">Sub-second response times with global CDN and edge caching.</p>
                </div>

                {{-- Role-Based Access --}}
                <div
                    class="reveal group bg-bg hover:bg-white border border-transparent hover:border-border rounded-2xl p-6 text-center hover:shadow-lift hover:-translate-y-1 transition-all duration-300">
                    <div
                        class="w-14 h-14 mx-auto rounded-2xl bg-white border border-border group-hover:bg-primary/10 group-hover:border-primary/20 flex items-center justify-center text-primary transition-colors duration-300">
                        <svg class="w-7 h-7" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                            <circle cx="9" cy="7" r="4" />
                            <path d="M22 11h-6M19 8v6" />
                        </svg>
                    </div>
                    <h3 class="mt-5 font-bold text-secondary">Role-Based Access</h3>
                    <p class="mt-2 text-sm text-muted">Granular permissions for admin, manager, and employee roles.</p>
                </div>

                {{-- Cloud Ready --}}
                <div
                    class="reveal group bg-bg hover:bg-white border border-transparent hover:border-border rounded-2xl p-6 text-center hover:shadow-lift hover:-translate-y-1 transition-all duration-300">
                    <div
                        class="w-14 h-14 mx-auto rounded-2xl bg-white border border-border group-hover:bg-sky-500/10 group-hover:border-sky-500/20 flex items-center justify-center text-primary group-hover:text-sky-600 transition-colors duration-300">
                        <svg class="w-7 h-7" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 10h-1.26A8 8 0 1 0 9 20h9a5 5 0 0 0 0-10z" />
                        </svg>
                    </div>
                    <h3 class="mt-5 font-bold text-secondary">Cloud Ready</h3>
                    <p class="mt-2 text-sm text-muted">Deploy on AWS, GCP, or Azure with one-click provisioning.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ================= CTA ================= --}}
    <section class="py-20 lg:py-28">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div
                class="reveal relative overflow-hidden rounded-3xl bg-gradient-to-br from-primary via-primaryH to-secondary p-10 lg:p-16 text-center shadow-lift">
                <div class="absolute inset-0 opacity-30"
                    style="background-image: radial-gradient(circle at 20% 30%, #ffffff 0%, transparent 40%), radial-gradient(circle at 80% 70%, #60A5FA 0%, transparent 40%);">
                </div>
                <div class="absolute inset-0"
                    style="background-image: linear-gradient(#ffffff10 1px, transparent 1px), linear-gradient(90deg, #ffffff10 1px, transparent 1px); background-size: 40px 40px;">
                </div>

                <div class="relative">
                    <span
                        class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-white/15 text-white text-xs font-semibold border border-white/20 backdrop-blur">
                        <span class="w-1.5 h-1.5 rounded-full bg-white pulse-dot"></span>
                        Free 14-day trial · No credit card
                    </span>
                    <h2 class="mt-6 text-3xl lg:text-5xl font-extrabold text-white tracking-tight leading-tight">Ready
                        to Simplify<br class="hidden sm:block"> HR Management?</h2>
                    <p class="mt-4 text-white/80 text-lg max-w-xl mx-auto">Join thousands of companies already
                        transforming their HR operations with HRIS.</p>
                    <div class="mt-8 flex flex-col sm:flex-row gap-3 justify-center">
                        <a href="#"
                            class="btn-shine inline-flex items-center justify-center gap-2 px-7 py-4 rounded-2xl bg-white hover:bg-bg text-primary font-bold shadow-soft hover:shadow-lift transition-all duration-300">
                            Start Now
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5 12h14M13 5l7 7-7 7" />
                            </svg>
                        </a>
                        <a href="#"
                            class="inline-flex items-center justify-center gap-2 px-7 py-4 rounded-2xl bg-white/10 hover:bg-white/20 text-white font-semibold border border-white/20 backdrop-blur transition-all duration-300">
                            Book a Demo
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ================= FOOTER ================= --}}
    <footer id="contact" class="bg-secondary text-white/80 pt-16 pb-8">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-10 pb-12 border-b border-white/10">
                {{-- Company --}}
                <div>
                    <div class="flex items-center gap-2">
                        <div
                            class="w-9 h-9 rounded-xl bg-gradient-to-br from-primary to-primaryH flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                                <circle cx="9" cy="7" r="4" />
                                <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                                <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                            </svg>
                        </div>
                        <span class="font-bold text-lg text-white">HRIS<span class="text-primary">.</span></span>
                    </div>
                    <p class="mt-4 text-sm leading-relaxed">Modern Human Resource Information System — empowering teams
                        to manage people, time, and payroll with clarity.</p>
                    <div class="mt-5 flex gap-3">
                        @php
                            $socials = [
                                '<path d="M22 4.01c-1 .49-1.98.689-3 .99-1.121-1.265-2.783-1.335-4.38-.737S11.977 6.323 12 8v1c-3.245.083-6.135-1.395-8-4 0 0-4.182 7.433 4 11-1.872 1.247-3.739 2.088-6 2 3.308 1.803 6.913 2.423 10.034 1.517 3.58-1.04 6.522-3.723 7.651-7.742A13.84 13.84 0 0 0 22 4.01z"/>',
                                '<path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-4 0v7h-4v-7a6 6 0 0 1 6-6z"/><rect x="2" y="9" width="4" height="12"/><circle cx="4" cy="4" r="2"/>',
                                '<rect x="2" y="2" width="20" height="20" rx="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/>',
                                '<path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"/>',
                            ];
                        @endphp
                        @foreach ($socials as $path)
                            <a href="#"
                                class="w-9 h-9 rounded-lg bg-white/5 hover:bg-primary border border-white/10 flex items-center justify-center transition-colors duration-300">
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">{!! $path !!}</svg>
                            </a>
                        @endforeach
                    </div>
                </div>

                {{-- Quick Links --}}
                <div>
                    <h4 class="text-white font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2.5 text-sm">
                        <li><a href="#home" class="hover:text-primary transition-colors">Home</a></li>
                        <li><a href="#features" class="hover:text-primary transition-colors">Features</a></li>
                        <li><a href="#about" class="hover:text-primary transition-colors">About</a></li>
                        <li><a href="#" class="hover:text-primary transition-colors">Pricing</a></li>
                        <li><a href="#" class="hover:text-primary transition-colors">Blog</a></li>
                    </ul>
                </div>

                {{-- Legal --}}
                <div>
                    <h4 class="text-white font-semibold mb-4">Legal</h4>
                    <ul class="space-y-2.5 text-sm">
                        <li><a href="#" class="hover:text-primary transition-colors">Privacy Policy</a></li>
                        <li><a href="#" class="hover:text-primary transition-colors">Terms of Service</a></li>
                        <li><a href="#" class="hover:text-primary transition-colors">Cookie Policy</a></li>
                        <li><a href="#" class="hover:text-primary transition-colors">Security</a></li>
                    </ul>
                </div>

                {{-- Contact --}}
                <div>
                    <h4 class="text-white font-semibold mb-4">Contact</h4>
                    <ul class="space-y-3 text-sm">
                        <li class="flex items-start gap-2">
                            <svg class="w-4 h-4 mt-0.5 text-primary" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                                <path d="m22 6-10 7L2 6" />
                            </svg>
                            hello@hris.app
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="w-4 h-4 mt-0.5 text-primary" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path
                                    d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z" />
                            </svg>
                            +62 812 3456 7890
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="w-4 h-4 mt-0.5 text-primary" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
                                <circle cx="12" cy="10" r="3" />
                            </svg>
                            Jakarta, Indonesia
                        </li>
                    </ul>
                </div>
            </div>

            <div class="pt-6 flex flex-col md:flex-row items-center justify-between gap-4 text-xs text-white/50">
                <p>© 2026 HRIS. All rights reserved. Crafted with ♥ for modern HR teams.</p>
                <p>Made with Laravel · Tailwind · Heroicons</p>
            </div>
        </div>
    </footer>

    {{-- ================= SCRIPTS ================= --}}
    <script>
        // Mobile menu toggle
        const toggle = document.getElementById('menuToggle');
        const menu = document.getElementById('mobileMenu');
        const iOpen = document.getElementById('iconOpen');
        const iClose = document.getElementById('iconClose');
        toggle?.addEventListener('click', () => {
            menu.classList.toggle('open');
            iOpen.classList.toggle('hidden');
            iClose.classList.toggle('hidden');
        });
        menu?.querySelectorAll('a').forEach(a => a.addEventListener('click', () => {
            menu.classList.remove('open');
            iOpen.classList.remove('hidden');
            iClose.classList.add('hidden');
        }));

        // Navbar shadow on scroll
        const navbar = document.getElementById('navbar');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 10) navbar.classList.add('shadow-soft');
            else navbar.classList.remove('shadow-soft');
        });

        // Reveal on scroll
        const io = new IntersectionObserver((entries) => {
            entries.forEach(e => {
                if (e.isIntersecting) {
                    e.target.classList.add('is-visible');
                    io.unobserve(e.target);
                }
            });
        }, {
            threshold: 0.12,
            rootMargin: '0px 0px -40px 0px'
        });
        document.querySelectorAll('.reveal').forEach(el => io.observe(el));
    </script>
</body>

</html>
