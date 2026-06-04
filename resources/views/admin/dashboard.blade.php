@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 font-['Plus_Jakarta_Sans']">
    {{-- Header --}}
    <div class="flex justify-between items-end mb-8">
        <div>
            <h1 class="text-3xl font-bold text-slate-900 flex items-center gap-2">Welcome back, Admin 👋</h1>
            <p class="text-slate-500 mt-1 text-sm">Here's what's happening with VoyageEase today.</p>
        </div>
        <div class="text-sm text-slate-500">
            <span>Admin</span> <i class="fas fa-chevron-right text-xs mx-2"></i> <span class="font-bold text-slate-800">Dashboard</span>
        </div>
    </div>

    {{-- Stats Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        
        {{-- Card 1 --}}
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 relative overflow-hidden">
            {{-- Ikon Background (Watermark) --}}
            <i class="far fa-calendar-alt text-slate-50 text-6xl absolute -right-2 -top-2 z-0"></i>
            
            {{-- Konten Utama (z-10 agar selalu di atas ikon) --}}
            <div class="relative z-10">
                <p class="text-xs font-bold text-slate-500 uppercase flex items-center gap-2 mb-3"><i class="far fa-calendar-alt text-blue-600"></i> BOOKING HARI INI</p>
                <h3 class="text-4xl font-extrabold text-slate-900 mb-2">12</h3>
                <p class="text-xs font-bold text-green-500"><i class="fas fa-arrow-up"></i> +2 dari kemarin</p>
            </div>
        </div>
        
        {{-- Card 2 --}}
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 relative overflow-hidden">
            <i class="far fa-calendar-check text-slate-50 text-6xl absolute -right-2 -top-2 z-0"></i>
            <div class="relative z-10">
                <p class="text-xs font-bold text-slate-500 uppercase flex items-center gap-2 mb-3"><i class="far fa-calendar-check text-blue-600"></i> BOOKING BULAN INI</p>
                <h3 class="text-4xl font-extrabold text-slate-900 mb-2">148</h3>
                <p class="text-xs font-bold text-green-500"><i class="fas fa-arrow-up"></i> +15% vs bulan lalu</p>
            </div>
        </div>

        {{-- Card 3 --}}
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 relative overflow-hidden">
            <i class="fas fa-wallet text-slate-50 text-6xl absolute -right-2 -top-2 z-0"></i>
            <div class="relative z-10">
                <p class="text-xs font-bold text-slate-500 uppercase flex items-center gap-2 mb-3"><i class="fas fa-wallet text-blue-600"></i> PENDAPATAN EST.</p>
                <h3 class="text-3xl font-extrabold text-slate-900 mb-2">Rp 45.2M</h3>
                <p class="text-xs font-medium text-slate-400">Total bulan ini</p>
            </div>
        </div>

        {{-- Card 4 --}}
        <div class="bg-red-50 p-6 rounded-2xl shadow-sm border border-red-100 relative overflow-hidden">
            <i class="fas fa-clipboard-check text-red-100 text-6xl absolute -right-2 -top-2 z-0 opacity-50"></i>
            <div class="relative z-10">
                <p class="text-xs font-bold text-red-500 uppercase flex items-center gap-2 mb-3"><i class="fas fa-clipboard-check"></i> PENDING REVIEW</p>
                <h3 class="text-4xl font-extrabold text-red-600 mb-2">3</h3>
                <a href="{{ route('admin.bookings.index') }}" class="text-xs font-bold text-red-600 hover:underline inline-block">Lihat detail &rarr;</a>
            </div>
        </div>
    </div>

    {{-- Charts & Recent Bookings --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex flex-col justify-between">
            <div class="flex justify-between items-center mb-6">
                <h3 class="font-bold text-slate-900">Tren Pemesanan Mingguan</h3>
                <button class="text-slate-400 hover:text-slate-600"><i class="fas fa-ellipsis-h"></i></button>
            </div>
            {{-- Dummy Bar Chart --}}
            <div class="flex items-end justify-between h-48 gap-2 bg-slate-50 p-4 rounded-xl border border-slate-100">
                <div class="w-full bg-blue-300 rounded-t-md h-[30%] hover:bg-blue-600 transition-colors"></div>
                <div class="w-full bg-blue-400 rounded-t-md h-[50%] hover:bg-blue-600 transition-colors"></div>
                <div class="w-full bg-blue-500 rounded-t-md h-[70%] hover:bg-blue-600 transition-colors"></div>
                <div class="w-full bg-blue-700 rounded-t-md h-[100%] hover:bg-blue-800 transition-colors"></div>
                <div class="w-full bg-blue-300 rounded-t-md h-[40%] hover:bg-blue-600 transition-colors"></div>
                <div class="w-full bg-blue-200 rounded-t-md h-[20%] hover:bg-blue-600 transition-colors"></div>
                <div class="w-full bg-blue-200 rounded-t-md h-[25%] hover:bg-blue-600 transition-colors"></div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
            <div class="flex justify-between items-center mb-6">
                <h3 class="font-bold text-slate-900">Booking Terbaru</h3>
                <a href="{{ route('admin.bookings.index') }}" class="text-xs font-bold text-blue-600 hover:underline">Lihat Semua</a>
            </div>
            <div class="space-y-4">
                {{-- Item --}}
                <div class="flex items-center justify-between p-3 border border-slate-100 rounded-xl hover:bg-slate-50 transition-colors">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-slate-200 text-slate-500 rounded-full flex items-center justify-center"><i class="fas fa-user"></i></div>
                        <div>
                            <p class="text-sm font-bold text-slate-900">Budi Santoso</p>
                            <p class="text-xs text-slate-500">Bali Getaway - 2 Pax</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <span class="px-2 py-1 bg-green-100 text-green-700 rounded text-[10px] font-bold">CONFIRMED</span>
                        <p class="text-[10px] text-slate-400 mt-1">2 jam lalu</p>
                    </div>
                </div>
                {{-- Item --}}
                <div class="flex items-center justify-between p-3 border border-slate-100 rounded-xl hover:bg-slate-50 transition-colors">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-slate-200 text-slate-500 rounded-full flex items-center justify-center"><i class="fas fa-user"></i></div>
                        <div>
                            <p class="text-sm font-bold text-slate-900">Siti Aminah</p>
                            <p class="text-xs text-slate-500">Lombok Explorer - 4 Pax</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <span class="px-2 py-1 bg-yellow-100 text-yellow-700 rounded text-[10px] font-bold">PENDING</span>
                        <p class="text-[10px] text-slate-400 mt-1">5 jam lalu</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection