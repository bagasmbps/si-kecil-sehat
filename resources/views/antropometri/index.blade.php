@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto p-6 space-y-8">

    {{-- JUDUL --}}
    <div>
        <h2 class="text-2xl font-bold tracking-tight">Antropometri Anak</h2>
        <p class="text-sm text-gray-500">
            Input dan pantau status gizi anak berdasarkan pengukuran antropometri
        </p>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    {{-- FORM INPUT --}}
    <div class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition">
        <h3 class="font-semibold mb-4">📋 Input Data Antropometri</h3>

        <form method="POST" action="{{ route('antropometri.store') }}"
              class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @csrf

            <div class="md:col-span-2">
                <label class="block text-sm font-medium mb-1">Pilih Anak</label>
                <select name="anak_id" class="w-full border rounded-lg p-2" required>
                    <option value="">-- Pilih Anak --</option>
                    @foreach($anaks as $anak)
                        <option value="{{ $anak->id }}">{{ $anak->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm mb-1">Umur (bulan)</label>
                <input type="number" name="umur_bulan"
                       class="w-full border rounded-lg p-2" required>
            </div>

            <div>
                <label class="block text-sm mb-1">Berat Badan (kg)</label>
                <input type="number" step="0.1" name="berat_badan"
                       class="w-full border rounded-lg p-2" required>
            </div>

            <div>
                <label class="block text-sm mb-1">Tinggi Badan (cm)</label>
                <input type="number" step="0.1" name="tinggi_badan"
                       class="w-full border rounded-lg p-2" required>
            </div>

            <div>
                <label class="block text-sm mb-1">Lingkar Kepala (cm)</label>
                <input type="number" step="0.1" name="lingkar_kepala"
                       class="w-full border rounded-lg p-2">
            </div>

            <div class="md:col-span-2">
                <button
                    class="inline-flex items-center gap-2 bg-green-600 text-white
                           px-6 py-2 rounded-lg hover:bg-green-700 transition">
                    💾 Simpan & Hitung
                </button>
            </div>
        </form>
    </div>

    {{-- RIWAYAT --}}
    <div class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition">
        <h3 class="text-lg font-semibold mb-4">📊 Hasil Perhitungan</h3>

        @if($riwayat->count() === 0)
            <p class="text-gray-500">Belum ada data antropometri.</p>
        @else
            <div class="overflow-x-auto">
                <table class="w-full border-collapse text-sm">
                    <thead>
                        <tr class="bg-gray-100 text-gray-700">
                            <th class="p-3 text-left">Nama</th>
                            <th class="p-3 text-center">IMT</th>
                            <th class="p-3 text-center">Status Gizi</th>
                            <th class="p-3 text-center">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($riwayat as $item)
                            @php
                                $tinggi_m = $item->tinggi_badan / 100;
                                $imt = round($item->berat_badan / ($tinggi_m * $tinggi_m), 2);

                                if ($imt < 14) {
                                    $status = 'Gizi Kurang';
                                    $badge  = 'bg-blue-100 text-blue-700';
                                } elseif ($imt < 18) {
                                    $status = 'Normal';
                                    $badge  = 'bg-green-100 text-green-700';
                                } else {
                                    $status = 'Risiko Gizi Lebih';
                                    $badge  = 'bg-red-100 text-red-700';
                                }
                            @endphp
                            <tr class="border-t hover:bg-gray-50">
                                <td class="p-3">{{ $item->anak->nama }}</td>
                                <td class="p-3 text-center font-semibold">
                                    {{ $imt }}
                                </td>
                                <td class="p-3 text-center">
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $badge }}">
                                        {{ $status }}
                                    </span>
                                </td>
                                <td class="p-3 text-center">
                                    {{ $item->created_at->format('d M Y') }}
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