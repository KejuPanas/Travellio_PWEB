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
                <p class="text-xs font-bold text-blue-200 uppercase tracking-wider mb-1">TOTAL TAGIHAN TUNAI HARI INI</p>
                <h2 class="text-4xl font-extrabold mb-1">Rp 4.500.000</h2>
                <p class="text-sm text-blue-100"><i class="fas fa-arrow-trend-up"></i> Dari 8 booking terkonfirmasi</p>
            </div>
            <div class="w-16 h-16 bg-blue-500/50 rounded-2xl flex items-center justify-center text-3xl backdrop-blur-sm relative z-10">
                <i class="fas fa-wallet"></i>
            </div>
        </div>
        
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex flex-col justify-center">
            <div class="w-10 h-10 bg-green-100 text-green-600 rounded-full flex items-center justify-center mb-3"><i class="fas fa-user-check"></i></div>
            <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">SIAP DITAGIH</p>
            <h3 class="text-2xl font-bold text-slate-900">8 Rombongan</h3>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex flex-col justify-center">
            <div class="w-10 h-10 bg-amber-100 text-amber-600 rounded-full flex items-center justify-center mb-3"><i class="fas fa-map-marker-alt"></i></div>
            <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">MEETING POINTS</p>
            <h3 class="text-2xl font-bold text-slate-900">3 Lokasi Aktif</h3>
        </div>
    </div>

    {{-- Table Tagihan --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="p-6 border-b border-slate-100 flex flex-col sm:flex-row justify-between items-center gap-4">
            <h3 class="text-lg font-bold text-slate-900">Daftar Tagihan Tunai</h3>
            <div class="flex gap-2 w-full sm:w-auto">
                <div class="relative w-full sm:w-64">
                    <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-slate-400"></i>
                    <input type="text" placeholder="Cari ID atau Nama..." class="w-full pl-9 pr-4 py-2 border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-blue-600 outline-none">
                </div>
                <button class="px-3 py-2 border border-slate-200 rounded-lg text-slate-500 hover:bg-slate-50"><i class="fas fa-filter"></i></button>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-slate-50 border-b border-slate-100 text-xs font-bold text-slate-500 uppercase tracking-wider">
                    <tr>
                        <th class="p-4 px-6">ID Booking</th>
                        <th class="p-4">Pelanggan</th>
                        <th class="p-4">Paket & Lokasi Meeting</th>
                        <th class="p-4">Total Tagihan</th>
                        <th class="p-4 px-6 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    {{-- Row 1 --}}
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="p-4 px-6">
                            <p class="font-bold text-blue-600">#VE-8892</p>
                            <p class="text-[10px] font-extrabold text-green-600 mt-1 tracking-wider"><i class="fas fa-circle text-[8px]"></i> TERKONFIRMASI</p>
                        </td>
                        <td class="p-4">
                            <p class="font-bold text-slate-900">Budi Santoso</p>
                            <p class="text-xs text-slate-500">0812-3456-7890</p>
                            <p class="text-xs text-slate-500">4 Orang</p>
                        </td>
                        <td class="p-4">
                            <p class="font-bold text-slate-900">Paket Snorkeling Nusa Penida</p>
                            <p class="text-xs text-slate-500 mt-0.5"><i class="fas fa-map-marker-alt"></i> Pelabuhan Sanur (07:30 WITA)</p>
                        </td>
                        <td class="p-4">
                            <p class="font-bold text-slate-900 text-base">Rp 1.200.000</p>
                            <p class="text-xs text-slate-400 mt-0.5">Belum Dibayar</p>
                        </td>
                        <td class="p-4 px-6 text-right">
                            <form action="#" method="POST">
                                @csrf @method('PATCH')
                                <button type="submit" class="bg-green-700 hover:bg-green-800 text-white px-4 py-2 rounded-lg text-xs font-bold shadow-sm transition-colors flex items-center gap-2 justify-end ml-auto">
                                    <i class="fas fa-check-circle"></i> Tandai Sudah Bayar
                                </button>
                            </form>
                        </td>
                    </tr>
                    
                    {{-- Row 2 --}}
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="p-4 px-6">
                            <p class="font-bold text-blue-600">#VE-8895</p>
                            <p class="text-[10px] font-extrabold text-green-600 mt-1 tracking-wider"><i class="fas fa-circle text-[8px]"></i> TERKONFIRMASI</p>
                        </td>
                        <td class="p-4">
                            <p class="font-bold text-slate-900">Siti Rahma</p>
                            <p class="text-xs text-slate-500">0856-7890-1234</p>
                            <p class="text-xs text-slate-500">2 Orang</p>
                        </td>
                        <td class="p-4">
                            <p class="font-bold text-slate-900">Ubud Cultural Tour</p>
                            <p class="text-xs text-slate-500 mt-0.5"><i class="fas fa-map-marker-alt"></i> Monkey Forest Gate (09:00 WITA)</p>
                        </td>
                        <td class="p-4">
                            <p class="font-bold text-slate-900 text-base">Rp 800.000</p>
                            <p class="text-xs text-slate-400 mt-0.5">Belum Dibayar</p>
                        </td>
                        <td class="p-4 px-6 text-right">
                            <form action="#" method="POST">
                                @csrf @method('PATCH')
                                <button type="submit" class="bg-green-700 hover:bg-green-800 text-white px-4 py-2 rounded-lg text-xs font-bold shadow-sm transition-colors flex items-center gap-2 justify-end ml-auto">
                                    <i class="fas fa-check-circle"></i> Tandai Sudah Bayar
                                </button>
                            </form>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        {{-- Pagination Placeholder --}}
        <div class="p-4 border-t border-slate-100 flex justify-between items-center text-sm text-slate-500 bg-slate-50/50">
            <span>Menampilkan 1-3 dari 8 booking</span>
            <div class="flex gap-1">
                <button class="px-3 py-1 border border-slate-200 rounded hover:bg-slate-50 bg-white">&lt;</button>
                <button class="px-3 py-1 bg-blue-700 text-white rounded">1</button>
                <button class="px-3 py-1 border border-slate-200 rounded hover:bg-slate-50 bg-white">2</button>
                <button class="px-3 py-1 border border-slate-200 rounded hover:bg-slate-50 bg-white">&gt;</button>
            </div>
        </div>
    </div>
</div>
@endsection