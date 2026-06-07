@extends('layouts.app')
@section('title', 'Home')

@section('content')

{{-- Hero Section --}}
<section class="relative bg-cover bg-center bg-no-repeat py-32 lg:py-48" style="background-image: url('https://images.unsplash.com/photo-1510414842594-a61c69b5ae57?q=80&w=2000&auto=format&fit=crop');">
    <div class="absolute inset-0 bg-black/20"></div> {{-- Overlay tipis --}}
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="max-w-2xl">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white leading-tight mb-4 drop-shadow-lg">
                Jelajahi Dunia dengan Kemudahan Booking Travel
            </h1>
            <p class="text-white/90 text-lg md:text-xl mb-10 drop-shadow">
                Temukan paket wisata impianmu dan kelola perjalananmu dalam satu platform yang mudah. Dari pantai Bali hingga pegunungan Bromo, petualanganmu dimulai di sini.
            </p>
        </div>

        {{-- Floating Search Bar --}}
        <div class="bg-white p-3 rounded-2xl md:rounded-full shadow-2xl max-w-4xl flex flex-col md:flex-row items-center gap-3">
            <div class="w-full md:w-1/3 flex items-center bg-gray-100 rounded-xl md:rounded-full px-4 py-3">
                <i class="fas fa-location-dot text-gray-400 mr-3"></i>
                <input type="text" placeholder="Destinasi tujuan..." class="bg-transparent border-none outline-none w-full text-gray-700 placeholder-gray-400">
            </div>
            <div class="w-full md:w-1/3 flex items-center bg-gray-100 rounded-xl md:rounded-full px-4 py-3">
                <i class="far fa-calendar text-gray-400 mr-3"></i>
                <input type="text" placeholder="Pilih Tanggal" class="bg-transparent border-none outline-none w-full text-gray-700 placeholder-gray-400">
            </div>
            <button class="w-full md:w-1/3 bg-blue-700 hover:bg-blue-800 text-white font-semibold py-3 px-6 rounded-xl md:rounded-full transition-colors flex items-center justify-center gap-2">
                <i class="fas fa-search"></i> Cari Sekarang
            </button>
        </div>
    </div>
</section>

{{-- Popular Packages --}}
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-end mb-10">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">Paket Wisata Terpopuler</h2>
                <p class="text-gray-500 text-sm mt-1">Pilihan terbaik untuk liburan tak terlupakan Anda</p>
            </div>
            <a href="#" class="text-blue-700 font-semibold hover:underline hidden sm:block text-sm">Lihat Semua <i class="fas fa-arrow-right ml-1"></i></a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse($pakets as $paket)
            <div class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition p-3 flex flex-col justify-between">
                <div>
                    <a href="{{ route('paket.show', $paket->id) }}" class="block relative h-48 rounded-xl overflow-hidden group">
                        <img src="{{ $paket->foto_url }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <span class="absolute top-3 left-3 bg-green-500 text-white text-[10px] font-black uppercase tracking-wider px-2 py-1 rounded">Best Seller</span>
                    </a>
                    <div class="p-4">
                        <div class="text-slate-400 text-xs flex items-center gap-1 mb-1.5">
                            <i class="fas fa-location-dot text-blue-600"></i> {{ $paket->destinasi }}
                        </div>
                        <h3 class="font-bold text-slate-800 mb-4 line-clamp-2 h-12 leading-snug hover:text-blue-600 transition-colors">
                            <a href="{{ route('paket.show', $paket->id) }}">{{ $paket->nama_paket }}</a>
                        </h3>
                        <p class="text-xs text-slate-500 flex items-center gap-2 mb-4">
                            <i class="far fa-clock"></i> {{ $paket->durasi_hari }} Hari
                        </p>
                    </div>
                </div>
                <div class="p-4 pt-0">
                    <div class="flex justify-between items-center mt-auto border-t border-slate-50 pt-4">
                        <div>
                            <p class="text-[9px] font-bold text-slate-400 uppercase tracking-wider">Mulai dari</p>
                            <p class="text-blue-700 font-extrabold text-base">{{ $paket->harga_format }}</p>
                        </div>
                        
                        @auth
                            @if(auth()->user()->isCustomer())
                                <a href="{{ route('customer.bookings.create', $paket->id) }}" class="bg-blue-700 hover:bg-blue-800 text-white text-xs font-bold py-2 px-4 rounded-lg transition-colors shadow-sm">
                                    Pesan
                                </a>
                            @else
                                <span class="text-slate-400 text-xs font-semibold bg-slate-100 px-2 py-1 rounded">Admin</span>
                            @endif
                        @else
                            <a href="{{ route('customer.bookings.create', $paket->id) }}" class="bg-blue-700 hover:bg-blue-800 text-white text-xs font-bold py-2 px-4 rounded-lg transition-colors shadow-sm">
                                Pesan
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full bg-slate-50 p-8 rounded-2xl border border-slate-100 text-center">
                <i class="fas fa-box-open text-4xl text-slate-300 mb-3"></i>
                <h3 class="text-lg font-bold text-slate-800">Belum Ada Paket</h3>
                <p class="text-sm text-slate-500 mt-1">Belum ada paket wisata populer yang tersedia saat ini.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

