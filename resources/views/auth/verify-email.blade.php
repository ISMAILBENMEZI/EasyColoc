@extends('layouts.guest')

@section('content')
    <div class="min-h-screen bg-gray-50 flex items-center justify-center px-4 py-10">

        <div class="w-full max-w-md">

            <div class="mb-8 flex justify-center">
                <a href="{{ url('/') }}" class="group inline-flex items-center gap-[10px] no-underline select-none">
                    <div
                        class="relative flex h-[36px] w-[36px] shrink-0 items-center justify-center overflow-hidden bg-blue-600 rounded-[10px] transition-all duration-300 ease-in-out group-hover:rounded-full group-hover:scale-110 shadow-lg shadow-blue-200">
                        <div class="absolute -left-[6px] -top-[6px] h-5 w-5 rounded-full bg-white/15"></div>
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5"
                            stroke-linecap="round" stroke-linejoin="round" class="relative z-10">
                            <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                            <polyline points="9 22 9 12 15 12 15 22" />
                        </svg>
                    </div>
                    <div class="text-[19px] font-[900] tracking-[-0.04em] text-[#1a1625] leading-none">
                        Easy<span class="text-blue-600">Coloc</span>
                    </div>
                </a>
            </div>

            <div class="bg-white border border-gray-100 shadow-xl rounded-3xl p-8">

                <div class="text-center mb-6">
                    <div
                        class="inline-flex items-center justify-center w-12 h-12 bg-blue-50 text-blue-600 rounded-full mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <rect width="20" height="16" x="2" y="4" rx="2" />
                            <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7" />
                        </svg>
                    </div>
                    <h1 class="text-xl font-semibold text-gray-900">Verify your email</h1>
                    <p class="text-sm text-gray-500 mt-2 leading-relaxed">
                        {{ __('Thanks for signing up! Please verify your email address by clicking the link we just sent to you. If you didn\'t receive it, we\'ll send another.') }}
                    </p>
                </div>

                @if (session('status') == 'verification-link-sent')
                    <div
                        class="mb-6 rounded-xl border border-green-100 bg-green-50 px-4 py-3 text-sm text-green-700 text-center">
                        {{ __('A new verification link has been sent to your email address.') }}
                    </div>
                @endif

                <div class="mt-8 space-y-4">
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <button type="submit"
                            class="w-full h-11 rounded-2xl bg-blue-600 text-white text-sm font-bold shadow-md hover:bg-blue-700 transition-all active:scale-[0.98]">
                            {{ __('Resend Verification Email') }}
                        </button>
                    </form>

                    <form method="POST" action="{{ route('logout') }}" class="text-center">
                        @csrf
                        <button type="submit"
                            class="text-sm font-medium text-gray-500 hover:text-red-600 transition-colors underline decoration-gray-300 underline-offset-4">
                            {{ __('Log Out') }}
                        </button>
                    </form>
                </div>

            </div>

        </div>

    </div>
@endsection
