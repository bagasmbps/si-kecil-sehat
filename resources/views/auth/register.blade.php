<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register | Si Kecil Sehat</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-green-600 flex items-center justify-center">

    <div class="w-full max-w-md bg-white rounded-2xl shadow-xl p-8">

        {{-- LOGO --}}
        <div class="text-center mb-6">
            <img src="/logo.png" alt="Si Kecil Sehat" class="h-16 mx-auto mb-2">
            <p class="text-sm text-gray-500">Buat akun baru</p>
        </div>

        {{-- FORM --}}
        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-medium mb-1">Nama</label>
                <input type="text" name="name" required
                       class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-green-500">
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Email</label>
                <input type="email" name="email" required
                       class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-green-500">
            </div>

            <!-- PASSWORD -->
            <div>
                <label class="block text-sm font-medium mb-1">Password</label>
                <div class="relative">
                    <input type="password" name="password" id="password" required
                           class="w-full border rounded-lg p-2 pr-12 focus:ring-2 focus:ring-green-500">

                    <button type="button"
                            onclick="togglePassword('password','eyeOpen1','eyeOff1')"
                            class="absolute inset-y-0 right-3 flex items-center text-gray-500 hover:text-green-600">

                        <!-- EYE OPEN -->
                        <svg id="eyeOpen1" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                             fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M2.458 12C3.732 7.943 7.523 5 12 5
                                     c4.478 0 8.268 2.943 9.542 7
                                     -1.274 4.057-5.064 7-9.542 7
                                     -4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>

                        <!-- EYE OFF -->
                        <svg id="eyeOff1" xmlns="http://www.w3.org/2000/svg"
                             class="h-5 w-5 hidden" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M13.875 18.825A10.05 10.05 0 0112 19
                                     c-4.478 0-8.268-2.943-9.543-7
                                     a9.97 9.97 0 012.093-3.368M6.223 6.223
                                     A9.97 9.97 0 0112 5c4.478 0 8.268 2.943 9.543 7
                                     a9.977 9.977 0 01-4.132 5.411M15 12a3 3 0 00-3-3"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M3 3l18 18"/>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- CONFIRM PASSWORD -->
            <div>
                <label class="block text-sm font-medium mb-1">Konfirmasi Password</label>
                <div class="relative">
                    <input type="password" name="password_confirmation" id="password_confirmation" required
                           class="w-full border rounded-lg p-2 pr-12 focus:ring-2 focus:ring-green-500">

                    <button type="button"
                            onclick="togglePassword('password_confirmation','eyeOpen2','eyeOff2')"
                            class="absolute inset-y-0 right-3 flex items-center text-gray-500 hover:text-green-600">

                        <!-- EYE OPEN -->
                        <svg id="eyeOpen2" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                             fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M2.458 12C3.732 7.943 7.523 5 12 5
                                     c4.478 0 8.268 2.943 9.542 7
                                     -1.274 4.057-5.064 7-9.542 7
                                     -4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>

                        <!-- EYE OFF -->
                        <svg id="eyeOff2" xmlns="http://www.w3.org/2000/svg"
                             class="h-5 w-5 hidden" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M13.875 18.825A10.05 10.05 0 0112 19
                                     c-4.478 0-8.268-2.943-9.543-7
                                     a9.97 9.97 0 012.093-3.368M6.223 6.223
                                     A9.97 9.97 0 0112 5c4.478 0 8.268 2.943 9.543 7
                                     a9.977 9.977 0 01-4.132 5.411M15 12a3 3 0 00-3-3"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M3 3l18 18"/>
                        </svg>
                    </button>
                </div>
            </div>

            <button type="submit"
                    class="w-full bg-green-600 text-white py-2 rounded-lg hover:bg-green-700 transition">
                Daftar
            </button>
        </form>

        <p class="text-center text-sm mt-6">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="text-green-600 font-medium hover:underline">
                Login
            </a>
        </p>
    </div>

    <!-- SCRIPT -->
    <script>
        function togglePassword(inputId, eyeOpenId, eyeOffId) {
            const input = document.getElementById(inputId);
            const eyeOpen = document.getElementById(eyeOpenId);
            const eyeOff = document.getElementById(eyeOffId);

            if (input.type === 'password') {
                input.type = 'text';
                eyeOpen.classList.add('hidden');
                eyeOff.classList.remove('hidden');
            } else {
                input.type = 'password';
                eyeOpen.classList.remove('hidden');
                eyeOff.classList.add('hidden');
            }
        }
    </script>

</body>
</html>