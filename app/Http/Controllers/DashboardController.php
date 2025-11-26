
<?php


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Booking;
use App\Models\Kamar;

class DashboardController extends Controller
{
    public function index()
    {
        // Contoh statistik untuk dashboard admin
        $totalPenyewa = User::where('role', 'penyewa')->count();
        $totalKamar   = Kamar::count();
        $totalBooking = Booking::count();
        $bookingMenunggu = Booking::where('status', 'menunggu')->count();

        return view('admin.dashboard', [
            'totalPenyewa' => $totalPenyewa,
            'totalKamar' => $totalKamar,
            'totalBooking' => $totalBooking,
            'bookingMenunggu' => $bookingMenunggu
        ]);
    }
}