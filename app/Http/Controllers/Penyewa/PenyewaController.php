<?php

namespace App\Http\Controllers\Penyewa;

use App\Http\Controllers\Controller;
use App\Models\Kost;
use App\Models\Kamar;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class PenyewaController extends Controller
{
    public function index()
    {
        // Total statistik
        $totalKost = Kost::count();
        $kamarTersedia = Kamar::where('status', 'tersedia')->count();
        $bookingAktif = Booking::where('user_id', Auth::id())
            ->where('status', 'aktif')
            ->count();

        // ✅ KOST POPULER: 1 Cewe + 1 Cowo (total 2 kost)
        $kostCewePopuler = Kost::where('tipe', 'cewe')
            ->withCount(['kamars as kamar_tersedia' => function($query) {
                $query->where('status', 'tersedia');
            }])
            ->having('kamar_tersedia', '>', 0)
            ->orderBy('kamar_tersedia', 'desc')
            ->first();

        $kostCowoPopuler = Kost::where('tipe', 'cowo')
            ->withCount(['kamars as kamar_tersedia' => function($query) {
                $query->where('status', 'tersedia');
            }])
            ->having('kamar_tersedia', '>', 0)
            ->orderBy('kamar_tersedia', 'desc')
            ->first();

        // Gabungkan dan tambahkan atribut jenis
        $kostPopuler = collect([$kostCewePopuler, $kostCowoPopuler])
            ->filter()
            ->map(function($kost) {
                $kost->jenis = $kost->tipe; // Pastikan jenis tersedia
                
                // Parse fasilitas dari string ke boolean
                $fasilitasArray = [];
                if ($kost->fasilitas) {
                    $fasilitasList = explode(',', $kost->fasilitas);
                    foreach ($fasilitasList as $f) {
                        $f = trim(strtolower($f));
                        $fasilitasArray[$f] = true;
                    }
                }
                
                $kost->kasur = $fasilitasArray['kasur'] ?? false;
                $kost->km_dalam = $fasilitasArray['km dalam'] ?? $fasilitasArray['kamar mandi dalam'] ?? false;
                $kost->dapur = $fasilitasArray['dapur'] ?? false;
                
                return $kost;
            });

        // Booking terbaru user
        $bookingTerbaru = Booking::with('kamar.kost')
            ->where('user_id', Auth::id())
            ->latest()
            ->take(3)
            ->get();

        return view('penyewa.dashboard', compact(
            'totalKost',
            'kamarTersedia',
            'bookingAktif',
            'kostPopuler',
            'bookingTerbaru'
        ));
    }
}