{{-- Cara Kerja --}}
<section class="py-20 bg-gray-50 border-t border-gray-200 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl font-bold text-gray-900">Cara Kerja Travellio</h2>
        <p class="text-gray-500 mt-2 mb-16">Sistem booking yang transparan dan memudahkan setiap langkah perjalanan Anda.</p>

        <div class="relative max-w-5xl mx-auto">
            {{-- Garis Putus-putus Background (Disembunyikan di layar HP) --}}
            <div class="hidden md:block absolute top-8 left-10 right-10 h-0.5 border-t-2 border-dashed border-blue-200 z-0"></div>

            <div class="grid grid-cols-1 md:grid-cols-5 gap-8 relative z-10">
                <div class="flex flex-col items-center">
                    <div class="w-16 h-16 bg-blue-100 text-blue-700 rounded-full flex items-center justify-center text-xl mb-4 ring-8 ring-gray-50">
                        <i class="fas fa-hand-pointer"></i>
                    </div>
                    <h4 class="font-bold text-gray-900 text-sm">Pilih Paket</h4>
                    <p class="text-xs text-gray-500 mt-2 px-2">Pelanggan memilih paket wisata yang diinginkan.</p>
                </div>
                <div class="flex flex-col items-center">
                    <div class="w-16 h-16 bg-blue-100 text-blue-700 rounded-full flex items-center justify-center text-xl mb-4 ring-8 ring-gray-50">
                        <i class="fas fa-pen-to-square"></i>
                    </div>
                    <h4 class="font-bold text-gray-900 text-sm">Isi Form</h4>
                    <p class="text-xs text-gray-500 mt-2 px-2">Mengisi formulir booking dengan detail lengkap.</p>
                </div>
                <div class="flex flex-col items-center">
                    <div class="w-16 h-16 bg-blue-100 text-blue-700 rounded-full flex items-center justify-center text-xl mb-4 ring-8 ring-gray-50">
                        <i class="fas fa-shield-check"></i>
                    </div>
                    <h4 class="font-bold text-gray-900 text-sm">Review Admin</h4>
                    <p class="text-xs text-gray-500 mt-2 px-2">Admin meninjau pesanan dan ketersediaan.</p>
                </div>
                <div class="flex flex-col items-center">
                    <div class="w-16 h-16 bg-blue-100 text-blue-700 rounded-full flex items-center justify-center text-xl mb-4 ring-8 ring-gray-50">
                        <i class="fas fa-money-bill-wave"></i>
                    </div>
                    <h4 class="font-bold text-gray-900 text-sm">Pembayaran</h4>
                    <p class="text-xs text-gray-500 mt-2 px-2">Selesaikan pembayaran tunai atau transfer.</p>
                </div>
                <div class="flex flex-col items-center">
                    <div class="w-16 h-16 bg-green-100 text-green-600 rounded-full flex items-center justify-center text-xl mb-4 ring-8 ring-gray-50">
                        <i class="fas fa-suitcase-rolling"></i>
                    </div>
                    <h4 class="font-bold text-gray-900 text-sm">Perjalanan</h4>
                    <p class="text-xs text-gray-500 mt-2 px-2">Nikmati liburan Anda dengan tenang.</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Akses Penuh Features --}}
