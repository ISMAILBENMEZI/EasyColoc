<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>All Expenses - EasyColoc</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        input[type="month"]::-webkit-calendar-picker-indicator { cursor: pointer; opacity: 0.6; }
    </style>
</head>

<body class="min-h-screen bg-[#fcfcfd] py-10 px-4">
    <div class="max-w-4xl mx-auto">
        
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-10">
            <div>
                <a href="{{ route('my_colocation.show') }}" 
                   class="group inline-flex items-center gap-2 text-sm font-bold text-slate-500 hover:text-slate-900 transition-colors mb-4">
                    <div class="p-2 rounded-xl bg-white border border-slate-100 group-hover:bg-slate-50 shadow-sm transition-colors">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
                    </div>
                    Back to Dashboard
                </a>
                <h1 class="text-3xl font-black text-slate-900 tracking-tight">Expense History</h1>
                <p class="text-sm font-bold text-slate-400 mt-1">Track and manage all shared spending.</p>
            </div>

            <a href="{{ route('expenses.create') }}"
                class="inline-flex items-center justify-center gap-2 rounded-2xl bg-slate-900 px-6 py-4 text-sm font-black text-white hover:bg-slate-800 shadow-xl shadow-slate-200 transition-all active:scale-95">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                Add New Expense
            </a>
        </div>

        <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm p-6 mb-8">
            <form method="GET" action="{{ route('expenses.index') }}" class="flex flex-wrap items-end gap-4">
                <div class="flex-1 min-w-[200px]">
                    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2 ml-1">Filter by Month</label>
                    <input type="month" name="month" value="{{ $month ?? '' }}"
                        class="w-full rounded-2xl border-slate-100 bg-slate-50/50 px-4 py-3 text-sm font-bold text-slate-900 focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all outline-none" />
                </div>

                <div class="flex items-center gap-2">
                    <button type="submit"
                        class="rounded-2xl bg-blue-600 px-6 py-3 text-sm font-black text-white hover:bg-blue-700 shadow-lg shadow-blue-100 transition-all">
                        Apply
                    </button>

                    @if ($month)
                        <a href="{{ route('expenses.index') }}"
                            class="rounded-2xl bg-slate-100 px-6 py-3 text-sm font-black text-slate-600 hover:bg-slate-200 transition-all">
                            Reset
                        </a>
                    @endif
                </div>
            </form>
        </div>

        <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/40 overflow-hidden">
            @if ($expenses->count() === 0)
                <div class="p-20 text-center">
                    <div class="h-20 w-20 rounded-full bg-slate-50 flex items-center justify-center mx-auto mb-4 text-slate-300">
                        <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
                    </div>
                    <p class="text-lg font-bold text-slate-400">No expenses found</p>
                    <p class="text-sm text-slate-300 mt-1">Try selecting a different month or add a new record.</p>
                </div>
            @else
                <div class="divide-y divide-slate-50">
                    @foreach ($expenses as $expense)
                        <a href="{{ route('expenses.show', $expense->id) }}"
                            class="group block px-8 py-6 hover:bg-slate-50/80 transition-all">
                            <div class="flex items-center justify-between gap-6">
                                
                                <div class="flex items-center gap-5 flex-1 min-w-0">
                                    <div class="hidden sm:flex flex-col items-center justify-center h-14 w-14 rounded-2xl bg-slate-50 text-slate-400 group-hover:bg-white group-hover:text-blue-600 transition-colors border border-transparent group-hover:border-blue-50 shadow-sm">
                                        <span class="text-[10px] font-black uppercase tracking-tighter">{{ \Carbon\Carbon::parse($expense->date)->format('M') }}</span>
                                        <span class="text-lg font-black leading-none">{{ \Carbon\Carbon::parse($expense->date)->format('d') }}</span>
                                    </div>

                                    <div class="truncate">
                                        <div class="flex items-center gap-2 mb-1">
                                            <span class="font-black text-slate-900 group-hover:text-blue-600 transition-colors truncate">{{ $expense->title }}</span>
                                            @if ($expense->category)
                                                <span class="inline-flex px-2 py-0.5 rounded-lg bg-indigo-50 text-indigo-500 text-[9px] font-black uppercase tracking-widest border border-indigo-100/50">
                                                    {{ $expense->category->name }}
                                                </span>
                                            @endif
                                        </div>
                                        <div class="text-xs font-bold text-slate-400 flex items-center gap-2">
                                            <span class="flex items-center gap-1">
                                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                                                {{ $expense->payer?->name ?? 'Unknown' }}
                                            </span>
                                            <span class="text-slate-200">•</span>
                                            <span>{{ \Carbon\Carbon::parse($expense->date)->format('Y') }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-right shrink-0">
                                    <div class="text-lg font-black text-slate-900 tracking-tight group-hover:scale-110 transition-transform origin-right">
                                        {{ number_format((float) $expense->amount, 2) }}
                                        <span class="text-[10px] text-slate-400 uppercase ml-1">MAD</span>
                                    </div>
                                    <div class="text-[10px] font-black text-emerald-500 uppercase tracking-widest opacity-0 group-hover:opacity-100 transition-opacity">
                                        View Details →
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>

        <div class="mt-10 flex justify-center custom-pagination">
            {{ $expenses->links() }}
        </div>
    </div>
</body>

</html>