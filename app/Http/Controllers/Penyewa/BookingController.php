<?php

namespace App\Http\Controllers\Penyewa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Kamar;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with('kamar.kost')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('penyewa.booking.index', compact('bookings'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kamar_id' => 'required|exists:kamars,id',
        ]);

        $kamar = Kamar::with('kost')->findOrFail($request->kamar_id);

        // ❌ Tidak bisa booking kamar yang tidak tersedia
        if ($kamar->status !== 'tersedia') {
            return back()->with('error', 'Kamar tidak tersedia untuk dibooking.');
        }

        // ❌ Cegah penyewa booking lebih dari 1 kamar aktif
        $existing = Booking::where('user_id', Auth::id())
            ->where('status', 'aktif')
            ->exists();

        if ($existing) {
            return back()->with('error', 'Anda sudah memiliki booking aktif.');
        }

        // 🟢 Buat booking
        Booking::create([
            'user_id'  => Auth::id(),
            'kamar_id' => $kamar->id,
            'status'   => 'pending',
        ]);

        // 🟢 Update status kamar agar tidak dibooking orang lain
        $kamar->update([
            'status' => 'menunggu',
        ]);

        return redirect()->route('penyewa.booking')
            ->with('success', 'Booking berhasil dibuat! Menunggu konfirmasi admin.');
    }
    // Method untuk redirect ke WhatsApp Admin
public function redirectToWhatsApp(Request $request)
{
    $request->validate([
        'kamar_id' => 'required|exists:kamars,id',
    ]);

    $kamar = Kamar::with('kost')->findOrFail($request->kamar_id);
    $user = Auth::user();

    // ✅ SIMPAN BOOKING KE DATABASE
    $booking = Booking::create([
        'user_id'  => $user->id,
        'kamar_id' => $kamar->id,
        'status'   => 'pending', // Status awal: pending (menunggu konfirmasi admin)
    ]);

    // ✅ UPDATE STATUS KAMAR MENJADI TERBOOKING
    $kamar->update([
        'status' => 'terbooking',
    ]);

    // Nomor WhatsApp Admin
    $adminPhone = '6287769168694'; // Format: 62xxx (tanpa +)

    // Pesan WhatsApp
    $message = "Halo Admin, saya ingin booking kamar:\n\n";
    $message .= "📋 *Data Penyewa*\n";
    $message .= "Nama: {$user->name}\n";
    $message .= "Email: {$user->email}\n\n";
    $message .= "🏠 *Data Kost*\n";
    $message .= "Kost: {$kamar->kost->nama}\n";
    $message .= "Kamar: {$kamar->nomor}\n";
    $message .= "Tipe: {$kamar->tipe_kamar}\n";
    $message .= "Harga: Rp " . number_format($kamar->harga, 0, ',', '.') . "/bulan\n\n";
    $message .= "Mohon konfirmasi ketersediaan kamar. Terima kasih!";

    // URL WhatsApp
    $waUrl = "https://wa.me/{$adminPhone}?text=" . urlencode($message);

    return redirect()->away($waUrl);
}
}