<section class="py-20 bg-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            
            {{-- Kiri: Teks & List --}}
            <div>
                <span class="text-blue-700 font-bold uppercase tracking-wider text-xs mb-2 block">FITUR PELANGGAN</span>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-10 leading-tight">Akses Penuh untuk Kemudahan Perjalanan Anda</h2>
                
                <div class="space-y-8">
                    <div class="flex gap-4">
                        <div class="flex-shrink-0 w-12 h-12 bg-white rounded-xl shadow-sm flex items-center justify-center text-blue-700 border border-gray-100">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <div>
                            <h4 class="text-lg font-bold text-gray-900">Autentikasi Aman</h4>
                            <p class="text-gray-500 text-sm mt-1 leading-relaxed">Login dan registrasi yang mudah untuk menyimpan data perjalanan Anda dengan aman.</p>
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <div class="flex-shrink-0 w-12 h-12 bg-white rounded-xl shadow-sm flex items-center justify-center text-blue-700 border border-gray-100">
                            <i class="fas fa-search-location"></i>
                        </div>
                        <div>
                            <h4 class="text-lg font-bold text-gray-900">Lihat Paket Real-time</h4>
                            <p class="text-gray-500 text-sm mt-1 leading-relaxed">Telusuri ratusan destinasi menarik dengan harga terbaru dan detail itinerary lengkap.</p>
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <div class="flex-shrink-0 w-12 h-12 bg-white rounded-xl shadow-sm flex items-center justify-center text-blue-700 border border-gray-100">
                            <i class="fas fa-bolt"></i>
                        </div>
                        <div>
                            <h4 class="text-lg font-bold text-gray-900">Booking Instant</h4>
                            <p class="text-gray-500 text-sm mt-1 leading-relaxed">Pesan kursi perjalanan Anda dalam hitungan detik dengan formulir yang simpel.</p>
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <div class="flex-shrink-0 w-12 h-12 bg-white rounded-xl shadow-sm flex items-center justify-center text-blue-700 border border-gray-100">
                            <i class="fas fa-history"></i>
                        </div>
                        <div>
                            <h4 class="text-lg font-bold text-gray-900">Riwayat & Status</h4>
                            <p class="text-gray-500 text-sm mt-1 leading-relaxed">Pantau status pesanan dan lihat riwayat perjalanan lama Anda dalam satu dashboard.</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Kanan: Gambar Pesawat --}}
            <div class="relative mt-10 lg:mt-0">
                <img src="https://images.unsplash.com/photo-1436491865332-7a61a109cc05?auto=format&fit=crop&w=800&q=80" class="rounded-2xl shadow-xl w-full h-[500px] object-cover">
                
                {{-- Floating Card --}}
                <div class="absolute -bottom-8 lg:bottom-10 -left-4 md:-left-10 bg-white p-5 rounded-2xl shadow-2xl max-w-xs border border-gray-100">
                    <div class="flex items-center gap-3 mb-2">
                        <div class="w-8 h-8 bg-green-100 text-green-500 rounded-full flex items-center justify-center">
                            <i class="fas fa-check"></i>
                        </div>
                        <h5 class="font-bold text-gray-900">Booking Berhasil!</h5>
                    </div>
                    <p class="text-xs text-gray-500">Paket Bali Anda telah dikonfirmasi oleh admin.</p>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection