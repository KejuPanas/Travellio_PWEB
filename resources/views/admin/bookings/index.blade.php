@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 font-['Plus_Jakarta_Sans']">
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        {{-- Header & Search --}}
        <div class="p-6 border-b border-slate-100 flex flex-col md:flex-row justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold text-slate-900">Kelola Booking</h1>
                <p class="text-slate-500 mt-1 text-sm">Pantau dan kelola semua reservasi pelanggan Anda.</p>
            </div>
            <form action="{{ route('admin.bookings.index') }}" method="GET" class="relative w-full md:w-80">
                <input type="hidden" name="status" value="{{ $status }}">
                <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-slate-400"></i>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari Kode atau Nama Pelanggan..." class="w-full pl-9 pr-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-blue-600 outline-none shadow-sm">
            </form>
        </div>

        {{-- Tabs --}}
        <div class="px-6 flex gap-6 border-b border-slate-100 text-sm font-bold text-slate-500 overflow-x-auto">
            @php
                $tabs = ['Semua', 'Pending', 'Dikonfirmasi', 'Berlangsung', 'Selesai', 'Ditolak'];
            @endphp
            @foreach($tabs as $t)
                <a href="{{ route('admin.bookings.index', ['status' => $t, 'search' => request('search')]) }}" 
                   class="py-4 {{ $status === $t ? 'border-b-2 border-blue-600 text-blue-700' : 'hover:text-slate-800' }} whitespace-nowrap transition-colors">
                   {{ $t }}
                </a>
            @endforeach
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-slate-50 border-b border-slate-100 text-xs font-bold text-slate-500">
                    <tr>
                        <th class="p-4 px-6">ID Pesanan</th>
                        <th class="p-4">Nama Pelanggan</th>
                        <th class="p-4">Paket</th>
                        <th class="p-4">Tanggal Trip</th>
                        <th class="p-4">Status</th>
                        <th class="p-4 px-6 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($bookings as $booking)
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="p-4 px-6 font-bold text-slate-900">#{{ $booking->kode_booking }}</td>
                        <td class="p-4 flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-blue-600 text-white flex justify-center items-center font-bold text-xs uppercase">{{ substr($booking->user->name ?? '?', 0, 1) }}</div>
                            <span class="font-medium text-slate-700">{{ $booking->user->name ?? 'User Terhapus' }}</span>
                        </td>
                        <td class="p-4 text-slate-600">{{ $booking->paketWisata->nama_paket ?? 'Paket Terhapus' }}</td>
                        <td class="p-4 text-slate-600">{{ $booking->tanggal_berangkat->format('d M Y') }}</td>
                        <td class="p-4">
                            @php
                                $badgeClass = match($booking->status) {
                                    'Pending' => 'bg-yellow-100 text-yellow-700',
                                    'Dikonfirmasi' => 'bg-green-100 text-green-700',
                                    'Berlangsung' => 'bg-blue-100 text-blue-700',
                                    'Selesai' => 'bg-slate-100 text-slate-700',
                                    'Ditolak' => 'bg-red-100 text-red-700',
                                    default => 'bg-slate-100 text-slate-700'
                                };
                            @endphp
                            <span class="px-3 py-1 rounded-full text-[10px] font-extrabold tracking-wider uppercase {{ $badgeClass }}">
                                {{ $booking->status }}
                            </span>
                        </td>
                        <td class="p-4 px-6 text-right">
                            <a href="{{ route('admin.bookings.show', $booking->id) }}" class="border border-slate-200 text-blue-600 hover:bg-blue-50 px-4 py-1.5 rounded-lg text-xs font-bold transition-colors inline-block">Lihat Detail</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="p-8 text-center text-slate-500">
                            Tidak ada booking yang ditemukan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        {{-- Pagination --}}
        @if($bookings->hasPages())
        <div class="p-4 border-t border-slate-100">
            {{ $bookings->links() }}
        </div>
        @endif
    </div>
</div>
@endsection