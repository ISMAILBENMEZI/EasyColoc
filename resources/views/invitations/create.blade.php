<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Invite Roommate</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-gray-50">
    <div class="max-w-xl mx-auto px-4 py-10">
        <a href="{{ route('my_colocation.show') }}" class="text-sm font-semibold text-gray-600 hover:text-gray-900">←
            Back</a>

        <div class="mt-6 bg-white rounded-3xl border border-gray-200 shadow-sm p-8">
            <h1 class="text-2xl font-black text-slate-900">Invite by Email</h1>
            <p class="mt-2 text-sm text-gray-600">We will send a token link to the email.</p>

            <form method="POST" action="{{ route('invitations.store') }}" class="mt-6 space-y-4">
                @csrf

                <div>
                    <label class="block text-sm font-semibold text-gray-800">Email</label>
                    <input name="email" value="{{ old('email') }}" type="email"
                        class="mt-2 w-full rounded-2xl border border-gray-200 px-4 py-3 text-sm focus:border-blue-500 focus:ring-4 focus:ring-blue-100" />
                    @error('email')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit"
                    class="w-full rounded-2xl bg-blue-600 px-6 py-3 text-sm font-bold text-white hover:bg-blue-700 transition">
                    Send Invitation
                </button>
            </form>
        </div>
    </div>
</body>

</html>
