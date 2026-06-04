<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class PembayaranController extends Controller
{
    public function index(Request $request)
    {
        $query = Booking::with(['user', 'paketWisata'])
            ->whereIn('status', ['Dikonfirmasi', 'Berlangsung', 'Selesai'])
            ->latest();

        if ($request->filled('pembayaran')) {
            if ($request->pembayaran === 'sudah') {
                $query->where('pembayaran_diterima', true);
            } elseif ($request->pembayaran === 'belum') {
                $query->where('pembayaran_diterima', false);
            }
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('kode_booking', 'like', "%{$search}%")
                  ->orWhereHas('user', fn($q) => $q->where('name', 'like', "%{$search}%"));
            });
        }

        $bookings = $query->paginate(15)->withQueryString();

        $stats = [
            'total_booking'      => Booking::whereIn('status', ['Dikonfirmasi', 'Berlangsung', 'Selesai'])->count(),
            'sudah_bayar'        => Booking::whereIn('status', ['Dikonfirmasi', 'Berlangsung', 'Selesai'])->where('pembayaran_diterima', true)->count(),
            'belum_bayar'        => Booking::whereIn('status', ['Dikonfirmasi', 'Berlangsung', 'Selesai'])->where('pembayaran_diterima', false)->count(),
            'total_pendapatan'   => Booking::where('pembayaran_diterima', true)->sum('total_harga'),
        ];

        return view('admin.pembayaran.index', compact('bookings', 'stats'));
    }

    public function tandaiDiterima(Booking $booking)
    {
        if (!in_array($booking->status, ['Dikonfirmasi', 'Berlangsung', 'Selesai'])) {
            return back()->with('error', 'Pembayaran hanya bisa dicatat untuk booking yang sudah dikonfirmasi.');
        }

        $booking->update([
            'pembayaran_diterima'    => true,
            'pembayaran_diterima_at' => Carbon::now(),
        ]);

        return back()->with('success', 'Pembayaran booking ' . $booking->kode_booking . ' berhasil dicatat.');
    }

    public function show(Booking $booking)
    {
        $booking->load(['user', 'paketWisata']);
        return view('admin.pembayaran.show', compact('booking'));
    }
}