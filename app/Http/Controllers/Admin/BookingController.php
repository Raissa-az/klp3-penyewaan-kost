<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Kamar;
use Illuminate\Http\Request;

class BookingController extends Controller
{
public function index()
{
    // Ambil semua booking dengan relasi
    $bookings = Booking::with(['user', 'kamar' => function($query) {
            $query->with('kost');
        }])
        ->orderBy('created_at', 'desc')
        ->get();

    return view('admin.booking.index', compact('bookings'));
}

public function updateStatus(Request $request, $id)
{
    $booking = Booking::with('kamar')->findOrFail($id);
    
    // Validasi status harus sesuai dengan ENUM di database
    $request->validate([
        'status' => 'required|in:pending,aktif,selesai'
    ]);

    $oldStatus = $booking->status;
    $newStatus = $request->status;

    // Update status booking dengan DB transaction untuk keamanan
    \DB::transaction(function() use ($booking, $newStatus, $oldStatus) {
        
        // Update status booking
        $booking->status = $newStatus;
        $booking->save();

        // Update status kamar berdasarkan status booking
        if ($newStatus == 'aktif') {
            // Booking disetujui → Kamar menjadi disewa
            $booking->kamar->status = 'disewa';
            $booking->kamar->save();
        } elseif ($newStatus == 'selesai') {
            // Booking selesai → Kamar tersedia lagi
            $booking->kamar->status = 'tersedia';
            $booking->kamar->save();
        } elseif ($newStatus == 'pending') {
            // Jika dikembalikan ke pending → Kamar terbooking
            $booking->kamar->status = 'terbooking';
            $booking->kamar->save();
        }
    });

    return redirect()->back()->with('success', 'Status booking berhasil diupdate');
}

    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();

        return redirect()->back()->with('success', 'Booking berhasil dihapus');
    }
}