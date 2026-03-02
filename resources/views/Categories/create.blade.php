<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Add Category - EasyColoc</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>

<body class="min-h-screen bg-[#fcfcfd] flex items-center justify-center p-4">
    <div class="max-w-md w-full mx-auto">
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

        <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/50 p-8 sm:p-10">
            <div class="mb-8 text-center">
                <div
                    class="h-16 w-16 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center mx-auto mb-4 shadow-sm">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 2H2v10h10V2z" />
                        <path d="M22 2h-10v10h10V2z" />
                        <path d="M12 12H2v10h10V12z" />
                        <path d="M22 15.5l-3.5 3.5L15 15.5" />
                        <path d="M22 12h-10v10h10V12z" />
                    </svg>
                </div>
                <h1 class="text-2xl font-black text-slate-900 tracking-tight">New Category</h1>
                <p class="mt-2 text-sm font-medium text-slate-500 leading-relaxed">
                    Organize your expenses by creating custom categories like <span
                        class="text-indigo-600 font-bold">Rent</span> or <span
                        class="text-indigo-600 font-bold">Food</span>.
                </p>
            </div>

            <form method="POST" action="{{ route('categories.store') }}" class="space-y-6">
                @csrf

                <div>
                    <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-2 ml-1">
                        Category Name
                    </label>
                    <div class="relative group">
                        <div
                            class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-indigo-600 transition-colors">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2.5">
                                <path
                                    d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z" />
                                <line x1="7" y1="7" x2="7.01" y2="7" />
                            </svg>
                        </div>
                        <input name="name" value="{{ old('name') }}" type="text"
                            placeholder="e.g. Internet, Groceries..."
                            class="w-full rounded-2xl border-slate-100 bg-slate-50/50 pl-11 pr-4 py-4 text-sm font-black text-slate-900 placeholder:text-slate-300 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 transition-all outline-none"
                            required />
                    </div>
                    @error('name')
                        <p class="mt-2 text-xs font-bold text-red-500 flex items-center gap-1 ml-1">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="3">
                                <circle cx="12" cy="12" r="10" />
                                <line x1="12" y1="8" x2="12" y2="12" />
                                <line x1="12" y1="16" x2="12.01" y2="16" />
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <button type="submit"
                    class="w-full rounded-2xl bg-indigo-600 px-6 py-4 text-sm font-black text-white hover:bg-indigo-700 shadow-lg shadow-indigo-100 transition-all active:scale-[0.98]">
                    Add Category
                </button>
            </form>
        </div>
    </div>
</body>

</html>
