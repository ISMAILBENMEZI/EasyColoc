<section class="space-y-6">
    <header>
        <h2 class="text-xl font-bold text-red-600 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z" />
                <path d="M12 9v4" />
                <path d="M12 17h.01" />
            </svg>
            {{ __('Delete Account') }}
        </h2>

        <p class="mt-2 text-sm text-gray-500 leading-relaxed">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="inline-flex items-center px-6 py-3 bg-red-50 text-red-600 font-bold text-sm rounded-2xl border border-red-100 hover:bg-red-600 hover:text-white transition-all duration-300 active:scale-95 shadow-sm">
        {{ __('Delete Account') }}
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-8 bg-white rounded-[32px]">
            @csrf
            @method('delete')

            <h2 class="text-xl font-bold text-gray-900">
                {{ __('Are you sure you want to delete your account?') }}
            </h2>

            <p class="mt-3 text-sm text-gray-500 leading-relaxed">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
            </p>

            <div class="mt-6">
                <label for="password" class="sr-only">{{ __('Password') }}</label>

                <input id="password" name="password" type="password"
                    class="block w-full sm:w-3/4 rounded-2xl border-gray-200 focus:border-red-500 focus:ring-red-500 transition-all"
                    placeholder="{{ __('Enter your password to confirm') }}" />

                @error('password', 'userDeletion')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-8 flex flex-col sm:flex-row justify-end gap-3">
                <button type="button" x-on:click="$dispatch('close')"
                    class="px-6 py-3 rounded-2xl bg-gray-100 text-gray-600 font-bold text-sm hover:bg-gray-200 transition-all">
                    {{ __('Cancel') }}
                </button>

                <button type="submit"
                    class="px-6 py-3 rounded-2xl bg-red-600 text-white font-bold text-sm shadow-lg shadow-red-200 hover:bg-red-700 transition-all active:scale-95">
                    {{ __('Yes, Delete Account') }}
                </button>
            </div>
        </form>
    </x-modal>
</section>
