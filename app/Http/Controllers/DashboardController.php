<?php

namespace App\Http\Controllers;

use App\Models\Anak;
use App\Models\ImunisasiMaster;
use App\Models\ImunisasiAnak;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $masters = ImunisasiMaster::all();

        $anaks = Anak::where('user_id', Auth::id())->get();

        foreach ($anaks as $anak) {

            // Hitung umur anak (bulan)
            $umur = Carbon::parse($anak->tanggal_lahir)
                ->diffInMonths(now());

            // Imunisasi yang sudah dilakukan
            $sudah = ImunisasiAnak::where('anak_id', $anak->id)
                ->pluck('imunisasi_master_id')
                ->toArray();

            $terlambat = 0;
            $menunggu  = 0;

            foreach ($masters as $m) {

                // Kalau sudah imunisasi → skip
                if (in_array($m->id, $sudah)) {
                    continue;
                }

                // Belum imunisasi
                if ($umur > $m->umur_bulan) {
                    $terlambat++;
                } else {
                    $menunggu++;
                }
            }

            // Badge dashboard
            if ($terlambat > 0) {
                $anak->badge_text  = "⚠️ $terlambat Imunisasi Terlambat";
                $anak->badge_class = "bg-red-100 text-red-700";
            } elseif ($menunggu > 0) {
                $anak->badge_text  = "⏳ $menunggu Imunisasi Menunggu";
                $anak->badge_class = "bg-yellow-100 text-yellow-700";
            } else {
                $anak->badge_text  = "✅ Lengkap";
                $anak->badge_class = "bg-green-100 text-green-700";
            }
        }

        return view('dashboard-custom', compact('anaks'));
    }
}