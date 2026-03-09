@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto space-y-10">

    {{-- HEADER --}}
    <div class="mb-8">
        <h1 class="mt-4 text-3xl font-bold text-gray-800">
            👋 Hai, {{ Auth::user()->name }}
        </h1>
        <p class="text-gray-600 mt-1">
            Selamat datang di <span class="font-semibold text-green-600">Si Kecil Sehat</span>,  
            pantau tumbuh kembang anak secara mudah dan terstruktur.
        </p>
    </div>

    {{-- CARD ANAK --}}
    <div class="grid md:grid-cols-2 gap-6">
        @foreach($anaks as $anak)
        <div class="relative bg-white rounded-2xl p-6 shadow hover:shadow-lg transition">

            {{-- BADGE STATUS IMUNISASI --}}
            <span class="absolute top-4 right-4 px-3 py-1 text-xs rounded-full {{ $anak->badge_class }}">
                {{ $anak->badge_text }}
            </span>

            <h3 class="text-lg font-semibold">{{ $anak->nama }}</h3>

            <p class="text-sm text-gray-500 mt-1">
                Umur:
                {{ floor(\Carbon\Carbon::parse($anak->tanggal_lahir)->diffInMonths(now())) }}
                bulan
            </p>

            <div class="mt-4 flex gap-3">
                <a href="{{ route('imunisasi.show', $anak->id) }}"
                   class="px-4 py-2 text-sm rounded-lg bg-green-100 text-green-700 hover:bg-green-200">
                    🧾 Imunisasi
                </a>

            </div>

        </div>
        @endforeach
    </div>

    {{-- FEATURE CARDS --}}
    <div class="space-y-6">

        {{-- DATA ANAK --}}
        <a href="/data-anak"
           class="block bg-white rounded-2xl shadow hover:shadow-lg transition p-6 border-l-8 border-green-500">
            <h3 class="text-xl font-semibold text-gray-800">
                👶 Data Anak
            </h3>
            <p class="text-gray-600 mt-1">
                Kelola data dasar anak seperti nama, usia, dan identitas.
            </p>
        </a>

        {{-- ANTROPOMETRI --}}
        <a href="/antropometri"
           class="block bg-white rounded-2xl shadow hover:shadow-lg transition p-6 border-l-8 border-blue-500">
            <h3 class="text-xl font-semibold text-gray-800">
                ⚖️ Antropometri
            </h3>
            <p class="text-gray-600 mt-1">
                Hitung IMT, status gizi, serta riwayat pengukuran anak.
            </p>
        </a>

        {{-- GRAFIK --}}
        <a href="{{ route('antropometri.grafik') }}"
           class="block bg-white rounded-2xl shadow hover:shadow-lg transition p-6 border-l-8 border-purple-500">
            <h3 class="text-xl font-semibold text-gray-800">
                📈 Grafik Pertumbuhan
            </h3>
            <p class="text-gray-600 mt-1">
                Visualisasi IMT, berat & tinggi badan berdasarkan waktu.
            </p>
        </a>

        {{-- PERKEMBANGAN --}}
        <a href="/perkembangan"
           class="block bg-white rounded-2xl shadow hover:shadow-lg transition p-6 border-l-8 border-orange-500">
            <h3 class="text-xl font-semibold text-gray-800">
                🧠 Perkembangan Anak
            </h3>
            <p class="text-gray-600 mt-1">
                Penilaian milestone usia & rekomendasi stimulasi.
            </p>
        </a>

    </div>
    {{-- EDUKASI --}}
    <div class="mt-10 bg-green-50 border-l-4 border-green-600 p-6 rounded-xl">
        <h4 class="font-semibold text-green-800 mb-2">
            💡 Edukasi Kesehatan
        </h4>
        <p class="text-green-700 text-sm leading-relaxed">
            Pemantauan pertumbuhan dan perkembangan secara rutin membantu
            deteksi dini gangguan gizi maupun keterlambatan perkembangan
            sehingga intervensi dapat dilakukan lebih cepat dan tepat.
        </p>
    </div>

</div>
@endsection

@push('styles')
<style>
.menu-card{
    display:block;
    background:white;
    padding:20px;
    border-radius:16px;
    box-shadow:0 8px 20px rgba(0,0,0,.05);
    transition:.2s;
}
.menu-card:hover{
    transform:translateY(-4px);
    box-shadow:0 12px 30px rgba(0,0,0,.1);
}
.menu-card p{
    font-size:13px;
    color:#6b7280;
}
</style>
@endpush