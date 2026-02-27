<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Expense - {{ $expense->title }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>

<body class="min-h-screen bg-[#fcfcfd] py-10">
    <div class="max-w-3xl mx-auto px-4">

        <div class="flex items-center justify-between mb-8">
            <a href="{{ route('my_colocation.show') }}"
                class="group inline-flex items-center gap-2.5 text-sm font-bold text-slate-500 hover:text-slate-900 transition-colors">
                <div
                    class="p-2 rounded-xl bg-white border border-slate-100 group-hover:bg-slate-50 shadow-sm transition-colors">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="19" y1="12" x2="5" y2="12" />
                        <polyline points="12 19 5 12 12 5" />
                    </svg>
                </div>
                Back to Dashboard
            </a>

            @if (session('status'))
                <div
                    class="px-4 py-2 rounded-xl bg-emerald-50 text-emerald-600 text-xs font-black uppercase tracking-wider border border-emerald-100 animate-bounce">
                    {{ session('status') }}
                </div>
            @endif
        </div>

        <div
            class="bg-white rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/40 overflow-hidden mb-8">
            <div class="p-8 sm:p-10">
                <div class="flex flex-col md:flex-row md:items-start justify-between gap-6">
                    <div>
                        @if ($expense->category)
                            <span
                                class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-indigo-50 text-indigo-600 text-[10px] font-black uppercase tracking-widest border border-indigo-100 mb-4">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="3">
                                    <path
                                        d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z" />
                                    <line x1="7" y1="7" x2="7.01" y2="7" />
                                </svg>
                                {{ $expense->category->name }}
                            </span>
                        @endif

                        <h1 class="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight mb-2">
                            {{ $expense->title }}</h1>

                        <p class="text-sm font-bold text-slate-400">
                            Created on {{ \Carbon\Carbon::parse($expense->date)->format('M d, Y') }} by
                            <span class="text-slate-900">{{ $expense->creator?->name ?? 'Unknown' }}</span>
                        </p>
                    </div>

                    <div class="text-left md:text-right">
                        <div class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-1">Total Amount
                        </div>
                        <div class="text-4xl font-black text-slate-900 tracking-tighter">
                            {{ number_format((float) $expense->amount, 2) }} <span
                                class="text-lg text-slate-400 uppercase">MAD</span>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-10 pt-8 border-t border-slate-50">
                    <div class="flex items-center gap-4 p-4 rounded-2xl bg-blue-50/50 border border-blue-100">
                        <div
                            class="h-10 w-10 rounded-xl bg-blue-600 text-white flex items-center justify-center shadow-lg shadow-blue-200">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2.5">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                                <circle cx="12" cy="7" r="4" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-blue-400 uppercase tracking-widest">Payer</p>
                            <p class="text-sm font-black text-blue-900">{{ $expense->payer?->name ?? 'Unknown' }}</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-4 p-4 rounded-2xl bg-emerald-50/50 border border-emerald-100">
                        <div
                            class="h-10 w-10 rounded-xl bg-emerald-600 text-white flex items-center justify-center shadow-lg shadow-emerald-200">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2.5">
                                <circle cx="12" cy="12" r="10" />
                                <path d="M16 8l-4 4-4-4" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-emerald-400 uppercase tracking-widest">Individual
                                Share</p>
                            <p class="text-sm font-black text-emerald-900">{{ number_format((float) $share, 2) }} MAD
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/40 overflow-hidden">
            <div class="px-8 py-6 border-b border-slate-50 flex items-center justify-between bg-slate-50/30">
                <h2 class="text-xs font-black text-slate-400 uppercase tracking-[0.2em]">Debt Distribution</h2>
                <span
                    class="px-2 py-1 rounded-md bg-white text-[10px] font-black text-slate-500 shadow-sm border border-slate-100">
                    {{ $membersCount }} Members Involved
                </span>
            </div>

            @if (empty($debts))
                <div class="p-12 text-center">
                    <div
                        class="h-12 w-12 rounded-full bg-slate-50 flex items-center justify-center mx-auto mb-4 text-slate-300">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <circle cx="12" cy="12" r="10" />
                            <line x1="12" y1="8" x2="12" y2="12" />
                            <line x1="12" y1="16" x2="12.01" y2="16" />
                        </svg>
                    </div>
                    <p class="text-sm font-bold text-slate-400 italic">No debts found. Only the payer is involved.</p>
                </div>
            @else
                <div class="divide-y divide-slate-50">
                    @foreach ($debts as $d)
                        <div
                            class="px-8 py-6 flex items-center justify-between group hover:bg-slate-50/50 transition-colors">
                            <div class="flex items-center gap-4">
                                <div
                                    class="h-10 w-10 rounded-full bg-slate-100 flex items-center justify-center text-xs font-black text-slate-500 border-2 border-white shadow-sm">
                                    {{ substr($d['from_user']->name, 0, 1) }}
                                </div>
                                <div class="flex items-center gap-3">
                                    <span class="text-sm font-black text-slate-900">{{ $d['from_user']->name }}</span>
                                    <svg class="text-slate-300" width="16" height="16" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <line x1="5" y1="12" x2="19" y2="12" />
                                        <polyline points="12 5 19 12 12 19" />
                                    </svg>
                                    <span class="text-xs font-bold text-slate-400 italic">Owes to Payer</span>
                                </div>
                            </div>

                            <div class="text-right">
                                <div class="text-sm font-black text-slate-900 bg-slate-100 px-3 py-1 rounded-lg">
                                    {{ number_format((float) $d['amount'], 2) }} <span
                                        class="text-[10px] text-slate-400">MAD</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <p class="mt-8 text-center text-[10px] font-black text-slate-300 uppercase tracking-widest">
            EasyColoc • Smart Expense Manager
        </p>
    </div>
</body>

</html>
