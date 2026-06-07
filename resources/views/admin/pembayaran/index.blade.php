@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 font-['Plus_Jakarta_Sans']">
    {{-- Header --}}
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-slate-900">Rekap Pembayaran Tunai</h1>
        <p class="text-slate-500 mt-1 text-sm">Daftar booking terkonfirmasi yang menunggu pembayaran tunai di meeting point.</p>
    </div>

    {{-- Stats Banner --}}
    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6 mb-8">
        <div class="md:col-span-2 bg-blue-600 rounded-2xl p-6 text-white shadow-md relative overflow-hidden flex justify-between items-center" style="background-image: linear-gradient(135deg, #2563eb, #1d4ed8);">
            <div>
                <p class="text-xs font-bold text-blue-200 uppercase tracking-wider mb-1">TOTAL TAGIHAN TUNAI AKTIF</p>
                <h2 class="text-4xl font-extrabold mb-1">Rp {{ number_format($totalTagihan, 0, ',', '.') }}</h2>
                <p class="text-sm text-blue-100"><i class="fas fa-arrow-trend-up"></i> Dari {{ $totalRombongan }} booking terkonfirmasi</p>
            </div>
            <div class="w-16 h-16 bg-blue-500/50 rounded-2xl flex items-center justify-center text-3xl backdrop-blur-sm relative z-10">
                <i class="fas fa-wallet"></i>
            </div>
        </div>
        
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex flex-col justify-center">
            <div class="w-10 h-10 bg-green-100 text-green-600 rounded-full flex items-center justify-center mb-3"><i class="fas fa-user-check"></i></div>
            <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">SIAP DITAGIH</p>
            <h3 class="text-2xl font-bold text-slate-900">{{ $totalRombongan }} Rombongan</h3>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex flex-col justify-center">
            <div class="w-10 h-10 bg-amber-100 text-amber-600 rounded-full flex items-center justify-center mb-3"><i class="fas fa-map-marker-alt"></i></div>
            <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">MEETING POINTS</p>
            <h3 class="text-2xl font-bold text-slate-900">{{ $activeDestinations }} Lokasi Aktif</h3>
        </div>
    </div>

    {{-- Table Tagihan --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="p-6 border-b border-slate-100 flex flex-col sm:flex-row justify-between items-center gap-4">
            <h3 class="text-lg font-bold text-slate-900">Daftar Tagihan Tunai</h3>
            <form action="{{ route('admin.pembayaran.index') }}" method="GET" class="flex gap-2 w-full sm:w-auto">
                <div class="relative w-full sm:w-64">
                    <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-slate-400"></i>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari ID atau Nama..." class="w-full pl-9 pr-4 py-2 border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-blue-600 outline-none">
                </div>
                <button type="submit" class="px-4 py-2 bg-blue-700 hover:bg-blue-800 text-white rounded-lg text-sm font-bold transition-colors">Cari</button>
                @if(request('search'))
                    <a href="{{ route('admin.pembayaran.index') }}" class="px-3 py-2 border border-slate-200 rounded-lg text-slate-500 hover:bg-slate-50 flex items-center justify-center"><i class="fas fa-times"></i></a>
                @endif
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-slate-50 border-b border-slate-100 text-xs font-bold text-slate-500 uppercase tracking-wider">
                    <tr>
                        <th class="p-4 px-6">ID Booking</th>
                        <th class="p-4">Pelanggan</th>
                        <th class="p-4">Paket & Lokasi Meeting</th>
                        <th class="p-4">Sisa Tagihan Cash</th>
                        <th class="p-4 px-6 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($bookings as $booking)
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="p-4 px-6">
                            <a href="{{ route('admin.bookings.show', $booking->id) }}" class="font-bold text-blue-600 hover:underline">#{{ $booking->kode_booking }}</a>
                            <p class="text-[10px] font-extrabold text-green-600 mt-1 tracking-wider uppercase"><i class="fas fa-circle text-[8px]"></i> {{ $booking->status }}</p>
                        </td>
                        <td class="p-4">
                            <p class="font-bold text-slate-900">{{ optional($booking->user)->name ?? 'User Terhapus' }}</p>
                            <p class="text-xs text-slate-500">{{ optional($booking->user)->phone ?? '-' }}</p>
                            <p class="text-xs text-slate-500">{{ $booking->jumlah_peserta }} Orang</p>
                        </td>
                        <td class="p-4">
                            <p class="font-bold text-slate-900">{{ optional($booking->paketWisata)->nama_paket ?? 'Paket Terhapus' }}</p>
                            <p class="text-xs text-slate-500 mt-0.5"><i class="fas fa-map-marker-alt"></i> {{ optional($booking->paketWisata)->destinasi ?? '-' }}</p>
                        </td>
                        <td class="p-4">
                            <p class="font-bold text-slate-900 text-base">{{ $booking->sisa_pelunasan_format }}</p>
                            <p class="text-xs text-slate-400 mt-0.5">DP {{ $booking->nominal_dp_format }} Lunas</p>
                        </td>
                        <td class="p-4 px-6 text-right">
                            <form action="{{ route('admin.pembayaran.tandai', $booking->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin menandai sisa pelunasan cash sebesar {{ $booking->sisa_pelunasan_format }} sudah diterima?')">
                                @csrf @method('PATCH')
                                <button type="submit" class="bg-green-700 hover:bg-green-800 text-white px-4 py-2 rounded-lg text-xs font-bold shadow-sm transition-colors flex items-center gap-2 justify-end ml-auto">
                                    <i class="fas fa-check-circle"></i> Tandai Sudah Bayar
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="py-12 text-center text-slate-400">
                            <i class="fas fa-money-check text-4xl mb-3 text-slate-300"></i>
                            <p>Tidak ada tagihan pelunasan cash aktif.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        {{-- Pagination --}}
        <div class="p-4 border-t border-slate-100 bg-slate-50/50">
            {{ $bookings->links() }}
        </div>
    </div>
</div>
@endsection