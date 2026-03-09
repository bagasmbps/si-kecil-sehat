<?php

namespace App\Http\Controllers;

use App\Models\Anak;
use App\Models\ImunisasiMaster;
use App\Models\ImunisasiAnak;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ImunisasiController extends Controller
{
    /**
     * Tampilkan detail imunisasi anak
     */
    public function show(Anak $anak)
    {
        $umur = Carbon::parse($anak->tanggal_lahir)->diffInMonths(now());

        $masters = ImunisasiMaster::orderBy('umur_bulan')->get();

        $sudah = ImunisasiAnak::where('anak_id', $anak->id)
            ->pluck('imunisasi_master_id')
            ->toArray();

        $data = $masters->map(function ($m) use ($umur, $sudah) {

            if (in_array($m->id, $sudah)) {
                $status = 'Sudah';
            } elseif ($umur > $m->umur_bulan) {
                $status = 'Terlambat';
            } else {
                $status = 'Belum';
            }

            return [
                'id'         => $m->id,
                'nama'       => $m->nama_imunisasi,
                'umur_bulan' => $m->umur_bulan,
                'status'     => $status,
            ];
        });

        return view('imunisasi.show', compact('anak', 'umur', 'data'));
    }

    /**
     * Tandai imunisasi sebagai sudah
     */
    public function store(Request $request, $anak_id)
    {
        $request->validate([
            'imunisasi_master_id' => 'required'
        ]);

        ImunisasiAnak::firstOrCreate(
            [
                'anak_id' => $anak_id,
                'imunisasi_master_id' => $request->imunisasi_master_id
            ],
            [
                'tanggal' => now()
            ]
        );

        return back()->with('success', 'Imunisasi berhasil ditandai');
    }

    /**
     * Toggle status imunisasi (Sudah ↔ Belum)
     */
    public function toggle($anakId, $imunisasiId)
    {
        $record = ImunisasiAnak::where('anak_id', $anakId)
            ->where('imunisasi_master_id', $imunisasiId)
            ->first();

        if ($record) {
            // Kalau sudah ada → batalkan
            $record->delete();

            return back()->with('success', 'Status imunisasi dibatalkan');
        }

        // Kalau belum ada → tandai lengkap
        ImunisasiAnak::create([
            'anak_id' => $anakId,
            'imunisasi_master_id' => $imunisasiId,
        ]);

        return back()->with('success', 'Imunisasi berhasil ditandai lengkap');
    }
}