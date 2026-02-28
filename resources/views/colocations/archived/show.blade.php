<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Archived - {{ $colocation->name }}</title>
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
    <main class="max-w-6xl mx-auto px-4 py-10">

        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-8">
            <a href="{{ route('colocations.archived.index') }}"
                class="group inline-flex items-center gap-2.5 text-sm font-bold text-slate-500 hover:text-slate-900 transition-colors">
                <div
                    class="p-2 rounded-xl bg-white border border-slate-100 group-hover:bg-slate-50 shadow-sm transition-transform group-hover:-translate-x-1">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="19" y1="12" x2="5" y2="12" />
                        <polyline points="12 19 5 12 12 5" />
                    </svg>
                </div>
                Back to Archive
            </a>

            <div class="md:text-right">
                <div
                    class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-slate-900 text-[10px] font-black uppercase tracking-widest text-white mb-3">
                    <span class="relative flex h-2 w-2">
                        <span
                            class="animate-ping absolute inline-flex h-full w-full rounded-full bg-slate-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-slate-500"></span>
                    </span>
                    Historical Data
                </div>
                <h1 class="text-4xl font-black tracking-tight text-slate-900 italic">{{ $colocation->name }}</h1>
            </div>
        </div>

        <div
            class="mb-8 bg-white/50 backdrop-blur-sm border-2 border-dashed border-slate-200 p-6 rounded-[2.5rem] flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div class="flex items-center gap-4">
                <div
                    class="h-12 w-12 rounded-2xl bg-slate-100 flex items-center justify-center text-slate-500 shadow-inner">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
                    </svg>
                </div>
                <div>
                    <h2 class="text-sm font-black text-slate-900 uppercase tracking-tight">Read-Only Archive</h2>
                    <p class="text-xs text-slate-500 font-bold">This record was finalized and cannot be modified.</p>
                </div>
            </div>
            <div
                class="text-[11px] font-black text-slate-400 uppercase tracking-[0.2em] bg-white px-4 py-2 rounded-xl border border-slate-100">
                EasyColoc Secure Vault
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
            <div
                class="p-8 rounded-[2rem] bg-white border border-slate-100 shadow-sm hover:shadow-md transition-shadow">
                <p class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3">Community</p>
                <div class="flex items-end justify-between">
                    <span class="text-4xl font-black text-slate-900 tracking-tighter">{{ $membersCount }}</span>
                    <span class="text-xs font-bold text-slate-400">Members</span>
                </div>
            </div>

            <div
                class="p-8 rounded-[2rem] bg-white border border-slate-100 shadow-sm hover:shadow-md transition-shadow">
                <p class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3">Total Spending</p>
                <div class="flex flex-col">
                    <span
                        class="text-3xl font-black text-blue-600 tracking-tighter">{{ number_format($totalExpenses, 2) }}</span>
                    <span class="text-[10px] font-bold text-slate-400 mt-1">MAD OVERALL</span>
                </div>
            </div>

            <div class="p-8 rounded-[2rem] bg-red-50/50 border border-red-100 shadow-sm">
                <p class="text-[10px] font-black uppercase tracking-widest text-red-400 mb-3">Unsettled Debts</p>
                <div class="flex flex-col">
                    <span
                        class="text-3xl font-black text-red-600 tracking-tighter">{{ number_format($pendingDebtsTotal, 2) }}</span>
                    <span
                        class="text-[10px] font-bold text-red-400 mt-1 uppercase leading-none">{{ $pendingDebtsCount }}
                        Pending Items</span>
                </div>
            </div>

            <div class="p-8 rounded-[2rem] bg-emerald-50/50 border border-emerald-100 shadow-sm">
                <p class="text-[10px] font-black uppercase tracking-widest text-emerald-500 mb-3">Paid Back</p>
                <div class="flex flex-col">
                    <span
                        class="text-3xl font-black text-emerald-600 tracking-tighter">{{ number_format($paymentsTotal, 2) }}</span>
                    <span
                        class="text-[10px] font-bold text-emerald-500 mt-1 uppercase leading-none">{{ $paymentsCount }}
                        Transactions</span>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

            <div class="lg:col-span-4 space-y-8">
                <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden">
                    <div class="p-6 border-b border-slate-50 bg-slate-50/50">
                        <h3 class="text-sm font-black text-slate-900 uppercase tracking-tight">Living Group</h3>
                    </div>
                    <div class="p-6 space-y-4">
                        @foreach ($members as $m)
                            <div class="flex items-center gap-4 group">
                                <div
                                    class="h-10 w-10 rounded-xl bg-slate-100 flex items-center justify-center text-xs font-black text-slate-500 group-hover:bg-blue-600 group-hover:text-white transition-colors uppercase">
                                    {{ substr($m->user->name, 0, 1) }}
                                </div>
                                <div class="min-w-0 flex-1">
                                    <div class="text-sm font-black text-slate-800 truncate flex items-center gap-2">
                                        {{ $m->user->name }}
                                        @if ($m->role === 'owner')
                                            <svg width="12" height="12" viewBox="0 0 24 24" fill="#fbbf24"
                                                class="text-amber-400">
                                                <path
                                                    d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                                            </svg>
                                        @endif
                                    </div>
                                    <div class="text-[10px] text-slate-400 font-bold uppercase tracking-tighter">
                                        {{ $m->role }}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm p-8">
                    <h3 class="text-sm font-black text-slate-900 uppercase tracking-tight mb-6">Top Categories</h3>
                    <div class="space-y-5">
                        @foreach ($topCategories as $cat)
                            <div>
                                <div class="flex justify-between text-[11px] font-black uppercase mb-2">
                                    <span class="text-slate-600">{{ $cat->name }}</span>
                                    <span class="text-slate-400">{{ $cat->expenses_count }} Exp</span>
                                </div>
                                <div class="h-1.5 w-full bg-slate-100 rounded-full overflow-hidden">
                                    <div class="h-full bg-slate-900 rounded-full"
                                        style="width: {{ ($cat->expenses_count / max($expensesCount, 1)) * 100 }}%">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="lg:col-span-8 space-y-8">

                <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden">
                    <div class="p-8 border-b border-slate-50 flex items-center justify-between">
                        <h3 class="text-sm font-black text-slate-900 uppercase tracking-tight">Expense Logs</h3>
                        <span class="text-[10px] font-bold text-slate-400">SHOWING LAST 5</span>
                    </div>
                    <div class="divide-y divide-slate-50">
                        @forelse ($latestExpenses as $e)
                            <div
                                class="p-8 flex items-center justify-between group hover:bg-slate-50/50 transition-all">
                                <div class="flex items-center gap-5">
                                    <div
                                        class="h-12 w-12 rounded-2xl bg-slate-50 flex items-center justify-center text-slate-400 border border-slate-100 group-hover:scale-110 transition-transform">
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2.5">
                                            <path
                                                d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="text-sm font-black text-slate-900">{{ $e->title }}</div>
                                        <div
                                            class="text-[11px] font-bold text-slate-400 mt-0.5 uppercase tracking-tighter">
                                            Paid by <span class="text-blue-600">{{ $e->payer?->name }}</span> •
                                            {{ \Carbon\Carbon::parse($e->date)->format('M d, Y') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <div class="text-base font-black text-slate-900">
                                        {{ number_format($e->amount, 2) }}</div>
                                    <div class="text-[9px] font-black text-slate-400 uppercase">MAD</div>
                                </div>
                            </div>
                        @empty
                            <p class="p-10 text-center text-slate-400 font-bold">No expenses found.</p>
                        @endforelse
                    </div>
                </div>

                <div class="bg-slate-900 rounded-[2.5rem] shadow-xl overflow-hidden">
                    <div class="p-8 border-b border-white/5 flex items-center justify-between">
                        <h3 class="text-sm font-black text-white uppercase tracking-tight">Payment Settled</h3>
                        <div class="h-2 w-2 rounded-full bg-emerald-500 animate-pulse"></div>
                    </div>
                    <div class="divide-y divide-white/5">
                        @forelse ($latestPayments as $p)
                            <div class="p-8 flex items-center justify-between">
                                <div class="flex items-center gap-4 text-sm font-bold">
                                    <span class="text-slate-400">{{ $p->fromUser?->name }}</span>
                                    <div class="px-2 py-0.5 rounded bg-white/10 text-[10px] text-emerald-400">PAID
                                    </div>
                                    <span class="text-white">{{ $p->toUser?->name }}</span>
                                </div>
                                <div class="text-right font-black text-emerald-400">
                                    + {{ number_format($p->amount, 2) }} <span class="text-[10px] ml-1">MAD</span>
                                </div>
                            </div>
                        @empty
                            <p class="p-10 text-center text-white/30 font-bold">No payment history.</p>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>

        <div class="mt-16 text-center">
            <p class="text-[10px] font-black text-slate-300 uppercase tracking-[0.4em]">
                Verified by EasyColoc Financial Ledger System
            </p>
        </div>

    </main>
</body>

</html>
