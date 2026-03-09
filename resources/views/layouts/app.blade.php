<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Si Kecil Sehat</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-gray-50">

    {{-- NAVBAR --}}
    @auth
    <nav class="sticky top-0 z-50 bg-green-600/90 backdrop-blur text-white shadow-md">
        <div class="max-w-7xl mx-auto px-6 py-3 flex justify-between items-center">

            {{-- BRAND --}}
            <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
                <img src="/logo.png" alt="Si Kecil Sehat" class="h-9 drop-shadow-sm">
                <div class="leading-tight">
                </div>
            </a>

            {{-- ACTION --}}
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button
                    class="flex items-center gap-2 bg-white/90 text-green-700 px-4 py-2 rounded-lg text-sm font-medium
                           hover:bg-white transition shadow-sm">
                    <span>Logout</span>
                </button>
            </form>

        </div>
    </nav>
    @endauth

    {{-- CONTENT --}}
    <main class="pt-6">
        @yield('content')
    </main>

</body>
</html>