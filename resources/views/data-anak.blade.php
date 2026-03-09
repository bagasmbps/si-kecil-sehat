@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto">

    <h2 class="text-2xl font-bold mb-6">Data Anak</h2>

    <div class="bg-white p-6 rounded-xl shadow">

        <p class="text-gray-600 mb-6">
            Pengisian data dasar anak sangat penting untuk memantau
            pertumbuhan dan perkembangan secara optimal.
        </p>

        {{-- FORM --}}
        <form method="POST" action="/data-anak" class="space-y-4">
            @csrf

            <div>
                <label class="block font-medium mb-1">Nama Anak</label>
                <input type="text" name="nama" placeholder="Masukkan nama anak"
                       class="w-full border rounded-lg p-2"
                       required>
            </div>

            <div>
                <label class="block font-medium mb-1">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir"
                       class="w-full border rounded-lg p-2"
                       required>
            </div>

            <div>
                <label class="block font-medium mb-1">Jenis Kelamin</label>
                <select name="jenis_kelamin"
                        class="w-full border rounded-lg p-2"
                        required>
                    <option value="">-- Pilih --</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>

            <div>
                <label class="block font-medium mb-1">Umur Anak</label>
                <input type="text" name="umur"
                       placeholder="Contoh: 3 tahun 2 bulan"
                       class="w-full border rounded-lg p-2">
            </div>

            <button type="submit"
                    class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700">
                Simpan Data
            </button>
        </form>

    </div>

    {{-- EDUKASI --}}
    <div class="bg-green-50 border-l-4 border-green-500 p-4 mt-6 rounded">
        <p class="text-sm text-green-800">
            💡 <strong>Edukasi:</strong><br>
            Data anak digunakan sebagai dasar dalam pemantauan status gizi,
            perkembangan motorik, dan deteksi dini gangguan tumbuh kembang.
        </p>
    </div>

</div>
@endsection
