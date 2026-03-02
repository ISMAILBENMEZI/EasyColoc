<section>
    <header>
        <h2 class="text-xl font-bold text-slate-900 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"
                class="text-blue-600">
                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                <circle cx="12" cy="7" r="4" />
            </svg>
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-2 text-sm text-gray-500 leading-relaxed">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-8 space-y-5">
        @csrf
        @method('patch')

        <div>
            <label for="name" class="text-sm font-medium text-gray-700">{{ __('Name') }}</label>
            <input id="name" name="name" type="text"
                class="mt-1 block w-full rounded-2xl border-gray-200 focus:border-blue-500 focus:ring-blue-500 transition-all"
                value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
            @error('name')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="email" class="text-sm font-medium text-gray-700">{{ __('Email') }}</label>
            <input id="email" name="email" type="email"
                class="mt-1 block w-full rounded-2xl border-gray-200 focus:border-blue-500 focus:ring-blue-500 transition-all"
                value="{{ old('email', $user->email) }}" required autocomplete="username" />
            @error('email')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                <div class="mt-4 p-4 rounded-2xl bg-amber-50 border border-amber-100">
                    <p class="text-sm text-amber-800 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10" />
                            <line x1="12" x2="12" y1="8" y2="12" />
                            <line x1="12" x2="12.01" y1="16" y2="16" />
                        </svg>
                        {{ __('Your email address is unverified.') }}
                    </p>

                    <button form="send-verification"
                        class="mt-2 text-sm font-bold text-amber-700 hover:text-amber-900 underline underline-offset-4 decoration-amber-300 transition-colors">
                        {{ __('Click here to re-send the verification email.') }}
                    </button>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-3 font-medium text-sm text-green-600 flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round"
                                stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12" />
                            </svg>
                            {{ __('A new verification link has been sent.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4 pt-2">
            <button type="submit"
                class="px-8 h-11 rounded-2xl bg-blue-600 text-white text-sm font-bold shadow-md shadow-blue-100 hover:bg-blue-700 transition-all active:scale-95">
                {{ __('Save Changes') }}
            </button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm font-medium text-green-600 flex items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round"
                        stroke-linejoin="round">
                        <polyline points="20 6 9 17 4 12" />
                    </svg>
                    {{ __('Profile updated.') }}
                </p>
            @endif
        </div>
    </form>
</section>
