<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\PaketWisata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();

        $stats = [
            'total'        => $user->bookings()->count(),
            'pending'      => $user->bookings()->byStatus('Pending')->count(),
            'dikonfirmasi' => $user->bookings()->byStatus('Dikonfirmasi')->count(),
            'selesai'      => $user->bookings()->byStatus('Selesai')->count(),
        ];

        $recentBookings = $user->bookings()
            ->with('paketWisata')
            ->latest()
            ->take(5)
            ->get();

        return view('customer.dashboard', compact('stats', 'recentBookings'));
    }

    public function create(PaketWisata $paketWisata)
    {
        if (!$paketWisata->is_active) {
            return redirect()->route('pakets')
                ->with('error', 'Paket wisata ini tidak tersedia.');
        }

        return view('customer.booking.create', compact('paketWisata'));
    }

    public function store(Request $request, PaketWisata $paketWisata)
    {
        $request->validate([
            'tanggal_berangkat' => 'required|date|after:today',
            'jumlah_peserta'    => [
                'required',
                'integer',
                'min:' . $paketWisata->min_peserta,
                $paketWisata->max_peserta ? 'max:' . $paketWisata->max_peserta : '',
            ],
            'catatan'           => 'nullable|string|max:1000',
        ], [
            'tanggal_berangkat.required' => 'Tanggal berangkat wajib diisi.',
            'tanggal_berangkat.after'    => 'Tanggal berangkat harus setelah hari ini.',
            'jumlah_peserta.required'    => 'Jumlah peserta wajib diisi.',
            'jumlah_peserta.min'         => 'Jumlah peserta minimal ' . $paketWisata->min_peserta . ' orang.',
            'jumlah_peserta.max'         => 'Jumlah peserta maksimal ' . $paketWisata->max_peserta . ' orang.',
        ]);

        $totalHarga = $paketWisata->harga_per_orang * $request->jumlah_peserta;

        $booking = Booking::create([
            'user_id'          => Auth::id(),
            'paket_wisata_id'  => $paketWisata->id,
            'tanggal_berangkat' => $request->tanggal_berangkat,
            'jumlah_peserta'   => $request->jumlah_peserta,
            'total_harga'      => $totalHarga,
            'catatan'          => $request->catatan,
            'status'           => 'Pending',
        ]);

        return redirect()->route('customer.bookings.show', $booking)
            ->with('success', 'Booking berhasil dibuat! Kode booking kamu: ' . $booking->kode_booking . '. Tunggu konfirmasi dari admin.');
    }

    public function index()
    {
        $bookings = Auth::user()->bookings()
            ->with('paketWisata')
            ->latest()
            ->paginate(10);

        return view('customer.booking.index', compact('bookings'));
    }

    public function show(Booking $booking)
    {
        // Pastikan booking milik user yang login
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }

        return view('customer.booking.show', compact('booking'));
    }

    public function cancel(Booking $booking)
    {
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }

        if (!$booking->canBeCancelled()) {
            return back()->with('error', 'Booking tidak bisa dibatalkan karena statusnya sudah ' . $booking->status . '.');
        }

        $booking->update(['status' => 'Ditolak', 'alasan_tolak' => 'Dibatalkan oleh pelanggan.']);

        return redirect()->route('customer.bookings.index')
            ->with('success', 'Booking berhasil dibatalkan.');
    }
}