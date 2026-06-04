@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8 font-['Plus_Jakarta_Sans']">
    
    <div class="mb-6 flex items-center gap-2 text-sm text-slate-500">
        <a href="{{ route('customer.dashboard') }}" class="hover:text-blue-600">Beranda</a> <i class="fas fa-chevron-right text-xs"></i>
        <a href="{{ route('customer.bookings.index') }}" class="hover:text-blue-600">Pesanan Saya</a> <i class="fas fa-chevron-right text-xs"></i>
        <span class="text-slate-800 font-semibold">Detail Pesanan #VE-88291</span>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- Kiri: Detail Utama --}}
        <div class="lg:col-span-2 space-y-6">
            
            {{-- Header Paket --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <h1 class="text-2xl font-bold text-slate-900">Liburan Eksotis di Bali</h1>
                        <p class="text-sm text-slate-500 mt-1">ID Pesanan: <b>VE-88291</b> &bull; Dipesan pada 12 Okt 2024</p>
                    </div>
                    <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-bold flex items-center gap-1"><span class="w-2 h-2 rounded-full bg-green-500"></span> Terkonfirmasi</span>
                </div>
                
                <img src="https://images.unsplash.com/photo-1537996194471-e657df975ab4?auto=format&fit=crop&w=800&q=80" class="w-full h-64 object-cover rounded-xl mb-6">
                
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                    <div class="bg-slate-50 p-3 rounded-lg border border-slate-100">
                        <p class="text-xs text-slate-500 mb-1">Durasi</p>
                        <p class="font-bold text-slate-900 text-sm">5 Hari 4 Malam</p>
                    </div>
                    <div class="bg-slate-50 p-3 rounded-lg border border-slate-100">
                        <p class="text-xs text-slate-500 mb-1">Keberangkatan</p>
                        <p class="font-bold text-slate-900 text-sm">20 Nov 2024</p>
                    </div>
                    <div class="bg-slate-50 p-3 rounded-lg border border-slate-100">
                        <p class="text-xs text-slate-500 mb-1">Peserta</p>
                        <p class="font-bold text-slate-900 text-sm">2 Dewasa</p>
                    </div>
                    <div class="bg-slate-50 p-3 rounded-lg border border-slate-100">
                        <p class="text-xs text-slate-500 mb-1">Lokasi</p>
                        <p class="font-bold text-slate-900 text-sm">Ubud, Bali</p>
                    </div>
                </div>
            </div>

            {{-- Instruksi Pembayaran --}}
            <div class="bg-amber-50 border border-amber-200 rounded-2xl p-6">
                <div class="flex gap-3 items-center mb-4 text-amber-800">
                    <i class="fas fa-wallet text-2xl"></i>
                    <h3 class="text-lg font-bold">Instruksi Pembayaran Tunai</h3>
                </div>
                <p class="text-sm text-amber-800 mb-6">Pesanan Anda telah dikonfirmasi dengan metode <b>Bayar di Tempat</b>. Harap siapkan uang tunai sesuai total tagihan untuk diserahkan kepada pemandu kami di titik temu.</p>
                
                <div class="grid sm:grid-cols-2 gap-4">
                    <div class="flex gap-3">
                        <i class="fas fa-map-marker-alt text-amber-600 mt-1"></i>
                        <div>
                            <p class="text-xs font-bold text-amber-900">Titik Temu</p>
                            <p class="text-xs text-amber-800 mt-1">Lobi Utama Bandara I Gusti Ngurah Rai (Kedatangan Domestik)</p>
                        </div>
                    </div>
                    <div class="flex gap-3">
                        <i class="fas fa-clock text-amber-600 mt-1"></i>
                        <div>
                            <p class="text-xs font-bold text-amber-900">Waktu Temu</p>
                            <p class="text-xs text-amber-800 mt-1">20 November 2024, 09:00 WITA</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Kanan: Ringkasan --}}
        <div class="space-y-6">
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
                <h3 class="text-lg font-bold text-slate-900 mb-4">Ringkasan Pembayaran</h3>
                <div class="space-y-3 text-sm text-slate-600 border-b border-slate-100 pb-4 mb-4">
                    <div class="flex justify-between"><span>Paket Eksotis Bali (x2)</span><span>Rp 8.500.000</span></div>
                    <div class="flex justify-between"><span>Biaya Layanan</span><span>Rp 50.000</span></div>
                    <div class="flex justify-between font-bold text-slate-900"><span>Total Bayar</span><span class="text-blue-600 text-xl">Rp 8.550.000</span></div>
                </div>
                <button class="w-full bg-blue-700 hover:bg-blue-800 text-white font-bold py-3 rounded-lg transition-colors mb-3"><i class="fas fa-download mr-2"></i> Unduh E-Voucher</button>
                <button class="w-full bg-white border border-blue-200 text-blue-700 font-bold py-3 rounded-lg hover:bg-blue-50 transition-colors">Hubungi Pemandu</button>
            </div>
        </div>
    </div>
</div>
@endsection 