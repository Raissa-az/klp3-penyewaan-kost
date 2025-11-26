<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kost;
use App\Models\Kamar;
use App\Models\Booking;

class AdminController extends Controller
{
public function index()
{
    // Hitung total
    $totalKost       = Kost::count();
    $totalKamar      = Kamar::count();
    $kamarTersedia   = Kamar::where('status', 'tersedia')->count();
    $bookingPending  = Booking::where('status', 'pending')->count();

    // Ambil 5 booking terbaru dengan relasi lengkap
    $bookingTerbaru  = Booking::with(['user', 'kamar' => function($query) {
                            $query->with('kost');
                        }])
                        ->latest()
                        ->take(5)
                        ->get();

    return view('admin.dashboard', compact(
        'totalKost',
        'totalKamar',
        'kamarTersedia',
        'bookingPending',
        'bookingTerbaru'
    ));
}
}
