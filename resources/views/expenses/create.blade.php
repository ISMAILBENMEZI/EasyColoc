<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Add Expense - EasyColoc</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>

<body class="min-h-screen bg-[#fcfcfd] flex items-center justify-center py-12 px-4">
    <div class="max-w-xl w-full mx-auto">
        <a href="{{ route('my_colocation.show') }}"
            class="group inline-flex items-center gap-2.5 text-sm font-bold text-slate-500 hover:text-slate-900 transition-colors mb-8">
            <div
                class="p-2 rounded-xl bg-white border border-slate-100 group-hover:bg-slate-50 shadow-sm transition-colors">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="19" y1="12" x2="5" y2="12" />
                    <polyline points="12 19 5 12 12 5" />
                </svg>
            </div>
            Back to Colocation
        </a>

        <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/50 overflow-hidden">
            <div class="p-8 sm:p-10 border-b border-slate-50 bg-slate-50/30">
                <div class="flex items-center gap-4">
                    <div
                        class="h-12 w-12 rounded-2xl bg-slate-900 text-white flex items-center justify-center shadow-lg shadow-slate-200">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="12" y1="5" x2="12" y2="19" />
                            <line x1="5" y1="12" x2="19" y2="12" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-2xl font-black text-slate-900 tracking-tight">Add Expense</h1>
                        <p class="text-sm font-bold text-slate-400">Colocation: <span
                                class="text-slate-600">{{ $colocation->name }}</span></p>
                    </div>
                </div>
            </div>

            <form method="POST" action="{{ route('expenses.store') }}" class="p-8 sm:p-10 space-y-6">
                @csrf

                <div class="space-y-2">
                    <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 ml-1">Expense
                        Title</label>
                    <div class="relative group">
                        <div
                            class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-slate-900 transition-colors">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2.5">
                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
                            </svg>
                        </div>
                        <input name="title" value="{{ old('title') }}" type="text"
                            placeholder="What did you pay for?"
                            class="w-full rounded-2xl border-slate-100 bg-slate-50/50 pl-11 pr-4 py-4 text-sm font-black text-slate-900 placeholder:text-slate-300 focus:border-slate-900 focus:ring-4 focus:ring-slate-100 transition-all outline-none"
                            required />
                    </div>
                    @error('title')
                        <p class="text-xs font-bold text-red-500 mt-1 ml-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label
                            class="block text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 ml-1">Amount
                            (MAD)</label>
                        <input name="amount" value="{{ old('amount') }}" type="number" step="0.01" min="0"
                            placeholder="0.00"
                            class="w-full rounded-2xl border-slate-100 bg-slate-50/50 px-5 py-4 text-sm font-black text-slate-900 focus:border-slate-900 focus:ring-4 focus:ring-slate-100 transition-all outline-none"
                            required />
                        @error('amount')
                            <p class="text-xs font-bold text-red-500 mt-1 ml-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label
                            class="block text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 ml-1">Date</label>
                        <input name="date" value="{{ old('date', now()->toDateString()) }}" type="date"
                            class="w-full rounded-2xl border-slate-100 bg-slate-50/50 px-5 py-4 text-sm font-black text-slate-900 focus:border-slate-900 focus:ring-4 focus:ring-slate-100 transition-all outline-none"
                            required />
                        @error('date')
                            <p class="text-xs font-bold text-red-500 mt-1 ml-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 ml-1">Who paid
                        this?</label>
                    <div class="relative group">
                        <div
                            class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-slate-900 transition-colors">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2.5">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                                <circle cx="12" cy="7" r="4" />
                            </svg>
                        </div>
                        <select name="payer_id"
                            class="w-full rounded-2xl border-slate-100 bg-slate-50/50 pl-11 pr-4 py-4 text-sm font-black text-slate-900 focus:border-slate-900 focus:ring-4 focus:ring-slate-100 transition-all outline-none appearance-none cursor-pointer">
                            @foreach ($members as $m)
                                <option value="{{ $m->user_id }}" @selected(old('payer_id', auth()->id()) == $m->user_id)>
                                    {{ $m->user->name }} {{ $m->user_id === auth()->id() ? '(You)' : '' }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 ml-1">Category
                        (Optional)</label>
                    <div class="relative group">
                        <div
                            class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-slate-900 transition-colors">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2.5">
                                <path
                                    d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z" />
                                <line x1="7" y1="7" x2="7.01" y2="7" />
                            </svg>
                        </div>
                        <select name="category_id"
                            class="w-full rounded-2xl border-slate-100 bg-slate-50/50 pl-11 pr-4 py-4 text-sm font-black text-slate-900 focus:border-slate-900 focus:ring-4 focus:ring-slate-100 transition-all outline-none appearance-none cursor-pointer">
                            <option value="">— Select Category —</option>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}" @selected(old('category_id') == $cat->id)>{{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="pt-4">
                    <button type="submit"
                        class="w-full rounded-2xl bg-slate-900 px-6 py-5 text-sm font-black text-white hover:bg-slate-800 shadow-xl shadow-slate-200 transition-all active:scale-[0.98]">
                        Save Expense
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
