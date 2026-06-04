@extends('layouts.app') {{-- Ganti sesuai nama layout utama kamu --}}

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 font-['Plus_Jakarta_Sans']">
    {{-- Header --}}
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-slate-900">Selamat Datang, {{ Auth::user()->name }}!</h1>
        <p class="text-slate-500 mt-1">Rencanakan petualangan Anda berikutnya hari ini.</p>
    </div>

    {{-- Stats Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex flex-col">
            <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-xl flex items-center justify-center text-xl mb-4"><i class="fas fa-ticket-alt"></i></div>
            <p class="text-slate-500 text-sm font-medium">Total Pesanan</p>
            <h3 class="text-3xl font-bold text-slate-900">12</h3>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex flex-col">
            <div class="w-12 h-12 bg-yellow-100 text-yellow-600 rounded-xl flex items-center justify-center text-xl mb-4"><i class="fas fa-clock"></i></div>
            <p class="text-slate-500 text-sm font-medium">Menunggu Konfirmasi</p>
            <h3 class="text-3xl font-bold text-slate-900">2</h3>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex flex-col">
            <div class="w-12 h-12 bg-green-100 text-green-600 rounded-xl flex items-center justify-center text-xl mb-4"><i class="fas fa-check-circle"></i></div>
            <p class="text-slate-500 text-sm font-medium">Perjalanan Selesai</p>
            <h3 class="text-3xl font-bold text-slate-900">10</h3>
        </div>
    </div>

    {{-- Pesanan Terakhir & Akses Cepat --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- Table Pesanan --}}
        <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-bold text-slate-900">Pesanan Terakhir</h3>
                <a href="{{ route('customer.bookings.index') }}" class="text-blue-600 text-sm font-medium hover:underline">Lihat Semua</a>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="text-slate-400 text-xs uppercase border-b border-slate-100">
                            <th class="pb-3 font-semibold">Destinasi</th>
                            <th class="pb-3 font-semibold">Tanggal</th>
                            <th class="pb-3 font-semibold">Status</th>
                            <th class="pb-3 font-semibold">Total</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm">
                        <tr class="border-b border-slate-50 last:border-0">
                            <td class="py-4 flex items-center gap-3">
                                <div class="w-10 h-10 rounded-lg bg-slate-200 overflow-hidden"><img src="https://images.unsplash.com/photo-1537996194471-e657df975ab4?auto=format&fit=crop&w=100&q=80" class="w-full h-full object-cover"></div>
                                <span class="font-bold text-slate-900">Bali Getaway</span>
                            </td>
                            <td class="py-4 text-slate-500">15 Okt 2024</td>
                            <td class="py-4"><span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-bold">TERKONFIRMASI</span></td>
                            <td class="py-4 font-bold text-blue-600">Rp 4.500.000</td>
                        </tr>
                        <tr>
                            <td class="py-4 flex items-center gap-3">
                                <div class="w-10 h-10 rounded-lg bg-slate-200 overflow-hidden"><img src="https://images.unsplash.com/photo-1493976040374-85c8e12f0c0e?auto=format&fit=crop&w=100&q=80" class="w-full h-full object-cover"></div>
                                <span class="font-bold text-slate-900">Kyoto Spring</span>
                            </td>
                            <td class="py-4 text-slate-500">12 Nov 2024</td>
                            <td class="py-4"><span class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs font-bold">MENUNGGU</span></td>
                            <td class="py-4 font-bold text-blue-600">Rp 12.800.000</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Promo & Akses Cepat --}}
        <div class="space-y-6">
            <div class="bg-blue-600 rounded-2xl p-6 text-white text-center shadow-lg bg-cover bg-center" style="background-image: linear-gradient(to right, rgba(37,99,235,0.9), rgba(37,99,235,0.8)), url('https://images.unsplash.com/photo-1506929562872-bb421503ef21?auto=format&fit=crop&w=400&q=80');">
                <span class="bg-blue-800 text-xs font-bold px-3 py-1 rounded-full mb-4 inline-block">PROMO TERBATAS</span>
                <h3 class="text-xl font-bold mb-4">Jelajahi Paket Wisata Musim Panas</h3>
                <a href="{{ route('pakets') }}" class="bg-white text-blue-600 px-5 py-2 rounded-full font-bold text-sm hover:bg-blue-50 transition">Cek Sekarang &rarr;</a>
            </div>
        </div>
    </div>
</div>
@endsection