@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 font-['Plus_Jakarta_Sans']">
    {{-- Breadcrumb & Header --}}
    <div class="text-sm text-slate-500 mb-4">
        <a href="{{ route('admin.bookings.index') }}" class="hover:text-blue-600">Kelola Booking</a> <i class="fas fa-chevron-right text-xs mx-1"></i> <span class="font-bold text-slate-800">Detail Booking {{ $booking->kode_booking }}</span>
    </div>

    <div class="flex flex-col md:flex-row justify-between md:items-center gap-4 mb-8">
        <div class="flex items-center gap-3">
            <div class="w-12 h-12 bg-blue-100 text-blue-700 rounded-xl flex items-center justify-center text-xl"><i class="fas fa-receipt"></i></div>
            <div>
                <h1 class="text-3xl font-bold text-slate-900">Detail Booking</h1>
                <p class="text-slate-500 text-sm mt-0.5">ID Pesanan: <span class="font-bold bg-slate-100 px-2 py-0.5 rounded text-slate-700">{{ $booking->kode_booking }}</span></p>
            </div>
        </div>
        
        @php
            $badgeColor = match($booking->status) {
                'Pending' => 'bg-yellow-50 border-yellow-200 text-yellow-700',
                'Dikonfirmasi' => 'bg-green-50 border-green-200 text-green-700',
                'Berlangsung' => 'bg-blue-50 border-blue-200 text-blue-700',
                'Selesai' => 'bg-slate-50 border-slate-200 text-slate-700',
                'Ditolak' => 'bg-red-50 border-red-200 text-red-700',
                default => 'bg-slate-50 border-slate-200 text-slate-700'
            };
        @endphp
        <span class="px-4 py-2 border rounded-full text-xs font-extrabold tracking-wider flex items-center gap-2 w-max uppercase {{ $badgeColor }}">
            <i class="fas fa-circle text-[8px]"></i> {{ $booking->status }}
        </span>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Kiri: Detail Pelanggan & Paket --}}
        <div class="lg:col-span-2 space-y-6">
            
            {{-- Info Pelanggan --}}
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
                <h3 class="text-lg font-bold text-slate-800 mb-4 flex items-center gap-2"><i class="far fa-user text-blue-600"></i> Informasi Pelanggan</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-4 gap-x-8 text-sm">
                    <div>
                        <p class="text-xs text-slate-500 font-bold mb-1">Nama Lengkap</p>
                        <p class="text-slate-900">{{ $booking->user->name ?? 'User Terhapus' }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-slate-500 font-bold mb-1">Email</p>
                        <p class="text-slate-900">{{ $booking->user->email ?? '-' }}</p>
                    </div>
                    <div class="sm:col-span-2">
                        <p class="text-xs text-slate-500 font-bold mb-1">Catatan Tambahan</p>
                        <p class="text-slate-900">{{ $booking->catatan ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-slate-500 font-bold mb-1">Tanggal Pesan</p>
                        <p class="text-slate-900">{{ $booking->created_at->format('d M Y, H:i') }} WIB</p>
                    </div>
                </div>
            </div>

            {{-- Rincian Paket --}}
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
                <h3 class="text-lg font-bold text-slate-800 mb-4 flex items-center gap-2"><i class="far fa-flag text-blue-600"></i> Rincian Paket</h3>
                <div class="flex flex-col sm:flex-row gap-6">
                    <img src="{{ optional($booking->paketWisata)->foto_url ?? asset('images/default-destination.jpg') }}" class="w-full sm:w-48 h-48 object-cover rounded-xl shadow-sm">
                    <div class="flex-1 flex flex-col justify-between">
                        <div>
                            <h2 class="text-xl font-bold text-slate-900">{{ $booking->paketWisata->nama_paket ?? 'Paket Terhapus' }}</h2>
                            <p class="text-sm text-slate-500 mt-1 flex items-center gap-2"><i class="far fa-calendar-alt"></i> {{ $booking->tanggal_berangkat->format('d M Y') }} ({{ $booking->paketWisata->durasi_hari ?? '-' }} Hari)</p>
                        </div>
                        
                        <div class="bg-slate-50 rounded-xl p-4 mt-4 border border-slate-100">
                            <div class="flex justify-between text-sm mb-2">
                                <span class="text-slate-500">Jumlah Peserta</span>
                                <span class="font-bold text-slate-900">{{ $booking->jumlah_peserta }} Orang</span>
                            </div>
                            <div class="flex justify-between text-sm pb-3 border-b border-slate-200">
                                <span class="text-slate-500">Harga per Orang</span>
                                <span class="text-slate-900">{{ optional($booking->paketWisata)->harga_format ?? '-' }}</span>
                            </div>
                            <div class="flex justify-between items-end mt-3">
                                <span class="font-bold text-slate-900">Total Harga</span>
                                <span class="text-2xl font-extrabold text-blue-700">{{ $booking->total_harga_format }}</span>
                            </div>
                            <div class="flex justify-between text-sm mt-3 pt-3 border-t border-slate-100 text-green-600">
                                <span>DP 50% (Transfer)</span>
                                <span class="font-bold">{{ $booking->nominal_dp_format }}</span>
                            </div>
                            <div class="flex justify-between items-end mt-2 pt-2 border-t border-dashed border-slate-100">
                                <span class="font-bold text-slate-900">Sisa Tagihan Cash</span>
                                <span class="text-xl font-extrabold text-blue-600">{{ $booking->sisa_pelunasan_format }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Alert Cash --}}
                <div class="mt-4 bg-blue-50 border border-blue-200 rounded-xl p-4 flex gap-3 text-sm text-blue-800">
                    <i class="fas fa-info-circle mt-0.5 text-blue-600"></i>
                    <p>Metode Pembayaran: <b>Transfer DP 50% + Pelunasan Cash 50%</b>. Pastikan uang masuk ke mutasi bank sebelum melakukan konfirmasi booking.</p>
                </div>

                {{-- Bukti Transfer DP --}}
                @if($booking->bukti_transfer)
                <div class="mt-6 border-t border-slate-100 pt-6">
                    <h4 class="font-bold text-slate-800 mb-3"><i class="fas fa-file-image text-blue-600"></i> Bukti Transfer Uang Muka (DP 50%)</h4>
                    <div class="bg-slate-50 p-4 rounded-xl border border-slate-100">
                        <a href="{{ $booking->bukti_transfer_url }}" target="_blank" class="block mb-3 text-blue-600 hover:underline text-xs font-semibold">
                            <i class="fas fa-search-plus"></i> Lihat Ukuran Penuh (Buka di Tab Baru)
                        </a>
                        <img src="{{ $booking->bukti_transfer_url }}" class="max-w-md w-full h-auto rounded-lg shadow-sm border border-slate-200 object-contain max-h-96">
                    </div>
                </div>
                @endif
            </div>
        </div>

        {{-- Kanan: Action Admin --}}
        <div class="space-y-6">
            @if($booking->status === 'Pending')
            <div class="bg-blue-50/50 p-6 rounded-2xl shadow-sm border border-blue-100">
                <h3 class="text-lg font-bold text-blue-900 mb-2 flex items-center gap-2"><i class="fas fa-gavel"></i> Tindakan Admin</h3>
                <p class="text-xs text-blue-700 mb-4 leading-relaxed">Harap tinjau detail pesanan dan lakukan konfirmasi ketersediaan paket.</p>
                
                {{-- Form Konfirmasi --}}
                <form action="{{ route('admin.bookings.konfirmasi', $booking->id) }}" method="POST" class="mb-6">
                    @csrf @method('PATCH')
                    <button type="submit" class="w-full bg-blue-700 hover:bg-blue-800 text-white font-bold py-3 rounded-xl transition-colors flex justify-center items-center gap-2 shadow-md">
                        <i class="fas fa-check-circle"></i> Konfirmasi Pesanan
                    </button>
                </form>

                <hr class="border-blue-200 mb-6">

                {{-- Form Tolak --}}
                <form action="{{ route('admin.bookings.tolak', $booking->id) }}" method="POST">
                    @csrf @method('PATCH')
                    <label class="block text-xs font-bold text-slate-600 mb-1.5">Alasan Penolakan (Wajib jika menolak)</label>
                    <textarea name="alasan_tolak" required rows="2" placeholder="Tulis alasan jika menolak..." class="w-full p-3 border border-slate-300 rounded-xl text-sm outline-none focus:ring-2 focus:ring-red-500 mb-3"></textarea>
                    <button type="submit" class="w-full bg-white border border-red-500 hover:bg-red-50 text-red-600 font-bold py-2.5 rounded-xl transition-colors flex justify-center items-center gap-2">
                        <i class="far fa-times-circle"></i> Tolak Pesanan
                    </button>
                </form>
            </div>
            @endif

            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
                <h3 class="font-bold text-slate-800 mb-1">Update Status Perjalanan</h3>
                <p class="text-xs text-slate-400 mb-4">Ubah status setelah dikonfirmasi & dibayar.</p>
                
                @if(in_array($booking->status, ['Dikonfirmasi', 'Berlangsung', 'Selesai']))
                <form action="{{ route('admin.bookings.updateStatus', $booking->id) }}" method="POST" class="flex flex-col gap-3">
                    @csrf @method('PATCH')
                    <select name="status" class="w-full p-3 border border-slate-200 rounded-xl text-sm bg-white outline-none focus:ring-2 focus:ring-blue-600">
                        <option value="Dikonfirmasi" {{ $booking->status == 'Dikonfirmasi' ? 'selected' : '' }}>Dikonfirmasi</option>
                        <option value="Berlangsung" {{ $booking->status == 'Berlangsung' ? 'selected' : '' }}>Berlangsung</option>
                        <option value="Selesai" {{ $booking->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                    <button type="submit" class="w-full bg-slate-800 hover:bg-slate-900 text-white font-bold py-2.5 rounded-xl transition-colors flex justify-center items-center text-sm">
                        Simpan Perubahan
                    </button>
                </form>
                @else
                <select class="w-full p-3 border border-slate-200 rounded-xl text-sm bg-slate-50 text-slate-400 outline-none" disabled>
                    <option>{{ $booking->status }}</option>
                </select>
                @endif
                
                @if($booking->status === 'Ditolak' && $booking->alasan_tolak)
                <div class="mt-4 p-4 bg-red-50 rounded-xl border border-red-100 text-sm">
                    <p class="font-bold text-red-800 mb-1">Alasan Ditolak:</p>
                    <p class="text-red-700">{{ $booking->alasan_tolak }}</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection