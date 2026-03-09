@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">

    <h2 class="text-2xl font-bold mb-6">Antropometri Anak</h2>

    <div class="bg-white p-6 rounded-xl shadow mb-6">
        <p class="text-gray-600 mb-6">
            Antropometri adalah pengukuran fisik anak yang digunakan untuk
            menilai status gizi dan mendeteksi dini masalah pertumbuhan
            seperti stunting atau gizi kurang.
        </p>

        <form class="grid grid-cols-1 md:grid-cols-2 gap-4">

            <div>
                <label class="block font-medium mb-1">Umur Anak (bulan)</label>
                <input type="number" placeholder="Contoh: 36"
                       class="w-full border border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-green-500 focus:outline-none">
            </div>

            <div>
                <label class="block font-medium mb-1">Berat Badan (kg)</label>
                <input type="number" step="0.1" placeholder="Contoh: 12.5"
                       class="w-full border border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-green-500 focus:outline-none">
            </div>

            <div>
                <label class="block font-medium mb-1">Tinggi / Panjang Badan (cm)</label>
                <input type="number" step="0.1" placeholder="Contoh: 90"
                       class="w-full border border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-green-500 focus:outline-none">
            </div>

            <div>
                <label class="block font-medium mb-1">Lingkar Kepala (cm)</label>
                <input type="number" step="0.1" placeholder="Contoh: 48"
                       class="w-full border border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-green-500 focus:outline-none">
            </div>

        </form>

        <button type="button"
                class="mt-6 bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700">
            Lihat Hasil
        </button>
    </div>

    <!-- HASIL (DUMMY) -->
    <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded mb-6">
        <p class="font-semibold text-green-800 mb-1">Hasil Penilaian</p>
        <p class="text-sm text-green-700">
            Status gizi anak berada dalam kategori <strong>Normal</strong>.
            Lanjutkan pemantauan rutin setiap bulan.
        </p>
    </div>

    <!-- EDUKASI -->
    <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded">
        <p class="text-sm text-yellow-800">
            💡 <strong>Edukasi:</strong><br>
            Pengukuran berat badan dan tinggi badan secara rutin membantu
            mendeteksi gangguan pertumbuhan sejak dini. Jika hasil pengukuran
            tidak sesuai kurva pertumbuhan, segera konsultasikan ke tenaga
            kesehatan.
        </p>
    </div>

</div>
@endsection
