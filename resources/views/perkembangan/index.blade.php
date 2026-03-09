@extends('layouts.app')

@section('content')

{{-- MODAL HASIL --}}
@if(session('hasil'))
<div id="hasilModal" class="fixed inset-0 bg-black/40 flex items-center justify-center z-50">
    <div class="bg-white rounded-xl shadow-xl max-w-md w-full p-6 relative">

        <h3 class="text-xl font-bold mb-4 text-green-700">
            ✅ Hasil Perkembangan Tersimpan
        </h3>

        <p class="text-sm"><strong>Nama Anak:</strong> {{ session('hasil.nama') }}</p>
        <p class="text-sm"><strong>Umur:</strong> {{ session('hasil.umur') }} bulan</p>

        <div class="mt-3">
            <span class="
                inline-block px-3 py-1 rounded text-white text-sm
                @if(session('hasil.status') === 'Normal') bg-green-600
                @elseif(session('hasil.status') === 'Perlu Stimulasi') bg-yellow-500
                @else bg-red-600 @endif
            ">
                {{ session('hasil.status') }}
            </span>
        </div>

        <p class="mt-3 text-sm">
            Milestone tercapai:
            <strong>{{ session('hasil.tercapai') }}/{{ session('hasil.total') }}</strong>
        </p>

        <div class="mt-4 bg-gray-50 p-3 rounded text-sm">
            <strong>Edukasi:</strong>
            <p class="whitespace-pre-line">{{ session('hasil.edukasi') }}</p>
        </div>

        @if(session('hasil.red_flag'))
            <div class="mt-4 bg-red-50 border-l-4 border-red-600 p-3 rounded">
                <p class="font-semibold text-red-700">🚩 Red Flag SDIDTK</p>
                <p class="text-sm text-red-600">{{ session('hasil.red_flag') }}</p>
            </div>
        @endif

        <button onclick="document.getElementById('hasilModal').remove()"
            class="mt-6 bg-green-600 text-white px-6 py-2 rounded-lg w-full hover:bg-green-700 transition">
            Tutup
        </button>
    </div>
</div>
@endif

<div class="max-w-6xl mx-auto p-6 space-y-8">

    {{-- JUDUL --}}
    <div>
        <h2 class="text-2xl font-bold tracking-tight">Perkembangan Anak</h2>
        <p class="text-sm text-gray-500">
            Penilaian perkembangan anak berdasarkan milestone usia (SDIDTK)
        </p>
    </div>

    {{-- STEP 1 & 2 --}}
    <form method="GET"
          class="bg-white p-6 rounded-xl shadow grid grid-cols-1 md:grid-cols-3 gap-4">
        <select name="anak_id" class="border rounded-lg p-2" required>
            <option value="">Pilih Anak</option>
            @foreach($anaks as $anak)
                <option value="{{ $anak->id }}" {{ request('anak_id')==$anak->id?'selected':'' }}>
                    {{ $anak->nama }}
                </option>
            @endforeach
        </select>

        <select name="umur_bulan" class="border rounded-lg p-2" required>
            <option value="">Pilih Umur (bulan)</option>
            @for($i=1;$i<=72;$i++)
                <option value="{{ $i }}" {{ request('umur_bulan')==$i?'selected':'' }}>
                    {{ $i }} bulan
                </option>
            @endfor
        </select>

        <button class="bg-green-600 text-white rounded-lg px-4 hover:bg-green-700 transition">
            Tampilkan Milestone
        </button>
    </form>

    {{-- STEP 3 --}}
    @if(count($milestones))
    <form method="POST" action="{{ route('perkembangan.store') }}"
          class="bg-white p-6 rounded-xl shadow space-y-4">
        @csrf
        <input type="hidden" name="anak_id" value="{{ request('anak_id') }}">
        <input type="hidden" name="umur_bulan" value="{{ request('umur_bulan') }}">

        <div class="bg-green-50 border border-green-200 p-3 rounded text-sm text-green-700">
            Penilaian perkembangan untuk usia
            <strong>{{ request('umur_bulan') }} bulan</strong>
            berdasarkan 5 domain utama perkembangan anak.
        </div>

        <h3 class="font-semibold">Checklist Milestone (5 Domain)</h3>

        @foreach($milestones as $domain => $label)
        <div class="flex justify-between items-center border-b py-2">
            <span class="text-sm">
                <strong>{{ ucfirst(str_replace('_',' ',$domain)) }}</strong> — {{ $label }}
            </span>
            <select name="milestone[]"
                    class="border rounded-lg p-1 text-sm
                           focus:ring-2 focus:ring-green-500">
                <option value="ya">Tercapai</option>
                <option value="tidak">Belum</option>
            </select>
        </div>
        @endforeach

        <button
            class="mt-6 bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition">
            Simpan & Lihat Hasil
        </button>
    </form>
    @endif

    {{-- RIWAYAT --}}
    <h3 class="text-xl font-bold">📋 Riwayat Penilaian Perkembangan</h3>

    @if($riwayat->isEmpty())
        <p class="text-gray-500 italic">Belum ada riwayat penilaian perkembangan.</p>
    @else
        <div class="space-y-4">
            @foreach($riwayat as $item)

                @php
                    if ($item->status === 'Normal') {
                        $bg = 'bg-green-50';
                        $border = 'border-green-500';
                        $badge = 'bg-green-600';
                        $icon = '✅';
                    } elseif ($item->status === 'Perlu Stimulasi') {
                        $bg = 'bg-yellow-50';
                        $border = 'border-yellow-500';
                        $badge = 'bg-yellow-500';
                        $icon = '🧩';
                    } else {
                        $bg = 'bg-red-50';
                        $border = 'border-red-600';
                        $badge = 'bg-red-600';
                        $icon = '⚠️';
                    }
                @endphp

                <div class="border-l-4 {{ $border }} {{ $bg }} rounded-lg p-5 shadow-sm">
                    <div class="flex justify-between items-start">
                        <div>
                            <h4 class="font-semibold text-lg">
                                {{ $icon }} {{ $item->anak->nama }}
                            </h4>
                            <p class="text-sm text-gray-600">
                                Umur: {{ $item->umur_bulan }} bulan
                            </p>
                        </div>
                        <span class="text-xs text-gray-500">
                            {{ $item->created_at->format('d M Y') }}
                        </span>
                    </div>

                    <div class="mt-3">
                        <span class="inline-block text-white text-sm px-3 py-1 rounded {{ $badge }}">
                            {{ $item->status }}
                        </span>
                    </div>

                    <p class="mt-3 text-sm">
                        Milestone tercapai:
                        <strong>{{ $item->tercapai }}/{{ $item->total_milestone }}</strong>
                    </p>

                    <div class="mt-3 bg-white p-3 rounded border text-sm">
                        <strong>Edukasi:</strong>
                        <p class="whitespace-pre-line">{{ $item->edukasi }}</p>
                    </div>

                    @if($item->red_flag)
                        <div class="mt-4 bg-red-100 border-l-4 border-red-600 p-3 rounded">
                            <p class="font-semibold text-red-700">🚩 Red Flag SDIDTK</p>
                            <p class="text-sm text-red-600">{{ $item->red_flag }}</p>
                        </div>
                    @endif
                </div>

            @endforeach
        </div>
    @endif
</div>
@endsection