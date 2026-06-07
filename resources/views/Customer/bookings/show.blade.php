@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8 font-['Plus_Jakarta_Sans']">
    
    <div class="mb-6 flex items-center gap-2 text-sm text-slate-500">
        <a href="{{ route('customer.dashboard') }}" class="hover:text-blue-600">Beranda</a> <i class="fas fa-chevron-right text-xs"></i>
        <a href="{{ route('customer.bookings.index') }}" class="hover:text-blue-600">Pesanan Saya</a> <i class="fas fa-chevron-right text-xs"></i>
        <span class="text-slate-800 font-semibold">Detail Pesanan #{{ $booking->kode_booking }}</span>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- Kiri: Detail Utama --}}
        <div class="lg:col-span-2 space-y-6">
            
            {{-- Header Paket --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <h1 class="text-2xl font-bold text-slate-900">{{ optional($booking->paketWisata)->nama_paket ?? 'Paket Terhapus' }}</h1>
                        <p class="text-sm text-slate-500 mt-1">ID Pesanan: <b>{{ $booking->kode_booking }}</b> &bull; Dipesan pada {{ $booking->created_at->format('d M Y, H:i') }} WIB</p>
                    </div>
                    @php
                        $badgeColor = match($booking->status) {
                            'Pending' => 'bg-yellow-100 text-yellow-700',
                            'Dikonfirmasi' => 'bg-green-100 text-green-700',
                            'Berlangsung' => 'bg-blue-100 text-blue-700',
                            'Selesai' => 'bg-slate-100 text-slate-700',
                            'Ditolak' => 'bg-red-100 text-red-700',
                            default => 'bg-slate-100 text-slate-700'
                        };
                    @endphp
                    <span class="px-3 py-1 rounded-full text-xs font-bold uppercase {{ $badgeColor }}">{{ $booking->status }}</span>
                </div>
                
                <img src="{{ optional($booking->paketWisata)->foto_url ?? asset('images/default-destination.jpg') }}" class="w-full h-64 object-cover rounded-xl mb-6 shadow-sm">
                
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                    <div class="bg-slate-50 p-3 rounded-lg border border-slate-100">
                        <p class="text-xs text-slate-500 mb-1">Durasi</p>
                        <p class="font-bold text-slate-900 text-sm">{{ optional($booking->paketWisata)->durasi_hari ?? '-' }} Hari</p>
                    </div>
                    <div class="bg-slate-50 p-3 rounded-lg border border-slate-100">
                        <p class="text-xs text-slate-500 mb-1">Keberangkatan</p>
                        <p class="font-bold text-slate-900 text-sm">{{ $booking->tanggal_berangkat->format('d M Y') }}</p>
                    </div>
                    <div class="bg-slate-50 p-3 rounded-lg border border-slate-100">
                        <p class="text-xs text-slate-500 mb-1">Peserta</p>
                        <p class="font-bold text-slate-900 text-sm">{{ $booking->jumlah_peserta }} Orang</p>
                    </div>
                    <div class="bg-slate-50 p-3 rounded-lg border border-slate-100">
                        <p class="text-xs text-slate-500 mb-1">Lokasi</p>
                        <p class="font-bold text-slate-900 text-sm">{{ optional($booking->paketWisata)->destinasi ?? '-' }}</p>
                    </div>
                </div>
            </div>

            {{-- Status & Instruksi Pembayaran --}}
            @if($booking->status === 'Pending')
            <div class="bg-yellow-50 border border-yellow-200 rounded-2xl p-6">
                <div class="flex gap-3 items-center mb-4 text-yellow-800">
                    <i class="fas fa-clock text-2xl"></i>
                    <h3 class="text-lg font-bold">Menunggu Verifikasi Pembayaran DP (50%)</h3>
                </div>
                <p class="text-xs text-yellow-800 mb-4">Bukti transfer DP Anda sudah kami terima dan saat ini sedang dalam proses verifikasi manual oleh admin. Kami akan segera memperbarui status booking Anda dalam waktu 1x24 jam.</p>
                <div class="border border-yellow-200 rounded-lg p-3 bg-white text-xs text-slate-600">
                    <p class="font-bold mb-1"><i class="fas fa-file-invoice mr-1 text-slate-500"></i> Bukti Transfer Terupload:</p>
                    <a href="{{ $booking->bukti_transfer_url }}" target="_blank" class="text-blue-600 hover:underline flex items-center gap-1.5 font-medium mt-1">
                        <i class="fas fa-image"></i> Lihat Bukti Transfer DP (Buka di Tab Baru)
                    </a>
                </div>
            </div>
            @elseif($booking->status === 'Dikonfirmasi' || $booking->status === 'Berlangsung')
            <div class="bg-green-50 border border-green-200 rounded-2xl p-6">
                <div class="flex gap-3 items-center mb-4 text-green-800">
                    <i class="fas fa-check-circle text-2xl"></i>
                    <h3 class="text-lg font-bold">Pembayaran DP Terverifikasi & Booking Dikonfirmasi!</h3>
                </div>
                <p class="text-xs text-green-800 mb-6">Uang muka sebesar 50% telah kami terima. Harap siapkan sisa pelunasan cash saat bertemu di meeting point.</p>
                
                <div class="grid sm:grid-cols-2 gap-4">
                    <div class="flex gap-3">
                        <i class="fas fa-map-marker-alt text-green-700 mt-1"></i>
                        <div>
                            <p class="text-xs font-bold text-green-900">Titik Pertemuan</p>
                            <p class="text-xs text-green-800 mt-1">Lobi Kedatangan Domestik, Bandara / Meeting Point Utama Paket.</p>
                        </div>
                    </div>
                    <div class="flex gap-3">
                        <i class="fas fa-money-bill-wave text-green-700 mt-1"></i>
                        <div>
                            <p class="text-xs font-bold text-green-900">Sisa Pelunasan Cash</p>
                            <p class="text-sm font-bold text-green-900 mt-1">{{ $booking->sisa_pelunasan_format }}</p>
                        </div>
                    </div>
                </div>
            </div>
            @elseif($booking->status === 'Selesai')
            <div class="bg-blue-50 border border-blue-200 rounded-2xl p-6">
                <div class="flex gap-3 items-center mb-4 text-blue-800">
                    <i class="fas fa-handshake text-2xl"></i>
                    <h3 class="text-lg font-bold">Perjalanan Selesai & Lunas</h3>
                </div>
                <p class="text-xs text-blue-800">Terima kasih telah menggunakan jasa Travellio! Seluruh pembayaran (DP 50% & Pelunasan Cash 50%) telah kami terima dan perjalanan Anda telah ditandai Selesai.</p>
            </div>
            @elseif($booking->status === 'Ditolak')
            <div class="bg-red-50 border border-red-200 rounded-2xl p-6">
                <div class="flex gap-3 items-center mb-3 text-red-800">
                    <i class="fas fa-times-circle text-2xl"></i>
                    <h3 class="text-lg font-bold">Booking Ditolak / Dibatalkan</h3>
                </div>
                <p class="text-xs text-red-800 mb-1">Pemesanan ini tidak dapat dilanjutkan.</p>
                @if($booking->alasan_tolak)
                <div class="bg-white p-3 rounded-lg border border-red-100 text-xs text-slate-700 mt-2">
                    <p class="font-bold text-red-900">Alasan Penolakan:</p>
                    <p class="mt-0.5">{{ $booking->alasan_tolak }}</p>
                </div>
                @endif
            </div>
            @endif
        </div>

        {{-- Kanan: Ringkasan --}}
        <div class="space-y-6">
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
                <h3 class="text-lg font-bold text-slate-900 mb-4">Ringkasan Pembayaran</h3>
                <div class="space-y-3 text-sm text-slate-600 border-b border-slate-100 pb-4 mb-4">
                    <div class="flex justify-between"><span>Total Biaya Paket (x{{ $booking->jumlah_peserta }})</span><span>{{ $booking->total_harga_format }}</span></div>
                    <div class="flex justify-between text-green-600"><span>DP 50% (Sudah Dibayar)</span><span>- {{ $booking->nominal_dp_format }}</span></div>
                    <div class="flex justify-between font-bold text-slate-900 pt-1 border-t border-slate-100">
                        <span>Sisa Tagihan Cash</span>
                        <span class="text-blue-600 text-lg">{{ $booking->sisa_pelunasan_format }}</span>
                    </div>
                </div>
                
                @if(in_array($booking->status, ['Dikonfirmasi', 'Selesai']))
                    <button onclick="window.print()" class="w-full bg-blue-700 hover:bg-blue-800 text-white font-bold py-3 rounded-lg transition-colors mb-3 flex items-center justify-center gap-2"><i class="fas fa-print"></i> Cetak Bukti Booking</button>
                @endif
                
                <a href="https://wa.me/6281234567890?text=Halo%20Travellio,%20saya%20ingin%20bertanya%20tentang%20booking%20{{ $booking->kode_booking }}" target="_blank" class="w-full bg-white border border-slate-200 text-slate-700 font-bold py-3 rounded-lg hover:bg-slate-50 transition-colors flex items-center justify-center gap-2 mb-3">
                    <i class="fab fa-whatsapp text-green-500 text-lg"></i> Hubungi Customer Service
                </a>

                @if($booking->canBeCancelled())
                <form action="{{ route('customer.bookings.cancel', $booking->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan pesanan ini?')" class="mt-4">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="w-full bg-red-50 hover:bg-red-100 text-red-600 font-bold py-2.5 rounded-lg transition-colors text-xs flex items-center justify-center gap-1.5 border border-red-100">
                        <i class="far fa-trash-alt"></i> Batalkan Pemesanan
                    </button>
                </form>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection