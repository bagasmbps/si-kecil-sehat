<?php

namespace App\Http\Controllers;

use App\Models\Anak;
use App\Models\Perkembangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PerkembanganController extends Controller
{
    /**
     * MILESTONE 5 DOMAIN (0–72 BULAN) – BERDASARKAN KIA / SDIDTK
     */
    private function milestoneByUmur($umur)
    {
        if ($umur <= 3) {
            return [
                'motorik_kasar' => 'Mengangkat kepala saat tengkurap',
                'motorik_halus' => 'Menggenggam jari',
                'bahasa' => 'Mengoceh',
                'sosial' => 'Tersenyum sosial',
                'kemandirian' => 'Menoleh ke suara',
            ];
        } elseif ($umur <= 6) {
            return [
                'motorik_kasar' => 'Berguling',
                'motorik_halus' => 'Meraih benda',
                'bahasa' => 'Tertawa',
                'sosial' => 'Mengenali ibu',
                'kemandirian' => 'Memegang botol',
            ];
        } elseif ($umur <= 9) {
            return [
                'motorik_kasar' => 'Duduk tanpa bantuan',
                'motorik_halus' => 'Memindahkan benda',
                'bahasa' => 'Babbling (ba-ba/ma-ma)',
                'sosial' => 'Takut orang asing',
                'kemandirian' => 'Mengambil makanan',
            ];
        } elseif ($umur <= 12) {
            return [
                'motorik_kasar' => 'Berdiri berpegangan',
                'motorik_halus' => 'Menjepit benda kecil',
                'bahasa' => '1–2 kata bermakna',
                'sosial' => 'Melambaikan tangan',
                'kemandirian' => 'Minum dari cangkir',
            ];
        } elseif ($umur <= 18) {
            return [
                'motorik_kasar' => 'Berjalan sendiri',
                'motorik_halus' => 'Menyusun 2–3 balok',
                'bahasa' => '≥5 kata',
                'sosial' => 'Meniru aktivitas',
                'kemandirian' => 'Makan sendiri',
            ];
        } elseif ($umur <= 24) {
            return [
                'motorik_kasar' => 'Berlari',
                'motorik_halus' => 'Mencoret-coret',
                'bahasa' => 'Menggabung 2 kata',
                'sosial' => 'Bermain paralel',
                'kemandirian' => 'Melepas pakaian',
            ];
        } elseif ($umur <= 36) {
            return [
                'motorik_kasar' => 'Naik turun tangga',
                'motorik_halus' => 'Menggambar garis',
                'bahasa' => 'Kalimat sederhana',
                'sosial' => 'Bermain bersama teman',
                'kemandirian' => 'Toilet training awal',
            ];
        } elseif ($umur <= 48) {
            return [
                'motorik_kasar' => 'Melompat',
                'motorik_halus' => 'Menggambar lingkaran',
                'bahasa' => 'Bercerita pendek',
                'sosial' => 'Berpakaian sendiri',
                'kemandirian' => 'Ke toilet dibantu',
            ];
        } elseif ($umur <= 60) {
            return [
                'motorik_kasar' => 'Berdiri satu kaki',
                'motorik_halus' => 'Menggunting',
                'bahasa' => 'Menjawab pertanyaan',
                'sosial' => 'Bermain peran',
                'kemandirian' => 'Mandiri berpakaian',
            ];
        } else { // 61–72 bulan
            return [
                'motorik_kasar' => 'Koordinasi seimbang',
                'motorik_halus' => 'Menulis nama sederhana',
                'bahasa' => 'Kalimat kompleks',
                'sosial' => 'Mengikuti aturan',
                'kemandirian' => 'Mandiri ke toilet',
            ];
        }
    }

    /**
     * INDEX
     */
    public function index(Request $request)
    {
        $anaks = Anak::where('user_id', Auth::id())->get();
        $milestones = [];

        if ($request->filled('anak_id') && $request->filled('umur_bulan')) {
            $milestones = $this->milestoneByUmur($request->umur_bulan);
        }

        $riwayat = Perkembangan::with('anak')
            ->whereIn('anak_id', $anaks->pluck('id'))
            ->latest()
            ->get();

        return view('perkembangan.index', compact(
            'anaks',
            'milestones',
            'riwayat'
        ));
    }

    /**
     * SIMPAN HASIL
     */
    public function store(Request $request)
    {
        $request->validate([
            'anak_id' => 'required',
            'umur_bulan' => 'required|integer',
            'milestone' => 'required|array',
        ]);

        $total = count($request->milestone);
        $tercapai = collect($request->milestone)
            ->filter(fn ($v) => $v === 'ya')
            ->count();
        $belum = $total - $tercapai;

        if ($belum === 0) {
            $status = 'Normal';
            $edukasi = 'Perkembangan anak sesuai usia.';
        } elseif ($belum <= 2) {
            $status = 'Perlu Stimulasi';
            $edukasi = "Berikan stimulasi tambahan sesuai usia.
            Bisa dibawa ke dokter, bidan atau fasilitas kesehatan terdekat.";
        } else {
            $status = 'Risiko Keterlambatan';
            $edukasi = 'Disarankan konsultasi ke tenaga kesehatan.';
        }

        $redFlag = $belum >= 3
            ? 'Terdapat red flag perkembangan. Disarankan pemantauan dan rujukan.'
            : null;

        $data = Perkembangan::create([
            'anak_id' => $request->anak_id,
            'umur_bulan' => $request->umur_bulan,
            'total_milestone' => $total,
            'tercapai' => $tercapai,
            'belum' => $belum,
            'status' => $status,
            'edukasi' => $edukasi,
            'red_flag' => $redFlag,
        ]);

        return redirect()
            ->route('perkembangan.index')
            ->with('hasil', [
                'nama' => $data->anak->nama,
                'umur' => $data->umur_bulan,
                'status' => $status,
                'tercapai' => $tercapai,
                'total' => $total,
                'edukasi' => $edukasi,
                'red_flag' => $redFlag,
            ]);
    }
}