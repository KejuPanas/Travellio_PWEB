@extends('layouts.app')
@section('title', $paketWisata->nama_paket)

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8 font-['Plus_Jakarta_Sans']">
    {{-- Back Button --}}
    <a href="{{ route('pakets') }}" class="inline-flex items-center text-sm font-bold text-blue-700 hover:text-blue-800 mb-6 transition-colors group">
        <i class="fas fa-arrow-left mr-2 group-hover:-translate-x-1 transition-transform"></i> Kembali ke Daftar Paket
    </a>

    {{-- Main Image Banner --}}
    <div class="relative h-[300px] sm:h-[400px] md:h-[480px] w-full rounded-3xl overflow-hidden shadow-md mb-8">
        <img src="{{ $paketWisata->foto_url }}" class="absolute inset-0 w-full h-full object-cover" alt="{{ $paketWisata->nama_paket }}">
        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent"></div>
        
        <div class="absolute bottom-0 left-0 p-6 md:p-8 space-y-3 w-full">
            <div class="flex flex-wrap gap-2">
                <span class="bg-green-500 text-white text-[10px] font-black uppercase tracking-wider px-3 py-1 rounded-full">Terpopuler</span>
                <span class="bg-white/20 backdrop-blur-md text-white text-[10px] font-bold px-3 py-1 rounded-full flex items-center gap-1">
                    <i class="fas fa-star text-yellow-400"></i> 4.8 (120 Reviews)
                </span>
            </div>
            <h1 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-white tracking-tight leading-tight md:max-w-3xl">{{ $paketWisata->nama_paket }}</h1>
            <p class="text-white/90 text-xs sm:text-sm flex items-center gap-1.5 font-medium">
                <i class="fas fa-map-marker-alt text-red-500 text-sm"></i> {{ $paketWisata->destinasi }}
            </p>
        </div>
    </div>

    {{-- Four Stats Badges Grid --}}
    <div class="bg-slate-50 border border-slate-100 rounded-2xl p-5 md:p-6 grid grid-cols-2 md:grid-cols-4 gap-6 mb-8">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-lg flex-shrink-0"><i class="fas fa-clock"></i></div>
            <div>
                <p class="text-[9px] font-bold text-slate-400 uppercase tracking-wider">Durasi</p>
                <p class="font-extrabold text-slate-800 text-xs sm:text-sm">{{ $paketWisata->durasi_hari }} Hari</p>
            </div>
        </div>
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-lg flex-shrink-0"><i class="fas fa-user-friends"></i></div>
            <div>
                <p class="text-[9px] font-bold text-slate-400 uppercase tracking-wider">Min. Orang</p>
                <p class="font-extrabold text-slate-800 text-xs sm:text-sm">{{ $paketWisata->min_peserta }} Orang</p>
            </div>
        </div>
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-lg flex-shrink-0"><i class="fas fa-users"></i></div>
            <div>
                <p class="text-[9px] font-bold text-slate-400 uppercase tracking-wider">Maks. Orang</p>
                <p class="font-extrabold text-slate-800 text-xs sm:text-sm">{{ $paketWisata->max_peserta ?? '10' }} Orang</p>
            </div>
        </div>
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-lg flex-shrink-0"><i class="fas fa-map-marked-alt"></i></div>
            <div>
                <p class="text-[9px] font-bold text-slate-400 uppercase tracking-wider">Lokasi</p>
                <p class="font-extrabold text-slate-800 text-xs sm:text-sm">{{ $paketWisata->destinasi }}</p>
            </div>
        </div>
    </div>

    {{-- Main Columns --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- Kiri: Detail Utama --}}
        <div class="lg:col-span-2 space-y-8">
            
            {{-- Deskripsi --}}
            <div class="bg-white border border-slate-100 rounded-2xl p-6 md:p-8 shadow-sm space-y-4">
                <h2 class="text-lg font-bold text-slate-900 flex items-center gap-2">
                    <i class="far fa-file-alt text-blue-600"></i> Deskripsi
                </h2>
                <p class="text-slate-600 text-xs sm:text-sm leading-relaxed whitespace-pre-line">{{ $paketWisata->deskripsi }}</p>
            </div>

            {{-- Itinerary Perjalanan --}}
            @php
                $itineraryText = $paketWisata->itinerary;
                $days = [];
                $lines = explode("\n", $itineraryText);
                $currentDay = null;
                $currentContent = [];

                foreach ($lines as $line) {
                    $trimmed = trim($line);
                    if (empty($trimmed)) {
                        continue;
                    }

                    // Deteksi Hari ke-X atau Hari X atau Day X
                    if (preg_match('/^(Hari\s*(?:ke-)?\s*\d+|Day\s*\d+)/i', $trimmed)) {
                        if ($currentDay) {
                            $days[] = [
                                'title' => $currentDay,
                                'content' => $currentContent
                            ];
                        }
                        $currentDay = $trimmed;
                        $currentContent = [];
                    } else {
                        if ($currentDay === null) {
                            $currentDay = 'Rencana Perjalanan';
                        }
                        $currentContent[] = $trimmed;
                    }
                }

                if ($currentDay) {
                    $days[] = [
                        'title' => $currentDay,
                        'content' => $currentContent
                    ];
                }
            @endphp

            <div class="bg-white border border-slate-100 rounded-2xl p-6 md:p-8 shadow-sm space-y-6">
                <h2 class="text-lg font-bold text-slate-900 flex items-center gap-2">
                    <i class="fas fa-route text-blue-600"></i> Itinerary Perjalanan
                </h2>
                
                <div class="relative border-l border-slate-200 ml-4 pl-6 space-y-6">
                    @forelse($days as $day)
                    <div class="relative">
                        {{-- Timeline Marker --}}
                        <span class="absolute -left-[30.5px] top-1 bg-white border-2 border-blue-600 w-3.5 h-3.5 rounded-full z-10 flex items-center justify-center">
                            <span class="w-1.5 h-1.5 bg-blue-600 rounded-full"></span>
                        </span>
                        
                        <div class="bg-slate-50 border border-slate-100 rounded-xl p-5 space-y-3">
                            <h3 class="font-extrabold text-blue-700 text-sm md:text-base">{{ $day['title'] }}</h3>
                            <div class="text-xs md:text-sm text-slate-600 leading-relaxed space-y-2">
                                @foreach($day['content'] as $contentLine)
                                    @if(strpos($contentLine, '|') !== false)
                                        {{-- Render sebagai Tag Pills --}}
                                        <div class="flex flex-wrap gap-2 pt-1">
                                            @foreach(explode('|', $contentLine) as $tag)
                                                @if(trim($tag))
                                                    <span class="bg-slate-200/70 text-slate-700 text-[10px] font-bold px-2.5 py-1 rounded">{{ trim($tag) }}</span>
                                                @endif
                                            @endforeach
                                        </div>
                                    @else
                                        <p>{{ $contentLine }}</p>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @empty
                    <p class="text-slate-400 text-sm">Tidak ada detail itinerary.</p>
                    @endforelse
                </div>
            </div>

            {{-- Informasi Pembayaran Card --}}
            <div class="bg-blue-50 border border-blue-100 rounded-2xl p-5 flex gap-4 text-blue-800">
                <div class="w-10 h-10 bg-blue-600 text-white rounded-xl flex items-center justify-center flex-shrink-0 text-lg">
                    <i class="fas fa-credit-card"></i>
                </div>
                <div>
                    <h4 class="font-bold text-blue-900 text-sm md:text-base">Pembayaran DP 50% + Pelunasan Cash</h4>
                    <p class="text-[11px] md:text-xs text-blue-800 mt-1 leading-relaxed">Pembayaran uang muka (DP) sebesar 50% ditransfer setelah melakukan booking untuk mengamankan slot perjalanan Anda. Sisa pelunasan 50% dibayarkan secara cash/tunai saat bertemu dengan tim kami di meeting point.</p>
                </div>
            </div>
        </div>

        {{-- Kanan: Sidebar --}}
        <div class="space-y-6">
            <aside class="sticky top-24">
                <div class="bg-white border border-slate-100 rounded-2xl p-6 shadow-md space-y-6">
                    <div>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Mulai dari</p>
                        <div class="flex items-baseline gap-1 mt-1">
                            <span class="text-2xl font-black text-blue-600">{{ $paketWisata->harga_format }}</span>
                            <span class="text-xs text-slate-500 font-medium">/ orang</span>
                        </div>
                    </div>
                    
                    <div class="border-t border-slate-100 pt-5 space-y-3">
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400"><i class="far fa-calendar-alt"></i></span>
                            <input type="text" value="Pilih Tanggal" class="w-full pl-9 pr-4 py-3 border border-slate-200 rounded-xl text-xs outline-none bg-slate-50 font-semibold text-slate-500 cursor-not-allowed" readonly>
                            <span class="absolute inset-y-0 right-0 flex items-center pr-3 text-slate-400"><i class="fas fa-chevron-down text-xs"></i></span>
                        </div>
                    </div>
                    
                    <div class="space-y-3 text-xs text-slate-500 border-t border-slate-100 pt-5 font-medium">
                        <div class="flex justify-between items-center">
                            <span class="flex items-center gap-2 text-slate-400"><i class="far fa-clock text-slate-400"></i> Durasi</span>
                            <span class="font-bold text-slate-800">{{ $paketWisata->durasi_hari }} Hari / {{ $paketWisata->durasi_hari - 1 }} Malam</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="flex items-center gap-2 text-slate-400"><i class="fas fa-user-friends text-slate-400"></i> Min. Peserta</span>
                            <span class="font-bold text-slate-800">{{ $paketWisata->min_peserta }} Orang</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="flex items-center gap-2 text-slate-400"><i class="fas fa-wallet text-slate-400"></i> Pembayaran</span>
                            <span class="font-bold text-slate-800">DP 50% + Cash</span>
                        </div>
                    </div>
                    
                    <div class="pt-2">
                        @auth
                            @if(auth()->user()->isCustomer())
                                <a href="{{ route('customer.bookings.create', $paketWisata->id) }}" class="w-full bg-blue-700 hover:bg-blue-800 text-white font-bold py-3.5 rounded-xl transition-colors flex justify-center items-center gap-2 shadow-md text-sm">
                                    <i class="fas fa-calendar-plus"></i> Booking Sekarang
                                </a>
                            @else
                                <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-3 text-xs text-yellow-800 text-center font-bold">
                                    <i class="fas fa-exclamation-triangle"></i> Login sebagai Admin.
                                </div>
                            @endif
                        @else
                            <a href="{{ route('login') }}?redirect={{ route('customer.bookings.create', $paketWisata->id) }}" class="w-full bg-blue-700 hover:bg-blue-800 text-white font-bold py-3.5 rounded-xl transition-colors flex justify-center items-center gap-2 shadow-md text-sm">
                                <i class="fas fa-sign-in-alt"></i> Login untuk Booking
                            </a>
                            <a href="{{ route('register') }}" class="w-full mt-3 border border-blue-200 hover:bg-blue-50 text-blue-700 font-bold py-3 rounded-xl transition-colors flex justify-center items-center gap-2 text-sm">
                                Daftar Gratis
                            </a>
                        @endauth
                    </div>
                    <p class="text-[9px] text-center text-slate-400 mt-3"><i class="fas fa-info-circle"></i> Konfirmasi instan & Pembatalan gratis s/d 24 jam</p>
                </div>
            </aside>
        </div>
    </div>
</div>
@endsection