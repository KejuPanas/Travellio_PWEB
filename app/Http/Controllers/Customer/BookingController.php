<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function dashboard()
    {
        // Sementara kita tampilkan teks saja untuk membuktikan jalurnya sukses
        return view('customer.dashboard');
    }
    /**
     * Menampilkan halaman Riwayat Booking (My Bookings)
     */
    public function index()
    {
        return view('customer.bookings.index');
    }

    /**
     * Menampilkan halaman Form Booking Paket Wisata
     */
    public function create($paketWisata)
    {
        // Parameter $paketWisata nanti dipakai untuk mengambil data dari database
        return view('customer.bookings.create');
    }

    /**
     * Memproses data form booking yang disubmit (Simpan ke database)
     */
    public function store(Request $request, $paketWisata)
    {
        // (Logika simpan data ke database menyusul nanti)
        
        // Untuk sekarang, lempar dulu kembali ke halaman riwayat booking
        return redirect()->route('customer.bookings.index')->with('success', 'Booking berhasil dibuat! Menunggu konfirmasi admin.');
    }

    /**
     * Menampilkan halaman Detail sebuah Booking
     */
    public function show($booking)
    {
        return view('customer.bookings.show');
    }

    /**
     * Memproses pembatalan booking oleh pelanggan
     */
    public function cancel($booking)
    {
        // (Logika update status jadi Batal di database menyusul nanti)
        
        return back()->with('success', 'Booking berhasil dibatalkan.');
    }
}
