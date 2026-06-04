<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\PaketWisata;
use App\Models\User;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today();
        $thisMonth = Carbon::now()->startOfMonth();

        $stats = [
            'booking_hari_ini'   => Booking::whereDate('created_at', $today)->count(),
            'booking_bulan_ini'  => Booking::where('created_at', '>=', $thisMonth)->count(),
            'pending'            => Booking::byStatus('Pending')->count(),
            'dikonfirmasi'       => Booking::byStatus('Dikonfirmasi')->count(),
            'berlangsung'        => Booking::byStatus('Berlangsung')->count(),
            'selesai'            => Booking::byStatus('Selesai')->count(),
            'total_paket'        => PaketWisata::active()->count(),
            'total_customer'     => User::where('role', 'customer')->count(),
        ];

        // Pendapatan bulan ini (dari booking selesai)
        $pendapatanBulanIni = Booking::byStatus('Selesai')
            ->where('created_at', '>=', $thisMonth)
            ->sum('total_harga');

        $recentBookings = Booking::with(['user', 'paketWisata'])
            ->latest()
            ->take(8)
            ->get();

        return view('admin.dashboard', compact('stats', 'pendapatanBulanIni', 'recentBookings'));
    }
}