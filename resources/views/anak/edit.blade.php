@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto p-6">

    <h2 class="text-2xl font-bold mb-6">Edit Data Anak</h2>

    <div class="bg-white p-6 rounded-xl shadow">

        <form method="POST" action="{{ route('anak.update', $anak) }}" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block font-medium mb-1">Nama Anak</label>
                <input type="text"
                       name="nama"
                       value="{{ old('nama', $anak->nama) }}"
                       class="w-full border rounded-lg p-2"
                       required>
            </div>

            <div>
                <label class="block font-medium mb-1">Tanggal Lahir</label>
                <input type="date"
                       name="tanggal_lahir"
                       value="{{ old('tanggal_lahir', $anak->tanggal_lahir) }}"
                       class="w-full border rounded-lg p-2"
                       required>
            </div>

            <div>
                <label class="block font-medium mb-1">Jenis Kelamin</label>
                <select name="jenis_kelamin"
                        class="w-full border rounded-lg p-2"
                        required>
                    <option value="Laki-laki" {{ $anak->jenis_kelamin === 'Laki-laki' ? 'selected' : '' }}>
                        Laki-laki
                    </option>
                    <option value="Perempuan" {{ $anak->jenis_kelamin === 'Perempuan' ? 'selected' : '' }}>
                        Perempuan
                    </option>
                </select>
            </div>

            <div>
                <label class="block font-medium mb-1">Umur</label>
                <input type="text"
                       name="umur"
                       value="{{ old('umur', $anak->umur) }}"
                       class="w-full border rounded-lg p-2"
                       required>
            </div>

            <div class="flex gap-3 pt-4">
                <button class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700">
                    Simpan Perubahan
                </button>

                <a href="{{ route('anak.index') }}"
                   class="px-6 py-2 rounded-lg border border-gray-300 hover:bg-gray-100">
                    Batal
                </a>
            </div>

        </form>

    </div>

</div>
@endsection
