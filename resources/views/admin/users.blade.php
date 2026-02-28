<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users - EasyColoc Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .user-card { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
        .user-card:hover { transform: translateY(-5px); }
    </style>
</head>

<body class="bg-[#f8fafc] min-h-screen antialiased">
    <nav class="bg-white/80 backdrop-blur-md border-b border-slate-100 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.stats') }}" class="p-2.5 rounded-xl bg-slate-50 text-slate-500 hover:bg-slate-900 hover:text-white transition-all shadow-sm">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
                </a>
                <h2 class="text-lg font-black tracking-tighter text-slate-900">Admin<span class="text-blue-600">Panel</span></h2>
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="group flex items-center gap-2 px-5 py-2.5 rounded-2xl bg-white border border-slate-200 text-slate-600 hover:bg-red-50 hover:text-red-600 hover:border-red-100 transition-all font-bold text-xs">
                    <span>Log Out</span>
                    <svg class="group-hover:translate-x-1 transition-transform" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                </button>
            </form>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-6 py-12">
        <div class="flex items-end justify-between mb-12">
            <div>
                <h1 class="text-4xl font-black text-slate-900 tracking-tight">Community</h1>
                <p class="text-slate-500 font-medium mt-1">Manage {{ $users->total() }} registered members</p>
            </div>
            <div class="hidden md:block">
                 <span class="px-4 py-2 bg-blue-50 text-blue-700 rounded-full text-xs font-black uppercase tracking-widest">Access: Full Admin</span>
            </div>
        </div>

        @if (session('status'))
            <div class="mb-8 p-4 rounded-2xl bg-slate-900 text-white font-bold text-sm shadow-xl flex items-center gap-3 animate-in fade-in slide-in-from-top-4 duration-500">
                <div class="h-2 w-2 rounded-full bg-emerald-400"></div>
                {{ session('status') }}
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($users as $u)
                <div class="user-card bg-white rounded-[2.5rem] p-6 border border-slate-100 shadow-sm hover:shadow-xl hover:shadow-slate-200/50 flex flex-col justify-between">
                    
                    <div class="flex items-start justify-between">
                        <div class="flex items-center gap-4">
                            <div class="h-14 w-14 rounded-2xl @if($u->is_banned) bg-red-50 text-red-400 @else bg-slate-900 text-white @endif flex items-center justify-center font-black text-xl shadow-lg shadow-slate-200">
                                {{ substr($u->name, 0, 1) }}
                            </div>
                            <div class="min-w-0">
                                <h3 class="text-base font-black text-slate-900 truncate tracking-tight">{{ $u->name }}</h3>
                                <p class="text-xs text-slate-400 font-bold truncate">{{ $u->email }}</p>
                            </div>
                        </div>

                        @if ($u->id === auth()->id())
                            <span class="bg-blue-600 text-[9px] font-black text-white px-2 py-1 rounded-lg uppercase">You</span>
                        @endif
                    </div>

                    <div class="mt-8 flex items-center justify-between border-t border-slate-50 pt-5">
                        <div class="flex flex-col">
                            <span class="text-[10px] font-black text-slate-300 uppercase tracking-widest">Status</span>
                            <span class="text-xs font-black @if($u->is_banned) text-red-500 @else text-emerald-500 @endif capitalize">
                                {{ $u->is_banned ? 'Restricted' : 'Active Member' }}
                            </span>
                        </div>

                        <div class="flex gap-2">
                            @if ($u->id !== auth()->id())
                                @if ($u->is_banned)
                                    <form method="POST" action="{{ route('admin.users.unban', $u->id) }}">
                                        @csrf
                                        <button class="px-5 py-2.5 rounded-xl bg-emerald-500 text-white text-[10px] font-black uppercase hover:bg-emerald-600 transition-colors shadow-lg shadow-emerald-100">
                                            Lift Ban
                                        </button>
                                    </form>
                                @else
                                    <form method="POST" action="{{ route('admin.users.ban', $u->id) }}">
                                        @csrf
                                        <button class="px-5 py-2.5 rounded-xl bg-slate-50 text-slate-400 text-[10px] font-black uppercase hover:bg-red-50 hover:text-red-600 transition-all border border-transparent hover:border-red-100">
                                            Ban
                                        </button>
                                    </form>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-16 bg-white p-4 rounded-[2rem] border border-slate-100 shadow-sm">
            {{ $users->links() }}
        </div>
    </main>

    <footer class="pb-12 text-center">
        <p class="text-[10px] font-black text-slate-300 uppercase tracking-[0.4em]">EasyColoc Secure Admin Dashboard</p>
    </footer>
</body>

</html>