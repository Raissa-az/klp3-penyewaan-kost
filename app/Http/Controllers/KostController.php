<?php

namespace App\Http\Controllers\Penyewa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kost;

class KostController extends Controller
{
    public function index()
    {
        $totalKost = Kost::count();
        $kamarTersedia = Kost::sum('jumlah_kamar');

        $bookingAktif = auth()->user()
            ->bookings()
            ->where('status', 'aktif')
            ->count();

        $kostPopuler = Kost::take(3)->get();

        $bookingTerbaru = auth()->user()
            ->bookings()
            ->latest()
            ->take(5)
            ->get();

        return view('penyewa.dashboard', compact(
            'totalKost', 'kamarTersedia', 'bookingAktif', 'kostPopuler', 'bookingTerbaru'
        ));
    }

    public function show($id)
    {
        $kost = Kost::with('kamars')->findOrFail($id);

        $kamarTersedia = $kost->kamars->where('status', 'tersedia');

        return view('penyewa.kost.show', [
            'kost' => $kost,
            'kamarTersedia' => $kamarTersedia
        ]);
    }
    public function filterByType($tipe)
{
    $kosts = \App\Models\Kost::where('tipe', $tipe)->get();

    return view('penyewa.kost-by-type', [
        'tipe' => ucfirst($tipe),
        'kosts' => $kosts
    ]);
}

}
