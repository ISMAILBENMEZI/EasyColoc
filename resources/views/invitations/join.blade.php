<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Join with Token</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-gray-50">
    <div class="max-w-xl mx-auto px-4 py-10">
        <a href="{{ route('dashboard') }}" class="text-sm font-semibold text-gray-600 hover:text-gray-900">← Dashboard</a>

        <div class="mt-6 bg-white rounded-3xl border border-gray-200 shadow-sm p-8">
            <h1 class="text-2xl font-black text-slate-900">Join with Token</h1>
            <p class="mt-2 text-sm text-gray-600">Paste the token you received from the owner.</p>

            <form method="POST" action="{{ route('invitations.join.submit') }}" class="mt-6 space-y-4">
                @csrf

                <div>
                    <label class="block text-sm font-semibold text-gray-800">Token</label>
                    <input name="token" value="{{ old('token') }}" type="text"
                        class="mt-2 w-full rounded-2xl border border-gray-200 px-4 py-3 text-sm focus:border-blue-500 focus:ring-4 focus:ring-blue-100" />
                    @error('token')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit"
                    class="w-full rounded-2xl bg-slate-900 px-6 py-3 text-sm font-bold text-white hover:bg-slate-800 transition">
                    Join
                </button>
            </form>
        </div>
    </div>
</body>

</html>
