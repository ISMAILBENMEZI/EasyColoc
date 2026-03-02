@extends('layouts.guest')

@section('content')
    <div class="min-h-screen bg-gray-50 flex items-center justify-center px-4 py-10">

        <div class="w-full max-w-md">

            <div class="mb-8 flex justify-center">
                <a href="{{ url('/') }}" class="group flex items-center gap-3 select-none decoration-none">
                    <div
                        class="relative flex h-10 w-10 items-center justify-center bg-blue-600 rounded-[10px] overflow-hidden transition-all duration-300 group-hover:rounded-full group-hover:scale-110 shadow-lg shadow-blue-200">
                        <div class="absolute -top-1.5 -left-1.5 w-5 h-5 bg-white/15 rounded-full"></div>

                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5"
                            stroke-linecap="round" stroke-linejoin="round" class="relative z-10">
                            <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                            <polyline points="9 22 9 12 15 12 15 22" />
                        </svg>
                    </div>

                    <span class="text-2xl font-black tracking-tighter text-slate-900 leading-none">
                        Easy<span class="text-blue-600">Coloc</span>
                    </span>
                </a>
            </div>

            <div class="bg-white border border-gray-100 shadow-xl rounded-3xl p-8">

                <div class="text-center">
                    <h1 class="text-xl font-semibold text-gray-900">
                        Welcome back
                    </h1>
                    <p class="text-sm text-gray-500 mt-1">
                        Sign in to continue to your account.
                    </p>
                </div>

                @if (session('status'))
                    <div class="mt-4 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="mt-6 space-y-5">
                    @csrf

                    <div>
                        <label for="email" class="text-sm font-medium text-gray-700">
                            Email
                        </label>

                        <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus
                            autocomplete="username" placeholder="name@example.com"
                            class="mt-2 w-full rounded-2xl border-gray-200 
                                  focus:border-blue-500 focus:ring-blue-500 transition-all">

                        @error('email')
                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="text-sm font-medium text-gray-700">
                            Password
                        </label>

                        <input id="password" name="password" type="password" required autocomplete="current-password"
                            placeholder="••••••••"
                            class="mt-2 w-full rounded-2xl border-gray-200 
                                  focus:border-blue-500 focus:ring-blue-500 transition-all">

                        @error('password')
                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-between">
                        <label class="inline-flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="remember"
                                class="rounded border-gray-300 
                                      text-blue-600 focus:ring-blue-500">
                            <span class="text-sm text-gray-600">
                                Remember me
                            </span>
                        </label>

                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}"
                                class="text-sm font-medium text-blue-600 hover:text-blue-700">
                                Forgot password?
                            </a>
                        @endif
                    </div>

                    <button type="submit"
                        class="w-full h-11 rounded-2xl bg-blue-600 
                               text-white text-sm font-bold shadow-md
                               hover:bg-blue-700 hover:shadow-lg transition-all active:scale-[0.98]">
                        Log in
                    </button>

                    @if (Route::has('register'))
                        <p class="text-center text-sm text-gray-600">
                            Don’t have an account?
                            <a href="{{ route('register') }}" class="font-bold text-blue-600 hover:text-blue-700">
                                Create one
                            </a>
                        </p>
                    @endif

                </form>

            </div>

        </div>

    </div>
@endsection
