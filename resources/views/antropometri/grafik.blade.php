@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto p-6 space-y-6">

    {{-- JUDUL --}}
    <div>
        <h2 class="text-2xl font-bold">Grafik Pertumbuhan Anak</h2>
        <p class="text-sm text-gray-500">
            Pantau berat badan, tinggi badan, dan IMT anak secara berkala
        </p>
    </div>

    {{-- PILIH ANAK --}}
    <form method="GET" class="max-w-md">
        <label class="block text-sm font-medium mb-1">Pilih Anak</label>
        <select name="anak_id" onchange="this.form.submit()"
                class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-green-500">
            <option value="">-- Pilih Anak --</option>
            @foreach($anaks as $anak)
                <option value="{{ $anak->id }}"
                    {{ request('anak_id') == $anak->id ? 'selected' : '' }}>
                    {{ $anak->nama }}
                </option>
            @endforeach
        </select>
    </form>

    @if($anakDipilih && $data->count() > 0)

        {{-- INFO ANAK --}}
        <div class="bg-green-50 border border-green-200 p-4 rounded-xl text-sm text-green-700">
            Menampilkan grafik pertumbuhan untuk
            <strong>{{ $anakDipilih->nama }}</strong>
            berdasarkan data antropometri yang telah dicatat.
        </div>

        {{-- GRID GRAFIK --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            {{-- BERAT BADAN --}}
            <div class="bg-white p-6 rounded-xl shadow">
                <h3 class="font-semibold mb-1">📈 Berat Badan (kg)</h3>
                <p class="text-xs text-gray-500 mb-3">
                    Perubahan berat badan anak dari waktu ke waktu
                </p>
                <canvas id="bbChart"></canvas>
            </div>

            {{-- TINGGI BADAN --}}
            <div class="bg-white p-6 rounded-xl shadow">
                <h3 class="font-semibold mb-1">📏 Tinggi Badan (cm)</h3>
                <p class="text-xs text-gray-500 mb-3">
                    Pertumbuhan tinggi badan anak
                </p>
                <canvas id="tbChart"></canvas>
            </div>

            {{-- IMT --}}
            <div class="bg-white p-6 rounded-xl shadow md:col-span-2">
                <h3 class="font-semibold mb-1">⚖️ Indeks Massa Tubuh (IMT)</h3>
                <p class="text-xs text-gray-500 mb-3">
                    Perbandingan IMT anak dengan standar WHO (IMT/U)
                </p>

                <canvas id="imtChart"></canvas>

                {{-- LABEL STATUS IMT (STEP 3) --}}
                @php
                    $last = $data->last();
                @endphp

                @if($last)
                    @php
                        $imtTerakhir = round(
                            $last->berat_badan / pow($last->tinggi_badan / 100, 2),
                            2
                        );

                        if ($imtTerakhir < 14) {
                            $label = 'Kurus';
                            $class = 'bg-blue-100 text-blue-700';
                        } elseif ($imtTerakhir < 18) {
                            $label = 'Normal';
                            $class = 'bg-green-100 text-green-700';
                        } else {
                            $label = 'Gemuk';
                            $class = 'bg-red-100 text-red-700';
                        }
                    @endphp

                    <div class="mt-4">
                        <span class="px-4 py-1.5 rounded-full text-sm font-semibold {{ $class }}">
                            Status IMT Terakhir: {{ $label }} ({{ $imtTerakhir }})
                        </span>
                    </div>
                @endif
            </div>

        </div>

        {{-- CATATAN --}}
        <div class="bg-blue-50 border border-blue-200 p-4 rounded-xl text-sm text-blue-700">
            ℹ️ Grafik IMT menggunakan nilai referensi WHO sebagai
            <strong>pendekatan edukatif</strong>, bukan diagnosis medis.
        </div>

    @elseif($anakDipilih)
        <p class="text-gray-500">Belum ada data antropometri untuk anak ini.</p>
    @else
        <p class="text-gray-500">Silakan pilih anak untuk melihat grafik pertumbuhan.</p>
    @endif
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@if($anakDipilih && $data->count() > 0)
<script>
    // DATA DARI PHP
    const rawLabels = @json($data->pluck('umur_bulan'));
    const berat     = @json($data->pluck('berat_badan'));
    const tinggi    = @json($data->pluck('tinggi_badan'));

    // FORMAT LABEL
    const labels = rawLabels.map(u => u + ' bln');

    // HITUNG IMT + WARNA
    const imt = [];
    const imtColors = [];

    berat.forEach((bb, i) => {
        const tbMeter = tinggi[i] / 100;
        const nilai = Number((bb / (tbMeter * tbMeter)).toFixed(2));
        imt.push(nilai);

        if (nilai < 14) {
            imtColors.push('rgb(59,130,246)'); // Kurus
        } else if (nilai < 18) {
            imtColors.push('rgb(34,197,94)'); // Normal
        } else {
            imtColors.push('rgb(239,68,68)'); // Gemuk
        }
    });

    const whoMin = @json($who['minus2']);
    const whoMed = @json($who['median']);
    const whoMax = @json($who['plus2']);

    // CHART BB
    new Chart(document.getElementById('bbChart'), {
        type: 'line',
        data: {
            labels,
            datasets: [{
                label: 'Berat Badan (kg)',
                data: berat,
                borderColor: 'rgb(34,197,94)',
                tension: 0.3
            }]
        }
    });

    // CHART TB
    new Chart(document.getElementById('tbChart'), {
        type: 'line',
        data: {
            labels,
            datasets: [{
                label: 'Tinggi Badan (cm)',
                data: tinggi,
                borderColor: 'rgb(59,130,246)',
                tension: 0.3
            }]
        }
    });

    // CHART IMT
    new Chart(document.getElementById('imtChart'), {
        type: 'line',
        data: {
            labels,
            datasets: [
                {
                    label: 'IMT Anak',
                    data: imt,
                    borderColor: 'rgb(16,185,129)',
                    pointBackgroundColor: imtColors,
                    pointRadius: 5,
                    tension: 0.3
                },
                {
                    label: 'WHO -2 SD',
                    data: whoMin,
                    borderColor: 'rgb(239,68,68)',
                    borderDash: [5,5],
                    tension: 0.3
                },
                {
                    label: 'WHO Median',
                    data: whoMed,
                    borderColor: 'rgb(107,114,128)',
                    borderDash: [5,5],
                    tension: 0.3
                },
                {
                    label: 'WHO +2 SD',
                    data: whoMax,
                    borderColor: 'rgb(234,179,8)',
                    borderDash: [5,5],
                    tension: 0.3
                }
            ]
        }
    });
</script>
@endif
@endsection