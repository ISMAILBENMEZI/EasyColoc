<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Colocation - EasyColoc</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .bg-pattern {
            background-image: radial-gradient(#e5e7eb 1px, transparent 1px);
            background-size: 20px 20px;
        }
    </style>
</head>

<body class="bg-gray-50 bg-pattern min-h-screen flex flex-col items-center justify-center p-4">

    <div class="mb-8 flex justify-center">
        <a href="{{ url('/') }}" class="group flex items-center gap-3 select-none decoration-none">
            <div class="relative flex h-12 w-12 items-center justify-center bg-blue-600 rounded-[14px] overflow-hidden transition-all duration-300 group-hover:rounded-full group-hover:scale-110 shadow-xl shadow-blue-200">
                <div class="absolute -top-1.5 -left-1.5 w-6 h-6 bg-white/15 rounded-full"></div>
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="relative z-10">
                    <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                    <polyline points="9 22 9 12 15 12 15 22" />
                </svg>
            </div>
            <span class="text-3xl font-black tracking-tighter text-slate-900 leading-none">
                Easy<span class="text-blue-600">Coloc</span>
            </span>
        </a>
    </div>

    <div class="w-full max-w-xl">
        <div class="bg-white rounded-[2rem] border border-gray-100 shadow-2xl shadow-gray-200/50 overflow-hidden">
            
            <div class="px-8 pt-8 pb-6 text-center border-b border-gray-50">
                <h1 class="text-2xl font-bold text-gray-900">Create New Colocation</h1>
                <p class="mt-2 text-gray-500">Set up your shared space in seconds.</p>
            </div>

            <div class="p-8">
                @if (session('status'))
                    <div class="mb-6 flex items-center gap-3 rounded-2xl border border-green-100 bg-green-50 px-4 py-3 text-sm text-green-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('colocations.store') }}" class="space-y-6">
                    @csrf

                    <div class="space-y-2">
                        <label for="name" class="text-sm font-bold text-gray-700 ml-1">Colocation Name</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400 group-focus-within:text-blue-600 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                </svg>
                            </div>
                            <input id="name" name="name" type="text" value="{{ old('name') }}" required
                                placeholder="e.g. Dream House, Sunny Apartment"
                                class="block w-full pl-11 pr-4 py-3.5 bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-2xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all outline-none">
                        </div>
                        @error('name')
                            <p class="mt-2 text-xs text-red-500 font-medium ml-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex gap-3 rounded-2xl bg-blue-50/50 border border-blue-100 p-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="text-xs text-blue-800 leading-relaxed">
                            <strong>Quick Tip:</strong> You'll be the owner! You can invite your roommates and set up expenses right after this step.
                        </p>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-3 pt-4">
                        <button type="submit"
                            class="flex-1 order-2 sm:order-1 rounded-2xl bg-blue-600 px-6 py-4 text-sm font-bold text-white shadow-lg shadow-blue-200 hover:bg-blue-700 hover:-translate-y-0.5 transition-all active:scale-95">
                            Create Colocation
                        </button>
                        
                        <a href="/dashboard"
                            class="flex-1 order-1 sm:order-2 inline-flex items-center justify-center rounded-2xl border border-gray-200 bg-white px-6 py-4 text-sm font-bold text-gray-700 hover:bg-gray-50 transition-all">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <p class="mt-8 text-center text-sm text-gray-500">
            Need help? <a href="#" class="text-blue-600 font-semibold hover:underline">Check our guide</a>
        </p>
    </div>

</body>
</html>