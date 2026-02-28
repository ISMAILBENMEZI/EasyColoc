<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Archived Colocations - EasyColoc</title>
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
    <main class="max-w-4xl mx-auto px-4 py-12">

        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-6 mb-10">
            <a href="{{ route('dashboard') }}"
                class="group inline-flex items-center gap-3 text-sm font-bold text-slate-500 hover:text-slate-900 transition-all">
                <div
                    class="p-2.5 rounded-2xl bg-white border border-slate-100 group-hover:bg-slate-50 shadow-sm transition-all group-hover:scale-110">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="19" y1="12" x2="5" y2="12" />
                        <polyline points="12 19 5 12 12 5" />
                    </svg>
                </div>
                Dashboard
            </a>

            <div class="text-right">
                <h1 class="text-3xl font-black tracking-tight text-slate-900">Archived History</h1>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mt-1">Your past living
                    experiences</p>
            </div>
        </div>

        <div class="mb-8 bg-blue-50/50 border border-blue-100/50 p-5 rounded-[2rem] flex items-center gap-4">
            <div class="h-10 w-10 rounded-xl bg-blue-100 flex items-center justify-center text-blue-600 shrink-0">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2.5">
                    <circle cx="12" cy="12" r="10" />
                    <line x1="12" y1="16" x2="12" y2="12" />
                    <line x1="12" y1="8" x2="12.01" y2="8" />
                </svg>
            </div>
            <p class="text-xs sm:text-sm text-blue-800 font-bold leading-relaxed">
                These colocations are <span class="underline decoration-blue-200 underline-offset-4">Read-Only</span>.
                You can view historical data but cannot add or edit expenses.
            </p>
        </div>

        <div class="bg-white rounded-[3rem] border border-slate-100 shadow-xl shadow-slate-200/40 overflow-hidden">

            @if ($archivedMemberships->isEmpty())
                <div class="p-20 text-center">
                    <div
                        class="h-20 w-20 rounded-[2rem] bg-slate-50 flex items-center justify-center mx-auto mb-6 text-slate-300 border border-slate-100">
                        <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <path d="M21 8v13H3V8" />
                            <path d="M1 3h22v5H1z" />
                            <path d="M10 12h4" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-black text-slate-900">Archive is empty</h3>
                    <p class="text-sm font-bold text-slate-400 mt-2 max-w-xs mx-auto">Deactivated or left colocations
                        will appear here for your records.</p>
                </div>
            @else
                <div class="divide-y divide-slate-50">
                    @foreach ($archivedMemberships as $m)
                        @php $c = $m->colocation; @endphp

                        <a href="{{ route('colocations.archived.show', $c->id) }}"
                            class="group block p-8 hover:bg-slate-50/80 transition-all duration-300">
                            <div class="flex items-center justify-between gap-6">
                                <div class="flex items-center gap-6 min-w-0">
                                    <div
                                        class="h-16 w-16 rounded-[1.5rem] bg-slate-100 flex items-center justify-center text-slate-400 group-hover:bg-white group-hover:text-slate-600 shadow-inner group-hover:shadow-sm transition-all shrink-0 font-black text-xl">
                                        {{ substr($c->name, 0, 1) }}
                                    </div>

                                    <div class="min-w-0">
                                        <div class="flex items-center gap-3 mb-1">
                                            <h2
                                                class="text-lg font-black text-slate-900 truncate tracking-tight group-hover:text-blue-600 transition-colors">
                                                {{ $c->name }}
                                            </h2>
                                            <span
                                                class="text-[9px] font-black uppercase tracking-widest px-2.5 py-1 rounded-lg bg-slate-100 text-slate-400 border border-slate-200 group-hover:bg-slate-900 group-hover:text-white group-hover:border-slate-900 transition-all">
                                                Archived
                                            </span>
                                        </div>

                                        <div class="flex items-center gap-2 text-sm text-slate-500 font-semibold">
                                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2.5">
                                                <rect x="3" y="4" width="18" height="18" rx="2"
                                                    ry="2" />
                                                <line x1="16" y1="2" x2="16" y2="6" />
                                                <line x1="8" y1="2" x2="8" y2="6" />
                                                <line x1="3" y1="10" x2="21" y2="10" />
                                            </svg>
                                            Settled on <span
                                                class="text-slate-900">{{ \Carbon\Carbon::parse($m->left_at)->format('M d, Y') }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div
                                    class="shrink-0 h-12 w-12 rounded-full border border-slate-100 flex items-center justify-center text-slate-300 group-hover:text-slate-900 group-hover:border-slate-900 group-hover:translate-x-1 transition-all">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="3" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <polyline points="9 18 15 12 9 6" />
                                    </svg>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>

        <div class="mt-12 text-center">
            <div
                class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white border border-slate-100 shadow-sm">
                <span class="h-2 w-2 rounded-full bg-slate-300"></span>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.3em]">
                    EasyColoc Financial Vault
                </p>
            </div>
        </div>

    </main>
</body>

</html>
