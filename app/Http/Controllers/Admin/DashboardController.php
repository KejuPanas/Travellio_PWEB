<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\PaketWisata;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBookings = Booking::count();
        $pendingBookings = Booking::where('status', 'Pending')->count();
        $activePackages = PaketWisata::where('is_active', true)->count();
        $totalRevenue = Booking::where('status', 'Selesai')->sum('total_harga');

        $latestBookings = Booking::with(['user', 'paketWisata'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalBookings',
            'pendingBookings',
            'activePackages',
            'totalRevenue',
            'latestBookings'
        ));
    }
}