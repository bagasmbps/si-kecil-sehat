@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto p-6 space-y-6">

    <h2 class="text-2xl font-bold">
        💉 Detail Imunisasi — {{ $anak->nama }}
    </h2>

    <p class="text-sm text-gray-600">
        Umur: {{ number_format($umur, 1) }} bulan
    </p>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-xl shadow overflow-hidden">
                @php
            $adaTerlambat = collect($data)->contains(fn($i) => $i['status'] === 'Terlambat');
            $adaBelum     = collect($data)->contains(fn($i) => $i['status'] === 'Belum');
        @endphp

        <div class="mt-4 mb-4 space-y-2 text-sm">

            @if($adaTerlambat)
                <div class="p-4 rounded-lg bg-red-50 text-red-700">
                    ⚠️ <strong>Perhatian:</strong>
                    Terdapat imunisasi yang <strong>terlambat</strong>.
                    Segera lakukan imunisasi untuk menjaga kesehatan dan perlindungan anak.
                </div>
            @endif

            @if($adaBelum)
                <div class="p-4 rounded-lg bg-yellow-50 text-yellow-700">
                    ⏳ <strong>Informasi:</strong>
                    Beberapa imunisasi belum dapat diberikan karena usia anak
                    belum mencukupi. Silakan pantau jadwal imunisasi sesuai usia anjuran.
                </div>
            @endif

            @if(!$adaTerlambat && !$adaBelum)
                <div class="p-4 rounded-lg bg-green-50 text-green-700">
                    ✅ <strong>Lengkap:</strong>
                    Seluruh imunisasi anak telah dilakukan sesuai jadwal.
                </div>
            @endif
        </div>
        <table class="w-full text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3 text-left">Imunisasi</th>
                    <th class="p-3 text-center">Usia Anjuran</th>
                    <th class="p-3 text-center">Status</th>
                    <th class="p-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $item)
                <tr class="border-t">

                    {{-- Nama imunisasi --}}
                    <td class="p-3">
                        {{ $item['nama'] }}
                    </td>

                    {{-- Usia anjuran --}}
                    <td class="p-3 text-center">
                        {{ $item['umur_bulan'] }} bulan
                    </td>

                    {{-- Status --}}
                    <td class="p-3 text-center">
                        @if($item['status'] === 'Sudah')
                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs">
                                ✔ Sudah
                            </span>
                        @elseif($item['status'] === 'Terlambat')
                            <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs">
                                ⚠ Terlambat
                            </span>
                        @else
                            <span class="bg-gray-100 text-gray-600 px-3 py-1 rounded-full text-xs">
                                Belum
                            </span>
                        @endif
                    </td>

                    {{-- Aksi --}}
                    <td class="p-3 text-center">
                        <form method="POST" action="{{ route('imunisasi.toggle', [$anak->id, $item['id']]) }}">
                            @csrf
                            @method('PUT')

                            @if($item['status'] === 'Sudah')
                                {{-- Sudah → boleh dibatalkan --}}
                                <button
                                    class="text-xs bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">
                                    Batalkan
                                </button>

                            @elseif($item['status'] === 'Terlambat')
                                {{-- Terlambat → tandai sekarang --}}
                                <button
                                    class="text-xs bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">
                                    Tandai Sekarang
                                </button>

                            @else
                                {{-- Belum --}}
                                <button
                                    class="text-xs bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700">
                                    Tandai Sudah
                                </button>
                            @endif
                        </form>
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection