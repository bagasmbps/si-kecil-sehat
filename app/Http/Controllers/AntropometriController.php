<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Antropometri;
use App\Models\Anak;


class AntropometriController extends Controller
{
    public function index()
    {
        $anaks = Anak::where('user_id', auth()->id())->get();

        $riwayat = Antropometri::with('anak')
            ->whereHas('anak', function ($q) {
                $q->where('user_id', auth()->id());
            })
            ->latest()
            ->get();

        return view('antropometri.index', compact('anaks', 'riwayat'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'anak_id'        => 'required|exists:anaks,id',
            'umur_bulan'     => 'required|numeric',
            'berat_badan'    => 'required|numeric',
            'tinggi_badan'   => 'required|numeric',
            'lingkar_kepala' => 'nullable|numeric',
        ]);

        Antropometri::create([
            'anak_id'        => $request->anak_id,
            'umur_bulan'     => $request->umur_bulan,
            'berat_badan'    => $request->berat_badan,
            'tinggi_badan'   => $request->tinggi_badan,
            'lingkar_kepala' => $request->lingkar_kepala,
        ]);

        return redirect()
            ->route('antropometri.index')
            ->with('success', 'Data antropometri berhasil disimpan & dihitung');
    }
    public function grafik(Request $request)
    {
        $anaks = Anak::where('user_id', Auth::id())->get();

        $anakDipilih = null;
        $data = collect();

        if ($request->filled('anak_id')) {
            $anakDipilih = Anak::where('id', $request->anak_id)
                ->where('user_id', Auth::id())
                ->firstOrFail();

            $data = Antropometri::where('anak_id', $anakDipilih->id)
                ->orderBy('umur_bulan')
                ->get();
        }

        // === REFERENSI WHO (SIMPLIFIED IMT/U) ===
        $who = [
            'minus2' => [],
            'median' => [],
            'plus2' => [],
        ];

        foreach ($data as $d) {
            $umur = $d->umur_bulan;

            // Nilai pendekatan WHO IMT/U (AMAN UNTUK EDUKASI)
            $who['minus2'][] = 14.0;
            $who['median'][] = 16.0;
            $who['plus2'][]  = 18.0;
        }

        return view('antropometri.grafik', compact(
            'anaks',
            'anakDipilih',
            'data',
            'who'
        ));
    }
}
