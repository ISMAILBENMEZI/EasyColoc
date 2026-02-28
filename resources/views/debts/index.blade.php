<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Debts - EasyColoc</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>

<body class="bg-[#fcfcfd] min-h-screen py-10">

    <div class="max-w-4xl mx-auto px-4">

        <div class="flex flex-col gap-6 mb-8">
            <div class="flex items-center justify-between">
                <a href="{{ route('my_colocation.show') }}"
                    class="group inline-flex items-center gap-2 text-sm font-bold text-slate-500 hover:text-slate-900 transition-colors">
                    <div
                        class="p-2 rounded-xl bg-white border border-slate-100 group-hover:bg-slate-50 shadow-sm transition-colors">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="19" y1="12" x2="5" y2="12" />
                            <polyline points="12 19 5 12 12 5" />
                        </svg>
                    </div>
                    Dashboard
                </a>
                <h1 class="text-2xl font-black text-slate-900 tracking-tight text-right">My Debts</h1>
            </div>

            @if (session('status'))
                <div
                    class="flex items-center gap-3 bg-emerald-50 border border-emerald-100 text-emerald-700 px-6 py-4 rounded-[1.5rem] animate-in fade-in slide-in-from-top-4 duration-500">
                    <div
                        class="h-8 w-8 rounded-full bg-emerald-500 text-white flex items-center justify-center shrink-0 shadow-lg shadow-emerald-200">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="20 6 9 17 4 12" />
                        </svg>
                    </div>
                    <p class="text-sm font-black">{{ session('status') }}</p>
                </div>
            @endif
        </div>

        <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/40 overflow-hidden">
            <div class="p-8 border-b border-slate-50 bg-slate-50/30 flex items-center justify-between">
                <div>
                    <h2 class="text-xs font-black text-slate-400 uppercase tracking-[0.2em]">Pending Payments</h2>
                </div>
                <div
                    class="px-3 py-1 rounded-full bg-red-50 text-red-600 text-[10px] font-black uppercase tracking-widest border border-red-100">
                    Action Required
                </div>
            </div>

            @if ($debts->isEmpty())
                <div class="p-20 text-center">
                    <div
                        class="h-20 w-20 rounded-full bg-emerald-50 flex items-center justify-center mx-auto mb-6 text-emerald-500 shadow-inner">
                        <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                            <polyline points="22 4 12 14.01 9 11.01" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-black text-slate-900 mb-2">You're all settled!</h3>
                    <p class="text-sm font-bold text-slate-400">No pending debts found. Enjoy the peace of mind! 🎉</p>
                </div>
            @else
                <div class="divide-y divide-slate-50">
                    @foreach ($debts as $debt)
                        <div
                            class="group p-8 flex flex-col sm:flex-row sm:items-center justify-between gap-6 hover:bg-slate-50/50 transition-all">

                            <div class="flex items-center gap-5">
                                <div
                                    class="h-14 w-14 rounded-2xl bg-slate-100 flex flex-col items-center justify-center text-slate-400 border-2 border-white shadow-sm group-hover:bg-white group-hover:text-blue-600 transition-colors">
                                    <span
                                        class="text-[10px] font-black uppercase">{{ substr($debt->toUser->name, 0, 1) }}</span>
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2.5">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                                        <circle cx="12" cy="7" r="4" />
                                    </svg>
                                </div>

                                <div>
                                    <div class="text-sm font-black text-slate-900 flex items-center gap-2">
                                        You owe <span
                                            class="text-blue-600 underline decoration-blue-100 decoration-2 underline-offset-4">{{ $debt->toUser->name }}</span>
                                    </div>
                                    <div class="mt-1 flex items-center gap-2">
                                        <span class="text-[11px] font-bold text-slate-400 italic">For:
                                            {{ $debt->expense->title }}</span>
                                        <span class="text-slate-200">•</span>
                                        <span
                                            class="text-[10px] font-black text-slate-300 uppercase tracking-tighter">ID
                                            #{{ $debt->expense_id }}</span>
                                    </div>
                                </div>
                            </div>

                            <div
                                class="flex items-center justify-between sm:justify-end gap-6 sm:gap-8 border-t sm:border-t-0 pt-4 sm:pt-0">
                                <div class="text-right">
                                    <div class="text-xl font-black text-red-600 tracking-tight leading-none">
                                        {{ number_format((float) $debt->amount, 2) }}
                                    </div>
                                    <div class="text-[10px] font-black text-slate-400 uppercase tracking-widest mt-1">
                                        MAD</div>
                                </div>

                                <form method="POST" action="{{ route('debts.pay', $debt->id) }}">
                                    @csrf
                                    <button type="submit"
                                        class="inline-flex items-center gap-2 px-6 py-3.5 rounded-2xl bg-slate-900 text-white text-xs font-black hover:bg-emerald-600 shadow-xl shadow-slate-200 hover:shadow-emerald-100 transition-all active:scale-95 group/btn">
                                        <svg class="group-hover/btn:rotate-12 transition-transform" width="16"
                                            height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                                            <polyline points="22 4 12 14.01 9 11.01" />
                                        </svg>
                                        Mark Paid
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <div class="mt-12 text-center opacity-20 grayscale">
            <div class="text-[10px] font-black uppercase tracking-[0.4em] text-slate-900">EasyColoc Financial
                Transparency</div>
        </div>
    </div>

</body>

</html>
