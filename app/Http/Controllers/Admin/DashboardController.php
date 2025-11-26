<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Booking;
use App\Models\Kamar;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPenyewa = User::where('role', 'penyewa')->count();
        $totalKamar = Kamar::count();
        $kamarTersedia = Kamar::where('status', 'tersedia')->count();
        $kamarTerbooking = Kamar::where('status', 'terbooking')->count();
        $totalBooking = Booking::count();
        $bookingMenunggu = Booking::where('status', 'menunggu')->count();
        $bookingAktif = Booking::where('status', 'terbooking')->count();

        // Data untuk chart occupancy
        $kosts = \App\Models\Kost::with('kamars')->get()->map(function($kost) {
            $total = $kost->kamars->count();
            $terisi = $kost->kamars->where('status', 'terbooking')->count();
            return [
                'nama' => $kost->nama,
                'occupancy' => $total > 0 ? round(($terisi / $total) * 100, 1) : 0
            ];
        });

        return view('admin.dashboard', compact(
            'totalPenyewa',
            'totalKamar',
            'kamarTersedia',
            'kamarTerbooking',
            'totalBooking',
            'bookingMenunggu',
            'bookingAktif',
            'kosts'
        ));
    }
}