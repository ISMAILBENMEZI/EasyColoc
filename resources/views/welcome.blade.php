<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>EasyColoc - Find Your Perfect Roommate</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=syne:700,800|instrument-sans:400,500,600" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 font-['Instrument_Sans'] antialiased">

    <header class="fixed top-0 w-full z-50 bg-white/80 backdrop-blur-md border-b border-gray-100">
        <nav class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
            <a href="{{ url('/') }}" class="group inline-flex items-center gap-[10px] no-underline">
                <div
                    class="relative flex h-[36px] w-[36px] items-center justify-center bg-blue-600 rounded-[10px] shadow-lg shadow-blue-200">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="white"
                        stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                        <polyline points="9 22 9 12 15 12 15 22" />
                    </svg>
                </div>
                <div class="text-[20px] font-black tracking-[-0.04em] text-[#1a1625]">
                    Easy<span class="text-blue-600">Coloc</span>
                </div>
            </a>

            <div class="flex items-center gap-3">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}"
                            class="px-6 py-2.5 rounded-2xl bg-blue-600 text-white text-sm font-bold shadow-md hover:bg-blue-700 transition-all">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}"
                            class="text-sm font-bold text-gray-600 hover:text-blue-600 transition-colors">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="px-6 py-2.5 rounded-2xl bg-[#1a1625] text-white text-sm font-bold hover:bg-black transition-all shadow-lg">Join
                                Now</a>
                        @endif
                    @endauth
                @endif
            </div>
        </nav>
    </header>

    <main class="relative pt-32 pb-20 overflow-hidden">
        <div class="absolute top-0 right-0 -z-10 opacity-20 translate-x-1/4 -translate-y-1/4">
            <div class="w-[600px] h-[600px] bg-blue-400 rounded-full blur-[120px]"></div>
        </div>

        <div class="max-w-7xl mx-auto px-6 flex flex-col lg:flex-row items-center gap-16">
            <div class="lg:w-1/2 text-center lg:text-left">
                <div
                    class="inline-flex items-center px-4 py-2 bg-blue-50 rounded-full text-blue-600 text-sm font-bold mb-6">
                    <span class="flex h-2 w-2 rounded-full bg-blue-600 mr-2 animate-pulse"></span>
                    #1 Roommate Finder in Morocco
                </div>
                <h1
                    class="text-5xl lg:text-7xl font-black text-[#1a1625] leading-[0.9] tracking-tighter mb-6 font-['Syne']">
                    Find Your <br> <span class="text-blue-600">Perfect Home</span> <br> Shared.
                </h1>
                <p class="text-lg text-gray-500 max-w-lg mb-10 leading-relaxed mx-auto lg:mx-0 font-medium">
                    EasyColoc helps you find trustworthy roommates and shared flats effortlessly. Join thousands of
                    students and professionals today.
                </p>

                <div class="flex flex-col sm:flex-row items-center gap-4 justify-center lg:justify-start">
                    <a href="{{ route('register') }}"
                        class="w-full sm:w-auto px-10 py-4 bg-blue-600 text-white rounded-[24px] font-black text-lg shadow-xl shadow-blue-200 hover:scale-105 transition-all">
                        Start Finding
                    </a>
                    <a href="{{ route('how.works') }}"
                        class="w-full sm:w-auto px-10 py-4 bg-white text-gray-900 border-2 border-gray-100 rounded-[24px] font-black text-lg hover:bg-gray-50 transition-all text-center">
                        How it works
                    </a>
                </div>
            </div>

            <div class="lg:w-1/2 relative">
                <div
                    class="relative z-10 rounded-[40px] overflow-hidden shadow-2xl rotate-2 hover:rotate-0 transition-transform duration-500">
                    <img src="https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?auto=format&fit=crop&q=80&w=1000"
                        alt="Shared Flat" class="w-full h-[500px] object-cover">
                </div>
                <div
                    class="absolute -bottom-6 -left-6 z-20 bg-white p-5 rounded-3xl shadow-xl border border-gray-50 animate-bounce transition-all duration-1000">
                    <div class="flex items-center gap-3">
                        <div
                            class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center text-green-600">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="M20 6 9 17 4 12" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 font-bold uppercase tracking-wider">Verified</p>
                            <p class="font-bold text-gray-900">Safe Community</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="py-10 border-t border-gray-100">
        <div class="max-w-7xl mx-auto px-6 text-center text-gray-400 text-sm font-medium">
            &copy; {{ date('Y') }} EasyColoc. Built with Love for Moroccan Students.
        </div>
    </footer>

</body>

</html>
