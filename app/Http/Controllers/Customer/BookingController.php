<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\PaketWisata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BookingController extends Controller
{
    /**
     * Menampilkan dashboard customer
     */
    public function dashboard()
    {
        $user = Auth::user();
        $totalBookings = Booking::where('user_id', $user->id)->count();
        $pendingBookings = Booking::where('user_id', $user->id)->where('status', 'Pending')->count();
        $completedBookings = Booking::where('user_id', $user->id)->where('status', 'Selesai')->count();
        
        $latestBookings = Booking::where('user_id', $user->id)
            ->with('paketWisata')
            ->latest()
            ->take(5)
            ->get();

        return view('customer.dashboard', compact('totalBookings', 'pendingBookings', 'completedBookings', 'latestBookings'));
    }

    /**
     * Menampilkan halaman Riwayat Booking (My Bookings)
     */
    public function index()
    {
        $bookings = Booking::where('user_id', Auth::id())
            ->with('paketWisata')
            ->latest()
            ->get();

        return view('customer.bookings.index', compact('bookings'));
    }

    /**
     * Menampilkan halaman Form Booking Paket Wisata
     */
    public function create($paketWisataId)
    {
        $paket = PaketWisata::active()->findOrFail($paketWisataId);
        return view('customer.bookings.create', compact('paket'));
    }

    /**
     * Memproses data form booking yang disubmit (Simpan ke database)
     */
    public function store(Request $request, $paketWisataId)
    {
        $paket = PaketWisata::active()->findOrFail($paketWisataId);

        $request->validate([
            'tanggal' => 'required|date|after:today',
            'jumlah_peserta' => 'required|integer|min:1',
            'catatan' => 'nullable|string',
            'bukti_transfer' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048', // Maksimal 2MB
        ]);

        if ($request->jumlah_peserta < $paket->min_peserta) {
            return back()->withErrors(['jumlah_peserta' => 'Minimal jumlah peserta untuk paket ini adalah ' . $paket->min_peserta . ' orang.'])->withInput();
        }

        if ($paket->max_peserta && $request->jumlah_peserta > $paket->max_peserta) {
            return back()->withErrors(['jumlah_peserta' => 'Maksimal jumlah peserta untuk paket ini adalah ' . $paket->max_peserta . ' orang.'])->withInput();
        }

        $totalHarga = $request->jumlah_peserta * $paket->harga_per_orang;
        $nominalDp = $totalHarga * 0.50; // DP 50%

        // Upload file bukti transfer
        $buktiPath = null;
        if ($request->hasFile('bukti_transfer')) {
            $buktiPath = $request->file('bukti_transfer')->store('bukti_transfer', 'public');
        }

        Booking::create([
            'user_id' => Auth::id(),
            'paket_wisata_id' => $paket->id,
            'tanggal_berangkat' => $request->tanggal,
            'jumlah_peserta' => $request->jumlah_peserta,
            'total_harga' => $totalHarga,
            'nominal_dp' => $nominalDp,
            'bukti_transfer' => $buktiPath,
            'catatan' => $request->catatan,
            'status' => 'Pending',
        ]);

        return redirect()->route('customer.bookings.index')->with('success', 'Booking berhasil dibuat! Menunggu konfirmasi pembayaran DP oleh admin.');
    }

    /**
     * Menampilkan halaman Detail sebuah Booking
     */
    public function show($bookingId)
    {
        $booking = Booking::where('user_id', Auth::id())
            ->with('paketWisata')
            ->findOrFail($bookingId);

        return view('customer.bookings.show', compact('booking'));
    }

    /**
     * Memproses pembatalan booking oleh pelanggan
     */
    public function cancel($bookingId)
    {
        $booking = Booking::where('user_id', Auth::id())->findOrFail($bookingId);

        if (!$booking->canBeCancelled()) {
            return back()->with('error', 'Booking ini tidak bisa dibatalkan.');
        }

        // Hapus file bukti transfer jika ada
        if ($booking->bukti_transfer) {
            Storage::disk('public')->delete($booking->bukti_transfer);
        }

        $booking->delete();

        return redirect()->route('customer.bookings.index')->with('success', 'Booking berhasil dibatalkan.');
    }
}
