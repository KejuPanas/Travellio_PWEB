<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    /**
     * Menampilkan daftar tagihan tunai pelunasan di meeting point
     */
    public function index(Request $request)
    {
        $bookingsQuery = Booking::whereIn('status', ['Dikonfirmasi', 'Berlangsung'])
            ->where('pembayaran_diterima', false)
            ->with(['user', 'paketWisata']);

        // Handle search
        if ($request->filled('search')) {
            $search = $request->search;
            $bookingsQuery->where(function ($q) use ($search) {
                $q->where('kode_booking', 'like', "%{$search}%")
                  ->orWhereHas('user', function ($uq) use ($search) {
                      $uq->where('name', 'like', "%{$search}%");
                  });
            });
        }

        // Hitung total data statistik untuk rekap
        $allActiveBills = Booking::whereIn('status', ['Dikonfirmasi', 'Berlangsung'])
            ->where('pembayaran_diterima', false)
            ->get();

        $totalTagihan = $allActiveBills->sum(function ($b) {
            return $b->total_harga - $b->nominal_dp;
        });

        $totalRombongan = $allActiveBills->count();
        $activeDestinations = $allActiveBills->pluck('paket_wisata_id')->unique()->count();

        $bookings = $bookingsQuery->latest()->paginate(15)->withQueryString();

        return view('admin.pembayaran.index', compact('bookings', 'totalTagihan', 'totalRombongan', 'activeDestinations'));
    }

    /**
     * Menandai pembayaran cash pelunasan telah diterima
     */
    public function tandaiDiterima(Booking $booking)
    {
        if (!in_array($booking->status, ['Dikonfirmasi', 'Berlangsung'])) {
            return back()->with('error', 'Booking harus dalam status Dikonfirmasi atau Berlangsung untuk dilunasi.');
        }

        $booking->update([
            'pembayaran_diterima' => true,
            'pembayaran_diterima_at' => now(),
            'status' => 'Selesai' // Tandai status perjalanan selesai setelah pelunasan cash diterima
        ]);

        return back()->with('success', 'Pembayaran cash pelunasan untuk booking ' . $booking->kode_booking . ' berhasil diterima dan status diubah menjadi Selesai.');
    }
}