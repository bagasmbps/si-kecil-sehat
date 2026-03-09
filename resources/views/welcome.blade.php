<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Si Kecil Sehat</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-green-600 relative overflow-hidden">

    {{-- ORNAMEN BULAT --}}
    <div class="absolute -top-24 -left-24 w-96 h-96 bg-green-500 rounded-full opacity-30"></div>
    <div class="absolute top-1/2 -right-32 w-96 h-96 bg-green-700 rounded-full opacity-20"></div>
    <div class="absolute bottom-0 left-1/3 w-72 h-72 bg-green-500 rounded-full opacity-20"></div>

    {{-- HERO --}}
    <div class="relative z-10 flex items-center justify-center min-h-screen px-6">

        <div class="text-center max-w-2xl">

            {{-- LOGO --}}
            <div class="flex justify-center items-center gap-4 mb-6">
                <img src="/logo.png" alt="Si Kecil Sehat" class="h-24 drop-shadow-lg">
            </div>

            {{-- DESKRIPSI --}}
            <p class="text-white/90 text-lg md:text-xl mb-8 leading-relaxed">
                Media edukasi untuk membantu orang tua memantau
                <strong>pertumbuhan</strong>, <strong>gizi</strong>, dan
                <strong>perkembangan balita & anak pra sekolah</strong>.
            </p>

            {{-- BADGE FITUR --}}
            <div class="flex flex-wrap justify-center gap-1.5 mb-5">
                <span class="bg-white/20 text-white px-4 py-1.5 rounded-full text-sm">
                    🧒 Data Anak
                </span>
                <span class="bg-white/20 text-white px-4 py-1.5 rounded-full text-sm">
                    ⚖️ Antropometri
                </span>
                <span class="bg-white/20 text-white px-4 py-1.5 rounded-full text-sm">
                    📈 Grafik Pertumbuhan
                </span>
                <span class="bg-white/20 text-white px-4 py-1.5 rounded-full text-sm">
                    🧠 Perkembangan Anak
                </span>
            </div>

            {{-- FITUR TAMBAHAN --}}
            <div class="flex flex-wrap justify-center gap-1.5 mb-5">
                <span class="bg-white/20 text-white px-4 py-1.5 rounded-full text-sm">
                    💉 Monitoring Imunisasi
                </span>
            </div>

            {{-- BUTTON --}}
            <a href="{{ route('login') }}"
               class="inline-flex items-center gap-2 bg-white text-green-600 font-semibold px-10 py-4 rounded-full shadow-lg hover:scale-105 hover:bg-green-50 transition">
                Mulai
                <span class="text-xl">→</span>
            </a>

            {{-- FOOTER TEKS --}}
            <p class="text-white/70 text-sm mt-10">
                Dibuat untuk edukasi kesehatan ibu & anak ❤️
            </p>

        </div>
    </div>

</body>
</html>
