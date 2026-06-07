@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 font-['Plus_Jakarta_Sans']">
    {{-- Header --}}
    <div class="flex justify-between items-end mb-8">
        <div>
            <h1 class="text-3xl font-bold text-slate-900 flex items-center gap-2">Welcome back, {{ auth()->user()->name ?? 'Admin' }} 👋</h1>
            <p class="text-slate-500 mt-1 text-sm">Here's what's happening with VoyageEase today.</p>
        </div>
        <div class="text-sm text-slate-500">
            <span>Admin</span> <i class="fas fa-chevron-right text-xs mx-2"></i> <span class="font-bold text-slate-800">Dashboard</span>
        </div>
    </div>

    {{-- Stats Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        
        {{-- Card 1: Total Booking --}}
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 relative overflow-hidden">
            <i class="far fa-calendar-alt text-slate-50 text-6xl absolute -right-2 -top-2 z-0"></i>
            <div class="relative z-10">
                <p class="text-xs font-bold text-slate-500 uppercase flex items-center gap-2 mb-3"><i class="far fa-calendar-alt text-blue-600"></i> TOTAL BOOKING</p>
                <h3 class="text-4xl font-extrabold text-slate-900 mb-2">{{ number_format($totalBookings) }}</h3>
                <a href="{{ route('admin.bookings.index') }}" class="text-xs font-bold text-blue-600 hover:underline">Kelola pesanan &rarr;</a>
            </div>
        </div>
        
        {{-- Card 2: Paket Aktif --}}
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 relative overflow-hidden">
            <i class="far fa-flag text-slate-50 text-6xl absolute -right-2 -top-2 z-0"></i>
            <div class="relative z-10">
                <p class="text-xs font-bold text-slate-500 uppercase flex items-center gap-2 mb-3"><i class="far fa-flag text-blue-600"></i> PAKET AKTIF</p>
                <h3 class="text-4xl font-extrabold text-slate-900 mb-2">{{ number_format($activePackages) }}</h3>
                <a href="{{ route('admin.pakets.index') }}" class="text-xs font-bold text-blue-600 hover:underline">Kelola paket &rarr;</a>
            </div>
        </div>

        {{-- Card 3: Total Pendapatan --}}
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 relative overflow-hidden">
            <i class="fas fa-wallet text-slate-50 text-6xl absolute -right-2 -top-2 z-0"></i>
            <div class="relative z-10">
                <p class="text-xs font-bold text-slate-500 uppercase flex items-center gap-2 mb-3"><i class="fas fa-wallet text-blue-600"></i> TOTAL PENDAPATAN</p>
                <h3 class="text-3xl font-extrabold text-slate-900 mb-2">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h3>
                <p class="text-xs font-medium text-slate-400">Dari pesanan Selesai</p>
            </div>
        </div>

        {{-- Card 4: Pending Review --}}
        <div class="bg-red-50 p-6 rounded-2xl shadow-sm border border-red-100 relative overflow-hidden">
            <i class="fas fa-clipboard-check text-red-100 text-6xl absolute -right-2 -top-2 z-0 opacity-50"></i>
            <div class="relative z-10">
                <p class="text-xs font-bold text-red-500 uppercase flex items-center gap-2 mb-3"><i class="fas fa-clipboard-check"></i> PENDING REVIEW</p>
                <h3 class="text-4xl font-extrabold text-red-600 mb-2">{{ number_format($pendingBookings) }}</h3>
                <a href="{{ route('admin.bookings.index', ['status' => 'Pending']) }}" class="text-xs font-bold text-red-600 hover:underline inline-block">Lihat detail &rarr;</a>
            </div>
        </div>
    </div>

    {{-- Charts & Recent Bookings --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex flex-col justify-between">
            <div class="flex justify-between items-center mb-6">
                <h3 class="font-bold text-slate-900">Ilustrasi Aktivitas Sistem</h3>
                <button class="text-slate-400 hover:text-slate-600"><i class="fas fa-ellipsis-h"></i></button>
            </div>
            {{-- Dummy Bar Chart --}}
            <div class="flex items-end justify-between h-48 gap-2 bg-slate-50 p-4 rounded-xl border border-slate-100">
                <div class="w-full bg-blue-300 rounded-t-md h-[30%] hover:bg-blue-600 transition-colors" title="Statistik Dinamis dalam Pengembangan"></div>
                <div class="w-full bg-blue-400 rounded-t-md h-[50%] hover:bg-blue-600 transition-colors" title="Statistik Dinamis dalam Pengembangan"></div>
                <div class="w-full bg-blue-500 rounded-t-md h-[70%] hover:bg-blue-600 transition-colors" title="Statistik Dinamis dalam Pengembangan"></div>
                <div class="w-full bg-blue-700 rounded-t-md h-[100%] hover:bg-blue-800 transition-colors" title="Statistik Dinamis dalam Pengembangan"></div>
                <div class="w-full bg-blue-300 rounded-t-md h-[40%] hover:bg-blue-600 transition-colors" title="Statistik Dinamis dalam Pengembangan"></div>
                <div class="w-full bg-blue-200 rounded-t-md h-[20%] hover:bg-blue-600 transition-colors" title="Statistik Dinamis dalam Pengembangan"></div>
                <div class="w-full bg-blue-200 rounded-t-md h-[25%] hover:bg-blue-600 transition-colors" title="Statistik Dinamis dalam Pengembangan"></div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
            <div class="flex justify-between items-center mb-6">
                <h3 class="font-bold text-slate-900">Booking Terbaru</h3>
                <a href="{{ route('admin.bookings.index') }}" class="text-xs font-bold text-blue-600 hover:underline">Lihat Semua</a>
            </div>
            <div class="space-y-4">
                @forelse($latestBookings as $booking)
                <div class="flex items-center justify-between p-3 border border-slate-100 rounded-xl hover:bg-slate-50 transition-colors">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-slate-200 text-slate-500 rounded-full flex items-center justify-center font-bold uppercase">
                            {{ substr($booking->user->name ?? '?', 0, 1) }}
                        </div>
                        <div>
                            <p class="text-sm font-bold text-slate-900 truncate w-32" title="{{ $booking->user->name ?? 'User Terhapus' }}">{{ $booking->user->name ?? 'User Terhapus' }}</p>
                            <p class="text-xs text-slate-500 truncate w-32" title="{{ $booking->paketWisata->nama_paket ?? 'Paket Terhapus' }}">{{ $booking->paketWisata->nama_paket ?? 'Paket Terhapus' }} - {{ $booking->jumlah_peserta }} Pax</p>
                        </div>
                    </div>
                    <div class="text-right">
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
                        <span class="px-2 py-1 {{ $badgeClass }} rounded text-[10px] font-bold uppercase">{{ $booking->status }}</span>
                        <p class="text-[10px] text-slate-400 mt-1">{{ $booking->created_at->diffForHumans() }}</p>
                    </div>
                </div>
                @empty
                <div class="p-4 text-center text-sm text-slate-500 border border-slate-100 rounded-xl">
                    Belum ada booking masuk.
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection