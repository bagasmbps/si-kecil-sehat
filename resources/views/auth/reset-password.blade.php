<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Reset Password | Si Kecil Sehat</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-green-600 flex items-center justify-center">

    <div class="w-full max-w-md bg-white rounded-2xl shadow-xl p-8">

        {{-- LOGO --}}
        <div class="text-center mb-6">
            <img src="/logo.png" alt="Si Kecil Sehat" class="h-16 mx-auto mb-2">
            <p class="text-sm text-gray-500">
                Silakan buat password baru untuk akun Anda
            </p>
        </div>

        {{-- ERROR --}}
        @if ($errors->any())
            <div class="bg-red-100 text-red-700 text-sm p-3 rounded-lg mb-4">
                {{ $errors->first() }}
            </div>
        @endif

        {{-- FORM --}}
        <form method="POST" action="{{ route('password.update') }}" class="space-y-4">
            @csrf

            {{-- TOKEN --}}
            <input type="hidden" name="token" value="{{ request()->route('token') }}">

            {{-- EMAIL --}}
            <div>
                <label class="block text-sm font-medium mb-1">Email</label>
                <input type="email" name="email"
                       value="{{ old('email', request('email')) }}"
                       required autofocus
                       class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-green-500">
            </div>

            {{-- PASSWORD BARU --}}
            <div>
                <label class="block text-sm font-medium mb-1">Password Baru</label>
                <input type="password" name="password" required
                       class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-green-500">
            </div>

            {{-- KONFIRMASI --}}
            <div>
                <label class="block text-sm font-medium mb-1">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" required
                       class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-green-500">
            </div>

            <button type="submit"
                class="w-full bg-green-600 text-white py-2 rounded-lg
                       hover:bg-green-700 transition">
                Reset Password
            </button>
        </form>

        <div class="text-center text-sm mt-6">
            <a href="{{ route('login') }}"
               class="text-green-600 font-medium hover:underline">
                ← Kembali ke Login
            </a>
        </div>

    </div>

</body>
</html>