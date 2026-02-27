<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Member - {{ $user->name }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .avatar-user-{{ substr(strtolower($user->name), 0, 1) }} {
            background-color: {{ '#' . substr(md5($user->name), 0, 6) }}15;
            color: {{ '#' . substr(md5($user->name), 0, 6) }};
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

        <div
            class="bg-white rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/50 overflow-hidden text-slate-900">
            <div
                class="h-28 bg-gradient-to-br from-slate-50 to-slate-100 border-b border-slate-100 relative overflow-hidden">
                <div class="absolute inset-0 opacity-[0.03]"
                    style="background-image: url('data:image/svg+xml,%3Csvg width=\"20\" height=\"20\" viewBox=\"0 0 20 20\" xmlns=\"http://www.w3.org/2000/svg\"%3E%3Cg fill=\"%23000\" fill-opacity=\"1\" fill-rule=\"evenodd\"%3E%3Ccircle cx=\"3\" cy=\"3\" r=\"3\"/%3E%3Ccircle cx=\"13\" cy=\"13\" r=\"3\"/%3E%3C/g%3E%3C/svg%3E');">
                </div>
            </div>

            <div class="px-8 pb-10">
                <div class="relative -mt-14 mb-8 text-center">
                    <div class="inline-block p-1.5 rounded-full bg-white shadow-2xl shadow-slate-300">
                        <div
                            class="h-24 w-24 rounded-full flex items-center justify-center avatar-user-{{ substr(strtolower($user->name), 0, 1) }} border-4 border-white">
                            <svg width="44" height="44" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="opacity-80">
                                <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
                                <circle cx="12" cy="7" r="4" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="text-center mb-10">
                    <h1 class="text-3xl font-black tracking-tight">{{ $user->name }}</h1>
                    <div
                        class="inline-flex items-center gap-1.5 mt-2.5 px-3 py-1 rounded-full bg-slate-100 text-slate-600 border border-slate-200">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="3">
                            <path
                                d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                        </svg>
                        <span
                            class="text-[10px] font-black uppercase tracking-widest">{{ $targetMembership->role }}</span>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-5">
                    <div
                        class="p-5 rounded-2xl bg-slate-50/50 border border-slate-100 flex items-center gap-4 group hover:bg-white hover:shadow-md transition-all">
                        <div
                            class="h-12 w-12 rounded-xl bg-white flex items-center justify-center text-slate-400 border border-slate-100 shadow-sm group-hover:border-blue-100 group-hover:text-blue-500 transition-colors">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2.5">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                                <polyline points="22,6 12,13 2,6" />
                            </svg>
                        </div>
                        <div class="overflow-hidden">
                            <p class="text-[11px] font-black text-slate-400 uppercase tracking-tight">Email Address</p>
                            <p class="text-sm font-bold text-slate-800 truncate">{{ $user->email }}</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-5">
                        <div class="p-5 rounded-2xl bg-slate-50/50 border border-slate-100">
                            <p class="text-[11px] font-black text-slate-400 uppercase tracking-tight mb-2">Reputation
                            </p>
                            <div class="flex items-center gap-2.5 text-slate-900 font-black text-2xl tracking-tighter">
                                <svg width="22" height="22" viewBox="0 0 24 24" fill="#fbbf24" stroke="#fbbf24">
                                    <polygon
                                        points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" />
                                </svg>
                                {{ $user->reputation }}
                            </div>
                        </div>

                        <div class="p-5 rounded-2xl bg-slate-50/50 border border-slate-100">
                            <p class="text-[11px] font-black text-slate-400 uppercase tracking-tight mb-2">Joined</p>
                            <p class="text-base font-black text-slate-800">
                                {{ \Carbon\Carbon::parse($targetMembership->joined_at)->format('M d, Y') }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="mt-10 text-center">
                    <p class="text-[11px] font-bold text-slate-300 uppercase tracking-widest">
                        EasyColoc Member Profile
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
