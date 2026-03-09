@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto">

    <h2 class="text-2xl font-bold mb-6">Perkembangan Anak</h2>

    <div class="bg-white p-6 rounded-xl shadow mb-6">
        <p class="text-gray-600 mb-6">
            Pemantauan perkembangan anak dilakukan untuk menilai kemampuan
            motorik, bahasa, dan sosial sesuai usia. Deteksi dini keterlambatan
            perkembangan sangat penting untuk intervensi yang tepat.
        </p>

        <!-- MOTORIK KASAR -->
        <div class="mb-6">
            <h3 class="font-semibold text-lg mb-3">Motorik Kasar</h3>
            <div class="space-y-2">
                <label class="flex items-center gap-2">
                    <input type="checkbox" class="accent-green-600">
                    Anak dapat berdiri tanpa bantuan
                </label>
                <label class="flex items-center gap-2">
                    <input type="checkbox" class="accent-green-600">
                    Anak dapat berjalan sendiri
                </label>
                <label class="flex items-center gap-2">
                    <input type="checkbox" class="accent-green-600">
                    Anak dapat berlari
                </label>
            </div>
        </div>

        <!-- MOTORIK HALUS -->
        <div class="mb-6">
            <h3 class="font-semibold text-lg mb-3">Motorik Halus</h3>
            <div class="space-y-2">
                <label class="flex items-center gap-2">
                    <input type="checkbox" class="accent-green-600">
                    Anak dapat memegang benda kecil
                </label>
                <label class="flex items-center gap-2">
                    <input type="checkbox" class="accent-green-600">
                    Anak dapat mencoret-coret
                </label>
                <label class="flex items-center gap-2">
                    <input type="checkbox" class="accent-green-600">
                    Anak dapat menyusun balok
                </label>
            </div>
        </div>

        <!-- BAHASA & SOSIAL -->
        <div class="mb-6">
            <h3 class="font-semibold text-lg mb-3">Bahasa & Sosial</h3>
            <div class="space-y-2">
                <label class="flex items-center gap-2">
                    <input type="checkbox" class="accent-green-600">
                    Anak dapat mengucapkan kata sederhana
                </label>
                <label class="flex items-center gap-2">
                    <input type="checkbox" class="accent-green-600">
                    Anak dapat merespons panggilan nama
                </label>
                <label class="flex items-center gap-2">
                    <input type="checkbox" class="accent-green-600">
                    Anak dapat bermain dengan teman sebaya
                </label>
            </div>
        </div>

        <button type="button"
            class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700">
            Simpan Penilaian
        </button>
    </div>

    <!-- KESIMPULAN -->
    <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded">
        <p class="font-semibold text-blue-800 mb-1">Kesimpulan</p>
        <p class="text-sm text-blue-700">
            Berdasarkan hasil pemantauan, perkembangan anak
            berada dalam kategori <strong>Sesuai Usia</strong>.
        </p>
    </div>

</div>
@endsection
