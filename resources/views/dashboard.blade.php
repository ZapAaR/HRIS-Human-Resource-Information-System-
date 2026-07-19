@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
    <div class="space-y-6">
        {{-- Page Header --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl lg:text-3xl font-bold text-slate-900">Dashboard</h1>
                <p class="text-slate-500 mt-1">Selamat datang kembali, {{ auth()->user()->name ?? 'User' }} 👋</p>
            </div>
            <div class="flex items-center gap-2 text-sm text-slate-500">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25" /></svg>
                <span>{{ now()->format('d M Y') }}</span>
            </div>
        </div>

        {{-- Stats Grid --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            @php
                $stats = [
                    ['label' => 'Total Employees', 'value' => '1,248', 'change' => '+12%', 'icon' => 'users', 'color' => 'blue'],
                    ['label' => 'Present Today', 'value' => '1,180', 'change' => '+3%', 'icon' => 'check', 'color' => 'green'],
                    ['label' => 'On Leave', 'value' => '42', 'change' => '-5%', 'icon' => 'calendar', 'color' => 'orange'],
                    ['label' => 'Pending Requests', 'value' => '18', 'change' => '+8%', 'icon' => 'clock', 'color' => 'purple'],
                ];
                $colors = [
                    'blue'   => 'bg-blue-50 text-blue-600',
                    'green'  => 'bg-green-50 text-green-600',
                    'orange' => 'bg-orange-50 text-orange-600',
                    'purple' => 'bg-purple-50 text-purple-600',
                ];
            @endphp

            @foreach($stats as $stat)
                <div class="bg-white rounded-xl p-5 border border-slate-100 shadow-sm hover:shadow-md transition">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-11 h-11 rounded-xl {{ $colors[$stat['color']] }} flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                @if($stat['icon'] === 'users')
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                                @elseif($stat['icon'] === 'check')
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                @elseif($stat['icon'] === 'calendar')
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                                @else
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                @endif
                            </svg>
                        </div>
                        <span class="text-xs font-medium text-green-600 bg-green-50 px-2 py-1 rounded-lg">{{ $stat['change'] }}</span>
                    </div>
                    <p class="text-2xl font-bold text-slate-900">{{ $stat['value'] }}</p>
                    <p class="text-sm text-slate-500 mt-1">{{ $stat['label'] }}</p>
                </div>
            @endforeach
        </div>

        {{-- Content Grid --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            {{-- Recent Activity --}}
            <div class="lg:col-span-2 bg-white rounded-xl border border-slate-100 shadow-sm">
                <div class="p-5 border-b border-slate-100 flex items-center justify-between">
                    <h2 class="font-semibold text-slate-900">Recent Activity</h2>
                    <a href="#" class="text-sm text-[#2563EB] hover:text-[#1D4ED8] font-medium">View all</a>
                </div>
                <div class="divide-y divide-slate-100">
                    @foreach(['John Doe requested annual leave', 'Sarah approved overtime request', 'New employee onboarding completed', 'Payroll processed for July', 'Team meeting scheduled'] as $i => $activity)
                        <div class="p-4 flex items-center gap-3 hover:bg-slate-50 transition">
                            <div class="w-9 h-9 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-slate-900 truncate">{{ $activity }}</p>
                                <p class="text-xs text-slate-500">{{ now()->subMinutes($i * 15)->diffForHumans() }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Quick Actions --}}
            <div class="bg-white rounded-xl border border-slate-100 shadow-sm">
                <div class="p-5 border-b border-slate-100">
                    <h2 class="font-semibold text-slate-900">Quick Actions</h2>
                </div>
                <div class="p-4 grid grid-cols-2 gap-3">
                    @foreach([
                        ['label' => 'Request Leave', 'color' => 'bg-blue-50 text-blue-600 hover:bg-blue-100'],
                        ['label' => 'Clock In', 'color' => 'bg-green-50 text-green-600 hover:bg-green-100'],
                        ['label' => 'View Payslip', 'color' => 'bg-purple-50 text-purple-600 hover:bg-purple-100'],
                        ['label' => 'Overtime', 'color' => 'bg-orange-50 text-orange-600 hover:bg-orange-100'],
                    ] as $action)
                        <button class="{{ $action['color'] }} p-4 rounded-xl text-sm font-medium transition text-center">
                            {{ $action['label'] }}
                        </button>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
