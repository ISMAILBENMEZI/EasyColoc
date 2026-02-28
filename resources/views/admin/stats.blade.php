<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Stats - EasyColoc</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .bg-pattern {
            background-image: radial-gradient(#e5e7eb 1px, transparent 1px);
            background-size: 30px 30px;
        }
    </style>
</head>

<body class="bg-[#fcfcfd] bg-pattern min-h-screen">
    <main class="max-w-6xl mx-auto px-4 py-12">

        <div class="flex items-center justify-between gap-4 mb-10">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="flex items-center gap-2 px-4 py-2 rounded-xl bg-red-50 text-red-600 hover:bg-red-600 hover:text-white font-bold text-xs transition-all border border-red-100">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2.5">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                        <polyline points="16 17 21 12 16 7" />
                        <line x1="21" y1="12" x2="9" y2="12" />
                    </svg>
                    Log Out
                </button>
            </form>

            <div class="text-right">
                <div class="text-[10px] font-black uppercase tracking-[0.2em] text-blue-600 mb-1">System Intelligence
                </div>
                <h1 class="text-3xl font-black text-slate-900 tracking-tight">Global Statistics</h1>
            </div>
        </div>

        @if (session('status'))
            <div
                class="mb-8 p-4 rounded-2xl bg-emerald-500 text-white font-bold text-sm shadow-lg shadow-emerald-200/50 flex items-center gap-3">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="3">
                    <polyline points="20 6 9 17 4 12" />
                </svg>
                {{ session('status') }}
            </div>
        @endif

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <div
                class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm hover:shadow-md transition-shadow">
                <div class="h-12 w-12 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center mb-5">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                        <circle cx="9" cy="7" r="4" />
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
                        <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                    </svg>
                </div>
                <div class="text-xs font-black uppercase tracking-widest text-slate-400">Total Users</div>
                <div class="mt-2 text-4xl font-black text-slate-900 tracking-tighter">{{ $totalUsers }}</div>
                <div class="mt-4 flex items-center gap-2">
                    <span class="px-2 py-1 rounded-md bg-red-50 text-red-600 text-[10px] font-black uppercase">Banned:
                        {{ $bannedUsers }}</span>
                </div>
            </div>

            <div
                class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm hover:shadow-md transition-shadow">
                <div class="h-12 w-12 rounded-2xl bg-purple-50 text-purple-600 flex items-center justify-center mb-5">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2">
                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                        <polyline points="9 22 9 12 15 12 15 22" />
                    </svg>
                </div>
                <div class="text-xs font-black uppercase tracking-widest text-slate-400">Total Colocs</div>
                <div class="mt-2 text-4xl font-black text-slate-900 tracking-tighter">{{ $totalColocations }}</div>
                <div class="mt-4 text-[10px] font-bold text-slate-500 uppercase tracking-tight">
                    <span class="text-emerald-600">{{ $activeColocations }} Active</span> • {{ $inactiveColocations }}
                    Inactive
                </div>
            </div>

            <div
                class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm hover:shadow-md transition-shadow">
                <div class="h-12 w-12 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center mb-5">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2">
                        <line x1="12" y1="1" x2="12" y2="23" />
                        <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6" />
                    </svg>
                </div>
                <div class="text-xs font-black uppercase tracking-widest text-slate-400">Total Expenses</div>
                <div class="mt-2 text-4xl font-black text-slate-900 tracking-tighter">{{ $totalExpenses }}</div>
                <div class="mt-4 text-[11px] font-black text-slate-900">
                    {{ number_format((float) $sumExpenses, 2) }} <span class="text-slate-400">MAD</span>
                </div>
            </div>

            <div
                class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm hover:shadow-md transition-shadow">
                <div class="h-12 w-12 rounded-2xl bg-red-50 text-red-600 flex items-center justify-center mb-5">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2">
                        <circle cx="12" cy="12" r="10" />
                        <line x1="12" y1="8" x2="12" y2="12" />
                        <line x1="12" y1="16" x2="12.01" y2="16" />
                    </svg>
                </div>
                <div class="text-xs font-black uppercase tracking-widest text-slate-400">Pending Debts</div>
                <div class="mt-2 text-4xl font-black text-red-600 tracking-tighter">{{ $totalDebtsPending }}</div>
                <div class="mt-4 text-[11px] font-black text-slate-900">
                    {{ number_format((float) $sumDebtsPending, 2) }} <span class="text-slate-400">MAD</span>
                </div>
            </div>
        </div>

        <div class="mt-8 grid grid-cols-1 lg:grid-cols-12 gap-6">
            <div class="lg:col-span-4 bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm">
                <div class="text-xs font-black uppercase tracking-widest text-slate-400 mb-4">Total Payments</div>
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-3xl font-black text-slate-900">{{ $totalPayments }}</div>
                        <div class="text-xs font-bold text-emerald-600 mt-1">+
                            {{ number_format((float) $sumPayments, 2) }} MAD</div>
                    </div>
                    <div
                        class="h-12 w-12 rounded-full border-4 border-emerald-50 border-t-emerald-500 animate-spin-slow">
                    </div>
                </div>
            </div>

            <div class="lg:col-span-4 bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm">
                <div class="text-xs font-black uppercase tracking-widest text-slate-400 mb-4">Invitations Sent</div>
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-3xl font-black text-slate-900">{{ $totalInvitations }}</div>
                        <div class="text-xs font-bold text-slate-500 mt-1">{{ $pendingInvitations }} Still Pending
                        </div>
                    </div>
                    <div class="p-3 bg-slate-50 rounded-2xl text-slate-400">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                            <polyline points="22,6 12,13 2,6" />
                        </svg>
                    </div>
                </div>
            </div>

            <div
                class="lg:col-span-4 bg-slate-900 p-8 rounded-[2.5rem] shadow-xl shadow-slate-200 text-white relative overflow-hidden group">
                <div class="relative z-10">
                    <div
                        class="text-xs font-black uppercase tracking-widest text-white/50 mb-6 text-center lg:text-left">
                        Quick Actions</div>
                    <div class="space-y-3">
                        <a href="{{ route('admin.users') }}"
                            class="flex items-center justify-between bg-white/10 hover:bg-white/20 px-6 py-4 rounded-2xl font-black text-sm transition-all hover:scale-[1.02] active:scale-95 group">
                            <span>Manage All Users</span>
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="3"
                                class="group-hover:translate-x-1 transition-transform">
                                <line x1="5" y1="12" x2="19" y2="12" />
                                <polyline points="12 5 19 12 12 19" />
                            </svg>
                        </a>
                    </div>
                </div>
                <div class="absolute -right-4 -bottom-4 h-24 w-24 bg-blue-500/10 rounded-full blur-3xl"></div>
            </div>
        </div>

        <div class="mt-16 text-center">
            <div
                class="inline-flex items-center gap-3 px-5 py-2 rounded-full bg-white border border-slate-100 shadow-sm">
                <span class="relative flex h-2 w-2">
                    <span
                        class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-blue-500"></span>
                </span>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.3em]">
                    EasyColoc Core Engine v3.0
                </p>
            </div>
        </div>

    </main>

    <style>
        .animate-spin-slow {
            animation: spin 8s linear infinite;
        }

        @keyframes spin {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }
    </style>
</body>

</html>
