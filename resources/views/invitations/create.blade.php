<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Invite Roommate - EasyColoc</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>

<body class="min-h-screen bg-[#fcfcfd] flex items-center justify-center">
    <div class="max-w-md w-full mx-auto px-4 py-10">
        <a href="{{ route('my_colocation.show') }}" 
           class="group inline-flex items-center gap-2 text-sm font-bold text-slate-500 hover:text-slate-900 transition-colors mb-8">
            <div class="p-2 rounded-lg bg-white border border-slate-100 group-hover:bg-slate-50 transition-colors">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
            </div>
            Back to Colocation
        </a>

        <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/50 p-8 sm:p-10 text-slate-900">
            <div class="mb-8 text-center">
                <div class="h-16 w-16 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center mx-auto mb-4">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="8.5" cy="7" r="4"/><line x1="20" y1="8" x2="20" y2="14"/><line x1="23" y1="11" x2="17" y2="11"/>
                    </svg>
                </div>
                <h1 class="text-2xl font-black tracking-tight">Invite Roommate</h1>
                <p class="mt-2 text-sm font-medium text-slate-500">
                    We'll send a secure invitation link to join your colocation.
                </p>
            </div>

            <form method="POST" action="{{ route('invitations.store') }}" class="space-y-6">
                @csrf

                <div>
                    <label class="block text-xs font-black uppercase tracking-widest text-slate-400 mb-2 ml-1">
                        Email Address
                    </label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-blue-500 transition-colors">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                        </div>
                        <input name="email" value="{{ old('email') }}" type="email" placeholder="roommate@example.com"
                            class="w-full rounded-2xl border-slate-100 bg-slate-50/50 pl-11 pr-4 py-4 text-sm font-bold text-slate-900 placeholder:text-slate-300 focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all outline-none" 
                            required />
                    </div>
                    @error('email')
                        <p class="mt-2 text-xs font-bold text-red-500 flex items-center gap-1 ml-1">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <button type="submit"
                    class="w-full rounded-2xl bg-blue-600 px-6 py-4 text-sm font-black text-white hover:bg-blue-700 shadow-lg shadow-blue-100 transition-all active:scale-[0.98]">
                    Send Invitation
                </button>
            </form>

            <div class="mt-8 pt-6 border-t border-slate-50 text-center">
                <p class="text-[11px] font-bold text-slate-400 uppercase tracking-tighter">
                    Need help? Contact <a href="#" class="text-blue-500 hover:underline">support@easycoloc.com</a>
                </p>
            </div>
        </div>
    </div>
</body>

</html>