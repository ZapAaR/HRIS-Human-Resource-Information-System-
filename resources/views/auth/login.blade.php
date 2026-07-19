<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sign in to HRIS — Modern Human Resource Information System.">
    <title>Sign In · HRIS</title>

    {{-- Google Fonts: Inter --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    {{-- Tailwind CSS v4 (Browser CDN for preview — replace with @vite in production) --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'ui-sans-serif', 'system-ui'],
                    },
                    colors: {
                        primary:   '#2563EB',
                        primaryH:  '#1D4ED8',
                        secondary: '#0F172A',
                        bg:        '#F8FAFC',
                        card:      '#FFFFFF',
                        border:    '#E2E8F0',
                        text:      '#1E293B',
                        muted:     '#64748B',
                        success:   '#22C55E',
                        danger:    '#EF4444',
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
        html { scroll-behavior: smooth; }
        body {
            font-family: 'Inter', sans-serif;
            background: #F8FAFC;
            color: #1E293B;
            -webkit-font-smoothing: antialiased;
        }

        /* Gradient text */
        .gradient-text {
            background: linear-gradient(135deg, #ffffff 0%, #BFDBFE 60%, #93C5FD 100%);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        /* Left panel gradient */
        .left-gradient {
            background:
                radial-gradient(circle at 20% 20%, rgba(96, 165, 250, 0.35) 0%, transparent 45%),
                radial-gradient(circle at 80% 80%, rgba(99, 102, 241, 0.35) 0%, transparent 45%),
                linear-gradient(135deg, #1D4ED8 0%, #2563EB 50%, #1E40AF 100%);
        }

        /* Grid pattern overlay */
        .grid-pattern {
            background-image:
                linear-gradient(rgba(255,255,255,0.06) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.06) 1px, transparent 1px);
            background-size: 40px 40px;
        }

        /* Blob */
        .blob {
            position: absolute;
            border-radius: 9999px;
            filter: blur(60px);
            opacity: 0.5;
            pointer-events: none;
        }

        /* Floating animations */
        @keyframes floaty {
            0%, 100% { transform: translateY(0); }
            50%      { transform: translateY(-10px); }
        }
        .float-slow { animation: floaty 6s ease-in-out infinite; }
        .float-mid  { animation: floaty 5s ease-in-out infinite .6s; }
        .float-fast { animation: floaty 4s ease-in-out infinite 1.2s; }

        /* Pulse dot */
        @keyframes pulseDot {
            0%, 100% { box-shadow: 0 0 0 0 rgba(34, 197, 94, .6); }
            50%      { box-shadow: 0 0 0 8px rgba(34, 197, 94, 0); }
        }
        .pulse-dot { animation: pulseDot 2s infinite; }

        /* Bar grow */
        @keyframes barGrow {
            from { transform: scaleY(0); }
            to   { transform: scaleY(1); }
        }
        .bar { transform-origin: bottom; animation: barGrow 1.2s cubic-bezier(.2,.7,.2,1) both; }

        /* Reveal animations */
        .reveal {
            opacity: 0;
            transform: translateY(24px);
            animation: slideUp .8s cubic-bezier(.2,.7,.2,1) forwards;
        }
        .reveal-delay-1 { animation-delay: .1s; }
        .reveal-delay-2 { animation-delay: .2s; }
        .reveal-delay-3 { animation-delay: .3s; }
        .reveal-delay-4 { animation-delay: .4s; }
        .reveal-delay-5 { animation-delay: .5s; }

        @keyframes slideUp {
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to   { opacity: 1; }
        }
        .fade-in { animation: fadeIn 1s ease forwards; }

        /* Button shine */
        .btn-shine {
            position: relative;
            overflow: hidden;
        }
        .btn-shine::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(120deg, transparent 30%, rgba(255,255,255,.25) 50%, transparent 70%);
            transform: translateX(-120%);
            transition: transform .8s ease;
        }
        .btn-shine:hover::after { transform: translateX(120%); }

        /* Focus ring override */
        input:focus { outline: none; }

        /* Custom checkbox */
        .custom-check {
            appearance: none;
            width: 18px;
            height: 18px;
            border: 1.5px solid #CBD5E1;
            border-radius: 5px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all .2s ease;
            flex-shrink: 0;
        }
        .custom-check:checked {
            background: #2563EB;
            border-color: #2563EB;
        }
        .custom-check:checked::after {
            content: '';
            width: 10px;
            height: 10px;
            background-image: url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='white' stroke-width='3' stroke-linecap='round' stroke-linejoin='round'><polyline points='20 6 9 17 4 12'/></svg>");
            background-size: contain;
            background-repeat: no-repeat;
        }

        /* Scrollbar */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #F8FAFC; }
        ::-webkit-scrollbar-thumb { background: #CBD5E1; border-radius: 8px; }
    </style>
</head>
<body class="bg-bg text-text">

    <div class="min-h-screen flex flex-col lg:flex-row">

        {{-- ================= LEFT PANEL (Illustration) ================= --}}
        <section class="relative hidden lg:flex lg:w-1/2 left-gradient overflow-hidden">
            {{-- Grid overlay --}}
            <div class="absolute inset-0 grid-pattern"></div>

            {{-- Blobs --}}
            <div class="blob bg-sky-400/40 w-[300px] h-[300px] -top-20 -left-20"></div>
            <div class="blob bg-indigo-400/40 w-[280px] h-[280px] bottom-10 -right-10"></div>

            {{-- Content --}}
            <div class="relative z-10 flex flex-col justify-between w-full p-10 xl:p-14">

                {{-- Top: Logo --}}
                <div class="reveal fade-in flex items-center gap-2.5">
                    <div class="w-10 h-10 rounded-xl bg-white/15 backdrop-blur border border-white/20 flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                            <circle cx="9" cy="7" r="4"/>
                            <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                        </svg>
                    </div>
                    <span class="font-bold text-lg tracking-tight text-white">HRIS<span class="text-sky-300">.</span></span>
                </div>

                {{-- Middle: Copy + Illustration --}}
                <div class="flex-1 flex flex-col justify-center py-10">
                    <div class="reveal reveal-delay-1">
                        <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-white/10 text-white/90 text-xs font-semibold border border-white/20 backdrop-blur">
                            <span class="w-1.5 h-1.5 rounded-full bg-success pulse-dot"></span>
                            Secure · Enterprise Ready
                        </span>
                    </div>

                    <h1 class="reveal reveal-delay-2 mt-6 text-4xl xl:text-5xl font-extrabold tracking-tight leading-[1.1] text-white">
                        Human Resource <br>
                        <span class="gradient-text">Information System</span>
                    </h1>

                    <p class="reveal reveal-delay-3 mt-5 text-base xl:text-lg text-white/75 leading-relaxed max-w-md">
                        Manage employees, attendance, payroll, leave, overtime, and reports in one integrated platform.
                    </p>

                    {{-- Dashboard Illustration --}}
                    <div class="reveal reveal-delay-4 mt-10 relative">
                        <div class="relative rounded-2xl bg-white/10 backdrop-blur-xl border border-white/20 p-5 shadow-2xl">
                            {{-- Top bar --}}
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center gap-1.5">
                                    <span class="w-2.5 h-2.5 rounded-full bg-danger/80"></span>
                                    <span class="w-2.5 h-2.5 rounded-full bg-warning/80"></span>
                                    <span class="w-2.5 h-2.5 rounded-full bg-success/80"></span>
                                </div>
                                <div class="text-[10px] font-medium text-white/60 px-2.5 py-1 rounded-full bg-white/10">hris.app/dashboard</div>
                                <div class="w-10"></div>
                            </div>

                            <div class="grid grid-cols-3 gap-3">
                                {{-- Employee card --}}
                                <div class="float-slow col-span-2 rounded-xl bg-white/95 p-3.5">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-[10px] text-muted font-medium">Active Employees</p>
                                            <p class="text-xl font-bold text-secondary mt-0.5">1,248</p>
                                            <p class="text-[10px] text-success font-semibold mt-0.5 flex items-center gap-1">
                                                <svg class="w-3 h-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m6 15 6-6 6 6"/></svg>
                                                +12.4%
                                            </p>
                                        </div>
                                        <div class="w-9 h-9 rounded-lg bg-primary/10 flex items-center justify-center">
                                            <svg class="w-4 h-4 text-primary" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
                                        </div>
                                    </div>
                                    <div class="mt-3 flex gap-1 items-end h-10">
                                        <div class="bar flex-1 bg-primary/30 rounded-t" style="height:40%; animation-delay:.1s"></div>
                                        <div class="bar flex-1 bg-primary/40 rounded-t" style="height:60%; animation-delay:.2s"></div>
                                        <div class="bar flex-1 bg-primary/50 rounded-t" style="height:45%; animation-delay:.3s"></div>
                                        <div class="bar flex-1 bg-primary/60 rounded-t" style="height:80%; animation-delay:.4s"></div>
                                        <div class="bar flex-1 bg-primary/70 rounded-t" style="height:65%; animation-delay:.5s"></div>
                                        <div class="bar flex-1 bg-primary/80 rounded-t" style="height:90%; animation-delay:.6s"></div>
                                        <div class="bar flex-1 bg-primary     rounded-t" style="height:100%; animation-delay:.7s"></div>
                                    </div>
                                </div>

                                {{-- Attendance --}}
                                <div class="float-mid rounded-xl bg-white/95 p-3.5">
                                    <p class="text-[10px] text-muted font-medium">Attendance</p>
                                    <p class="text-lg font-bold text-secondary mt-0.5">98%</p>
                                    <div class="mt-2 relative w-12 h-12 mx-auto">
                                        <svg class="w-12 h-12 -rotate-90" viewBox="0 0 36 36">
                                            <circle cx="18" cy="18" r="15" fill="none" stroke="#E2E8F0" stroke-width="3"/>
                                            <circle cx="18" cy="18" r="15" fill="none" stroke="#22C55E" stroke-width="3"
                                                    stroke-dasharray="94.2" stroke-dashoffset="1.9" stroke-linecap="round"/>
                                        </svg>
                                        <div class="absolute inset-0 flex items-center justify-center">
                                            <svg class="w-4 h-4 text-success" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Floating stat cards --}}
                        <div class="hidden xl:flex absolute -left-6 top-8 bg-white rounded-2xl shadow-2xl px-3.5 py-2.5 items-center gap-2.5 float-fast border border-border">
                            <div class="w-9 h-9 rounded-xl bg-primary/10 flex items-center justify-center">
                                <svg class="w-4 h-4 text-primary" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-secondary">1,200+</p>
                                <p class="text-[10px] text-muted">Employees</p>
                            </div>
                        </div>

                        <div class="hidden xl:flex absolute -right-4 top-24 bg-white rounded-2xl shadow-2xl px-3.5 py-2.5 items-center gap-2.5 float-slow border border-border">
                            <div class="w-9 h-9 rounded-xl bg-success/10 flex items-center justify-center">
                                <svg class="w-4 h-4 text-success" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-secondary">98%</p>
                                <p class="text-[10px] text-muted">Attendance</p>
                            </div>
                        </div>

                        <div class="hidden xl:flex absolute -left-4 -bottom-4 bg-white rounded-2xl shadow-2xl px-3.5 py-2.5 items-center gap-2.5 float-mid border border-border">
                            <div class="w-9 h-9 rounded-xl bg-indigo-500/10 flex items-center justify-center">
                                <svg class="w-4 h-4 text-indigo-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="m9 12 2 2 4-4"/></svg>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-secondary">Secure</p>
                                <p class="text-[10px] text-muted">System</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Bottom: Testimonial / Tagline --}}
                <div class="reveal reveal-delay-5 flex items-center gap-4">
                    <div class="flex -space-x-2">
                        <div class="w-9 h-9 rounded-full bg-gradient-to-br from-pink-400 to-rose-500 border-2 border-white/30"></div>
                        <div class="w-9 h-9 rounded-full bg-gradient-to-br from-amber-400 to-orange-500 border-2 border-white/30"></div>
                        <div class="w-9 h-9 rounded-full bg-gradient-to-br from-emerald-400 to-teal-500 border-2 border-white/30"></div>
                    </div>
                    <div class="text-sm">
                        <p class="text-white font-semibold">Trusted by 1,200+ HR teams</p>
                        <p class="text-white/60 text-xs">Across 40+ countries worldwide</p>
                    </div>
                </div>
            </div>
        </section>

        {{-- ================= RIGHT PANEL (Login Form) ================= --}}
        <section class="relative flex-1 flex flex-col min-h-screen">

            {{-- Mobile-only illustration strip --}}
            <div class="lg:hidden left-gradient relative overflow-hidden px-6 pt-8 pb-10">
                <div class="absolute inset-0 grid-pattern"></div>
                <div class="relative z-10">
                    <div class="flex items-center gap-2.5">
                        <div class="w-10 h-10 rounded-xl bg-white/15 backdrop-blur border border-white/20 flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                                <circle cx="9" cy="7" r="4"/>
                                <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                            </svg>
                        </div>
                        <span class="font-bold text-lg tracking-tight text-white">HRIS<span class="text-sky-300">.</span></span>
                    </div>
                    <h2 class="mt-5 text-2xl font-extrabold text-white leading-tight">
                        Human Resource <br><span class="gradient-text">Information System</span>
                    </h2>
                    <p class="mt-2 text-sm text-white/75 max-w-sm">
                        Manage employees, attendance, payroll, leave, overtime, and reports in one integrated platform.
                    </p>

                    {{-- Mini stat pills --}}
                    <div class="mt-5 flex flex-wrap gap-2">
                        <div class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-white/10 border border-white/20 backdrop-blur text-white text-xs font-medium">
                            <svg class="w-3.5 h-3.5 text-sky-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
                            1,200+ Employees
                        </div>
                        <div class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-white/10 border border-white/20 backdrop-blur text-white text-xs font-medium">
                            <svg class="w-3.5 h-3.5 text-emerald-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
                            98% Attendance
                        </div>
                        <div class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-white/10 border border-white/20 backdrop-blur text-white text-xs font-medium">
                            <svg class="w-3.5 h-3.5 text-indigo-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="m9 12 2 2 4-4"/></svg>
                            Secure System
                        </div>
                    </div>
                </div>
            </div>

            {{-- Form container --}}
            <div class="flex-1 flex items-center justify-center px-6 py-10 lg:py-12">
                <div class="w-full max-w-[420px]">

                    {{-- Card --}}
                    <div class="reveal reveal-delay-1 bg-card rounded-2xl shadow-xl border border-border p-8">

                        {{-- Logo (desktop only — shown again in card for branding) --}}
                        <div class="hidden lg:flex items-center gap-2 mb-6">
                            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-primary to-primaryH flex items-center justify-center shadow-soft">
                                <svg class="w-5 h-5 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                                    <circle cx="9" cy="7" r="4"/>
                                    <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                                </svg>
                            </div>
                            <span class="font-bold text-lg tracking-tight text-secondary">HRIS<span class="text-primary">.</span></span>
                        </div>

                        {{-- Heading --}}
                        <div class="mb-7">
                            <h2 class="text-2xl font-bold tracking-tight text-secondary">Welcome Back</h2>
                            <p class="mt-1.5 text-sm text-muted">Sign in to continue to your HRIS dashboard.</p>
                        </div>

                        {{-- Form --}}
                        <form action="#" method="POST" class="space-y-5">
                            @csrf

                            {{-- Email --}}
                            <div class="reveal reveal-delay-2">
                                <label for="email" class="block text-sm font-semibold text-text mb-1.5">Email Address</label>
                                <div class="relative group">
                                    <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-muted group-focus-within:text-primary transition-colors duration-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                                            <path d="m22 6-10 7L2 6"/>
                                        </svg>
                                    </span>
                                    <input
                                        id="email"
                                        name="email"
                                        type="email"
                                        autocomplete="email"
                                        required
                                        placeholder="you@company.com"
                                        class="w-full pl-11 pr-4 py-3 rounded-xl border border-slate-300 bg-white text-text placeholder:text-slate-400 text-sm focus:border-primary focus:ring-4 focus:ring-blue-500/15 transition-all duration-300"
                                    />
                                </div>
                            </div>

                            {{-- Password --}}
                            <div class="reveal reveal-delay-3">
                                <label for="password" class="block text-sm font-semibold text-text mb-1.5">Password</label>
                                <div class="relative group">
                                    <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-muted group-focus-within:text-primary transition-colors duration-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <rect x="3" y="11" width="18" height="11" rx="2"/>
                                            <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                                        </svg>
                                    </span>
                                    <input
                                        id="password"
                                        name="password"
                                        type="password"
                                        autocomplete="current-password"
                                        required
                                        placeholder="Enter your password"
                                        class="w-full pl-11 pr-12 py-3 rounded-xl border border-slate-300 bg-white text-text placeholder:text-slate-400 text-sm focus:border-primary focus:ring-4 focus:ring-blue-500/15 transition-all duration-300"
                                    />
                                    <button
                                        type="button"
                                        id="togglePassword"
                                        aria-label="Toggle password visibility"
                                        class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-muted hover:text-primary transition-colors duration-300"
                                    >
                                        <svg id="eyeOpen" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                            <circle cx="12" cy="12" r="3"/>
                                        </svg>
                                        <svg id="eyeClosed" class="w-5 h-5 hidden" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94"/>
                                            <path d="M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19"/>
                                            <path d="M14.12 14.12a3 3 0 1 1-4.24-4.24"/>
                                            <line x1="1" y1="1" x2="23" y2="23"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            {{-- Remember + Forgot --}}
                            <div class="reveal reveal-delay-4 flex items-center justify-between">
                                <label for="remember" class="flex items-center gap-2 cursor-pointer select-none group">
                                    <input id="remember" name="remember" type="checkbox" class="custom-check"/>
                                    <span class="text-sm text-text group-hover:text-primary transition-colors duration-300">Remember me</span>
                                </label>
                                <a href="#" class="text-sm font-semibold text-primary hover:text-primaryH transition-colors duration-300">
                                    Forgot password?
                                </a>
                            </div>

                            {{-- Submit --}}
                            <div class="reveal reveal-delay-5 pt-1">
                                <button
                                    type="submit"
                                    class="btn-shine w-full inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold shadow-soft hover:shadow-lift hover:scale-[1.01] active:scale-[0.99] transition-all duration-300"
                                >
                                    Sign In
                                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M5 12h14M13 5l7 7-7 7"/>
                                    </svg>
                                </button>
                            </div>

                        </form>
                    </div>

                    {{-- Footer --}}
                    <footer class="reveal reveal-delay-5 mt-6 text-center text-xs text-muted">
                        <p>© 2026 HRIS. All rights reserved.</p>
                        <div class="mt-2 inline-flex items-center gap-3">
                            <a href="#" class="hover:text-primary transition-colors duration-300">Privacy Policy</a>
                            <span class="text-border">·</span>
                            <a href="#" class="hover:text-primary transition-colors duration-300">Terms of Service</a>
                        </div>
                    </footer>
                </div>
            </div>
        </section>
    </div>

    {{-- ================= SCRIPTS ================= --}}
    <script>
        // Password show/hide toggle
        const toggleBtn   = document.getElementById('togglePassword');
        const pwdInput    = document.getElementById('password');
        const eyeOpen     = document.getElementById('eyeOpen');
        const eyeClosed   = document.getElementById('eyeClosed');

        toggleBtn?.addEventListener('click', () => {
            const isPwd = pwdInput.type === 'password';
            pwdInput.type = isPwd ? 'text' : 'password';
            eyeOpen.classList.toggle('hidden', isPwd);
            eyeClosed.classList.toggle('hidden', !isPwd);
            pwdInput.focus();
        });

        // Subtle parallax on left panel illustration (desktop only)
        const leftPanel = document.querySelector('section.left-gradient');
        if (leftPanel && window.matchMedia('(min-width: 1024px)').matches) {
            leftPanel.addEventListener('mousemove', (e) => {
                const rect = leftPanel.getBoundingClientRect();
                const x = (e.clientX - rect.left) / rect.width - 0.5;
                const y = (e.clientY - rect.top) / rect.height - 0.5;
                leftPanel.querySelectorAll('.float-slow, .float-mid, .float-fast').forEach((el, i) => {
                    const depth = (i + 1) * 6;
                    el.style.transform = `translate(${x * depth}px, ${y * depth}px)`;
                });
            });
            leftPanel.addEventListener('mouseleave', () => {
                leftPanel.querySelectorAll('.float-slow, .float-mid, .float-fast').forEach(el => {
                    el.style.transform = '';
                });
            });
        }
    </script>
</body>
</html>
