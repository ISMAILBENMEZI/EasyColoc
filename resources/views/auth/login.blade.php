<x-guest-layout>
    <div class="mb-6">
        <h1 class="text-xl font-semibold text-gray-900">Welcome back</h1>
        <p class="text-sm text-gray-500 mt-1">Sign in to continue.</p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input
                id="email"
                class="mt-2 block w-full rounded-2xl border-gray-200 bg-gray-50/40
                       focus:border-indigo-500 focus:ring-indigo-500"
                type="email"
                name="email"
                :value="old('email')"
                required autofocus autocomplete="username"
                placeholder="name@example.com"
            />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input
                id="password"
                class="mt-2 block w-full rounded-2xl border-gray-200 bg-gray-50/40
                       focus:border-indigo-500 focus:ring-indigo-500"
                type="password"
                name="password"
                required autocomplete="current-password"
                placeholder="••••••••"
            />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between pt-1">
            <label for="remember_me" class="inline-flex items-center gap-2">
                <input id="remember_me" type="checkbox"
                       class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                       name="remember">
                <span class="text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm font-medium text-indigo-600 hover:text-indigo-700"
                   href="{{ route('password.request') }}">
                    {{ __('Forgot password?') }}
                </a>
            @endif
        </div>

        <button type="submit"
            class="w-full h-11 rounded-2xl bg-indigo-600 text-white text-sm font-semibold
                   hover:bg-indigo-700 transition shadow-sm">
            {{ __('Log in') }}
        </button>

        @if (Route::has('register'))
            <div class="pt-2 text-center text-sm text-gray-600">
                Don’t have an account?
                <a href="{{ route('register') }}" class="font-semibold text-indigo-600 hover:text-indigo-700">
                    Create one
                </a>
            </div>
        @endif
    </form>
</x-guest-layout>