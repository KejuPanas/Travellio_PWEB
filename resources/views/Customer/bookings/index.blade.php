@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 font-['Plus_Jakarta_Sans']">
    
    <div class="flex justify-between items-end mb-6">
        <div>
            <h1 class="text-3xl font-bold text-slate-900">Riwayat Pemesanan</h1>
            <p class="text-slate-500 mt-1">Kelola dan pantau semua rencana perjalanan Anda.</p>
        </div>
    </div>

    {{-- Tabs Status --}}
    <div class="flex gap-2 mb-6 overflow-x-auto pb-2">
        <button class="bg-blue-700 text-white px-5 py-2 rounded-full text-sm font-bold shadow-sm whitespace-nowrap">Semua (4)</button>
        <button class="bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 px-5 py-2 rounded-full text-sm font-bold whitespace-nowrap">Pending (1)</button>
        <button class="bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 px-5 py-2 rounded-full text-sm font-bold whitespace-nowrap">Konfirmasi (2)</button>
        <button class="bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 px-5 py-2 rounded-full text-sm font-bold whitespace-nowrap">Selesai (1)</button>
    </div>

    {{-- Tabel Riwayat --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden mb-8">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse min-w-[800px]">
                <thead class="bg-slate-50">
                    <tr class="text-slate-500 text-xs uppercase tracking-wider">
                        <th class="p-4 font-bold">Destinasi & ID</th>
                        <th class="p-4 font-bold">Tanggal</th>
                        <th class="p-4 font-bold">Status</th>
                        <th class="p-4 font-bold">Total Harga</th>
                        <th class="p-4 font-bold text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-sm divide-y divide-slate-100">
                    
                    {{-- Row: Pending --}}
                    <tr class="hover:bg-slate-50 transition">
                        <td class="p-4 flex items-center gap-4">
                            <div class="w-10 h-10 bg-blue-50 text-blue-600 rounded-lg flex items-center justify-center"><i class="fas fa-plane-departure"></i></div>
                            <div>
                                <p class="font-bold text-slate-900">Liburan Bali - Seminyak</p>
                                <p class="text-xs text-slate-400">#VE-90123-ID</p>
                            </div>
                        </td>
                        <td class="p-4 text-slate-600">15 Okt - 20 Okt 2024</td>
                        <td class="p-4"><span class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs font-bold">Menunggu</span></td>
                        <td class="p-4 font-bold text-slate-900">Rp 12.500.000</td>
                        <td class="p-4 text-center">
                            <a href="#" class="text-blue-600 hover:text-blue-800 bg-blue-50 p-2 rounded-lg"><i class="fas fa-eye"></i></a>
                        </td>
                    </tr>

                                        <tr class="hover:bg-slate-50 transition">
                        <td class="p-4 flex items-center gap-4">
                            <div class="w-10 h-10 bg-blue-50 text-blue-600 rounded-lg flex items-center justify-center"><i class="fas fa-plane-departure"></i></div>
                            <div>
                                <p class="font-bold text-slate-900">Liburan Bali - Seminyak</p>
                                <p class="text-xs text-slate-400">#VE-90123-ID</p>
                            </div>
                        </td>
                        <td class="p-4 text-slate-600">15 Okt - 20 Okt 2024</td>
                        <td class="p-4"><span class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs font-bold">Menunggu</span></td>
                        <td class="p-4 font-bold text-slate-900">Rp 12.500.000</td>
                        <td class="p-4 text-center">
                            <a href="#" class="text-blue-600 hover:text-blue-800 bg-blue-50 p-2 rounded-lg"><i class="fas fa-eye"></i></a>
                        </td>
                    </tr>

                                        <tr class="hover:bg-slate-50 transition">
                        <td class="p-4 flex items-center gap-4">
                            <div class="w-10 h-10 bg-blue-50 text-blue-600 rounded-lg flex items-center justify-center"><i class="fas fa-plane-departure"></i></div>
                            <div>
                                <p class="font-bold text-slate-900">Liburan Bali - Seminyak</p>
                                <p class="text-xs text-slate-400">#VE-90123-ID</p>
                            </div>
                        </td>
                        <td class="p-4 text-slate-600">15 Okt - 20 Okt 2024</td>
                        <td class="p-4"><span class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs font-bold">Menunggu</span></td>
                        <td class="p-4 font-bold text-slate-900">Rp 12.500.000</td>
                        <td class="p-4 text-center">
                            <a href="#" class="text-blue-600 hover:text-blue-800 bg-blue-50 p-2 rounded-lg"><i class="fas fa-eye"></i></a>
                        </td>
                    </tr>

                                        <tr class="hover:bg-slate-50 transition">
                        <td class="p-4 flex items-center gap-4">
                            <div class="w-10 h-10 bg-blue-50 text-blue-600 rounded-lg flex items-center justify-center"><i class="fas fa-plane-departure"></i></div>
                            <div>
                                <p class="font-bold text-slate-900">Liburan Bali - Seminyak</p>
                                <p class="text-xs text-slate-400">#VE-90123-ID</p>
                            </div>
                        </td>
                        <td class="p-4 text-slate-600">15 Okt - 20 Okt 2024</td>
                        <td class="p-4"><span class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs font-bold">Menunggu</span></td>
                        <td class="p-4 font-bold text-slate-900">Rp 12.500.000</td>
                        <td class="p-4 text-center">
                            <a href="#" class="text-blue-600 hover:text-blue-800 bg-blue-50 p-2 rounded-lg"><i class="fas fa-eye"></i></a>
                        </td>
                    </tr>

                                        <tr class="hover:bg-slate-50 transition">
                        <td class="p-4 flex items-center gap-4">
                            <div class="w-10 h-10 bg-blue-50 text-blue-600 rounded-lg flex items-center justify-center"><i class="fas fa-plane-departure"></i></div>
                            <div>
                                <p class="font-bold text-slate-900">Liburan Bali - Seminyak</p>
                                <p class="text-xs text-slate-400">#VE-90123-ID</p>
                            </div>
                        </td>
                        <td class="p-4 text-slate-600">15 Okt - 20 Okt 2024</td>
                        <td class="p-4"><span class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs font-bold">Menunggu</span></td>
                        <td class="p-4 font-bold text-slate-900">Rp 12.500.000</td>
                        <td class="p-4 text-center">
                            <a href="#" class="text-blue-600 hover:text-blue-800 bg-blue-50 p-2 rounded-lg"><i class="fas fa-eye"></i></a>
                        </td>
                    </tr>

                    {{-- Row: Konfirmasi --}}
                    <tr class="hover:bg-slate-50 transition">
                        <td class="p-4 flex items-center gap-4">
                            <div class="w-10 h-10 bg-green-50 text-green-600 rounded-lg flex items-center justify-center"><i class="fas fa-map-marked-alt"></i></div>
                            <div>
                                <p class="font-bold text-slate-900">Petualangan Raja Ampat</p>
                                <p class="text-xs text-slate-400">#VE-88421-ID</p>
                            </div>
                        </td>
                        <td class="p-4 text-slate-600">02 Des - 10 Des 2024</td>
                        <td class="p-4"><span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-bold">Terkonfirmasi</span></td>
                        <td class="p-4 font-bold text-slate-900">Rp 25.750.000</td>
                        <td class="p-4 text-center">
                            <a href="#" class="text-blue-600 hover:text-blue-800 bg-blue-50 p-2 rounded-lg"><i class="fas fa-eye"></i></a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection