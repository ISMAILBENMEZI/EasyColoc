<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <div class="p-2 bg-blue-600 rounded-xl shadow-lg shadow-blue-200">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                    stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
                    <circle cx="12" cy="7" r="4" />
                </svg>
            </div>
            <h2 class="font-bold text-2xl text-slate-900 tracking-tight">
                {{ __('Profile Settings') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50/50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <div
                class="p-6 sm:p-10 bg-white border border-gray-100 shadow-sm rounded-[32px] transition-all hover:shadow-md">
                <div class="max-w-xl">
                    <div class="mb-6">
                        <h3 class="text-lg font-bold text-gray-900">Personal Information</h3>
                        <p class="text-sm text-gray-500">Update your account's profile information and email address.
                        </p>
                    </div>
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div
                class="p-6 sm:p-10 bg-white border border-gray-100 shadow-sm rounded-[32px] transition-all hover:shadow-md">
                <div class="max-w-xl">
                    <div class="mb-6">
                        <h3 class="text-lg font-bold text-gray-900">Security</h3>
                        <p class="text-sm text-gray-500">Ensure your account is using a long, random password to stay
                            secure.</p>
                    </div>
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div
                class="p-6 sm:p-10 bg-white border border-red-50 shadow-sm rounded-[32px] transition-all hover:shadow-md">
                <div class="max-w-xl">
                    <div class="mb-6">
                        <h3 class="text-lg font-bold text-red-600">Danger Zone</h3>
                        <p class="text-sm text-gray-500">Once your account is deleted, all of its resources and data
                            will be permanently deleted.</p>
                    </div>
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
