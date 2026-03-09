@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto p-6 space-y-8">

    {{-- JUDUL --}}
    <div>
        <h2 class="text-2xl font-bold tracking-tight">Data Anak</h2>
        <p class="text-sm text-gray-500">
            Kelola data dasar anak sebagai dasar pemantauan tumbuh kembang
        </p>
    </div>

    {{-- FLASH MESSAGE --}}
    @if(session('success'))
        <div class="bg-green-100 text-green-700 px-4 py-3 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    {{-- FORM INPUT --}}
    <div class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition">
        <h3 class="font-semibold mb-4">🧒 Tambah Data Anak</h3>

        <form method="POST" action="{{ route('anak.store') }}"
              class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @csrf

            <div>
                <label class="block text-sm font-medium mb-1">Nama Anak</label>
                <input name="nama"
                       class="w-full border rounded-lg p-2"
                       placeholder="Nama lengkap anak"
                       required>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir"
                       class="w-full border rounded-lg p-2"
                       required>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Jenis Kelamin</label>
                <select name="jenis_kelamin"
                        class="w-full border rounded-lg p-2"
                        required>
                    <option value="">-- Pilih --</option>
                    <option>Laki-laki</option>
                    <option>Perempuan</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Umur</label>
                <input name="umur"
                       placeholder="contoh: 2 tahun 3 bulan"
                       class="w-full border rounded-lg p-2"
                       required>
            </div>

            <div class="md:col-span-2">
                <button
                    class="inline-flex items-center gap-2 bg-green-600 text-white
                           px-6 py-2 rounded-lg hover:bg-green-700 transition">
                    💾 Simpan Data
                </button>
            </div>
        </form>
    </div>

    {{-- DAFTAR ANAK --}}
    <div class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition">
        <h3 class="text-lg font-semibold mb-4">📋 Daftar Anak</h3>

        @if($anaks->count() === 0)
            <p class="text-gray-500">Belum ada data anak.</p>
        @else
            <div class="overflow-x-auto">
                <table class="w-full border-collapse text-sm">
                    <thead>
                        <tr class="bg-gray-100 text-gray-700">
                            <th class="p-3 text-left">Nama</th>
                            <th class="p-3 text-left">Jenis Kelamin</th>
                            <th class="p-3 text-left">Umur</th>
                            <th class="p-3 text-left">Tanggal Lahir</th>
                            <th class="p-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($anaks as $anak)
                        <tr class="border-t hover:bg-gray-50">
                            <td class="p-3 font-medium">{{ $anak->nama }}</td>
                            <td class="p-3">{{ $anak->jenis_kelamin }}</td>
                            <td class="p-3">{{ $anak->umur }}</td>
                            <td class="p-3">
                                {{ \Carbon\Carbon::parse($anak->tanggal_lahir)->format('d M Y') }}
                            </td>
                            <td class="p-3 text-center">
                                <div class="flex justify-center gap-2">
                                    <a href="{{ route('anak.edit', $anak) }}"
                                       class="px-3 py-1 bg-blue-500 text-white
                                              rounded-lg text-xs hover:bg-blue-600">
                                        Edit
                                    </a>

                                    <form method="POST" action="{{ route('anak.destroy', $anak) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            onclick="return confirm('Yakin ingin menghapus data ini?')"
                                            class="px-3 py-1 bg-red-500 text-white
                                                   rounded-lg text-xs hover:bg-red-600">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

</div>
@endsection