<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard - EasyColoc</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .dashboard-card:hover .icon-container {
            transform: scale(1.1) rotate(-5deg);
        }
    </style>
</head>

<body class="min-h-screen bg-slate-50/50">
    <nav
        class="sticky top-0 z-50 bg-white border-b border-slate-200/60 shadow-sm shadow-slate-200/20 backdrop-blur-lg bg-white/90">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <a href="{{ url('/') }}" class="flex items-center gap-2.5 group transition-all">
                    <div
                        class="h-10 w-10 rounded-xl bg-gradient-to-br from-blue-600 to-blue-700 flex items-center justify-center shadow-lg shadow-blue-200 group-hover:shadow-blue-300 transition-all">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="white"
                            stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                            <polyline points="9 22 9 12 15 12 15 22" />
                        </svg>
                    </div>
                    <span class="text-xl font-extrabold tracking-tight text-slate-900">
                        Easy<span class="text-blue-600">Coloc</span>
                    </span>
                </a>

                <div class="flex items-center gap-5">
                    <a href="{{ route('profile.edit') }}"
                        class="text-sm font-bold text-slate-600 hover:text-blue-600 transition">
                        Account Settings
                    </a>

                    <a href="{{ route('colocations.archived.index') }}"
                        class="text-sm font-bold text-blue-600 hover:underline">
                        Archived colocations →
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="flex items-center gap-2 text-sm font-bold text-white bg-slate-900 hover:bg-slate-800 px-5 py-2.5 rounded-xl transition-all shadow-md active:scale-95">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                                <polyline points="16 17 21 12 16 7" />
                                <line x1="21" y1="12" x2="9" y2="12" />
                            </svg>
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <main class="py-12 sm:py-20">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="mb-12">
                <span
                    class="inline-block py-1 px-3 rounded-full bg-blue-50 text-blue-700 text-xs font-bold uppercase tracking-widest mb-4">Control
                    Panel</span>
                <h1 class="text-3xl sm:text-5xl font-black text-slate-900 tracking-tight leading-tight">
                    Welcome back, <span class="text-blue-600">{{ auth()->user()->name }}</span>
                </h1>
                <p class="mt-4 text-slate-500 text-lg max-w-2xl font-medium">
                    Manage your shared living expenses, tasks, and communications from one central place.
                </p>
            </div>

            @if (session('status'))
                <div
                    class="mb-8 p-4 rounded-2xl border border-emerald-100 bg-emerald-50 flex items-center gap-3 text-emerald-800 font-semibold text-sm">
                    <svg class="h-5 w-5 text-emerald-500" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd" />
                    </svg>
                    {{ session('status') }}
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                @if (!$activeMembership)
                    <a href="{{ route('colocations.create') }}"
                        class="dashboard-card group relative overflow-hidden bg-white border border-slate-200 rounded-[2.5rem] p-8 transition-all hover:border-blue-400 hover:shadow-2xl hover:shadow-blue-100">
                        <div class="relative z-10">
                            <div
                                class="icon-container h-14 w-14 rounded-2xl bg-blue-600 flex items-center justify-center mb-6 transition-all duration-300">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white"
                                    stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="12" y1="5" x2="12" y2="19"></line>
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-slate-900 mb-2">Create Colocation</h3>
                            <p class="text-slate-500 font-medium leading-relaxed">Setup a new workspace for your home,
                                invite roommates, and start tracking everything.</p>
                            <div
                                class="mt-8 flex items-center gap-2 text-blue-600 font-extrabold text-sm uppercase tracking-wider">
                                Start Setup
                                <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24" stroke-width="3">
                                    <path d="M5 12h14M12 5l7 7-7 7"></path>
                                </svg>
                            </div>
                        </div>
                    </a>

                    <a href="{{ route('invitations.join.form') }}"
                        class="dashboard-card group relative overflow-hidden bg-white border border-slate-200 rounded-[2.5rem] p-8 transition-all hover:border-indigo-400 hover:shadow-2xl hover:shadow-indigo-100">
                        <div class="relative z-10">
                            <div
                                class="icon-container h-14 w-14 rounded-2xl bg-indigo-600 flex items-center justify-center mb-6 transition-all duration-300">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white"
                                    stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4" />
                                    <polyline points="10 17 15 12 10 7" />
                                    <line x1="15" y1="12" x2="3" y2="12" />
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-slate-900 mb-2">Join with Token</h3>
                            <p class="text-slate-500 font-medium leading-relaxed">Already invited? Enter your unique
                                access token to connect with your existing roommates.</p>
                            <div
                                class="mt-8 flex items-center gap-2 text-indigo-600 font-extrabold text-sm uppercase tracking-wider">
                                Access Now
                                <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24" stroke-width="3">
                                    <path d="M5 12h14M12 5l7 7-7 7"></path>
                                </svg>
                            </div>
                        </div>
                    </a>
                @else
                    <a href="{{ route('my_colocation.show') }}"
                        class="dashboard-card group md:col-span-2 relative overflow-hidden bg-white border border-slate-200 rounded-[3rem] p-10 transition-all hover:border-emerald-400 hover:shadow-2xl hover:shadow-emerald-100">
                        <div class="flex flex-col md:flex-row md:items-center justify-between gap-8">
                            <div class="flex items-center gap-6">
                                <div
                                    class="icon-container h-20 w-20 rounded-3xl bg-emerald-600 flex items-center justify-center shadow-lg shadow-emerald-200 transition-all duration-500">
                                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none"
                                        stroke="white" stroke-width="2.5" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                                        <polyline points="9 22 9 12 15 12 15 22" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-3xl font-black text-slate-900 leading-none mb-2">
                                        {{ $activeColocation?->name }}
                                    </h3>
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full bg-emerald-50 text-emerald-700 text-xs font-bold uppercase tracking-tighter">
                                        Active • Role: {{ $activeMembership->role }}
                                    </span>
                                </div>
                            </div>
                            <div class="flex flex-col items-end">
                                <span
                                    class="text-emerald-600 font-black text-lg group-hover:translate-x-2 transition-transform">Enter
                                    Workspace →</span>
                            </div>
                        </div>
                    </a>
                @endif
            </div>
        </div>
    </main>
</body>

</html>
