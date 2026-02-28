<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $colocation->name }} - EasyColoc</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
        }
    </style>
</head>

<body class="min-h-screen bg-[#fcfcfd]">
    <nav class="sticky top-0 z-50 bg-white/80 backdrop-blur-md border-b border-gray-100">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-2.5 group transition-all">
                    <div
                        class="h-10 w-10 rounded-xl bg-gradient-to-br from-blue-600 to-blue-700 flex items-center justify-center shadow-lg shadow-blue-200 group-hover:shadow-blue-300 transition-all">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="white"
                            stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                            <polyline points="9 22 9 12 15 12 15 22" />
                        </svg>
                    </div>
                    <span class="text-xl font-extrabold tracking-tight text-slate-900">
                        Easy<span class="text-blue-600">Coloc</span>
                    </span>
                </a>

                <div class="flex items-center gap-6">
                    <a href="{{ route('profile.edit') }}"
                        class="text-sm font-bold text-gray-600 hover:text-blue-600 transition">Profile</a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="text-xs font-bold text-red-500 hover:text-red-600 bg-red-50 px-3 py-2 rounded-xl transition">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <main class="py-10">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            @if (session('status'))
                <div
                    class="rounded-2xl border-l-4 border-emerald-500 bg-white shadow-sm p-4 flex items-center gap-3 animate-in fade-in slide-in-from-top-4">
                    <div class="bg-emerald-100 p-1 rounded-full text-emerald-600">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="20 6 9 17 4 12" />
                        </svg>
                    </div>
                    <span class="text-sm font-bold text-slate-700">{{ session('status') }}</span>
                </div>
            @endif

            <div
                class="bg-slate-900 rounded-[2.5rem] p-8 sm:p-12 text-white shadow-2xl shadow-slate-200 relative overflow-hidden">
                <div class="absolute top-0 right-0 p-12 opacity-10">
                    <svg width="200" height="200" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="1.5">
                        <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                    </svg>
                </div>

                <div class="relative z-10">
                    <div class="flex flex-wrap items-center gap-3 mb-6">
                        <span
                            class="px-3 py-1 rounded-full bg-blue-100 border border-blue-200 text-blue-700 text-[10px] font-black uppercase tracking-wider">
                            {{ $colocation->status }}
                        </span>

                        <span
                            class="px-3 py-1 rounded-full bg-emerald-100 border border-emerald-200 text-emerald-700 text-[10px] font-black uppercase tracking-wider">
                            {{ $membership->role }}
                        </span>
                    </div>

                    <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-8">
                        <div>
                            <h1 class="text-4xl sm:text-5xl font-black tracking-tight mb-2">{{ $colocation->name }}</h1>
                            <p class="text-slate-400 font-medium text-lg italic">"Managing shared life, simplified."</p>
                        </div>

                        <div class="flex items-center gap-3">
                            <a href="{{ route('expenses.create') }}"
                                class="inline-flex items-center gap-2 rounded-xl bg-slate-900 px-5 py-2.5 text-sm font-bold text-white hover:bg-slate-800 transition shadow-sm active:scale-95">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="3" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <line x1="12" y1="5" x2="12" y2="19"></line>
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                </svg>
                                Add Expense
                            </a>

                            @if ($membership->role === 'owner')
                                <a href="{{ route('invitations.create') }}"
                                    class="inline-flex items-center gap-2 rounded-xl bg-blue-600 px-5 py-2.5 text-sm font-bold text-white hover:bg-blue-700 transition shadow-md shadow-blue-100 active:scale-95">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="3" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="8.5" cy="7" r="4"></circle>
                                        <line x1="20" y1="8" x2="20" y2="14"></line>
                                        <line x1="23" y1="11" x2="17" y2="11"></line>
                                    </svg>
                                    Invite
                                </a>

                                <a href="{{ route('categories.create') }}"
                                    class="inline-flex justify-center rounded-2xl bg-white border border-gray-200 px-6 py-3 text-sm font-bold text-slate-900 hover:bg-gray-50 transition">
                                    Add Category
                                </a>

                                @if ($membership->role === 'owner' && $colocation->status === 'active')
                                    <form method="POST" action="{{ route('colocation.deactivate') }}">
                                        @csrf
                                        <button type="submit"
                                            class="w-full py-4 rounded-2xl bg-slate-900 text-white font-black text-sm hover:bg-slate-800 transition">
                                            Deactivate Colocation
                                        </button>
                                    </form>
                                @endif
                            @else
                                <form method="POST" action="{{ route('colocation.leave') }}"
                                    onsubmit="return confirm('Are you sure you want to leave this colocation?');">
                                    @csrf
                                    <button type="submit"
                                        class="inline-flex items-center gap-2 rounded-xl bg-red-50 px-4 py-2 text-xs font-bold text-red-600 hover:bg-red-600 hover:text-white transition-all duration-200 active:scale-95 group"
                                        title="Leave colocation">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                            <polyline points="16 17 21 12 16 7"></polyline>
                                            <line x1="21" y1="12" x2="9" y2="12">
                                            </line>
                                        </svg>
                                        Leave Colocation
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div
                    class="bg-white rounded-[2.5rem] p-8 border border-slate-100 shadow-xl shadow-slate-200/40 transition-all hover:translate-y-[-4px]">
                    <div
                        class="h-14 w-14 rounded-2xl bg-blue-50 flex items-center justify-center text-blue-600 mb-6 shadow-sm shadow-blue-100">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2.5">
                            <line x1="12" y1="1" x2="12" y2="23" />
                            <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6" />
                        </svg>
                    </div>
                    <div class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-2">Total Expenses
                    </div>
                    <div class="flex items-baseline gap-1">
                        <div class="text-4xl font-black text-slate-900 tracking-tighter">
                            {{ number_format((float) $totalExpenses, 2) }}
                        </div>
                        <span class="text-xs font-bold text-slate-400 uppercase">MAD</span>
                    </div>
                </div>

                <div
                    class="bg-white rounded-[2.5rem] p-8 border border-slate-100 shadow-xl shadow-slate-200/40 transition-all hover:translate-y-[-4px]">
                    <div
                        class="h-14 w-14 rounded-2xl bg-emerald-50 flex items-center justify-center text-emerald-600 mb-6 shadow-sm shadow-emerald-100">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2.5">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                            <circle cx="8.5" cy="7" r="4" />
                            <polyline points="17 11 19 13 23 9" />
                        </svg>
                    </div>
                    <div class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-2">Total Members
                    </div>
                    <div class="text-4xl font-black text-slate-900 tracking-tighter">
                        {{ $membersCount }}
                        <span class="text-xs font-bold text-slate-400 uppercase ml-1">People</span>
                    </div>
                </div>

                <a href="{{ route('debts.index') }}"
                    class="group bg-white rounded-[2.5rem] p-8 border border-slate-100 shadow-xl shadow-slate-200/40 transition-all hover:translate-y-[-4px] hover:shadow-red-100/50 hover:border-red-100">

                    <div
                        class="h-14 w-14 rounded-2xl bg-red-50 flex items-center justify-center text-red-600 mb-6 shadow-sm shadow-red-100 transition-colors group-hover:bg-red-600 group-hover:text-white">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 12V8H6a2 2 0 0 1-2-2c0-1.1.9-2 2-2h12v4" />
                            <path d="M4 6v12c0 1.1.9 2 2 2h14v-4" />
                            <path d="M18 12a2 2 0 0 0-2 2c0 1.1.9 2 2 2h4v-4h-4z" />
                        </svg>
                    </div>

                    <div class="flex items-center justify-between mb-2">
                        <div
                            class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 group-hover:text-red-500 transition-colors">
                            My Pending Debts</div>
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="3"
                            class="text-slate-300 opacity-0 -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 transition-all">
                            <polyline points="9 18 15 12 9 6" />
                        </svg>
                    </div>

                    <div class="flex items-baseline gap-1">
                        <div
                            class="text-4xl font-black text-slate-900 tracking-tighter group-hover:text-red-600 transition-colors">
                            {{ number_format((float) $myTotalDebt, 2) }}
                        </div>
                        <span class="text-xs font-bold text-slate-400 uppercase">MAD</span>
                    </div>

                    <div
                        class="mt-4 text-[9px] font-bold text-slate-300 uppercase tracking-widest italic group-hover:text-slate-400">
                        Click to view & pay →
                    </div>
                </a>

                <div class="lg:col-span-3">
                    <div
                        class="bg-white rounded-[3rem] p-8 sm:p-10 border border-slate-100 shadow-xl shadow-slate-200/30">
                        <div class="flex items-center justify-between mb-8">
                            <div>
                                <h2 class="text-2xl font-black text-slate-900 tracking-tight">Member Balances</h2>
                                <p class="text-sm font-bold text-slate-400">Net standing for each member</p>
                            </div>
                            <div class="flex flex-col items-end">
                                <span
                                    class="text-[10px] font-black bg-amber-100 text-amber-700 px-3 py-1 rounded-full uppercase tracking-widest border border-amber-200/50 mb-1">Live
                                    Update</span>
                                <span class="text-[9px] font-bold text-slate-300 italic">Auto-calculated</span>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach ($memberBalances as $mb)
                                @php
                                    $b = $mb['balance'];
                                    $isPositive = $b > 0;
                                    $isNegative = $b < 0;
                                    $isSettled = $b == 0;
                                @endphp

                                <div
                                    class="group flex items-center justify-between p-5 rounded-[2rem] border transition-all duration-300 hover:shadow-lg
                        @if ($isPositive) bg-emerald-50/40 border-emerald-100/50 hover:bg-emerald-50
                        @elseif($isNegative) bg-red-50/40 border-red-100/50 hover:bg-red-50
                        @else bg-slate-50 border-slate-100 @endif">

                                    <div class="flex items-center gap-4">
                                        <div
                                            class="h-12 w-12 rounded-2xl flex items-center justify-center text-sm font-black shadow-sm transition-transform group-hover:scale-110
                                @if ($isPositive) bg-emerald-600 text-white
                                @elseif($isNegative) bg-red-600 text-white
                                @else bg-slate-400 text-white @endif">
                                            {{ strtoupper(substr($mb['user']->name, 0, 1)) }}
                                        </div>

                                        <div>
                                            <div class="flex items-center gap-2">
                                                <span
                                                    class="text-sm font-black text-slate-900">{{ $mb['user']->name }}</span>
                                                @if ($mb['user']->id === auth()->id())
                                                    <span
                                                        class="text-[9px] font-black bg-blue-600 text-white px-1.5 py-0.5 rounded-md uppercase">You</span>
                                                @endif
                                            </div>
                                            <div
                                                class="text-[10px] font-black uppercase tracking-wider mt-0.5 
                                    @if ($isPositive) text-emerald-600
                                    @elseif($isNegative) text-red-600
                                    @else text-slate-400 @endif">
                                                @if ($isPositive)
                                                    Is Owed Money
                                                @elseif($isNegative)
                                                    Owes Money
                                                @else
                                                    Settled Up
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-right">
                                        <div
                                            class="text-lg font-black tracking-tight
                                @if ($isPositive) text-emerald-700
                                @elseif($isNegative) text-red-700
                                @else text-slate-500 @endif">
                                            {{ $isPositive ? '+' : '' }}{{ number_format($b, 2) }}
                                        </div>
                                        <div class="text-[9px] font-bold text-slate-400 uppercase">MAD</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 text-slate-900">
                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm overflow-hidden">
                        <div
                            class="px-8 py-6 border-b border-slate-50 flex items-center justify-between bg-slate-50/50">
                            <h2 class="text-xl font-black tracking-tight">Latest Expenses</h2>
                            <a href="{{ route('expenses.index') }}"
                                class="text-sm font-bold text-blue-600 hover:text-blue-700">
                                View All
                            </a>
                        </div>

                        @if ($latestExpenses->isEmpty())
                            <div class="p-16 text-center">
                                <div
                                    class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        stroke="#cbd5e1" stroke-width="2.5">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                                        <polyline points="14 2 14 8 20 8" />
                                    </svg>
                                </div>
                                <h3 class="font-bold text-slate-400 italic">No expenses recorded yet.</h3>
                            </div>
                        @else
                            <div class="divide-y divide-slate-50">
                                @foreach ($latestExpenses as $expense)
                                    <a href="{{ route('expenses.show', $expense->id) }}" class="block group">
                                        <div
                                            class="px-8 py-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4 group hover:bg-slate-50/80 transition-colors">
                                            <div class="flex items-center gap-4">
                                                <div
                                                    class="h-12 w-12 rounded-xl bg-slate-900 flex flex-col items-center justify-center text-white shrink-0">
                                                    <span
                                                        class="text-[10px] font-black uppercase tracking-tighter">{{ \Carbon\Carbon::parse($expense->date)->format('M') }}</span>
                                                    <span
                                                        class="text-lg font-black leading-none">{{ \Carbon\Carbon::parse($expense->date)->format('d') }}</span>
                                                </div>
                                                <div>
                                                    <div class="flex items-center gap-2 mb-1">
                                                        <h4 class="font-black text-slate-900">{{ $expense->title }}
                                                        </h4>
                                                        @if ($expense->category)
                                                            <span
                                                                class="text-[10px] font-bold bg-slate-100 px-2 py-0.5 rounded text-slate-500">{{ $expense->category->name }}</span>
                                                        @endif
                                                    </div>
                                                    <p class="text-sm text-slate-400 font-medium">
                                                        Paid by <span
                                                            class="text-slate-600 font-bold">{{ $expense->payer?->name ?? 'Unknown' }}</span>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <div class="text-xl font-black text-slate-900">
                                                    ${{ number_format((float) $expense->amount, 2) }}
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="bg-blue-600 rounded-[2rem] p-8 text-white shadow-xl shadow-blue-100">
                        <h3 class="text-lg font-black mb-4">Roommate Invitation</h3>
                        <p class="text-blue-100 text-sm leading-relaxed mb-6 font-medium">
                            Share this workspace with your roommates to start splitting bills and managing home tasks
                            together.
                        </p>
                        <a href="{{ route('invitations.create') }}"
                            class="block text-center w-full py-4 rounded-2xl bg-white text-blue-600 font-black text-sm shadow-lg hover:bg-blue-50 transition-all">
                            Generate Invite Link
                        </a>
                    </div>

                    <div class="bg-white rounded-[2rem] p-8 border border-slate-100 shadow-sm">
                        <h3 class="font-black text-slate-900 mb-4">Active Members</h3>

                        <div class="space-y-4">
                            @foreach ($activeMembers as $m)
                                <a href="{{ route('members.show', $m->user_id) }}"
                                    class="flex items-center gap-3 hover:bg-slate-50 rounded-2xl p-2 transition">
                                    <div
                                        class="h-8 w-8 rounded-full bg-slate-100 flex items-center justify-center text-xs font-black text-slate-600 border-2 border-white shadow-sm italic">
                                        {{ strtoupper(substr($m->user->name, 0, 1)) }}
                                    </div>

                                    <div class="text-sm font-bold text-slate-700">
                                        {{ $m->user->name }}

                                        @if ($m->user_id === auth()->id())
                                            <span class="text-[10px] text-blue-500 ml-1">(You)</span>
                                        @endif

                                        @if ($m->role === 'owner')
                                            <span class="text-[10px] text-emerald-600 ml-2">(Owner)</span>
                                        @endif
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>
</body>

</html>
