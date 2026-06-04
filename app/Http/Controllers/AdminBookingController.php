<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $query = Booking::with(['user', 'paketWisata'])->latest();

        if ($request->filled('status')) {
            $query->byStatus($request->status);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('kode_booking', 'like', "%{$search}%")
                  ->orWhereHas('user', fn($q) => $q->where('name', 'like', "%{$search}%"))
                  ->orWhereHas('paketWisata', fn($q) => $q->where('nama_paket', 'like', "%{$search}%"));
            });
        }

        $bookings = $query->paginate(15)->withQueryString();

        $statusCounts = [
            'Pending'      => Booking::byStatus('Pending')->count(),
            'Dikonfirmasi' => Booking::byStatus('Dikonfirmasi')->count(),
            'Berlangsung'  => Booking::byStatus('Berlangsung')->count(),
            'Selesai'      => Booking::byStatus('Selesai')->count(),
            'Ditolak'      => Booking::byStatus('Ditolak')->count(),
        ];

        return view('admin.booking.index', compact('bookings', 'statusCounts'));
    }

    public function show(Booking $booking)
    {
        $booking->load(['user', 'paketWisata']);
        return view('admin.booking.show', compact('booking'));
    }

    public function konfirmasi(Booking $booking)
    {
        if ($booking->status !== 'Pending') {
            return back()->with('error', 'Hanya booking berstatus Pending yang bisa dikonfirmasi.');
        }

        $booking->update(['status' => 'Dikonfirmasi']);

        return back()->with('success', 'Booking ' . $booking->kode_booking . ' berhasil dikonfirmasi.');
    }

    public function tolak(Request $request, Booking $booking)
    {
        $request->validate([
            'alasan_tolak' => 'required|string|max:500',
        ], [
            'alasan_tolak.required' => 'Alasan penolakan wajib diisi.',
        ]);

        if (!in_array($booking->status, ['Pending', 'Dikonfirmasi'])) {
            return back()->with('error', 'Booking ini tidak bisa ditolak.');
        }

        $booking->update([
            'status'       => 'Ditolak',
            'alasan_tolak' => $request->alasan_tolak,
        ]);

        return back()->with('success', 'Booking ' . $booking->kode_booking . ' berhasil ditolak.');
    }

    public function updateStatus(Request $request, Booking $booking)
    {
        $request->validate([
            'status' => 'required|in:Berlangsung,Selesai',
        ]);

        // Validasi alur status
        $allowedTransitions = [
            'Dikonfirmasi' => ['Berlangsung'],
            'Berlangsung'  => ['Selesai'],
        ];

        if (!isset($allowedTransitions[$booking->status]) ||
            !in_array($request->status, $allowedTransitions[$booking->status])) {
            return back()->with('error', 'Perubahan status tidak valid.');
        }

        $booking->update(['status' => $request->status]);

        return back()->with('success', 'Status booking berhasil diupdate ke ' . $request->status . '.');
    }
}