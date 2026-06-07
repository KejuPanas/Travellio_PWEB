<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $query = Booking::with(['user', 'paketWisata']);

        // Handle pencarian (kode booking atau nama user)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('kode_booking', 'like', "%{$search}%")
                  ->orWhereHas('user', function ($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%");
                  });
        }

        // Handle filter status
        $status = $request->get('status', 'Semua');
        if ($status !== 'Semua') {
            $query->where('status', $status);
        }

        $bookings = $query->latest()->paginate(15)->withQueryString();

        return view('admin.bookings.index', compact('bookings', 'status'));
    }

    public function show($id)
    {
        $booking = Booking::with(['user', 'paketWisata'])->findOrFail($id);
        return view('admin.bookings.show', compact('booking'));
    }

    public function konfirmasi(Request $request, Booking $booking)
    {
        if ($booking->status !== 'Pending') {
            return back()->with('error', 'Hanya pesanan berstatus Pending yang dapat dikonfirmasi.');
        }

        $booking->update([
            'status' => 'Dikonfirmasi'
        ]);

        return back()->with('success', 'Booking berhasil dikonfirmasi.');
    }

    public function tolak(Request $request, Booking $booking)
    {
        if ($booking->status !== 'Pending') {
            return back()->with('error', 'Hanya pesanan berstatus Pending yang dapat ditolak.');
        }

        $request->validate([
            'alasan_tolak' => 'required|string|max:255'
        ]);

        $booking->update([
            'status' => 'Ditolak',
            'alasan_tolak' => $request->alasan_tolak
        ]);

        return back()->with('success', 'Booking berhasil ditolak.');
    }

    public function updateStatus(Request $request, Booking $booking)
    {
        $request->validate([
            'status' => 'required|in:Pending,Dikonfirmasi,Berlangsung,Selesai,Ditolak'
        ]);

        $booking->update([
            'status' => $request->status
        ]);

        return back()->with('success', 'Status booking berhasil diubah menjadi ' . $request->status);
    }
}