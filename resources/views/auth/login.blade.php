<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login | Si Kecil Sehat</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-green-600 flex items-center justify-center">

    <div class="w-full max-w-md bg-white rounded-2xl shadow-xl p-8">

        {{-- LOGO --}}
        <div class="text-center mb-6">
            <img src="/logo.png" alt="Si Kecil Sehat" class="h-16 mx-auto mb-2">
            <p class="text-sm text-gray-500">Silakan login untuk melanjutkan</p>
        </div>

        {{-- FORM --}}
        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-medium mb-1">Email</label>
                <input type="email" name="email" required autofocus
                       class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-green-500">
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Password</label>

                <!-- PASSWORD WITH EYE ICON -->
                <div class="relative">
                    <input type="password" name="password" id="password" required
                           class="w-full border rounded-lg p-2 pr-12 focus:ring-2 focus:ring-green-500">

                    <button type="button"
                            onclick="togglePassword()"
                            class="absolute inset-y-0 right-3 flex items-center text-gray-500 hover:text-green-600">
                        
                        <!-- EYE OPEN -->
                        <svg id="eyeOpen" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                             fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7
                                     -1.274 4.057-5.064 7-9.542 7
                                     -4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>

                        <!-- EYE OFF -->
                        <svg id="eyeOff" xmlns="http://www.w3.org/2000/svg"
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

            <div class="flex items-center justify-between text-sm">
                <label class="flex items-center gap-2">
                    <input type="checkbox" name="remember" class="accent-green-600">
                    Ingat saya
                </label>

                <a href="{{ route('password.request') }}" class="text-green-600 hover:underline">
                    Lupa password?
                </a>
            </div>

            <button type="submit"
                    class="w-full bg-green-600 text-white py-2 rounded-lg hover:bg-green-700 transition">
                Login
            </button>
        </form>

        <p class="text-center text-sm mt-6">
            Belum punya akun?
            <a href="{{ route('register') }}" class="text-green-600 font-medium hover:underline">
                Daftar
            </a>
        </p>
    </div>

    <!-- SCRIPT -->
    <script>
        function togglePassword() {
            const password = document.getElementById('password');
            const eyeOpen = document.getElementById('eyeOpen');
            const eyeOff = document.getElementById('eyeOff');

            if (password.type === 'password') {
                password.type = 'text';
                eyeOpen.classList.add('hidden');
                eyeOff.classList.remove('hidden');
            } else {
                password.type = 'password';
                eyeOpen.classList.remove('hidden');
                eyeOff.classList.add('hidden');
            }
        }
    </script>

</body>
</html>