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
            <div class="relative w-full md:w-80">
                <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-slate-400"></i>
                <input type="text" placeholder="Cari Nama atau ID Booking..." class="w-full pl-9 pr-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-blue-600 outline-none shadow-sm">
            </div>
        </div>

        {{-- Tabs --}}
        <div class="px-6 flex gap-6 border-b border-slate-100 text-sm font-bold text-slate-500 overflow-x-auto">
            <button class="py-4 border-b-2 border-blue-600 text-blue-700 whitespace-nowrap">Semua</button>
            <button class="py-4 hover:text-slate-800 whitespace-nowrap">Pending</button>
            <button class="py-4 hover:text-slate-800 whitespace-nowrap">Dikonfirmasi</button>
            <button class="py-4 hover:text-slate-800 whitespace-nowrap">Berlangsung</button>
            <button class="py-4 hover:text-slate-800 whitespace-nowrap">Selesai</button>
            <button class="py-4 hover:text-slate-800 whitespace-nowrap">Ditolak</button>
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
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="p-4 px-6 font-bold text-slate-900">#TRV-2023-1042</td>
                        <td class="p-4 flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-blue-600 text-white flex justify-center items-center font-bold text-xs">B</div>
                            <span class="font-medium text-slate-700">Budi Santoso</span>
                        </td>
                        <td class="p-4 text-slate-600">Eksplorasi Bali 3H2M</td>
                        <td class="p-4 text-slate-600">15 Nov 2023</td>
                        <td class="p-4"><span class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full text-[10px] font-extrabold tracking-wider">PENDING</span></td>
                        <td class="p-4 px-6 text-right">
                            <a href="{{ route('admin.bookings.show', 1) }}" class="border border-slate-200 text-blue-600 hover:bg-blue-50 px-4 py-1.5 rounded-lg text-xs font-bold transition-colors inline-block">Lihat Detail</a>
                        </td>
                    </tr>
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="p-4 px-6 font-bold text-slate-900">#TRV-2023-1041</td>
                        <td class="p-4 flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-green-400 text-white flex justify-center items-center font-bold text-xs">S</div>
                            <span class="font-medium text-slate-700">Siti Rahmawati</span>
                        </td>
                        <td class="p-4 text-slate-600">Bromo Sunrise Tour</td>
                        <td class="p-4 text-slate-600">20 Nov 2023</td>
                        <td class="p-4"><span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-[10px] font-extrabold tracking-wider">DIKONFIRMASI</span></td>
                        <td class="p-4 px-6 text-right">
                            <a href="{{ route('admin.bookings.show', 2) }}" class="border border-slate-200 text-blue-600 hover:bg-blue-50 px-4 py-1.5 rounded-lg text-xs font-bold transition-colors inline-block">Lihat Detail</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection 