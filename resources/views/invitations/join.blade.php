<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Join Colocation - EasyColoc</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>

<body class="min-h-screen bg-[#fcfcfd] flex items-center justify-center">
    <div class="max-w-md w-full mx-auto px-4 py-10">
        <a href="{{ route('dashboard') }}" 
           class="group inline-flex items-center gap-2 text-sm font-bold text-slate-500 hover:text-slate-900 transition-colors mb-8">
            <div class="p-2 rounded-lg bg-white border border-slate-100 group-hover:bg-slate-50 transition-colors">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
            </div>
            Back to Dashboard
        </a>

        <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/50 p-8 sm:p-10">
            <div class="mb-8 text-center">
                <div class="h-16 w-16 rounded-2xl bg-slate-900 text-white flex items-center justify-center mx-auto mb-4 shadow-lg shadow-slate-200">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/><polyline points="10 17 15 12 10 7"/><line x1="15" y1="12" x2="3" y2="12"/>
                    </svg>
                </div>
                <h1 class="text-2xl font-black text-slate-900 tracking-tight">Join with Token</h1>
                <p class="mt-2 text-sm font-medium text-slate-500 leading-relaxed">
                    Paste the invitation token you received to access your new shared home.
                </p>
            </div>

            <form method="POST" action="{{ route('invitations.join.submit') }}" class="space-y-6">
                @csrf

                <div>
                    <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-2 ml-1">
                        Invitation Token
                    </label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-slate-900 transition-colors">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                        </div>
                        <input name="token" value="{{ old('token') }}" type="text" placeholder="e.g. ABC-123-XYZ"
                            class="w-full rounded-2xl border-slate-100 bg-slate-50/50 pl-11 pr-4 py-4 text-sm font-black text-slate-900 placeholder:text-slate-300 focus:border-slate-900 focus:ring-4 focus:ring-slate-100 transition-all outline-none" 
                            required />
                    </div>
                    @error('token')
                        <p class="mt-2 text-xs font-bold text-red-500 flex items-center gap-1 ml-1">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <button type="submit"
                    class="w-full rounded-2xl bg-slate-900 px-6 py-4 text-sm font-black text-white hover:bg-slate-800 shadow-xl shadow-slate-200 transition-all active:scale-[0.98]">
                    Join Colocation
                </button>
            </form>

            <p class="mt-8 text-center text-[11px] font-bold text-slate-400 uppercase tracking-tighter">
                Don't have a token? Ask the owner to invite you.
            </p>
        </div>
    </div>
</body>

</html>