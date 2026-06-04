<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\Customer\BookingController as CustomerBookingController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PaketController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\Admin\PembayaranController;
use Illuminate\Support\Facades\Route;


// ─── Halaman Publik (tanpa login) ───────────────────────────────────────────
Route::get('/', [PublicController::class, 'index'])->name('home');
Route::get('/paket', [PublicController::class, 'pakets'])->name('pakets');
Route::get('/paket/{paketWisata}', [PublicController::class, 'showPaket'])->name('paket.show');

// ─── Auth (Tempat yang BENAR untuk Register & Login) ────────────────────────
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    // 👇 PASTIKAN NAMA FUNGSI DAN NAME-NYA SESUAI 👇
    Route::post('/register', [AuthController::class, 'registerProses'])->name('register.proses'); 
    
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    // 👇 PASTIKAN NAMA FUNGSI DAN NAME-NYA SESUAI 👇
    Route::post('/login', [AuthController::class, 'loginProses'])->name('login.proses'); 
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// ─── Customer (harus login + role customer) ──────────────────────────────────
Route::middleware(['auth', 'role:customer'])->prefix('customer')->name('customer.')->group(function () {
    Route::get('/dashboard', [CustomerBookingController::class, 'dashboard'])->name('dashboard');
//
    // Booking
    Route::get('/bookings', [CustomerBookingController::class, 'index'])->name('bookings.index');
    Route::get('/bookings/create/{paketWisata}', [CustomerBookingController::class, 'create'])->name('bookings.create');
    Route::post('/bookings/{paketWisata}', [CustomerBookingController::class, 'store'])->name('bookings.store');
    Route::get('/bookings/{booking}', [CustomerBookingController::class, 'show'])->name('bookings.show');
    Route::patch('/bookings/{booking}/cancel', [CustomerBookingController::class, 'cancel'])->name('bookings.cancel');
});

// ─── Admin (harus login + role admin) ───────────────────────────────────────
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Kelola Paket Wisata
    Route::get('/pakets', [PaketController::class, 'index'])->name('pakets.index');
    Route::get('/pakets/create', [PaketController::class, 'create'])->name('pakets.create'); // <-- Tambahkan ini
    Route::get('/pakets/{id}/edit', [PaketController::class, 'edit'])->name('pakets.edit');
    Route::resource('pakets', PaketController::class)->except(['index', 'create', 'edit']);

    // Kelola Booking
    Route::get('/bookings', [AdminBookingController::class, 'index'])->name('bookings.index');
    Route::get('/bookings/{id}', [AdminBookingController::class, 'show'])->name('bookings.show');
    Route::patch('/bookings/{booking}/konfirmasi', [AdminBookingController::class, 'konfirmasi'])->name('bookings.konfirmasi');
    Route::patch('/bookings/{booking}/tolak', [AdminBookingController::class, 'tolak'])->name('bookings.tolak');
    Route::patch('/bookings/{booking}/status', [AdminBookingController::class, 'updateStatus'])->name('bookings.updateStatus');

    // Pembayaran Cash
    Route::get('/pembayaran', [PembayaranController::class, 'index'])->name('pembayaran.index');
    Route::get('/pembayaran/{booking}', [PembayaranController::class, 'show'])->name('pembayaran.show');
    Route::patch('/pembayaran/{booking}/tandai', [PembayaranController::class, 'tandaiDiterima'])->name('pembayaran.tandai');
    
    // (Rute register & login yang tadi nyasar di sini SUDAH DIHAPUS)
});